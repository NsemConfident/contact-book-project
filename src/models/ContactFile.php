<?php

class ContactFile {
    private $contacts;

    public function __construct() {
        $this->contacts = json_decode(file_get_contents('contacts.json'), true) ?? [];
    }

    public function getAllContacts() {
        return $this->contacts;
    }

    public function getContact($id) {
        return $this->contacts[$id] ?? null;
    }

    public function addContact($name, $phone, $category, $image) {
        $this->contacts[] = [
            'name' => $name,
            'phone' => $phone,
            'category' => $category,
            'image' => $image,
        ];
        $this->saveContacts();
    }

    public function updateContact($id, $name, $phone, $category, $image) {
        $this->contacts[$id] = [
            'name' => $name,
            'phone' => $phone,
            'category' => $category,
            'image' => $image,
        ];
        $this->saveContacts();
    }

    public function deleteContact($id) {
        unset($this->contacts[$id]);
        $this->saveContacts();
    }

    private function saveContacts() {
        file_put_contents('contacts.json', json_encode(array_values($this->contacts)));
    }
    
}

?>
