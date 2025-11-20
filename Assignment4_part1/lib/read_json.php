<?php
function read_json_file($path) {
    if (!file_exists($path)) {
        return null;
    }
    $json = file_get_contents($path);
    $data = json_decode($json, true);
    return $data;
}
