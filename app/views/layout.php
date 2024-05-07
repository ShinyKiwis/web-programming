<?php
require_once 'models/User.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if(!isset($_SESSION['user']) && isset($_SESSION['user_id'])) {
  $_SESSION['user'] = User::get_user_by_id($_SESSION['user_id']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($pageTitle) ? $pageTitle : "Work Seekers"; ?></title>
  <link rel="stylesheet" href="/views/css/main.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
  <header>
    <?php
      $current_path = $_SERVER['REQUEST_URI']; 
      $excludeHeaderPaths = array("/login", "/register");
      $excludeSearchBarPaths = array("/profile", "/profile/edit", "/profile/applied-job", "/profile/cv", "/company/profile", "/company/profile/edit", "/company/add-job", "/company/list-job");
      if (!in_array($current_path, $excludeHeaderPaths)) {
        include('components/header.php');
      }
    ?>
  </header>
  <main class="overflow-auto overflow-x-hidden" style="height: 100vh;">
    <?php
      if (!in_array($current_path, $excludeSearchBarPaths) && !in_array($current_path, $excludeHeaderPaths) && !strstr($current_path, '/job') && !strstr($current_path, "/cv")) {
        include ('components/search_bar.php');
      }
      echo $content;
    ?>

  </main>
  <footer>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
  <script src="https://kit.fontawesome.com/9255a9b9ab.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/pdfobject"></script>
</body>
</html>
