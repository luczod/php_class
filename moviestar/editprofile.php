<?php
require_once("templates/header.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");

$user = new User();
$userDao = new UserDao($conn, $BASE_URL);
$userData = $userDao->verifyToken(true);
$fullName = $user->getFullName($userData);

if ($userData->image == "") {
  $userData->image = "user.png";
}
?>
<main id="main-container" class="container-fluid edit-profile-page">
  <div class="col-md-12">
    <form action="<?= $BASE_URL ?>user_process.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="type" value="update">
      <div class="row">
        <div class="col-md-4">
          <h1><?= $fullName ?></h1>
          <p class="page-description">Change your details in the form below:</p>
          <div class="form-group">
            <label for="name">Name:</label>
            <input id="name" type="text" class="form-control" name="name" placeholder="Enter your name" value="<?= $userData->name ?>">
          </div>
          <div class="form-group">
            <label for="lastname">Lastname:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter your name" value="<?= $userData->lastname ?>">
          </div>
          <div class="form-group">
            <label for="email">E-mail:</label>
            <input id="email" type="text" class="form-control disabled" name="email" placeholder="Enter your name" value="<?= $userData->email ?>" readonly>
          </div>
          <input type="submit" class="btn card-btn" value="Change">
        </div>
        <div class="col-md-4">
          <div id="profile-image-container" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>')"></div>
          <div class="form-group">
            <label for="image">Photo::</label>
            <input id="image" type="file" class="form-control-file" name="image">
          </div>
          <div class="form-group">
            <label for="bio">About you:</label>
            <textarea id="bio" class="form-control" name="bio" rows="5" placeholder="Tell us who you are, what you do and where you work...">
              <?= $userData->bio ?>
            </textarea>
          </div>
        </div>
      </div>
    </form>
    <div class="row" id="change-password-container">
      <div class="col-md-4">
        <h2>Change password:</h2>
        <p class="page-description">Enter the new password and confirm it to change your password:</p>
        <form action="<?= $BASE_URL ?>user_process.php" method="POST">
          <input type="hidden" name="type" value="changepassword">
          <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Digite a sua nova senha">
          </div>
          <div class="form-group">
            <label for="confirmpassword">Password confirmation:</label>
            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirme a sua nova senha">
          </div>
          <input type="submit" class="btn card-btn" value="Change Password">
        </form>
      </div>
    </div>
  </div>
</main>
<?php
require_once("templates/footer.php");
?>