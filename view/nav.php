<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo BASE_URL ?>task">TASK</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL ?>task"><i class="fa-solid fa-house"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#appModal"><i class="fa-sharp fa-solid fa-calendar-plus"></i></a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link active" href="<?php echo BASE_URL ?>user/logout"><i class="fa-solid fa-right-from-bracket"></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>