<?php
session_start();

$passkey = "4881AA2";
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
<div id="leftTxt">
<h1>Welcome to AA2: clips</h1>
<p>Share your clips with others and watch some little funny clips, this website was made for a specific group of people.</p>
<p>After enterring the password, you can upload clips (50mb cap) and watch clips on this website.</p>
<p>That's all, also sorry for making the website in <b>EN-US</b>.</p>
<br/>
<h1>Data and Terms:</h1>
<p>Do not overdrive the website's forms, do not upload off-topic stuff and no self-promotion.</p>
<p><strong>Owner isn't responsible for user acts.</strong></p>
<p>We do not get data from you.</p>
</div>
<div id="rightPane">
<img src="/aa2.png" id="AA2_icon" alt="AA2" draggable="false" />
</div>
</div>
</main>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["code"]) && $_POST["code"] === $passkey) {
            $_SESSION['logged_in'] = true;
        } else {
            echo "<div id='ERROR'>Incorrect code. Please try again.</div>";
        }
    }

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        echo "<div id='anj247'>";
        echo "<form method='post'>";
        echo "<p for='code'>Enter password:</p>";
        echo "<input type='text' name='code' id='code'/>";
        echo "<input type='submit' value='Submit' id='goButton' />";
        echo "</form>";
        echo "</div>";
}
    ?>
</div>
 </body>
</html>