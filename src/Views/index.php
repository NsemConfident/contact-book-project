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
                <tr class="clickable-row" data-href="details.php?id=<?= $row['id']; ?>">
                    <!-- Correcting the image path -->
                    <td>
                        <img src="<?php echo '/phonebook/uploads/' . htmlspecialchars(basename($row['image'])); ?>" alt="profile image" style="width: 50px; height: 50px;">
                    </td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                    <td>
                        <a class="btn btn-primary" href="index.php?action=edit&id=<?php echo $row['id']; ?>" onclick="confirmEdit();">Edit</a>
                        <a class="btn btn-danger" href="index.php?action=delete&id=<?php echo $row['id']; ?>" onclick="confirmDelete();">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>



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

    function confirmEdit(){
        return confirm("Are you sure you want to edit this contact.");
        
    }
    function confirmDelete(){
        return confirm("Are you sure you want to delete this contact.")? true: false;
    }

</script>


<?php include __DIR__ . '/partials/footer.php'; ?>