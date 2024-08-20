<?php
require_once("templates/header.php");
// Checks if user is authenticated
require_once("models/User.php");
require_once("dao/UserDAO.php");

$user = new User();
$userDao = new UserDao($conn, $BASE_URL);

$userData = $userDao->verifyToken(true);

?>
<main id="main-container" class="continer-fluid">
  <div class="offset-md-4 col-md-4 new-movie-container">
    <h1 class="page-title">Include movie</h1>
    <p class="page-description">Add your review and share it with the world!</p>
    <form action="<?= $BASE_URL ?>movie_process.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="type" value="create">
      <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Enter the title of your movie">
      </div>
      <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control-file" name="image" id="image">
      </div>
      <div class="form-group">
        <label for="length">Duração:</label>
        <input type="text" class="form-control" id="length" name="length" placeholder="Enter the duration of the movie">
      </div>
      <div class="form-group">
        <label for="category">Category:</label>
        <select name="category" id="category" class="form-control">
          <option value="">Selecione</option>
          <option value="Action">Action</option>
          <option value="Drama">Drama</option>
          <option value="Comedy">Comedy</option>
          <option value="Fantasy / Sci-Fi">Fantasy / Sci-Fi</option>
          <option value="Romantic">Romantic</option>
        </select>
      </div>
      <div class="form-group">
        <label for="trailer">Trailer:</label>
        <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insert trailer link">
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="5" class="form-control" placeholder="Describe the movie..."></textarea>
      </div>
      <input type="submit" class="btn card-btn" value="Add movie">
    </form>
  </div>
</main>
<?php
require_once("templates/footer.php");
?>