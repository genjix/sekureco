<?php
require('hlib.php');

if ($_FILES["file"]["error"] > 0)
{
    die('ERROR BADFILE');
}
else
{
    // give filename a random number between 1-5 and upload it.
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    if ($ext == 'enc') {
        $prefix = strval(rand(1,5));
        $filename = "$prefix.$ext";
    }
    else if ($ext == 'zip')
        $filename = 'secrets.enc.zip';
    else
        die('ERROR NONFILE');
    move_uploaded_file($_FILES['file']['tmp_name'], "$dirname/" . $filename);
}
?> 
