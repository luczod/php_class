<?php
  require_once("templates/header.php");
  // Checks if user is authenticated
  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("dao/MovieDAO.php");

  $user = new User();
  $userDao = new UserDAO($conn, $BASE_URL);
  $movieDao = new MovieDAO($conn, $BASE_URL);

  // Get user id
  $id = filter_input(INPUT_GET, "id");

  if(empty($id)) {

    if(!empty($userData)) {
      $id = $userData->id;

    } else {
      $message->setMessage("User not found", "error", "index.php");

    }

  } else {
    $userData = $userDao->findById($id);
    // // If user not found
    if(!$userData) {
      $message->setMessage("User not found", "error", "index.php");
    }

  }

  $fullName = $user->getFullName($userData);

  if($userData->image == "") {
    $userData->image = "user.png";
  }
  // Movies the user added
  $userMovies = $movieDao->getMoviesByUserId($id);

?>
  <div id="main-container" class="container-fluid">
    <div class="col-md-8 offset-md-2">
      <div class="row profile-container">
        <div class="col-md-12 about-container">
          <h1 class="page-title"><?= $fullName ?></h1>
          <div id="profile-image-container" class="profile-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>')"></div>
          <h3 class="about-title">Sobre:</h3>
          <?php if(!empty($userData->bio)): ?>
            <p class="profile-description"><?= $userData->bio ?></p>
          <?php else: ?>
            <p class="profile-description">The user has not written anything here yet...</p>
          <?php endif; ?>
        </div>
        <div class="col-md-12 added-movies-container">
          <h3>Filmes que enviou:</h3>
          <div class="movies-container">
            <?php foreach($userMovies as $movie): ?>
              <?php require("templates/movie_card.php"); ?>
            <?php endforeach; ?>
            <?php if(count($userMovies) === 0): ?>
              <p class="empty-list">The user has not yet uploaded any movies.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>