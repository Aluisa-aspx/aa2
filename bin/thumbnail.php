<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $imagePath = '/usr/home/NilB/domains/nilb.serv00.net/public_html/bin/source/' . $id . '.png';
    
    if(file_exists($imagePath)) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $imagePath);
        finfo_close($finfo);

        if($mimeType === 'image/png') {
            $image = imagecreatefrompng($imagePath);
        } else {
            $imagePath = '/usr/home/NilB/domains/nilb.serv00.net/public_html/default.png';
            $image = imagecreatefrompng($imagePath);
        }
    } else {
        $imagePath = '/usr/home/NilB/domains/nilb.serv00.net/public_html/default.png';
        $image = imagecreatefrompng($imagePath);
    }
    header('Content-Type: image/png');
    imagepng($image);
    imagedestroy($image);
} else {
    echo '<h2 style="color:red;font-family: Arial, Verdana, sans-serif;">Please provide the ID in parameter or insert "?id={id}" parameter</h2>';
}
?>
