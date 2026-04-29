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
// Last modified 21/jul/2012 by cassio@ime.usp.br
ob_start();
header ("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-Type: text/html; charset=utf-8");
require_once(__DIR__ . '/../private/boca_session.php');
boca_session_start();
ob_end_flush();
require_once(__DIR__ . '/../versionnum.php');
require_once("../globals.php");
require_once("../db.php");
require_once(__DIR__ . '/../private/boca_tailwind.php');
$runteam = 'run.php';

if (!ValidSession()) {
	InvalidSession("team/index.php");
	ForceLoad("../index.php");
}
if ($_SESSION["usertable"]["usertype"] != "team") {
	IntrusionNotify("team/index.php");
	ForceLoad("../index.php");
}

$balloonHtml = '';
$ds = DIRECTORY_SEPARATOR;
if ($ds == "") {
	$ds = "/";
}

$runtmp = $_SESSION["locr"] . $ds . "private" . $ds . "runtmp" . $ds . "run-contest" . $_SESSION["usertable"]["contestnumber"] .
	"-site" . $_SESSION["usertable"]["usersitenumber"] . "-user" . $_SESSION["usertable"]["usernumber"] . ".php";
$doslow = true;
if (file_exists($runtmp)) {
	if (($strtmp = file_get_contents($runtmp, false, null, 0, 1000000)) !== false) {
		$postab = strpos($strtmp, "\t");
		$conf = globalconf();
		if (isset($conf['doenc']) && $conf['doenc']) {
			$strcolors = decryptData(substr($strtmp, $postab + 1, strpos($strtmp, "\n") - $postab - 1), $conf['key'], '');
		} else {
			$strcolors = substr($strtmp, $postab + 1, strpos($strtmp, "\n") - $postab - 1);
		}
		$doslow = false;
		$rn = explode("\t", $strcolors);
		$n = count($rn);
		for ($i = 1; $i < $n - 1; $i++) {
			$balloonHtml .= "<img alt=\"" . htmlspecialchars($rn[$i]) . "\" width=\"10\" " .
				"src=\"" . balloonurl($rn[$i + 1]) . "\" class=\"inline-block\" />\n";
			$i++;
		}
	} else {
		unset($strtmp);
	}
}
if ($doslow) {
	$run = DBUserRunsYES($_SESSION["usertable"]["contestnumber"],
		$_SESSION["usertable"]["usersitenumber"],
		$_SESSION["usertable"]["usernumber"]);
	$n = count($run);
	for ($i = 0; $i < $n; $i++) {
		$balloonHtml .= "<img alt=\"" . htmlspecialchars($run[$i]["colorname"]) . "\" width=\"10\" " .
			"src=\"" . balloonurl($run[$i]["color"]) . "\" class=\"inline-block\" />\n";
	}
}

if (!isset($_SESSION["popuptime"]) || $_SESSION["popuptime"] < time() - 120) {
	$_SESSION["popuptime"] = time();

	if (($st = DBSiteInfo($_SESSION["usertable"]["contestnumber"], $_SESSION["usertable"]["usersitenumber"])) != null) {
		$clar = DBUserClars($_SESSION["usertable"]["contestnumber"],
			$_SESSION["usertable"]["usersitenumber"],
			$_SESSION["usertable"]["usernumber"]);
		for ($i = 0; $i < count($clar); $i++) {
			if ($clar[$i]["anstime"] > $_SESSION["usertable"]["userlastlogin"] - $st["sitestartdate"] &&
				$clar[$i]["anstime"] < $st['siteduration'] &&
				trim($clar[$i]["answer"]) != '' && !isset($_SESSION["popups"]['clar' . $i . '-' . $clar[$i]["anstime"]])) {
				$_SESSION["popups"]['clar' . $i . '-' . $clar[$i]["anstime"]] = "(Clar for problem " . $clar[$i]["problem"] . " answered)\n";
			}
		}
		$run = DBUserRuns($_SESSION["usertable"]["contestnumber"],
			$_SESSION["usertable"]["usersitenumber"],
			$_SESSION["usertable"]["usernumber"]);
		for ($i = 0; $i < count($run); $i++) {
			if ($run[$i]["anstime"] > $_SESSION["usertable"]["userlastlogin"] - $st["sitestartdate"] &&
				$run[$i]["anstime"] < $st['sitelastmileanswer'] &&
				$run[$i]["ansfake"] != "t" && !isset($_SESSION["popups"]['run' . $i . '-' . $run[$i]["anstime"]])) {
				$_SESSION["popups"]['run' . $i . '-' . $run[$i]["anstime"]] = "(Run " . $run[$i]["number"] . " result: " . $run[$i]["answer"] . ')\n';
			}
		}
	}

	$str = '';
	if (isset($_SESSION["popups"])) {
		foreach ($_SESSION["popups"] as $key => $value) {
			if ($value != '') {
				$str .= $value;
				$_SESSION["popups"][$key] = '';
			}
		}
		if ($str != '') {
			MSGError('YOU GOT NEWS:\n' . $str . '\n');
		}
	}
}

