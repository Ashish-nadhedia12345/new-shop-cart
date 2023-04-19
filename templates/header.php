<nav class="navbar navbar-expand-lg bg-primary" >
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=SITE_WS_PATH.'/catelog.php'?>">catelog</a>
          </li>
          <?php if(User::checkLogin()){ ?>
              <li class="nav-item">
            <a class="nav-link" href="<?=SITE_WS_PATH.'/logout.php'?>">Logout</a>
          </li>
        <?php  } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?=SITE_WS_PATH.'/register.php'?>">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=SITE_WS_PATH.'/login.php'?>">Login</a>
          </li>
      <?php  } ?>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-light" type="submit">Search</button>
          <a  class="btn btn-primary" href="<?=SITE_WS_PATH.'/cart.php'?>">Cart</a>
        </form>
      </div>
    </div>
  </nav>