<?php
require_once 'functions.php';
$uploadDir = './input/';
$inputFileName = $fileNewName = '';
$outputFileName = "";
$fileName = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['fileImport'])) {
        $fileName = $_FILES['fileImport']['name'];
        $fileNewName = $_POST['outputFileName'];
        $outputFileName = $_POST['outputFileName'];

        if ($_FILES['fileImport']['type'] === 'text/plain') {
            if (move_uploaded_file($_FILES['fileImport']['tmp_name'], $uploadDir . $fileNewName . ".txt")) {
                _log($fileName . " has been uploaded successfully.");
                _log("info - File " . $fileName . " has been renamed to " . $fileNewName . ".txt");
                processFile($fileNewName, $uploadDir, $_POST['input1'], $_POST['input2']);
            } else {
                writeMessage("There has been an error uploading the file. Please try again.", "error");
            }
        } else {
            writeMessage("Sorry, only TXT files are allowed.", "error");
        }
    } else {
        writeMessage("There has been an error uploading the file. Please try again.", "error");
    }
}

include './templates/index.html';