<?php
$dataDir = __DIR__ . '/../data/';
$contactsFile = $dataDir . 'contacts.json';

// Get all contact requests
function get_all_contacts() {
    global $contactsFile;
    $data = read_contacts_file();
    return $data;
}

// Get a specific contact by ID
function get_contact_by_id($id) {
    $contacts = get_all_contacts();
    foreach ($contacts as $c) {
        if ($c['id'] == $id) {
            return $c;
        }
    }
    return null;
}

// Create a new contact request
function create_contact($contact) {
    $contacts = get_all_contacts();
    $newId = 1;
    foreach ($contacts as $c) {
        if ($c['id'] >= $newId) {
            $newId = $c['id'] + 1;
        }
    }
    $contact['id'] = $newId;
    $contact['submitted_at'] = date('Y-m-d H:i:s');
    $contacts[] = $contact;
    save_contacts_file($contacts);
    return $contact;
}

// Delete a contact request
function delete_contact($id) {
    $contacts = get_all_contacts();
    $contacts = array_filter($contacts, function($c) use ($id) {
        return $c['id'] != $id;
    });
    save_contacts_file(array_values($contacts));
    return true;
}

// Read contacts JSON file
function read_contacts_file() {
    global $contactsFile;
    if (!file_exists($contactsFile)) {
        return [];
    }
    $json = file_get_contents($contactsFile);
    $data = json_decode($json, true);
    return $data ?: [];
}

// Save contacts JSON file
function save_contacts_file($contacts) {
    global $contactsFile;
    $json = json_encode($contacts, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    file_put_contents($contactsFile, $json);
}
?>
