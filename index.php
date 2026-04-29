<?php
////////////////////////////////////////////////////////////////////////////////
//BOCA Online Contest Administrator
//    Copyright (C) 2003-2012 by BOCA Development Team (bocasystem@gmail.com)
//
//    This program is free software: you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation, either version 3 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//    You should have received a copy of the GNU General Public License
//    along with this program.  If not, see <http://www.gnu.org/licenses/>.
////////////////////////////////////////////////////////////////////////////////
// Last modified 05/aug/2012 by cassio@ime.usp.br

ob_start();
header ("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-Type: text/html; charset=utf-8");
require_once(__DIR__ . '/private/boca_session.php');
boca_session_start();
$_SESSION["loc"] = dirname($_SERVER['PHP_SELF']);
if($_SESSION["loc"]=="/") $_SESSION["loc"] = "";
$_SESSION["locr"] = dirname(__FILE__);
if($_SESSION["locr"]=="/") $_SESSION["locr"] = "";

require_once("globals.php");
require_once("db.php");

if (!isset($_GET["name"])) {
	// Do not wipe an active session just by opening the login URL (fixes false logouts with multiple tabs / bookmarks).
	if (ValidSession() && !isset($_GET["logout"]) && !isset($_GET["login"])) {
		header('Location: ' . $_SESSION["usertable"]["usertype"] . '/index.php');
		exit;
	}
	if (ValidSession())
	  DBLogOut($_SESSION["usertable"]["contestnumber"], 
		   $_SESSION["usertable"]["usersitenumber"], $_SESSION["usertable"]["usernumber"],
		   $_SESSION["usertable"]["username"]=='admin');
	session_unset();
	session_destroy();
	boca_session_start();
	$_SESSION["loc"] = dirname($_SERVER['PHP_SELF']);
	if($_SESSION["loc"]=="/") $_SESSION["loc"] = "";
	$_SESSION["locr"] = dirname(__FILE__);
	if($_SESSION["locr"]=="/") $_SESSION["locr"] = "";
}
if(isset($_GET["getsessionid"])) {
	echo session_id();
	exit;
}

$coo = array();
if(isset($_COOKIE['biscoitobocabombonera'])) {
  $coo = explode('-',$_COOKIE['biscoitobocabombonera']);
  if(count($coo) != 2 ||
     strlen($coo[1])!=strlen(myhash('xxx')) ||
     !is_numeric($coo[0]) ||
     !ctype_alnum($coo[1]))
    $coo = array();
}
if(count($coo) != 2)
  setcookie('biscoitobocabombonera',time() . '-' . myhash(time() . rand() . time() . rand()),time() + 240*3600);

ob_end_flush();

require_once(__DIR__ . '/versionnum.php');
require_once(__DIR__ . '/private/boca_tailwind.php');

