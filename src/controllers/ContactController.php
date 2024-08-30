<?php
// src/controllers/ContactController.php
$path = '../../src/models/ContactFile.php';
require_once __DIR__ . '/../models/Contact.php';




class ContactController
{
    public function index()
    {
        $contact = new Contact();
        $stmt = $contact->read();
        include __DIR__ . '/../views/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contact = new Contact();
            $contact->name = $_POST['name'];
            $contact->phone = $_POST['phone'];
            $contact->email = $_POST['email'];
            $contact->category = $_POST['category'];

            if (is_string($contact->name) && is_string($contact->category) && is_string($contact->email)) {

                //email verification and validation and phone number verification 
                $sanitizedEmail = filter_var($contact->email, FILTER_SANITIZE_EMAIL);
                if (filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {

                    $sanitizedEmail = $contact->email;
                    if (strlen($contact->phone) < 9) {

                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>sorry!</strong> incorrect phone number
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                    } else {
                        if ($contact->create()) {
                            header('Location: index.php');
                        }
                    }
                } else {
                }
            } else {
            }
        }
        include __DIR__ . '/../views/create.php';
    }

    public function edit($id)
    {
        // code to update file
        $id = $_GET['id'] ?? null;
        $contactFile = new ContactFile();
        $contactData = $contactFile->getContact($id);


        // if (!$contactData) {
        //     header('Location: index.php');
        //     exit;
        // }
        // end
        $contact = new Contact();
        $contact->id = $id;
        $currentContact = $contact->readOne();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contact->name = $_POST['name'];
            $contact->phone = $_POST['phone'];
            $contact->email = $_POST['email'];
            $contact->category = $_POST['category'];
            $contact->image = $_POST['image'];

            //handle image upload
            // $image = null;
            // if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            //     $image = "C:\xampp\htdocs\phonebook\src\controllers\uploads\\" . basename($_FILES['image']['name']);
            //     move_uploaded_file($_FILES['image']['tmp_name'], $image);
            //     echo "image is uploaded";
            // }

            if ($contact->update()) {
                header('Location: index.php');
            }
        }

        include __DIR__ . '/../views/edit.php';
    }

    public function delete($id)
    {
        $contact = new Contact();
        $contact->id = $id;

        if ($id !== null) {
            $contactfile = new ContactFile();
            $contactfile->deleteContact($id);
        }

        if ($contact->delete()) {
            // Return a success response (1)
            
        } else {
            // Return a failure response (0 or any other value)
        }
    }
}
