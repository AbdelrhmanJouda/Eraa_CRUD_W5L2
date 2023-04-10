<?php session_start();
    define("BASE_URL","http://127.0.0.1/eraasoft2/session11/task/CRUD_Sys/");
    include "../functions/function.php";
    include "../messages/sessions.php"
 ?>


<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">AJ-CRUD SYS</a>
    <?php if(isset($_SESSION['user'])): ?>
    <span value=""><?=UserName('user');?></span>
    <?php endif;?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if(isset($_SESSION['logedin']) && $_SESSION['logedin']===true): ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL."pages/home.php" ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo BASE_URL."pages/users.php" ?>">User</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo BASE_URL."pages/products.php" ?>">products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo BASE_URL."pages/category.php" ?>">category</a>
        </li>
        <?php else: ?>
        <li class="nav-item">
          <a class="nav-link " href="<?PHP echo BASE_URL."pages/login.php" ?>">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?PHP echo BASE_URL."pages/register.php" ?>">Register</a>
        </li>
        <?php endif; ?>
      </ul>
        <?php if(isset($_SESSION['logedin']) && $_SESSION['logedin']===true): ?>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 my-auto">
        <li class="nav-item border rounded">
          <a class="nav-link btn  text-danger " href="<?php echo BASE_URL."pages/logout.php" ?>">Logout</a>
        </li>
        </ul>
        <?php endif; ?>

      
    </div>
  </div>
</nav>