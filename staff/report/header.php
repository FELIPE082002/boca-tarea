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
require_once(__DIR__ . '/../../private/boca_session.php');
boca_session_start();
ob_end_flush();
$loc = $locr = "../..";

require_once($locr . '/versionnum.php');
require_once($locr . '/private/boca_tailwind.php');
require_once($locr . "/globals.php");
if (!ValidSession()) {
	InvalidSession($_SERVER['PHP_SELF']);
	ForceLoad($loc . "/index.php");
}
if ($_SESSION["usertable"]["usertype"] != "staff") {
	IntrusionNotify($_SERVER['PHP_SELF']);
	ForceLoad($loc . "/index.php");
}

require_once($locr . "/db.php");
require_once($locr . "/freport.php");

$contest = $_SESSION["usertable"]["contestnumber"];
if (($ct = DBContestInfo($contest)) == null) {
	ForceLoad($loc . "/index.php");
}
$site = $_SESSION["usertable"]["usersitenumber"];
if (($st = DBSiteInfo($contest, $site)) == null) {
	ForceLoad($loc . "/index.php");
}
?>
<!DOCTYPE html>
<html class="dark" lang="es">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title><?php echo htmlspecialchars($ct["contestname"] . ' — Staff reports'); ?></title>
<?php boca_tailwind_print_head_assets(); ?>
</head>
<body class="boca-app-ui bg-surface font-body text-on-background min-h-screen selection:bg-primary selection:text-on-primary pt-[7.25rem] md:pt-24 px-3 md:px-8 pb-10">
<header class="fixed top-0 left-0 right-0 z-50 border-b border-outline-variant/30 bg-[#060e20]/95 backdrop-blur-md shadow-lg shadow-black/20">
  <div class="flex h-14 items-center justify-between gap-3 px-4 md:px-6">
    <div class="flex min-w-0 items-center gap-3">
      <img src="<?php echo htmlspecialchars($loc); ?>/images/smallballoontransp.png" alt="" class="h-8 w-8 shrink-0 opacity-90"/>
      <div class="min-w-0">
        <div class="truncate text-sm font-black tracking-tight text-on-surface md:text-base"><a class="text-on-surface hover:text-primary" href="https://www.ime.usp.br/~cassio/boca/">BOCA</a></div>
        <div class="truncate text-[10px] font-semibold uppercase tracking-widest text-on-surface-variant">Staff reports</div>
      </div>
    </div>
    <div class="min-w-0 flex-1 px-2 text-center text-xs font-medium text-on-surface-variant md:text-sm">
      <?php echo htmlspecialchars($ct["contestname"] . ' — ' . $st["sitename"]); ?>
    </div>
    <nav class="flex shrink-0 flex-wrap items-center justify-end gap-1 text-xs md:text-sm">
<?php
boca_tailwind_nav_pill('../index.php', 'Staff', false);
boca_tailwind_nav_pill('../../index.php?logout=1', 'Logout', false);
?>
    </nav>
  </div>
</header>
