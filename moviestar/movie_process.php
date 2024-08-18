<?php

require_once("globals.php");
require_once("db.php");
require_once("models/Movie.php");
require_once("models/Message.php");
require_once("dao/MovieDAO.php");
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$movieDao = new MovieDAO($conn, $BASE_URL);

// Receiving the form type
$type = filter_input(INPUT_POST, "type");

// Retrieve user data  data Invalid information! Receiving post data
$userData = $userDao->verifyToken();

if($type === "create") {
    // Receiving post data
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");

    $movie = new Movie();

    // Check minimum
    if(!empty($title) && !empty($description) && !empty($category)) {
      $movie->title = $title;
      $movie->description = $description;
      $movie->trailer = $trailer;
      $movie->category = $category;
      $movie->length = $length;
      $movie->users_id = $userData->id;

      // Movie image upload
      if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
        $image = $_FILES["image"];
        $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
        $jpgArray = ["image/jpeg", "image/jpg"];

        // Checking image type
        if(in_array($image["type"], $imageTypes)) {
          // Checa se imagem é jpg
          if(in_array($image["type"], $jpgArray)) {
            $imageFile = imagecreatefromjpeg($image["tmp_name"]);
          } else {
            $imageFile = imagecreatefrompng($image["tmp_name"]);
          }

          // Generating the image name
          $imageName = $movie->imageGenerateName();
          imagejpeg($imageFile, "./img/movies/" . $imageName, 100);
          $movie->image = $imageName;

        } else {
          $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");
        }

      }

      $movieDao->create($movie);

    } else {
      $message->setMessage("Você precisa adicionar pelo menos: título, descrição e categoria!", "error", "back");
    }

  } else if($type === "delete") {
    // Receiving post data
    $id = filter_input(INPUT_POST, "id");
    $movie = $movieDao->findById($id);

    if($movie) {
      // Check if the movie belongs to the user
      if($movie->users_id === $userData->id) {

        $movieDao->destroy($movie->id);

      } else {
        $message->setMessage("Invalid information!!", "error", "index.php");
      }

    } else {
      $message->setMessage("Invalid information!!", "error", "index.php");
    }

  } else if($type === "update") { 
    // Receiving post data
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");
    $id = filter_input(INPUT_POST, "id");

    $movieData = $movieDao->findById($id);

    // Check if you found the movie
    if($movieData) {
      // Check if the movie belongs to the user
      if($movieData->users_id === $userData->id) {
        // Minimum data validation
        if(!empty($title) && !empty($description) && !empty($category)) {

          // Film editing
          $movieData->title = $title;
          $movieData->description = $description;
          $movieData->trailer = $trailer;
          $movieData->category = $category;
          $movieData->length = $length;

          // Movie image upload
          if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $image = $_FILES["image"];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpeg", "image/jpg"];

            // Checking image type
            if(in_array($image["type"], $imageTypes)) {

              // Check if image is jpg
              if(in_array($image["type"], $jpgArray)) {
                $imageFile = imagecreatefromjpeg($image["tmp_name"]);
              } else {
                $imageFile = imagecreatefrompng($image["tmp_name"]);
              }

              // Generating the image name
              $movie = new Movie();
              $imageName = $movie->imageGenerateName();
              imagejpeg($imageFile, "./img/movies/" . $imageName, 100);
              $movieData->image = $imageName;

            } else {
              $message->setMessage("Invalid image type, please enter png or jpg!", "error", "back");
            }
          }

          $movieDao->update($movieData);

        } else {
          $message->setMessage("You need to add at least: title, description and category!", "error", "back");
        }

      } else {
        $message->setMessage("Invalid information!!", "error", "index.php");
      }

    } else {
      $message->setMessage("Invalid information!!", "error", "index.php");
    }
  
  } else {
    $message->setMessage("Invalid information!!", "error", "index.php");
  }