<?php
function readTextFile($filename) {
    if (!file_exists($filename)) {
        return "Error: File not found.";
    }

    if (!is_readable($filename)) {
        return "Error: File is not readable.";
    }

    $content = file_get_contents($filename);

    if ($content === false) {
        return "Error: Failed to read the file.";
    }

    return $content;
}
