<?php include __DIR__ . '/../views/partials/header.php'; ?>
<div class="container my-5">
    <h2>Edit Contact</h2>
    <br>
    <form class="row g-3" action="index.php?action=edit&id=<?php echo $currentContact['id']; ?>" method="POST">
        <div class="col-md-6">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlspecialchars($currentContact['name']); ?>" required>
        </div>
        <div class="col-md-6">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo htmlspecialchars($currentContact['phone']); ?>" required>
        </div>
        <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="<?php echo htmlspecialchars($currentContact['email']); ?>" required>
        </div>
        <div class="col-12">
            <label for="category" class="form-label">Category</label>
            <select id="category" name="category" class="form-select" required>
                <option value="<?php echo htmlspecialchars($currentContact['email']); ?>" selected><?php echo htmlspecialchars($currentContact['category']); ?></option>
                <option value="Family">Family</option>
                <option value="Work">Work</option>
                <option value="Mobile">Mobile</option>
                <option value="Friends">Friends</option>
            </select>
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
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Update Contact</button>
        </div>
    </form>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>
