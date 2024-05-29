<?php
$servername = "mysql0.serv00.com";
$username = "m11610_user97491";
$password = "+nxa.ts5-(5tP8Py94-^Vgu_-PXS%k";
$dbname = "m11610_aa2_9489929";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$clipTitle = empty($_POST['clipTitle']) ? "N/A" : $_POST['clipTitle'];
$clipDescription = empty($_POST['clipDescription']) ? "N/A" : $_POST['clipDescription'];
$uploaderName = empty($_POST['uploaderName']) ? "N/A" : $_POST['uploaderName'];
$uploadDate = gmdate("Y-m-d H:i:s", strtotime("+3 hours"));

$stmt = $conn->prepare("INSERT INTO clips (clipTitle, clipDescription, uploaderName, uploadDate) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $clipTitle, $clipDescription, $uploaderName, $uploadDate);

if ($stmt->execute()) {
    $last_id = $conn->insert_id;
    $target_dir = "/usr/home/NilB/domains/nilb.serv00.net/public_html/bin/clips/";
    $target_file = $target_dir . $last_id . ".mp4";
    move_uploaded_file($_FILES["clipFile"]["tmp_name"], $target_file);
    echo "New record created successfully";

    $source_file = $target_file;
    $source_image = "/usr/home/NilB/domains/nilb.serv00.net/public_html/bin/source/" . $last_id . ".png";
    $video = new Imagick($source_file);
    $video->setIteratorIndex(0);
    $frame = $video->getimage();
    $width = $frame->getImageWidth();
    $height = $frame->getImageHeight();
    $newWidth = 350;
    $newHeight = floor($height * ($newWidth / $width));
    $frame->resizeImage($newWidth, $newHeight, imagick::FILTER_LANCZOS, 1);
    
    $frame->setImageFormat('png');
    $frame->writeImage($source_image);
    
    $frame->clear();
    $frame->destroy();
    $video->clear();
    $video->destroy();
    
    header("Location: /browse.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
