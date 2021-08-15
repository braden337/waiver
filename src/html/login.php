<?php
require_once '../app.php';

Auth::guest();
User::login();

include 'header.php'
?>

<section class="d-flex justify-content-center align-items-center">

<form action="/login.php" method="POST">
<div class="mb-3">
<label class="form-label">Username</label>
<input type="text" class="form-control" name="username">
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" class="form-control" name="password">
</div>
<?= Auth::csrf_field() ?>

<div class="mb-3 d-flex flex-column align-items-center">
<input class="btn btn-primary" type="submit" value="Login">
or
<a href="/register.php">Register</a>
</div>
</form>

</section>

<?php include 'footer.php' ?>