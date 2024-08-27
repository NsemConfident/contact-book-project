#BASIC PHONE BOOK APP USING *PHP + BOOSTRAP AND XAMP FOR MYSQL DATABASE*

This app will permit you to see list of contacts - name, phone number, category, image and when user clicks on a Contact, it shows them a details page with their full information. The user can click on edit and it will take them to an edit page and the user can also delete the contact from their contact list. We should also be able to add new users.

##INSTALLATION
To run this project, make sure you have the following installed 
-xampp any local server of your choice
-vscode
-install php

### HOW TO RUN THE PROJECT

-Pull the code to your local matchine and creat a folder in your xamp/htdocs folder. 
-copy the project folder and past inside the folder you just created
-run your xam control panel and run he appache sever and mysql
-click on admin, just beside mysql and create a database and also execute the query below

```CREATE DATABASE phonebook;```

`CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);`

-open your browser and search *localhost*, click on the folder containing your project

