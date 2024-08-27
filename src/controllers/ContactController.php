<?php
// src/controllers/ContactController.php
$path = '../../src/models/ContactFile.php';
echo "$path";
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


            if ($contact->create()) {
                header('Location: index.php');
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

            //handle image upload
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = "C:\xampp\htdocs\phonebook\src\controllers\uploads\\". basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $image);
            echo "image is uploaded";
           }


            $contactFile->updateContact($id, $contact->name, $contact->phone, $contact->category, $image);

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
            header('Location: index.php');
        }
    }
}
