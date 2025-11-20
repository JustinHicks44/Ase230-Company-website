<?php
require_once __DIR__ . '/JSONHelper.php';

class Award {
    private static $file = __DIR__ . '/../data/team_awards.json';

    // Return awards array (stored under 'awards' key)
    public static function all(): array {
        $data = JSONHelper::readAll(self::$file);
        if (!is_array($data)) return [];
        return $data['awards'] ?? [];
    }

    // Find by index (awards use array indices as IDs)
    public static function find($id) {
        $awards = self::all();
        if (isset($awards[$id])) {
            $award = $awards[$id];
            $award['id'] = $id;
            return $award;
        }
        return null;
    }

    // Create a new award (appends)
    public static function create(array $award) {
        $data = JSONHelper::readAll(self::$file) ?: [];
        $awards = $data['awards'] ?? [];
        $awards[] = $award;
        $data['awards'] = $awards;
        JSONHelper::saveAll(self::$file, $data);
        return $award;
    }

    // Update award by index
    public static function update($id, array $awardData) {
        $data = JSONHelper::readAll(self::$file) ?: [];
        $awards = $data['awards'] ?? [];
        if (isset($awards[$id])) {
            $awards[$id] = array_merge($awards[$id], $awardData);
            $data['awards'] = $awards;
            JSONHelper::saveAll(self::$file, $data);
            return $awards[$id];
        }
        return null;
    }

    // Delete award by index
    public static function delete($id) {
        $data = JSONHelper::readAll(self::$file) ?: [];
        $awards = $data['awards'] ?? [];
        if (isset($awards[$id])) {
            unset($awards[$id]);
            $data['awards'] = array_values($awards);
            return JSONHelper::saveAll(self::$file, $data);
        }
        return false;
    }
}

?>
