<?php

use PHPUnit\Framework\TestCase;

require_once '../functions.php';

class FileProcessingTest extends TestCase
{
    public function testReadFileContents()
    {
        $uploadDir = '../input/';
        $targetFile = 'test_file';
        $testContent = 'Testing content for the file.';

        // Create a test file
        file_put_contents($uploadDir . $targetFile . ".txt", $testContent);

        $result = readFileContents($targetFile, $uploadDir);

        $this->assertEquals($testContent, $result);

        // Remove the test file after testing
        unlink($uploadDir . $targetFile . ".txt");
    }

    public function testShortenFile()
    {
        $uploadDir = '../input/';
        $targetFile = 'test_file_shorten';
        $input1 = ['replace1', 'replace2'];
        $input2 = ['with1', 'with2'];
        $testContent = 'This is some content to replace1 and replace2.';

        // Create a test file
        file_put_contents($uploadDir . $targetFile . ".txt", $testContent);

        // Call shortenFile function
        shortenFile($targetFile, $uploadDir, $input1, $input2);

        $result = readFileContents($targetFile, $uploadDir);

        // Check if the replacements were made
        $this->assertEquals('This is some content to with1 and with2.', $result);

        // Remove the test file after testing
        unlink($uploadDir . $targetFile . ".txt");
    }
}