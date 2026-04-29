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
// Last modified 19/oct/2017 by cassio@ime.usp.br

ob_start();
header ("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-Type: text/html; charset=utf-8");
require_once(__DIR__ . '/../private/boca_session.php');
boca_session_start();
if (!isset($_POST['noflush'])) {
	ob_end_flush();
}
$loc = $locr = "..";
$runphp = "run.php";
$runeditphp = "runedit.php";

require_once("$locr/globals.php");
require_once("$locr/db.php");
require_once("$locr/private/boca_tailwind.php");
require_once("$locr/versionnum.php");

if (!ValidSession()) {
	InvalidSession("admin/index.php");
	ForceLoad("$loc/index.php");
}
if ($_SESSION["usertable"]["usertype"] != "admin") {
	IntrusionNotify("admin/index.php");
	ForceLoad("$loc/index.php");
}

if (!isset($_POST['noflush'])) {
	list($clockstr, $clocktype) = siteclock();
	$self = basename($_SERVER['SCRIPT_NAME'] ?? '');
	$sn = $_SERVER['SCRIPT_NAME'] ?? '';
	$inReport = (strpos($sn, '/report/') !== false);
	$runAct = in_array($self, ['run.php', 'runedit.php'], true);
	$clarAct = in_array($self, ['clar.php', 'claredit.php'], true);
	?>
<!DOCTYPE html>
<html class="dark" lang="es">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>BOCA — Admin<?php echo isset($BOCAVERSION) ? ' ' . htmlspecialchars($BOCAVERSION) : ''; ?></title>
<?php
if ((isset($_GET["Submit1"]) && $_GET["Submit1"] == "Transfer") ||
    (isset($_GET["Submit3"]) && $_GET["Submit3"] == "Transfer scores")) {
	echo "<meta http-equiv=\"refresh\" content=\"60\" />\n";
}
boca_tailwind_print_head_assets();
?>
</head>
<body id="body" class="boca-app-ui bg-surface font-body text-on-background min-h-screen selection:bg-primary selection:text-on-primary pt-[7.25rem] md:pt-24 px-3 md:px-8 pb-10">
<header class="fixed top-0 left-0 right-0 z-50 border-b border-outline-variant/30 bg-[#060e20]/95 backdrop-blur-md shadow-lg shadow-black/20">
  <div class="flex h-14 items-center justify-between gap-3 px-4 md:px-6">
    <div class="flex min-w-0 items-center gap-3">
      <img src="../images/smallballoontransp.png" alt="" class="h-8 w-8 shrink-0 opacity-90"/>
      <div class="min-w-0">
        <div class="truncate text-sm font-black tracking-tight text-on-surface md:text-base">BOCA</div>
        <div class="truncate text-[10px] font-semibold uppercase tracking-widest text-on-surface-variant">Admin</div>
      </div>
    </div>
    <div class="text-center text-[10px] font-semibold uppercase tracking-wide text-primary md:text-sm">
      <?php echo htmlspecialchars($clockstr); ?>
    </div>
    <div class="flex max-w-[55%] flex-col items-end text-right md:max-w-none">
      <span class="truncate text-xs font-semibold text-on-surface md:text-sm"><?php echo htmlspecialchars($_SESSION["usertable"]["username"]); ?></span>
      <span class="text-[10px] uppercase tracking-wider text-on-surface-variant">site <?php echo (int)$_SESSION["usertable"]["usersitenumber"]; ?></span>
    </div>
  </div>
  <nav class="flex flex-wrap items-center gap-1 border-t border-outline-variant/25 bg-[#0b1426]/95 px-2 py-2 md:gap-2 md:px-4">
<?php
boca_tailwind_nav_pill('run.php', 'Runs', $runAct);
boca_tailwind_nav_pill('score.php', 'Score', $self === 'score.php');
boca_tailwind_nav_pill('clar.php', 'Clarifications', $clarAct);
boca_tailwind_nav_pill('user.php', 'Users', $self === 'user.php');
boca_tailwind_nav_pill('problem.php', 'Problems', $self === 'problem.php');
boca_tailwind_nav_pill('language.php', 'Languages', $self === 'language.php');
boca_tailwind_nav_pill('answer.php', 'Answers', $self === 'answer.php');
boca_tailwind_nav_pill('misc.php', 'Misc', $self === 'misc.php');
boca_tailwind_nav_pill('task.php', 'Tasks', $self === 'task.php');
boca_tailwind_nav_pill('site.php', 'Site', $self === 'site.php');
boca_tailwind_nav_pill('contest.php', 'Contest', $self === 'contest.php');
boca_tailwind_nav_pill('log.php', 'Logs', $self === 'log.php');
boca_tailwind_nav_pill('report.php', 'Reports', $self === 'report.php' || $inReport);
boca_tailwind_nav_pill('files.php', 'Backups', $self === 'files.php');
boca_tailwind_nav_pill('option.php', 'Options', $self === 'option.php');
boca_tailwind_nav_pill($loc . '/index.php?logout=1', 'Logout', false);
?>
  </nav>
</header>
<?php
}
?>
