<?php
  require_once("templates/header.php");
  // Checks if user is authenticated
  require_once("models/Movie.php");
  require_once("dao/MovieDAO.php");
  require_once("dao/ReviewDAO.php");

  // Get movie id
  $id = filter_input(INPUT_GET, "id");

  $movie;
  $movieDao = new MovieDAO($conn, $BASE_URL);

  $reviewDao = new ReviewDAO($conn, $BASE_URL);

  if(empty($id)) {
    $message->setMessage("The movie was not found!", "error", "index.php");

  } else {
    $movie = $movieDao->findById($id);
    // Check if movie exists
    if(!$movie) {
      $message->setMessage("The movie was not found!", "error", "index.php");
    }
  }

  // Check if the movie has an image
  if($movie->image == "") {
    $movie->image = "movie_cover.jpg";
  }

  // Check if the movie belongs to the user
  $userOwnsMovie = false;

  if(!empty($userData)) {

    if($userData->id === $movie->users_id) {
      $userOwnsMovie = true;
    }
    // Recover movie reviews 
    $alreadyReviewed = $reviewDao->hasAlreadyReviewed($id, $userData->id);;
  }
  // Recover movie reviews 
  $movieReviews = $reviewDao->getMoviesReview($movie->id);;

?>
<div id="main-container" class="container-fluid">
  <div class="row">
    <div class="offset-md-1 col-md-6 movie-container">
      <h1 class="page-title"><?= $movie->title ?></h1>
      <p class="movie-details">
        <span>Duration: <?= $movie->length ?></span>
        <span class="pipe"></span>
        <span><?= $movie->category ?></span>
        <span class="pipe"></span>
        <span><i class="fas fa-star"></i> <?= $movie->rating ?></span>
      </p>
      <iframe src="<?= $movie->trailer ?>" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encryted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <p><?= $movie->description ?></p>
    </div>
    <div class="col-md-4">
      <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?>img/movies/<?= $movie->image ?>')"></div>
    </div>
    <div class="offset-md-1 col-md-10" id="reviews-container">
      <h3 id="reviews-title">Reviews:</h3>
      <!-- Checks whether to enable review for the user or not -->
      <?php if(!empty($userData) && !$userOwnsMovie && !$alreadyReviewed): ?>
      <div class="col-md-12" id="review-form-container">
        <h4>Submit your review:</h4>
        <p class="page-description">Fill out the form with your rating and comment about the film</p>
        <form action="<?= $BASE_URL ?>review_process.php" id="review-form" method="POST">
          <input type="hidden" name="type" value="create">
          <input type="hidden" name="movies_id" value="<?= $movie->id ?>">
          <div class="form-group">
            <label for="rating">Movie rating:</label>
            <select name="rating" id="rating" class="form-control">
              <option value="">Selecione</option>
              <option value="10">10</option>
              <option value="9">9</option>
              <option value="8">8</option>
              <option value="7">7</option>
              <option value="6">6</option>
              <option value="5">5</option>
              <option value="4">4</option>
              <option value="3">3</option>
              <option value="2">2</option>
              <option value="1">1</option>
            </select>
          </div>
          <div class="form-group">
            <label for="review">Your comment:</label>
            <textarea name="review" id="review" rows="3" class="form-control" placeholder="What did you think of the movie?"></textarea>
          </div>
          <input type="submit" class="btn card-btn" value="Submit a comment">
        </form>
      </div>
      <?php endif; ?>
      <!-- Commentss -->
      <?php foreach($movieReviews as $review): ?>
        <?php require("templates/user_review.php"); ?>
      <?php endforeach; ?>
      <?php if(count($movieReviews) == 0): ?>
        <p class="empty-list">There are no comments for this movie yet...</p>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php
  require_once("templates/footer.php");
?>