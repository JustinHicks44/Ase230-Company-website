<?php
function read_text_file($path) {
    if (!file_exists($path)) {
        return "";
    }
    $content = file_get_contents($path);
    // Normalize line endings
    $content = str_replace(["\r\n", "\r"], "\n", $content);
    return $content;
}
