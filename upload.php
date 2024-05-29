<?php
session_start();
if (session_status() == PHP_SESSION_NONE) {
    header("Location: /index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Index</title>

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
            <h2 istitle="true">AA2: clips</h2>
            <div class="content">
<form action="/process/form/clips/a9849249.php" method="post" enctype="multipart/form-data" id="UploadClip">
        <h1 for="clipTitle">Clip Title:</h1>
    <input type="text" id="clipTitle" name="clipTitle" class="default" required minlegth="2" maxlength="20" /><br/><br/>

    <h1 for="clipDescription">Clip Description:</h1><br>
    <textarea id="clipDescription" name="clipDescription" rows="4" cols="50" class="default textarea1" minlegth="10" required></textarea><br/><br/>

    <h1l for="clipFile">Clip File (50mb max):</h1l>
    <input type="file" id="clipFile" name="clipFile" accept="video/*" maxlength="50" required/><br/><br/>

    <h1 for="uploaderName">Uploaded by:</h1>
    <input type="text" id="uploaderName" name="uploaderName" class="default" placeholder="Your Nickname" maxlength="20" required minlegth="2" /><br/><br/>
<input type="checkbox" required value="agree" /> I agree with the Terms and Data<br/><br/>

    <input type="submit" value="Upload" class="uploadButton" />
</form>
            </div>
        </main>
        </div>
</body>
</html>