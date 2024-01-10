<?php
function readFileContents(string $targetFile, string $uploadDir)
{
    $file = fopen($uploadDir . $targetFile . ".txt", 'r');
    $fileContent = fread($file, filesize($uploadDir . $targetFile . ".txt"));
    fclose($file);
    return $fileContent;
}

function shortenFile(string $targetFile, string $uploadDir, array $input1, array $input2)
{
    if (!empty($input1) && !empty($input2) && count($input1) === count($input2)) {
        $fileContent = readFileContents($targetFile, $uploadDir);

        $replacementArray = array_filter(array_combine($input1, $input2), function ($value) {
            return $value !== '';
        });

        $newData = strtr($fileContent, $replacementArray);

        $file = fopen($uploadDir . $targetFile . ".txt", 'w');
        fwrite($file, $newData);
        fclose($file);
    }
}

function _log(string $message)
{
    $date = getdate()['mday'] . "/" . getdate()['mon'] . "/" . getdate()['year'] . " " . getdate()['hours'] . ":" . getdate()['minutes'] . ":" . getdate()['seconds'] . " - ";
    $message = $date . $message . "\n";
    $logFile = fopen("./log/log.txt", "a");
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

function processFile(string $targetFile, string $uploadDir, array $input1, array $input2)
{
    $fileName = $targetFile . ".txt";
    shortenFile($targetFile, $uploadDir, $input1, $input2);
    downloadFile($targetFile, $uploadDir);
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

        unlink($file);
        _log("info - File " . $targetFile . ".txt has been deleted.");
        exit;
    }
}