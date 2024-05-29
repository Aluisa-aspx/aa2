<?php
session_start();
if (session_status() == PHP_SESSION_NONE) {
    header("Location: /index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deletion_password = $_POST['deletion_password'];
    if ($deletion_password !== "deleteajhfhguj24804") {
        echo "Incorrect deletion password.";
        exit();
    }

    $clip_id = $_POST['clip_id'];
    $servername = "mysql0.serv00.com";
    $username = "m11610_user97491";
    $password = "+nxa.ts5-(5tP8Py94-^Vgu_-PXS%k";
    $dbname = "m11610_aa2_9489929";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql_delete_clip = "DELETE FROM clips WHERE id = $clip_id";
    if ($conn->query($sql_delete_clip) === TRUE) {
        echo "Video information deleted successfully.";
    } else {
        echo "Error deleting video information: " . $conn->error;
    }

    $conn->close();
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Clip Details</title>
    <link rel="stylesheet" href="/CSS/structure.css" type="text/css" id="StructureCSS" />
    <link rel="stylesheet" href="/CSS/light_mode.css" type="text/css" id="Light_Mode" />
</head>
<body>
    <div id="Container">
        <header>
            <div class="logo">AA2</div>
            <nav>
                <ul>
                    <li>
                        <a class="button" href="/index.php">INDEX</a>
                    </li>
                    <li>
                        <a class="button" href="/upload.php">UPLOAD</a>
                    </li>
                    <li>
                        <a class="button" href="/browse.php">BROWSE</a>
                    </li>
                </ul>
            </nav>
            <div id="you">
                <img src="/profile/0.png" alt="You" draggable="false" id="ProfilePicture" />
            </div>
        </header>
        <main>
            <div class="clip-player">
                <?php
                if (isset($_GET['id'])) {
                    $clip_id = $_GET['id'];
                    echo "<video controls id='videoo'>";
                    echo "<source src='/bin/player.php?id={$clip_id}' type='video/mp4'>";
                    echo "Your browser does not support the video tag.";
                    echo "</video>";
                }
                ?>
            </div>
            <div class="clip-details">
                <?php
                $servername = "mysql0.serv00.com";
                $username = "m11610_user97491";
                $password = "+nxa.ts5-(5tP8Py94-^Vgu_-PXS%k";
                $dbname = "m11610_aa2_9489929";
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                if (isset($_GET['id'])) {
                    $clip_id = $_GET['id'];
                    $sql = "SELECT * FROM clips WHERE id = $clip_id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<h2 class='titleTITLE'>{$row['clipTitle']}</h2>";
                            $uploadDate = date('M j Y g:i a', strtotime($row['uploadDate']));
                            echo "<span class='uploadDate'>( $uploadDate )</span>";
                            echo "<p>Upload by: {$row['uploaderName']}</p>";
                            echo "<p>{$row['clipDescription']}</p>";
                            echo "<form action='' method='post'>";
                            echo "<input type='hidden' name='clip_id' value='$clip_id'>";
                            echo "<label for='deletion_password'><b>Deletion Password:</b> </label>";
                            echo "<input type='password' name='deletion_password' required>";
                            echo "<button type='submit' style='background:#fff;'>Delete Video Information</button>";
                            echo "</form>";
                        }
                    } else {
                        header("Location: /browse.php");
                        exit();
                    }
                } else {
                    echo "Clip ID not provided.";
                }

                $conn->close();
                ?>
            </div>
        </main>
    </div>
</body>
</html>
