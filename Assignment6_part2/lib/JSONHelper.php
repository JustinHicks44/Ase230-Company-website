<?php
/**
 * Simple static JSON helper for reading and writing JSON files.
 */
class JSONHelper {
    /**
     * Read and decode JSON file. Returns decoded value or null on failure.
     */
    public static function readAll(string $path) {
        if (!file_exists($path)) {
            return null;
        }
        $json = file_get_contents($path);
        $data = json_decode($json, true);
        return $data;
    }

    /**
     * Save data (array/object) as pretty-printed JSON to file.
     */
    public static function saveAll(string $path, $data): bool {
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        if ($json === false) {
            return false;
        }
        $written = file_put_contents($path, $json, LOCK_EX);
        return $written !== false;
    }

    /**
     * Find an item by ID field in an array of associative arrays.
     * Returns the key/index or null if not found.
     */
    public static function findIndexById(array $items, $id, string $idField = 'id') {
        foreach ($items as $k => $item) {
            if (isset($item[$idField]) && $item[$idField] == $id) {
                return $k;
            }
        }
        return null;
    }
}

?>
