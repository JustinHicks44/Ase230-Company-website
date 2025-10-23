<?php
function readCSVFile($filename, $delimiter = ",") {
    if (!file_exists($filename)) {
        return "Error: File not found.";
    }

    if (($handle = fopen($filename, "r")) === false) {
        return "Error: Unable to open file.";
    }

    $data = [];

    while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
        $data[] = $row;
    }

    fclose($handle);
    return $data;
}