<?php
$uploadDir = './input/';
$inputFileName = $fileNewName = '';
$outputFileName = $_POST['outputFileName'];
$fileName = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['fileImport'])) {
        $fileName = $_FILES['fileImport']['name'];
        $fileNewName = $_POST['outputFileName'];

        if ($_FILES['fileImport']['type'] === 'text/plain') {
            if (move_uploaded_file($_FILES['fileImport']['tmp_name'], $uploadDir . $fileNewName . ".txt")) {
                //File uploaded successfully.
                _log($fileName . " has been uploaded successfully.", "success");
                _log("info - File " . $fileName . " has been renamed to " . $fileNewName . ".txt");
                processFile($fileNewName, $uploadDir);
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

function readFileContents(string $targetFile, string $uploadDir)
{
    $file = fopen($uploadDir . $targetFile . ".txt", 'r');
    $fileContent = fread($file, filesize($uploadDir . $targetFile . ".txt"));
    fclose($file);
    return $fileContent;
}

function shortenFile(string $targetFile, string $uploadDir)
{
    //TODO: implement shortening algorithm
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input1 = $_POST['input1'];
        $input2 = $_POST['input2'];

        // Check if both input arrays have non-empty elements and equal count
        if (!empty($input1) && !empty($input2) && count($input1) === count($input2)) {
            $fileContent = readFileContents($targetFile, $uploadDir);

            // Create an associative array to map input1 to input2
            $replacementArray = array_combine($input1, $input2);

            // Filter out empty strings from the replacement array
            $replacementArray = array_filter($replacementArray, function ($value) {
                return $value !== '';
            });

            // Replace occurrences of input1 with input2 in the file content
            $newData = strtr($fileContent, $replacementArray);

            // Write the new data back to the file (overwrite the existing content)
            $file = fopen($uploadDir . $targetFile . ".txt", 'w');
            fwrite($file, $newData);
            fclose($file);
        }
    }
}

function _log(string $message)
{
    $date = getdate()['mday'] . "/" . getdate()['mon'] . "/" . getdate()['year'] . " " . getdate()['hours'] . ":" . getdate()['minutes'] . ":" . getdate()['seconds'] . " - ";
    $message = $date . $message . "\n";
    $logFile = fopen("./log.txt", "a");
    fwrite($logFile, $message);
    fclose($logFile);
}

function writeMessage(string $message, string $alertType)
{
    echo '<script>
            const alert = document.getElementById("phpError");
            const info = document.getElementById("phpInfo");
            const success = document.getElementById("phpSuccess");
            ';

    switch ($alertType) {
        case "error":
            echo "alert.innerHTML = '$message';alert.style.display = 'block';";
            _log($alertType . ": " . $message);
            break;
        case "info":
            echo "info.innerHTML = '$message;info.style.display = 'block';";
            _log($alertType . ": " . $message);
            break;
        case "success":
            echo "success.innerHTML = '$message';success.style.display = 'block';";
            _log($alertType . ": " . $message);
            break;
        default:
            break;
    }
    echo 'setTimeout(function(){alert.style.display = "none";info.style.display = "none";success.style.display = "none";}, 5000);';
    echo '</script>';
}

function processFile(string $targetFile, string $uploadDir)
{
    $fileName = $targetFile . ".txt";
    // TODO: implement file processing
    shortenFile($targetFile, $uploadDir);

    //Download file after processing
    downloadFile($targetFile, $uploadDir);

    // Delete file after processing
    unlink($uploadDir . $targetFile . ".txt");
    _log("info - File " . $fileName . " has been deleted.");
}

function downloadFile(string $targetFile, string $uploadDir)
{
    $file = $uploadDir . $targetFile . ".txt";

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);

        // Close the output buffer to allow deleting the file
        ob_end_clean();

        // Delete the file after download
        unlink($uploadDir . $file . ".txt");
        _log("info - File " . $targetFile . ".txt has been deleted.");

        exit;
    }
}