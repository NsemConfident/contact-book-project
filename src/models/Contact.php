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
        $this->image = null;
        $query = "INSERT INTO " . $this->table_name . " (name, phone, email, category,image) VALUES (:name, :phone, :email, :category, :image)";
        $stmt = $this->conn->prepare($query);


        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $this->image = 'C:\xampp\htdocs\phonebook\uploads\\' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $this->image);
        }

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

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $this->image = 'C:\xampp\htdocs\phonebook\uploads\\' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $this->image);
        }


        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
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
