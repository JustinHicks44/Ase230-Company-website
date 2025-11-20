<?php
require_once __DIR__ . '/../lib/Page.php';

// Wrapper functions kept for compatibility with admin UI files.
function get_all_pages() {
    return Page::all();
}

function get_page_by_id($id) {
    return Page::find($id);
}

function create_page($page) {
    return Page::create($page);
}

function update_page($id, $pageData) {
    return Page::update($id, $pageData);
}

function delete_page($id) {
    return Page::delete($id);
}

?>
