#!/usr/bin/env php
<?php
/**
 * CLI: insert demo users (one per role) for UI testing.
 * Password for all: BocaDemo2026 (same layers as BOCA web login; see DBNewUser in fcontest.php).
 *
 * Run from project root (so db.php can load hex.php, etc.):
 *   cd /path/to/boca-nuevo && php private/seed_demo_users.php --yes
 */
$ds = DIRECTORY_SEPARATOR;
if ($ds === '') {
	$ds = '/';
}
$bocadir = dirname(__DIR__);

if (php_sapi_name() !== 'cli') {
	echo "This script must be run from the command line.\n";
	exit(1);
}
if (!isset($argv[1]) || $argv[1] !== '--yes') {
	echo "This will DELETE users named demoadmin, demojudge, ... for one contest/site, then recreate them.\n";
	echo "Run from the BOCA project root:\n  php private/seed_demo_users.php --yes\n";
	exit(1);
}

chdir($bocadir);
require_once $bocadir . $ds . 'db.php';

$c = DBConnect();
$plain = 'BocaDemo2026';
$passInner = myhash($plain);

$row = DBGetRow("select * from contesttable where contestactive='t' order by contestnumber limit 1", 0, $c, 'seed_demo(active)');
if ($row === null) {
	$row = DBGetRow("select * from contesttable where contestnumber=0", 0, $c, 'seed_demo(template)');
}
if ($row === null) {
	echo "No contest found (no active and no template 0). Create a contest first.\n";
	exit(1);
}

$cn = (int)$row['contestnumber'];
$site = (int)$row['contestlocalsite'];
$t = time();

$st = DBGetRow("select * from sitetable where contestnumber=$cn and sitenumber=$site", 0, $c, 'seed_demo(site)');
if ($st === null) {
	echo "Site $site not found for contest $cn.\n";
	exit(1);
}

$defs = [
	['demoadmin', 'admin', 'Demo Admin'],
	['demojudge', 'judge', 'Demo Judge'],
	['demoteam', 'team', 'Demo Team'],
	['demostaff', 'staff', 'Demo Staff'],
	['demoscore', 'score', 'Demo Score'],
	['demosite', 'site', 'Demo Site'],
];

DBExec($c, 'begin work', 'seed_demo(begin)');
foreach ($defs as $d) {
	$eu = escape_string($d[0]);
	DBExec($c, "delete from usertable where contestnumber=$cn and usersitenumber=$site and username='$eu'", 'seed_demo(delete)');
}

$rmax = DBGetRow("select coalesce(max(usernumber),0) as m from usertable where contestnumber=$cn and usersitenumber=$site", 0, $c, 'seed_demo(max)');
$num = (int)$rmax['m'];

foreach ($defs as $d) {
	$num++;
	list($uname, $type, $full) = $d;
	$eu = escape_string($uname);
	$fullE = escape_string($full);
	$desc = escape_string('seed_demo_users');
	// Match fcontest.php DBNewUser: admin stores bare myhash(plain); others store '!' . myhash(plain)
	if ($type === 'admin') {
		$pw = escape_string($passInner);
	} else {
		$pw = escape_string('!' . $passInner);
	}
	$sql = "insert into usertable (contestnumber, usersitenumber, usernumber, username, usericpcid, userfullname, " .
		"userdesc, usertype, userenabled, usermultilogin, userpassword, userpermitip, updatetime) values " .
		"($cn, $site, $num, '$eu', '', '$fullE', '$desc', '$type', 't', 'f', '$pw', '', $t)";
	DBExec($c, $sql, 'seed_demo(insert ' . $uname . ')');
}

DBExec($c, 'commit work', 'seed_demo(commit)');
DBClose($c);

echo "OK — demo users created for contest=$cn site=$site\n\n";
echo "Login in the web UI (password for all: $plain):\n";
foreach ($defs as $d) {
	echo "  {$d[0]}  ({$d[1]})\n";
}
echo "\nSystem panel: user \"system\" with password from private/conf.php (basepass), not these accounts.\n";
echo "Main site admin: often \"admin\" / basepass unless you changed it.\n";
