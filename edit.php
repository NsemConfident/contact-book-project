<?php
require 'Contact.php';
$id = $_GET['id'] ?? null;
$contact = new Contact();
$contactData = $contact->getContact($id);

if (!$contactData) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $category = $_POST['category'];

    // Handle image upload
    $image = $contactData['image']; // Keep existing image by default
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    $contact->updateContact($id, $name, $phone, $category, $image);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Contact</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Edit Contact</h1>
    <form action="edit.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($contactData['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($contactData['phone']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" id="category" name="category" value="<?= htmlspecialchars($contactData['category']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Profile Image</label>
            <input type="file" class="form-control" id="image" name="image">
            <p>Current Image:</p>
            <?php if ($contactData['image']): ?>
                <img src="<?= htmlspecialchars($contactData['image']) ?>" alt="Profile Image" class="img-thumbnail" style="width: 150px;">
            <?php else: ?>
                <p>No image uploaded</p>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Update Contact</button>
    </form>
    <a href="index.php" class="btn btn-secondary mt-3">Back to List</a>
</div>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
