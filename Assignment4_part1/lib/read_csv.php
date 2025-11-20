<?php
function read_csv_file($path, $delimiter = ',') {
    $rows = [];
    if (!file_exists($path)) {
        return $rows;
    }
    if (($handle = fopen($path, 'r')) !== false) {
        $headers = null;
        while (($data = fgetcsv($handle, 0, $delimiter)) !== false) {
            if ($headers === null) {
                $headers = $data;
                continue;
            }
            $row = [];
            foreach ($headers as $i => $h) {
                $row[$h] = isset($data[$i]) ? $data[$i] : null;
            }
            $rows[] = $row;
        }
        fclose($handle);
    }
    return $rows;
}
