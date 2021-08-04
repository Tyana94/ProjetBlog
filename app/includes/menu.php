<?php
  @session_start();
?>

<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <a class="navbar-brand" href="http://localhost/blog/"><img class="logo-blog" src="/blog/public/images/logo.jpg" alt="Logo blog"> </a>
        </div>
      </div>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <b>Menu</b>
      <i class="fa fa-bars"></i>
      </button>



<!-- </div> -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
              <li class="nav-item">
                  <a class="nav-link" href="/blog/"><b>Accueil</b></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="public/cv/cv_developpeuse_php.pdf"><b>CV</b></a>
              </li>
              <?php if(!isset($_SESSION["user"])): ?>
              <li class="nav-item">
                  <a class="nav-link" href="/blog/login"><b>Connexion</b></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="/blog/inscription" class="bnt btn-primary btn-lg" data-toggle="modal" data-target="#"><b>Inscription</b></a>
             </li>
             <?php else: ?>
             <li class="nav-item">
                  <a class="nav-link" href="/blog/logout"><b>Déconnexion</b></a>
              </li>
              <?php endif; ?>
         </ul>
        </div>
    </div>
</nav>
