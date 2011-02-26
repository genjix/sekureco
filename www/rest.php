<?php
require('hlib.php');

$newstamp = 0;
$newname = '';
$dc = opendir($dirname);
while ($fn = readdir($dc)) {
    # Eliminate current directory, parent directory
    if (ereg('^\.{1,2}$',$fn))
        continue;
    $timedat = filemtime("$dirname/$fn");
    if ($timedat > $newstamp) {
        $newstamp = $timedat;
        $newname = $fn;
    }
}
echo "http://localhost/$dirname/$newname";
?>
