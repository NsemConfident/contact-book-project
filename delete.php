<?php
require 'Contact.php';
$id = $_GET['id'] ?? null;

if ($id !== null) {
    $contact = new Contact();
    $contact->deleteContact($id);
}

header('Location: index.php');
exit;
?>
