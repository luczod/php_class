<?php
require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");

 $message = new Message($BASE_URL);
 $userDao = new UserDAO($conn, $BASE_URL);
 $type = filter_input(INPUT_POST,"type");
 
 if($type === "register") {
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // Minimum data verification
    if($name && $lastname && $email && $password) {
      // Check if passwords are the same
      if($password === $confirmpassword) {
        // Check if the email is already registered in the system
        if($userDao->findByEmail($email) === false) {

          $user = new User();
          // Token and password creation
          $userToken = $user->generateToken();
          $finalPassword = $user->generatePassword($password);

          $user->name = $name;
          $user->lastname = $lastname;
          $user->email = $email;
          $user->password = $finalPassword;
          $user->token = $userToken;

          $auth = true;

          $userDao->create($user, $auth);

        } else {
          // Send an error message, user already exists
          $message->setMessage("User already registered, try another email.", "error", "back");
        }

      } else {
        // Send an error message if the passwords don't match
        $message->setMessage("The passwords are not the same.", "error", "back");
      }

    } else {
      // Send an error message about missing data
      $message->setMessage("Please fill in all fields.", "error", "back");
    }

 }else if($type === "login"){
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    // Attempts to authenticate user
    if($userDao->authenticateUser($email, $password)) {
      $message->setMessage("Welcome!", "success", "editprofile.php");
    } else {
      // Redireciona o usuário, caso não conseguir autenticar
      $message->setMessage("Incorrect username and/or password.", "error", "back");
    }

  } else {
    $message->setMessage("Invalid information!", "error", "index.php");
  }

?>