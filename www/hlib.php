<?php
if (!isset($_POST['nickname']) || !isset($_POST['password'])) {
    die('ERROR NOARGS');
}
$nickname = $_POST['nickname'];
$password = $_POST['password'];

require_once('lib.php');

$row = fetch_record($nickname);
$realpass = $row['password'];
$dirname = $row['dirname'];
$attempts = $row['attempts'];
$locktime = $row['locktime'];

test_attempts($nickname, $password == $realpass, $attempts, $locktime);
?>

