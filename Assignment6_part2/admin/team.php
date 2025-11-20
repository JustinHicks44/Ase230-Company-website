<?php
$dataDir = __DIR__ . '/../data/';
$teamAwardsFile = $dataDir . 'team_awards.json';

// ==================== TEAM FUNCTIONS ====================

// Get all team members
function get_all_team() {
    global $teamAwardsFile;
    $data = read_team_awards_file();
    return $data['team'] ?? [];
}

// Get a specific team member by ID
function get_team_by_id($id) {
    $team = get_all_team();
    if (isset($team[$id])) {
        $member = $team[$id];
        $member['id'] = $id;
        return $member;
    }
    return null;
}

// Create a new team member
function create_team_member($member) {
    $data = read_team_awards_file();
    $team = $data['team'] ?? [];
    $team[] = $member;
    $data['team'] = $team;
    save_team_awards_file($data);
    return $member;
}

// Update a team member
function update_team_member($id, $memberData) {
    $data = read_team_awards_file();
    $team = $data['team'] ?? [];
    if (isset($team[$id])) {
        $team[$id] = array_merge($team[$id], $memberData);
        $data['team'] = $team;
        save_team_awards_file($data);
        return $team[$id];
    }
    return null;
}

// Delete a team member
function delete_team_member($id) {
    $data = read_team_awards_file();
    $team = $data['team'] ?? [];
    if (isset($team[$id])) {
        unset($team[$id]);
        $data['team'] = array_values($team);
        save_team_awards_file($data);
        return true;
    }
    return false;
}

// ==================== AWARDS FUNCTIONS ====================

// Get all awards
function get_all_awards() {
    $data = read_team_awards_file();
    return $data['awards'] ?? [];
}

// Get a specific award by ID
function get_award_by_id($id) {
    $awards = get_all_awards();
    if (isset($awards[$id])) {
        $award = $awards[$id];
        $award['id'] = $id;
        return $award;
    }
    return null;
}

// Create a new award
function create_award($award) {
    $data = read_team_awards_file();
    $awards = $data['awards'] ?? [];
    $awards[] = $award;
    $data['awards'] = $awards;
    save_team_awards_file($data);
    return $award;
}

// Update an award
function update_award($id, $awardData) {
    $data = read_team_awards_file();
    $awards = $data['awards'] ?? [];
    if (isset($awards[$id])) {
        $awards[$id] = array_merge($awards[$id], $awardData);
        $data['awards'] = $awards;
        save_team_awards_file($data);
        return $awards[$id];
    }
    return null;
}

// Delete an award
function delete_award($id) {
    $data = read_team_awards_file();
    $awards = $data['awards'] ?? [];
    if (isset($awards[$id])) {
        unset($awards[$id]);
        $data['awards'] = array_values($awards);
        save_team_awards_file($data);
        return true;
    }
    return false;
}

// ==================== HELPER FUNCTIONS ====================

// Read the entire team_awards.json file
function read_team_awards_file() {
    global $teamAwardsFile;
    if (!file_exists($teamAwardsFile)) {
        return ['team' => [], 'awards' => []];
    }
    $json = file_get_contents($teamAwardsFile);
    $data = json_decode($json, true);
    return $data ?: ['team' => [], 'awards' => []];
}

// Save the entire team_awards.json file
function save_team_awards_file($data) {
    global $teamAwardsFile;
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    file_put_contents($teamAwardsFile, $json);
}
?>
