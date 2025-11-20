<?php
require_once __DIR__ . '/JSONHelper.php';

class Page {
    private static $file = __DIR__ . '/../data/pages.json';

    // Return all pages as an array
    public static function all(): array {
        $data = JSONHelper::readAll(self::$file);
        return is_array($data) ? $data : [];
    }

    // Find page by numeric id
    public static function find($id) {
        $pages = self::all();
        foreach ($pages as $p) {
            if (isset($p['id']) && $p['id'] == $id) {
                return $p;
            }
        }
        return null;
    }

    // Create page (assigns next numeric id)
    public static function create(array $page) {
        $pages = self::all();
        $newId = 1;
        foreach ($pages as $p) {
            if (isset($p['id']) && $p['id'] >= $newId) {
                $newId = $p['id'] + 1;
            }
        }
        $page['id'] = $newId;
        $pages[] = $page;
        JSONHelper::saveAll(self::$file, $pages);
        return $page;
    }

    // Update page by id
    public static function update($id, array $pageData) {
        $pages = self::all();
        foreach ($pages as $i => $p) {
            if (isset($p['id']) && $p['id'] == $id) {
                $pages[$i] = array_merge($p, $pageData);
                JSONHelper::saveAll(self::$file, $pages);
                return $pages[$i];
            }
        }
        return null;
    }

    // Delete page by id
    public static function delete($id) {
        $pages = self::all();
        $pages = array_filter($pages, function($p) use ($id) {
            return !isset($p['id']) || $p['id'] != $id;
        });
        $pages = array_values($pages);
        return JSONHelper::saveAll(self::$file, $pages);
    }
}

?>