list($clockstr, $clocktype) = siteclock();
$self = basename($_SERVER['SCRIPT_NAME'] ?? '');
$runAct = in_array($self, ['run.php', 'runview.php'], true);
$clarAct = in_array($self, ['clar.php'], true);
?>
<!DOCTYPE html>
<html class="dark" lang="es">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>BOCA — Team<?php echo isset($BOCAVERSION) ? ' ' . htmlspecialchars($BOCAVERSION) : ''; ?></title>
<?php boca_tailwind_print_head_assets(); ?>
<script src="../reload.js"></script>
</head>
<body class="boca-app-ui bg-surface font-body text-on-background min-h-screen selection:bg-primary selection:text-on-primary pt-[7.25rem] md:pt-24 px-3 md:px-8 pb-10" onload="Comecar()" onunload="Parar()">
<header class="fixed top-0 left-0 right-0 z-50 border-b border-outline-variant/30 bg-[#060e20]/95 backdrop-blur-md shadow-lg shadow-black/20">
  <div class="flex min-h-[3.5rem] flex-wrap items-center justify-between gap-3 px-4 py-2 md:px-6">
    <div class="flex min-w-0 items-center gap-3">
      <img src="../images/smallballoontransp.png" alt="" class="h-8 w-8 shrink-0 opacity-90"/>
      <div class="min-w-0">
        <div class="truncate text-sm font-black tracking-tight text-on-surface md:text-base">BOCA</div>
        <div class="truncate text-[10px] font-semibold uppercase tracking-widest text-on-surface-variant">Team</div>
      </div>
    </div>
    <div class="flex min-w-0 flex-1 flex-wrap items-center justify-center gap-2 px-2 text-xs text-on-surface md:text-sm">
      <span class="font-semibold"><?php echo htmlspecialchars($_SESSION["usertable"]["username"]); ?></span>
      <span class="text-on-surface-variant">·</span>
      <span class="text-on-surface-variant">site <?php echo (int)$_SESSION["usertable"]["usersitenumber"]; ?></span>
      <?php if ($balloonHtml !== '') { ?>
      <span class="flex flex-wrap items-center gap-1"><?php echo $balloonHtml; ?></span>
      <?php } ?>
    </div>
    <div class="shrink-0 text-[10px] font-semibold uppercase tracking-wide text-primary md:text-sm">
      <?php echo htmlspecialchars($clockstr); ?>
    </div>
  </div>
  <nav class="flex flex-wrap items-center gap-1 border-t border-outline-variant/25 bg-[#0b1426]/95 px-2 py-2 md:gap-2 md:px-4">
<?php
boca_tailwind_nav_pill('problem.php', 'Problems', $self === 'problem.php');
boca_tailwind_nav_pill('run.php', 'Runs', $runAct);
boca_tailwind_nav_pill('score.php', 'Score', $self === 'score.php');
boca_tailwind_nav_pill('clar.php', 'Clarifications', $clarAct);
boca_tailwind_nav_pill('task.php', 'Tasks', $self === 'task.php');
boca_tailwind_nav_pill('files.php', 'Backups', $self === 'files.php');
boca_tailwind_nav_pill('option.php', 'Options', $self === 'option.php');
boca_tailwind_nav_pill('../index.php?logout=1', 'Logout', false);
?>
  </nav>
</header>
