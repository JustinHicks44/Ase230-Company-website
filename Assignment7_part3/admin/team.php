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
require_once __DIR__ . '/../lib/Award.php';

// Awards wrappers using Award entity class
function get_all_awards() {
    return Award::all();
}

function get_award_by_id($id) {
    return Award::find($id);
}

function create_award($award) {
    return Award::create($award);
}

function update_award($id, $awardData) {
    return Award::update($id, $awardData);
}

function delete_award($id) {
    return Award::delete($id);
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
