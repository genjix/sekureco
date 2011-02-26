<?php
if (!isset($_POST['nickname']) || !isset($_POST['password'])) {
    die('ERROR NOARGS');
}
$nickname = $_POST['nickname'];
$rsapassword = $_POST['password'];

require_once('lib.php');

$row = fetch_record($nickname);
$realpass = $row['password'];
$dirname = $row['dirname'];
$attempts = $row['attempts'];
$locktime = $row['locktime'];

$filename = $dirname . '/secrets.enc.zip';
$command = "sektst $filename \"$rsapassword\"";
$return_var = -1;
$output = array();   // unused
exec($command, $output, $return_var);
// will die if problem
test_attempts($nickname, $return_var != 0, $attempts, $locktime);
if ($return_var == 1)
    echo $realpass;
else
    die('ERROR BADPROG');
?>

