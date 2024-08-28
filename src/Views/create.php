<?php include __DIR__ . '/../views/partials/header.php'; ?>

<div class="container my-5">
    <h2>Create a Contact</h2>
    <br>
    <form class="row g-3" action="index.php?action=create" method="POST" enctype="multipart/form-data">
        <div class="col-md-6">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
        <div class="col-md-6">
            <label for="phone" class="form-label">Phone</label>
            <input type="number" class="form-control" name="phone" id="phone">
        </div>
        <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="col-12">
            <label for="category" class="form-label">Category</label>
            <select id="category" name="category" class="form-select" required>
                <option selected>Choose...</option>
                <option value="family">Family</option>
                <option value="work">Work</option>
                <option value="mobile">Mobile</option>
                <option value="friends">Friends</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Profile Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Save Contact</button>
        </div>
    </form>
</div>

<!-- <?php include 'src/views/partials/footer.php'; ?> -->