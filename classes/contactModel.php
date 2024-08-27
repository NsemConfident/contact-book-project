<?php
// class ContactModel {
//   public $name;
//   public $phone;
//   public $category;

//   public $image;

//   function __construct($name, $phone, $category, $image){
//     $this->name = $name;
//     $this->phone = $phone;
//     $this->category = $category;
//   }

//   function image_picker(){
//     $image = null;
//     if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
//         $image = 'uploads/' . basename($_FILES['image']['name']);
//         move_uploaded_file($_FILES['image']['tmp_name'], $image);
//     }
//     return $image;
//   }

//   function set_name($name) { 
//     $this->name = $name;
//   }
//   function set_phone($phone) { 
//     $this->phone = $phone;
//   }
// function set_category($category) { 
//     $this->category = $category;
//   }
//   function get_name() {
//     return $this->name;
//   }
//   function get_phone() {
//     return $this->phone;
//   }
//   function get_category() {
//     return $this->category;
//   }
//   function get_image(){
//     return $this->get_image();
//   }
//   function set_imgage($image){
//     $this->image=$image;
//   }
// }
?>