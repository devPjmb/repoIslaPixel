<?php
  use yii\helpers\Html;
  use yii\bootstrap\Nav;
  use yii\bootstrap\NavBar;
  use yii\widgets\Breadcrumbs;
  use frontend\assets\AppAsset;
  use common\widgets\Alert;
  AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-145009983-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-145009983-1');
  </script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Isla Pixel Publicidad!">
  <meta name="author" content="Desarrollo Marcano F.P.">

  <?= Html::csrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>

</head>

<body id="page-top">
  <?php $this->beginBody() ?>
  <div class="se-pre-con"></div>

  <!-- Navigation -->
  <nav class="wow fadeInDownBig navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="img/logo.png" class="img-fluid" width="250"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#services">Servicios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#portfolio">Portafolio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">Acerca de Nosotros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#team">Equipo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contacto</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?= $content ?>
  
  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="wow flipInY row footer-center">
        <div class="col-md-4">
          <span class="copyright">Copyright &copy; Pablo Marcano <a href="mailto:pablo.marcano.16@gmail.com?subject=Cotizacion%20de%20un%20sitio%20o%20sistema%20web"><i class="far fa-paper-plane fa-lg"></i></a></span>
        </div>
        <div class="col-md-4">
          <ul class="list-inline social-buttons">
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-whatsapp"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-instagram"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-4">
          <ul class="list-inline quicklinks">
            <li class="list-inline-item">
              <a href="javascript:void(0);">
                  <i class="fab fa-html5 fa-4x"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="javascript:void(0);">
                  <i class="fab fa-css3-alt fa-4x"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="javascript:void(0);">
                  <i class="fab fa-js fa-4x"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <?php foreach($GLOBALS['dataPortfolio'] as $auxPortfolio): ?>
  <?php $dataModal = str_replace(' ', '_', $auxPortfolio['ProjectName']) ?>
  <div class="portfolio-modal modal fade" id="<?= $dataModal?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
                <!-- Project Details Go Here -->
                <h2 class="text-uppercase"><?= $auxPortfolio->ProjectName?></h2>
                <!-- <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p> -->
                <img class="img-fluid d-block mx-auto" src="img/portfolio/<?= $auxPortfolio->ProjectImg?>" alt="">
                <p><?= $auxPortfolio->ProjectDescription?></p>
                <!-- <ul class="list-inline">
                  <li>Date: January 2017</li>
                  <li>Client: Window</li>
                  <li>Category: Photography</li>
                </ul> -->
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                  <i class="fas fa-times"></i>
                  Cerrar Proyecto</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach ?>
  <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>