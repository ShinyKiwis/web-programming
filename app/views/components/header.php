<nav class="navbar navbar-expand-lg bg-blue-700 px-5">
  <div class="container-fluid">
    <a class="navbar-brand logo" href="/home">Work Seekers</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-5">
        <li class="nav-item">
          <i class="fa-solid fa-house"></i>
          <a class="nav-link" aria-current="page" href="/home">Home</a>
        </li>
        <li class="nav-item">
          <i class="fa-solid fa-user"></i>
          <a class="nav-link" href="/home/candidate">Candidates</a>
        </li>
      </ul>
      <div class="dropdown">
        <i class="fa-solid fa-circle-user" id="profile-icon" data-bs-toggle="dropdown" aria-expanded="false"></i>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile-icon">
        <?php if(isset($_SESSION['user'])) {
          if($_SESSION['user']['type'] == 'candidate') {
            echo '<li><a class="dropdown-item" href="/profile">My profile</a></li>';
            echo '<li><a class="dropdown-item text-danger" href="/logout">Log out</a></li>';
          } else {
            echo '<li><a class="dropdown-item" href="/company/profile">Company profile</a></li>';
            echo '<li><a class="dropdown-item text-danger" href="/logout">Log out</a></li>';
          }
        } else {
          echo '<li><a class="dropdown-item" href="/login">Sign in</a></li>';
          echo '<li><a class="dropdown-item" href="/register">Create an account</a></li>';
        } 
        ?>
        </ul>
      </div>
    </div>
  </div>
</nav>