?>
<!DOCTYPE html>
<html class="dark" lang="es">
<head>
<meta charset="utf-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BOCA <?php echo htmlspecialchars($BOCAVERSION); ?> — Login</title>
<?php boca_tailwind_print_head_assets(); ?>
<script src="sha256.js"></script>
<script language="JavaScript">
function computeHASH()
{
	var userHASH, passHASH;
	userHASH = document.form1.name.value;
	passHASH = js_myhash(js_myhash(document.form1.password.value)+'<?php echo session_id(); ?>');
	document.form1.name.value = '';
	document.form1.password.value = '                                                                                 ';
	document.location = 'index.php?name='+userHASH+'&password='+passHASH;
}
</script>
<?php
if(function_exists("globalconf") && function_exists("sanitizeVariables")) {
  if(isset($_GET["name"]) && $_GET["name"] != "" ) {
	$name = $_GET["name"];
	$password = $_GET["password"];
	$usertable = DBLogIn($name, $password);
	if(!$usertable) {
		ForceLoad("index.php");
	}
	else {
		if(($ct = DBContestInfo($_SESSION["usertable"]["contestnumber"])) == null)
			ForceLoad("index.php");
		if($ct["contestlocalsite"]==$ct["contestmainsite"]) $main=true; else $main=false;
		if(isset($_GET['action']) && $_GET['action'] == 'transfer') {
			echo "TRANSFER OK";
		} else {
			if($main && $_SESSION["usertable"]["usertype"] == 'site') {
				MSGError('Direct login of this user is not allowed');
				unset($_SESSION["usertable"]);
				ForceLoad("index.php");
				exit;
			}
			echo "<script language=\"JavaScript\">\n";
			echo "document.location='" . $_SESSION["usertable"]["usertype"] . "/index.php';\n";
			echo "</script>\n";
		}
		exit;
	}
  }
} else {
  echo "<script language=\"JavaScript\">\n";
  echo "alert('Unable to load config files. Possible file permission problem in the BOCA directory.');\n";
  echo "</script>\n";
}
?>
</head>
<body class="min-h-screen flex flex-col items-center justify-center tonal-layering-bg selection:bg-primary selection:text-on-primary text-on-background font-body" onload="document.form1.name.focus()">
<main class="w-full max-w-md px-6 py-12 relative z-10">
<div class="mb-10 text-center">
  <div class="inline-flex items-center justify-center mb-5">
    <div class="w-12 h-12 bg-primary-container rounded-xl flex items-center justify-center shadow-lg shadow-black/30">
      <img src="images/smallballoontransp.png" alt="" class="h-7 w-7 opacity-90"/>
    </div>
  </div>
  <h1 class="text-3xl font-black tracking-tighter text-on-background mb-1">BOCA</h1>
  <p class="text-xs font-semibold uppercase tracking-widest text-on-surface-variant"><?php echo htmlspecialchars($BOCAVERSION); ?> — Online Contest Administrator</p>
</div>
<div class="glass-panel border border-outline-variant/20 rounded-xl p-8 shadow-2xl shadow-black/40">
  <div class="mb-6">
    <h2 class="text-lg font-bold text-on-surface">Login</h2>
    <div class="h-1 w-8 bg-primary mt-2 rounded-full"></div>
  </div>
  <form name="form1" action="javascript:computeHASH()" class="space-y-5">
    <div class="space-y-2">
      <label class="block text-[0.6875rem] font-bold uppercase tracking-widest text-on-surface-variant" for="boca-user">Name</label>
      <input class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg py-3 px-4 focus:ring-1 focus:ring-primary placeholder:text-outline/40 transition-all" id="boca-user" type="text" name="name" autocomplete="username" placeholder="username"/>
    </div>
    <div class="space-y-2">
      <label class="block text-[0.6875rem] font-bold uppercase tracking-widest text-on-surface-variant" for="boca-pass">Password</label>
      <input class="w-full bg-surface-container-low border-0 text-on-surface rounded-lg py-3 px-4 focus:ring-1 focus:ring-primary placeholder:text-outline/40 transition-all" id="boca-pass" type="password" name="password" autocomplete="current-password" placeholder="••••••••"/>
    </div>
    <button class="primary-gradient w-full py-3.5 rounded-lg font-bold text-on-primary shadow-lg shadow-primary/10 hover:opacity-95 transition-all active:scale-[0.99] mt-2 flex items-center justify-center gap-2 boca-btn-plain" type="submit" name="Submit">
      Sign in
      <span class="material-symbols-outlined text-lg">login</span>
    </button>
  </form>
</div>
<?php
echo '<div class="mt-10 text-center text-[0.65rem] font-semibold uppercase tracking-wider text-on-secondary-fixed-variant opacity-80">';
echo 'Powered by BOCA ' . htmlspecialchars($BOCAVERSION) . ' · © 2003–' . htmlspecialchars($YEAR) . ' BOCA System';
echo '</div>';
?>
</main>
<div class="fixed top-0 left-0 w-full h-full pointer-events-none overflow-hidden -z-10" aria-hidden="true">
  <div class="absolute -top-[20%] -right-[10%] w-[60%] h-[60%] rounded-full bg-surface-container-highest/20 blur-[120px]"></div>
  <div class="absolute -bottom-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-primary-container/10 blur-[100px]"></div>
</div>
</body>
</html>
