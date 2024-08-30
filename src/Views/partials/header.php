<!-- src/views/partials/header.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Phone Book</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- <==================LINKS ADDED FOR bootbox, bootstrap, ajax, jquery ===================> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js'></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    .clickable-row {
      cursor: pointer;
    }
  </style>

  <script>
    $(document).ready(function() {
      // Delete 
      $('.delete').click(function(event) {
        event.preventDefault(); // Prevent the default behavior of the link

        var el = this; // Store reference to the clicked element

        // Get the ID from data-id attribute
        var deleteid = $(this).data('id');

        // Confirm deletion using Bootbox
        bootbox.confirm("Do you really want to delete this record?", function(result) {
          if (result) {
            // If confirmed, make the AJAX request to delete the record
            $.ajax({
              url: 'index.php?action=delete&id=' + deleteid, // Target URL
              type: 'POST', // HTTP method
              data: {id: deleteid},
              success: function(response) {
                // Check if the response indicates success
                if (response == 1) {
                  // If successful, remove the row from the table
                  $(el).closest('tr').css('background', 'tomato');
                  $(el).closest('tr').fadeOut(800, function() {
                    $(this).remove();
                  });
                } else {
                  // If the deletion failed, show an alert
                  bootbox.alert('Record not deleted.');
                }
              }
            });
          }
        });
      });
    });
  </script>




</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container my-2">
      <a class="navbar-brand text-primary" href="index.php?action=index">PhoneBook</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php?action=index">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
        <div class="d-flex">
          <a href="index.php?action=create" class="btn btn-primary">Add Contact</a>
        </div>
      </div>
    </div>
  </nav>