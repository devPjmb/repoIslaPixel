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
<html lang="es">

<head>
  <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?render=6Ld3DGIaAAAAAOBqXniz4hFjFF7lU8XZtMQvjlbj"></script> 
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-145009983-1"></script>
  <script>
    function enviarFormulario() {
      grecaptcha.ready(function() {
        grecaptcha.execute('6Ld3DGIaAAAAAOBqXniz4hFjFF7lU8XZtMQvjlbj', {
          action: 'procesar'
        }).then(function(token) {
          document.getElementById('token').value = token;
          document.getElementById("formulario").submit();
        });
      });
    } 
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-145009983-1');
    function onSubmit(token) {
      document.getElementById("contactForm").submit();
    }
  </script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="googlebot" content="noodp"/>
  <title><?= Html::encode($this->title) ?></title>
  <meta name="description" content="<?= $GLOBALS['dataSeo'][0]['metaDescription'] ?>">
  <meta name="keywords" content="<?= $GLOBALS['dataSeo'][0]['metaKeywords'] ?>">
  <link rel="canonical" href="https://www.islapixel.com"/>
  <meta name="Robots" content="index, follow">
  <meta name="revisit-after" content="1 day">
  <meta name="Distribution" content="Global">
  <meta name="geography" content="Venezuela">
  <meta name="language" content="spanish">
  <meta name="city" content="Nueva Esparta, Venezuela">
  <meta name="country" content="Venezuela">
  <meta name="author" content="NXT LVL DEV">
  <link rel="shortcut icon" href="img/favicon.ico">
  <?= Html::csrfMetaTags() ?>
  <?php $this->head() ?>
  <style>
    header.masthead{
      background-image:url(img/start/<?= $GLOBALS['dataStart'][0]['ImgBackground'] ?>);
      background-repeat:no-repeat;
      background-position:center;
      background-attachment:fixed;
      background-size: cover;
    }
    section#contact{
      background-image:url(img/contact/<?= $GLOBALS['dataContact'][0]['imgBackground'] ?>);
      background-repeat:no-repeat;
      background-position:center;
      background-attachment:fixed;
      background-size: cover;
    }
  </style>
</head>

<body id="page-top">
  <?php $this->beginBody() ?>
  <div class="se-pre-con">
    <img src="img/page-loading.webp" class="img-fluid w-25" alt="page-loading">
  </div>

  <!-- Navigation -->
  <nav class="fadeInDownBig navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="img/logo.webp" class="img-fluid" width="250" alt="Logo IslaPixel Blanco"></a>
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
          <!-- <li class="nav-item">
            <a class="nav-link" href="blog">Blog</a>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>

  <?= $content ?>
  
  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="flipInY row footer-center">
        <div class="col-md-4">
          <span class="copyright">Copyright &copy; <?= date('Y') ?> <a href="mailto:nxtlvl.oficial@gmail.com?subject=Cotizacion%20de%20un%20sitio%20o%20sistema%20web"><strong>Nxt Lvl Dev<sup><i class="far fa-paper-plane fa-lg"></i></sup></strong></a></span>
        </div>
        <div class="col-md-4">
          <ul class="list-inline social-buttons">
            <li class="list-inline-item">
              <a href="https://facebook.com/islapixel/" target="_blank">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://api.whatsapp.com/send?phone=584268882241&text=Contacto%20desde%20https%3A%2F%2Fislapixel.com%2F" target="_blank">
                <i class="fab fa-whatsapp"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://instagram.com/islapixel" target="_blank">
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
  <?php $dataModal = preg_replace('([^A-Za-z0-9])', '_', $auxPortfolio['ProjectName']) ?>
  <div class="portfolio-modal modal fade" id="<?= $dataModal.$auxPortfolio['PortfolioID']?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                <h2 class="text-uppercase"><?= $auxPortfolio->ProjectName?></h2>
                <img class="img-fluid d-block mx-auto" src="img/portfolio/<?= $auxPortfolio->ProjectImg?>" alt="<?= $auxPortfolio->ProjectName?>">
                <div><?= $auxPortfolio->ProjectDescription?></div>
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
  <!--Start of Tawk.to Script-->
  <!-- <script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/5fd3c945a8a254155ab27e09/default';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
  })();
  </script> -->
  <!--End of Tawk.to Script-->
</body>
</html>
<?php $this->endPage() ?>