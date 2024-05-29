<?php
session_start();

$passkey = "4881AA2";

// Function to sanitize input
function sanitizeInput($input) {
    $input = trim($input);
    $input = htmlspecialchars($input);
    return $input;
}

// Function to handle form submission
function handleFormSubmission() {
    global $passkey;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["code"]) && $_POST["code"] === $passkey) {
            $_SESSION['logged_in'] = true;
        } else {
            echo "<div id='ERROR'>Incorrect code. Please try again.</div>";
        }
    }
}
function generatePaginationLinks($total_pages, $order) {
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='?order=$order&page=$i'" . ($i == $current_page ? " class='active'" : "") . ">$i</a>";
    }
    echo "</div>";
}

function generateSQLQuery() {
    global $order, $start_from, $results_per_page;
    $sql = "SELECT * FROM clips";
    if (!empty($_GET['searchTerm'])) {
        $searchTerm = sanitizeInput($_GET['searchTerm']);
        $sql .= " WHERE clipTitle LIKE '%$searchTerm%'";
    }
    $sql .= " ORDER BY uploadDate " . ($order == 'oldest' ? 'ASC' : 'DESC') . " LIMIT $start_from, $results_per_page";
    return $sql;
}

$servername = "mysql0.serv00.com";
$username = "m11610_user97491";
$password = "+nxa.ts5-(5tP8Py94-^Vgu_-PXS%k";
$dbname = "m11610_aa2_9489929";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$results_per_page = 12;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_from = ($page - 1) * $results_per_page;

$order = isset($_GET['order']) ? $_GET['order'] : 'newest';

handleFormSubmission();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Index</title>
    <link rel="stylesheet" href="/CSS/structure.css" type="text/css" id="StructureCSS" />
    <link rel="stylesheet" href="/CSS/light_mode.css" type="text/css" id="Light_Mode" />
    <script>
        function submitForm() {
            document.getElementById("searchForm").submit();
        }
    </script>
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
        <div>
            <form id="searchForm" method="GET">
                <label for="searchTerm">Search:</label>
                <input type="text" id="searchTerm" name="searchTerm" value="<?= isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '' ?>" />
                <button type="button" onclick="submitForm()" class="uploadButton">Search</button>
                <button name="order" value="newest" type="submit" class="uploadButton">Newest</button>
                <button name="order" value="oldest" type="submit" class="uploadButton">Oldest</button>
            </form>
        </div>
        <div class="content">
            <?php
            $sql = generateSQLQuery();
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<div class='video-table cfjh287'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='video'>";
                    echo "<div class='thumbnail'><img src='/bin/thumbnail.php?id={$row['id']}' alt='Thumbnail'></div>";
                    echo "<div class='clipName'><a href='/clip.php?id={$row['id']}'>{$row['clipTitle']}</a></div>";
                    $uploadDate = date('M j Y g:i a', strtotime($row['uploadDate']));
                    echo "<div class='pubDate'>$uploadDate</div>";
                    echo "</div>";
                }
                echo "</div>";

                $sql = "SELECT COUNT(id) AS total FROM clips";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $total_pages = ceil($row["total"] / $results_per_page);
                generatePaginationLinks($total_pages, $order);
            } else {
                echo "No clips found";
            }

            $conn->close();
            ?>
        </div>
    </main>
    <?php
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
