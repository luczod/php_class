<?php
require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);

// Recovers the form type
$type = filter_input(INPUT_POST, "type");

// Update user
if ($type === "update") {
    // Recovers user data
    $userData = $userDao->verifyToken();

    // Receive post data
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $bio = filter_input(INPUT_POST, "bio");

    // Create a new user object
    $user = new User();

    // Fill in user data
    $userData->name = $name;
    $userData->lastname = $lastname;
    $userData->email = $email;
    $userData->bio = $bio;

    // Image upload
    // $_FILES["image"] = global variable to handle images
    if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
        $image = $_FILES["image"];
        $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
        $jpgArray = ["image/jpeg", "image/jpg"];

        // Image type check
        if (in_array($image["type"], $imageTypes)) {
            // Check jpg
            if (in_array($image["type"], $jpgArray)) {
                // extension=gd must be enabled in the php.ini file
                $imageFile = imagecreatefromjpeg($image["tmp_name"]);
            } else {
                $imageFile = imagecreatefrompng($image["tmp_name"]);
            }

            $imageName = $user->imageGenerateName();
            imagejpeg($imageFile, "./img/users/" . $imageName, 100);

            $userData->image = $imageName;
        } else {
            $message->setMessage("Invalid image type, please enter png or jpg!", "error", "back");
        }
    }
    $userDao->update($userData);
} else if ($type === "changepassword") {
    // Receive post data
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");
    // Recovers user data
    $userData = $userDao->verifyToken();

    $id = $userData->id;

    if ($password == $confirmpassword) {
        // Create a new user object
        $user = new User();

        $finalPassword = $user->generatePassword($password);

        $user->password = $finalPassword;
        $user->id = $id;

        $userDao->changePassword($user);
    } else {
        $message->setMessage("The passwords are not the same!", "error", "back");
    }
} else {
    $message->setMessage("Invalid information!", "error");
}
