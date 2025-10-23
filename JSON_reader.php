<?php
function readJSONFile($filename) {
    if (!file_exists($filename)) {
        return "Error: File not found.";
    }

    $jsonContent = file_get_contents($filename);

    if ($jsonContent === false) {
        return "Error: Unable to read the file.";
    }

    $data = json_decode($jsonContent, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return "Error: Invalid JSON - " . json_last_error_msg();
    }

    return $data;
}