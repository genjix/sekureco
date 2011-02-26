<?php
function connectdb() {
    $con = mysql_connect('localhost', 'root', '');
    mysql_select_db('sekureco', $con);
    return $con;
}
function fetch_record($nickname) {
    $con = connectdb();
    $result = mysql_query("SELECT * FROM sekureco WHERE nickname='$nickname';");
    $row = mysql_fetch_array($result);
    mysql_close($con);
    return $row;
}
function save_attempts($nickname, $attempts) {
    $locktime = time();
    $con = connectdb();
    mysql_query("UPDATE sekureco SET attempts=$attempts, locktime=$locktime WHERE nickname='$nickname';");
    mysql_close($con);
}

function test_attempts($nickname, $goodpass, $attempts, $locktime) {
    $max_attempts = 2;
    $retry_time = 10*60*60;  // 10 hours
    if ($attempts > $max_attempts) {
        if (time() - $locktime > $retry_time) {
            $attempts = 0;
            // save in DB
            save_attempts($nickname, $attempts);
        }
        else
            die('ERROR LOCKED');
    }
    else if (!$goodpass) {
        // increment lock
        $attempts++;
        // save in DB
        save_attempts($nickname, $attempts);
        die('ERROR WRONGPASS');
    }
}
?>

