<?php
$dataDir = __DIR__ . '/../data/';
$pagesFile = $dataDir . 'pages.json';

// Get all pages
function get_all_pages() {
    global $pagesFile;
    $data = read_pages_file();
    return $data;
}

// Get a specific page by ID
function get_page_by_id($id) {
    $pages = get_all_pages();
    foreach ($pages as $p) {
        if ($p['id'] == $id) {
            return $p;
        }
    }
    return null;
}

// Create a new page
function create_page($page) {
    $pages = get_all_pages();
    $newId = 1;
    foreach ($pages as $p) {
        if ($p['id'] >= $newId) {
            $newId = $p['id'] + 1;
        }
    }
    $page['id'] = $newId;
    $pages[] = $page;
    save_pages_file($pages);
    return $page;
}

// Update a page
function update_page($id, $pageData) {
    $pages = get_all_pages();
    foreach ($pages as &$p) {
        if ($p['id'] == $id) {
            $p = array_merge($p, $pageData);
            save_pages_file($pages);
            return $p;
        }
    }
    return null;
}

// Delete a page
function delete_page($id) {
    $pages = get_all_pages();
    $pages = array_filter($pages, function($p) use ($id) {
        return $p['id'] != $id;
    });
    save_pages_file(array_values($pages));
    return true;
}

// Read pages JSON file
function read_pages_file() {
    global $pagesFile;
    if (!file_exists($pagesFile)) {
        return [];
    }
    $json = file_get_contents($pagesFile);
    $data = json_decode($json, true);
    return $data ?: [];
}

// Save pages JSON file
function save_pages_file($pages) {
    global $pagesFile;
    $json = json_encode($pages, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    file_put_contents($pagesFile, $json);
}
?>
