# aa2
Clip platform made for a group chat called AA2

# Disclaimer:

I pretty sure there's SQL vulnerabilities and other stuff like that, this was made in a few hours and the project died on day as the uploading videos ans thumbnail generator made the servers go down 5 times in a day, use with caution.

# Database set up:
SQL command for setting up the Clips database:
`CREATE TABLE clips (
    id INT AUTO_INCREMENT PRIMARY KEY,
    clipTitle VARCHAR(255),
    clipDescription TEXT,
    uploaderName VARCHAR(255),
    uploadDate DATETIME
);`
