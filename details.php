<?php
require 'Contact.php';
$id = $_GET['id'] ?? null;
$contact = new Contact();
$contactData = $contact->getContact($id);

if (!$contactData) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Contact Details</h1>
    <div>
        <?php if ($contactData['image']): ?>
            <img src="<?= htmlspecialchars($contactData['image']) ?>" alt="Contact Image" class="img-thumbnail" style="width: 150px;">
        <?php else: ?>
            <p>No image available</p>
        <?php endif; ?>
        <h2><?= htmlspecialchars($contactData['name']) ?></h2>
        <p><strong>Phone:</strong> <?= htmlspecialchars($contactData['phone']) ?></p>
        <p><strong>Category:</strong> <?= htmlspecialchars($contactData['category']) ?></p>
    </div>
    <a href="index.php" class="btn btn-secondary mt-3">Back to List</a>
</div>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
