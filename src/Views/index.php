<?php include __DIR__ . '/../views/partials/header.php'; ?>
<div class="container my-5">
    <h2>Phone Book</h2>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>PROFILE</th>
                <th>NAME</th>
                <th>PHONE NUMBER</th>
                <th>EMAIL</th>
                <th>CATEGORY</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <td>
                    <img src="<?php echo '/phonebook/uploads/' . htmlspecialchars(basename($row['image'])); ?>" alt="profile image" style="width: 50px; height: 50px;">
                </td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['category']); ?></td>
                <td>
                    <a class="btn btn-primary" href="index.php?action=edit&id=<?php echo $row['id']; ?>">Edit</a>
                    <a class="delete btn btn-danger" id="del_<?= $row['id'] ?>" data-id="<?= $row['id'] ?>">Delete</a>
                </td>
                </tr>
            <?php endwhile; ?>



        </tbody>

    </table>

</div>
<script src="assets/js/bootstrap.min.js"></script>


<?php include __DIR__ . '/partials/footer.php'; ?>