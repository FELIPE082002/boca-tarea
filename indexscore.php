<?php
////////////////////////////////////////////////////////////////////////////////
//BOCA Online Contest Administrator
//    Copyright (C) 2003-2014 by BOCA Development Team (bocasystem@gmail.com)
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
// Last modified 06/nov/2014 by cassio@ime.usp.br

ob_start();
header ("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-Type: text/html; charset=utf-8");
session_start();
$_SESSION["loc"] = dirname($_SERVER['PHP_SELF']);
if($_SESSION["loc"]=="/") $_SESSION["loc"] = "";
$_SESSION["locr"] = dirname(__FILE__);
if($_SESSION["locr"]=="/") $_SESSION["locr"] = "";

require_once("globals.php");
require_once("db.php");

if (!isset($_GET["name"])) {
	if (ValidSession())
		DBLogOut($_SESSION["usertable"]["contestnumber"], 
				 $_SESSION["usertable"]["usersitenumber"], $_SESSION["usertable"]["usernumber"],
				 $_SESSION["usertable"]["username"]=='admin');
	session_unset();
	session_destroy();
	session_start();
	$_SESSION["loc"] = dirname($_SERVER['PHP_SELF']);
	if($_SESSION["loc"]=="/") $_SESSION["loc"] = "";
	$_SESSION["locr"] = dirname(__FILE__);
	if($_SESSION["locr"]=="/") $_SESSION["locr"] = "";
}
if(isset($_GET["getsessionid"])) {
	echo session_id();
	exit;
}
ob_end_flush();

require_once('version.php');

?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>BOCA Online Contest Administrator <?php echo $BOCAVERSION; ?> - Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel=stylesheet href="Css.php" type="text/css">
<script language="JavaScript" src="sha256.js"></script>
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
		if(isset($_GET['action']) && $_GET['action'] == 'scoretransfer') {
			echo "SCORETRANSFER OK";
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
<body class="boca-login" onload="document.form1.submit()">
<div class="boca-login-wrap">
      <form name="form1" action="javascript:computeHASH()">
        <div class="boca-login-card">
                <h1>BOCA Login</h1>
                <p class="boca-login-sub">Score transfer</p>
                <table border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr> 
                    <td><label for="boca-user-score">Name</label></td>
                    <td> 
                      <input id="boca-user-score" type="text" name="name" value="score" autocomplete="username">
                    </td>
                  </tr>
                  <tr> 
                    <td><label for="boca-pass-score">Password</label></td>
                    <td> 
                      <input id="boca-pass-score" type="password" name="password" value="score" autocomplete="current-password">
                    </td>
                  </tr>
                </table>
                <div class="boca-login-actions">
                <input type="submit" name="Submit" value="Login">
                </div>
        </div>
      </form>
</div>
<?php include('footnote.php'); ?>
