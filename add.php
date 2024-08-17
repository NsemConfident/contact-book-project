<?php
require 'Contact.php';
require './classes/contactModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $category = $_POST['category'];

    // Handle image upload
    $image = null;
    // if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    //     $image = 'uploads/' . basename($_FILES['image']['name']);
    //     move_uploaded_file($_FILES['image']['tmp_name'], $image);
    // }
    

    $contactModel = new ContactModel($name, $phone, $category, $image);
    $image = $contactModel->image_picker();
    $contact = new Contact();
    $contact->addContact($contactModel->get_name(), $contactModel->get_phone(), $contactModel->get_category(), $image);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Contact</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Add New Contact</h1>
    <form action="add.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" id="category" name="category" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Profile Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Add Contact</button>
    </form>
    <a href="index.php" class="btn btn-secondary mt-3">Back to List</a>
</div>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
