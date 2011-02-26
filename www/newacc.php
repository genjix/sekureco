<?php
// newacc.php&nickname=genjix
function random_string($length=10) {
    $characters = "0123456789abcdefghijklmnopqrstuvwxyz";
    $string = "";    

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }

    return $string;
}

if (!isset($_GET['nickname']))
    die('ERROR NONICKSET');

$nickname = $_GET['nickname'];
// force alphanumeric for the nickname
$nickname = ereg_replace('[^A-Za-z0-9]', '', $nickname);
$dirname = random_string(40);
$password = random_string(80);
$attempts = 0;
$locktime = 0;

$con = mysql_connect("localhost", "root", "");

mysql_select_db("sekureco", $con);
if (mysql_num_rows(mysql_query("SELECT * FROM sekureco WHERE nickname='$nickname';")) == 0) {
    mysql_query("INSERT INTO sekureco VALUES ('$nickname', '$dirname', '$password', $attempts, $locktime);", $con);
    mkdir($dirname);
}

mysql_close($con);

echo $password;
?>

