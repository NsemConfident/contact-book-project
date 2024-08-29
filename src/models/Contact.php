<?php
// src/models/Contact.php
require_once __DIR__ . '/ContactFile.php';
require_once __DIR__ . '/../../config/database.php';

class Contact
{
    private $conn;
    private $table_name = 'contacts';

    public $id;
    public $name;
    public $phone;
    public $email;
    public $category;
    public $created_at;
    public $image;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Create new contact
    public function create()
    {
        // Initialize image to null
        $this->image = null;

        // Manage file upload
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
            $target_dir = realpath(dirname(__FILE__) . '/../../uploads') . '/';
            $target_file = $target_dir . basename($_FILES["image"]["name"]);

            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if the file is an actual image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                if (file_exists($target_file)) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>sorry!</strong> sorry image already exist
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                    $uploadOk = 0;
                } else if ($_FILES["image"]["size"] > 500000) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>sorry!</strong> incorrect phone number
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                    $uploadOk = 0;
                } else if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>sorry!</strong> Sorry, Only  JPG, JPEG, PNG & GIF files are allowed.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                    $uploadOk = 0;
                } else {
                    if ($uploadOk == 1 && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                        $this->image = "../../uploads/" . htmlspecialchars(basename($_FILES["image"]["name"]));
                        echo '<img src="' . $this->image . '" alt="">';
                    } else {
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>sorry!</strong> Sorry, there was an error uploading your file
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                    }
                }
            } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>sorry!</strong> File is not an image
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                $uploadOk = 0;
            }
        }

        // Ensure $this->image is not null before the insert query
        if (is_null($this->image)) {
            // Handle the case where no image was uploaded (use a default image, throw an error, etc.)
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>sorry!</strong> no image uploaded.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
            return false;
        }

        // Prepare and execute the insert query
        $query = "INSERT INTO " . $this->table_name . " (name, phone, email, category, image) VALUES (:name, :phone, :email, :category, :image)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':image', $this->image);

        $contactfile = new ContactFile();
        $contactfile->addContact($this->name, $this->phone, $this->category, $this->image);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Get all contacts
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Get a single contact by ID
    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a contact
    public function update()
    {

        $query = "UPDATE " . $this->table_name . " SET name = :name, phone = :phone, email = :email, category = :category, image= :image WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
            $target_dir = realpath(dirname(__FILE__) . '/../../uploads') . '/';
            $target_file = $target_dir . basename($_FILES["image"]["name"]);

            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if the file is an actual image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                } else if ($_FILES["image"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                } else if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                } else {
                    if ($uploadOk == 1 && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                        $this->image = "../../uploads/" . htmlspecialchars(basename($_FILES["image"]["name"]));
                        echo '<img src="' . $this->image . '" alt="">';
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Ensure $this->image is not null before the insert query
        if (is_null($this->image)) {
            // Handle the case where no image was uploaded (use a default image, throw an error, etc.)
            echo "No image uploaded.";
            return false;
        }



        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            $contactFile = new ContactFile();
            $contactFile->updateContact($this->id, $this->name, $this->phone, $this->category, $this->image);
            return true;
        }
        return false;
    }

    // Delete a contact
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);
        

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
