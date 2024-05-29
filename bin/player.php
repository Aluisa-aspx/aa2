<?php
$video_dir = "/usr/home/NilB/domains/nilb.serv00.net/public_html/bin/clips/";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $video_path = $video_dir . $id . ".mp4";
    if (file_exists($video_path)) {
        header('Content-Type: video/mp4');
        header('Content-Length: ' . filesize($video_path));
        readfile($video_path);
        exit;
    } else {
        echo "Video not found.";
    }
} else {
    echo "Parameter 'id' not provided.";
}
?>
