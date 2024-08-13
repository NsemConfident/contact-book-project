<?php
require 'Contact.php';
$contact = new Contact();
$contacts = $contact->getAllContacts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Phone Book</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        .clickable-row {
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1>Phone Book</h1>
    <a href="add.php" class="btn btn-primary mb-3">Add New Contact</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($contacts as $id => $contact): ?>
            <tr class="clickable-row" data-href="details.php?id=<?= $id ?>">
                <td><?= htmlspecialchars($contact['name']) ?></td>
                <td><?= htmlspecialchars($contact['phone']) ?></td>
                <td><?= htmlspecialchars($contact['category']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $id ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete.php?id=<?= $id ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="assets/js/bootstrap.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const rows = document.querySelectorAll(".clickable-row");
        rows.forEach(row => {
            row.addEventListener("click", function() {
                window.location.href = this.dataset.href;
            });
        });
    });
</script>
</body>
</html>
