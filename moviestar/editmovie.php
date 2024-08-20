<?php
require_once("templates/header.php");
// Checks if user is authenticated
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("dao/MovieDAO.php");

$user = new User();
$userDao = new UserDao($conn, $BASE_URL);
$userData = $userDao->verifyToken(true);
$movieDao = new MovieDAO($conn, $BASE_URL);

$id = filter_input(INPUT_GET, "id");

if (empty($id)) {
  $message->setMessage("The movie was not found!", "error", "index.php");
} else {
  $movie = $movieDao->findById($id);
  // Check if movie exists
  if (!$movie) {
    $message->setMessage("The movie was not found!", "error", "index.php");
  }
}
// Check if the movie has an image
if ($movie->image == "") {
  $movie->image = "movie_cover.jpg";
}

?>
<div id="main-container" class="container-fluid">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-6 offset-md-1">
        <h1><?= $movie->title ?></h1>
        <p class="page-description">Change the film data in the form below:</p>
        <form id="edit-movie-form" action="<?= $BASE_URL ?>movie_process.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="type" value="update">
          <input type="hidden" name="id" value="<?= $movie->id ?>">
          <div class="form-group">
            <label for="title">Título:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter the title of your movie" value="<?= $movie->title ?>">
          </div>
          <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" name="image" id="image">
          </div>
          <div class="form-group">
            <label for="length">Duration:</label>
            <input type="text" class="form-control" id="length" name="length" placeholder="Enter the duration of the movie" value="<?= $movie->length ?>">
          </div>
          <div class="form-group">
            <label for="category">Category:</label>
            <select name="category" id="category" class="form-control">
              <option value="">Select</option>
              <option value="Action" <?= $movie->category === "Action" ? "selected" : "" ?>>Action</option>
              <option value="Drama" <?= $movie->category === "Drama" ? "selected" : "" ?>>Drama</option>
              <option value="Comedy" <?= $movie->category === "Comedy" ? "selected" : "" ?>>Comedy</option>
              <option value="Fantasy / Fiction" <?= $movie->category === "Fantasy / Fiction" ? "selected" : "" ?>>Fantasy / Fiction</option>
              <option value="Romantic" <?= $movie->category === "Romantic" ? "selected" : "" ?>>Romantic</option>
            </select>
          </div>
          <div class="form-group">
            <label for="trailer">Trailer:</label>
            <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insert trailer link" value="<?= $movie->trailer ?>">
          </div>
          <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea name="description" id="description" rows="5" class="form-control" placeholder="Describe the movie..."><?= $movie->description ?></textarea>
          </div>
          <input type="submit" class="btn card-btn" value="Edit movie">
        </form>
      </div>
      <div class="col-md-3">
        <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?>img/movies/<?= $movie->image ?>')"></div>
      </div>
    </div>
  </div>
</div>
<?php
require_once("templates/footer.php");
?>