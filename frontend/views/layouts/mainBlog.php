<?php
  use yii\helpers\Html;
  use yii\bootstrap\Nav;
  use yii\bootstrap\NavBar;
  use yii\widgets\Breadcrumbs;
  use frontend\assets\AppAssetBlog;
  use common\widgets\Alert;
  	AppAssetBlog::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="googlebot" content="noodp"/>
  <title><?= Html::encode($this->title) ?></title>
  <meta name="description" content="<?= $GLOBALS['dataSeo'][0]['metaDescription'] ?>">
  <meta name="keywords" content="<?= $GLOBALS['dataSeo'][0]['metaKeywords'] ?>">
  <link rel="canonical" href="https://www.islapixel.com/blog"/>
  <meta name="Robots" content="index, follow">
  <meta name="revisit-after" content="1 day">
  <meta name="Distribution" content="Global">
  <meta name="geography" content="Venezuela">
  <meta name="language" content="spanish">
  <meta name="city" content="Nueva Esparta, Venezuela">
  <meta name="country" content="Venezuela">
  <link rel="shortcut icon" href="<?= Yii::getAlias('@web').'/img/logo.webp'?>">
  <meta name="author" content="Desarrollo Marcano F.P.">

  <?= Html::csrfMetaTags() ?>
  <?php $this->head() ?>

</head>

<body>
	<?php $this->beginBody() ?>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="<?= Yii::getAlias('@web').'/img/logo.webp'?>" class="img-fluid w-75" alt="Logo IslaPixel Blanco"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?= $content ?>

  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; <?= date('Y') ?> <a href="mailto:nxtlvl.oficial@gmail.com?subject=Cotizacion%20de%20un%20sitio%20o%20sistema%20web"><strong>Nxt Lvl Dev<sup><i class="far fa-paper-plane fa-lg"></i></sup></strong></a></p>
    </div>
    <!-- /.container -->
  </footer>
<?php $this->endBody() ?>
</body>

</html>

<?php $this->endPage() ?>