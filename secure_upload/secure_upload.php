<?php
$uploadDirectory = 'secured_upload/';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
    $targetDirectory = dirname(__FILE__) . '/' . $uploadDirectory;
    $originalFileName = $_FILES["fileToUpload"]["name"];
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    $newFileName = uniqid() . '.' . $fileExtension . '.txt';
    $targetFile = $targetDirectory . $newFileName;

    // Attempt to move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        echo "The file " . htmlspecialchars($originalFileName) . " has been uploaded and renamed to " . htmlspecialchars($newFileName) . ".";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
</head>
<body>
    <h1>Upload a File (Will be renamed to file.extension.txt)</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload File" name="submit">
    </form>
</body>
</html>
