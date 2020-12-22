<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\bootstrap\ActiveForm;
    $this->title = 'Isla Pixel Publicidad C.A. Empresa dedicada al diseño grafico.';
?>

<!-- Header -->
  <header class="masthead">
    <div class="container">
      <div class="intro-text">
        <a class="fadeInUpBig btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Conoce Mas</a>
      </div>
    </div>
  </header>

  <!-- Services -->
  <section class="page-section" id="services">
    <div class="container">
      <div class="row">
        <div class="zoomIn col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Servicios</h2>
          <hr>
        </div>
      </div>
      <div class="row text-center">
        <?php foreach($ModelServices as $auxServices): ?>
          <div class="slideInLeft col-md-4">
            <img alt="<?= $auxServices->ServiceName?>" class="img-fluid imgServices" src="img/services/<?= $auxServices->ServiceImg?>">
            <h4 class="service-heading"><?= $auxServices->ServiceName?></h4>
            <div class="text-muted"><?= $auxServices->ServiceDescription?></div>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </section>

  <!-- Portfolio Grid -->
  <section class="bg-light page-section" id="portfolio">
    <div class="container">
      <div class="row">
        <div class="fadeInUpBig col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Portafolio</h2>
          <hr>
        </div>
      </div>
      <div class="row" id="portfolio-carousel">
        <?php foreach($ModelPortfolio as $auxPortfolio): ?>
          <?php $dataModal = str_replace('([^A-Za-z0-9])', '_', $auxPortfolio->ProjectName) ?>
          <div class="rotateInDownLeft col-md-6 portfolio-item">
            <a class="portfolio-link" data-toggle="modal" href="#<?= $dataModal.$auxPortfolio->PortfolioID?>">
              <div class="portfolio-hover">
                <div class="portfolio-hover-content">
                  <i class="fas fa-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid img-thumbnail" src="img/portfolio/<?= $auxPortfolio->ProjectImg?>" alt="<?= $auxPortfolio->ProjectName?>">
            </a>
            <div class="portfolio-caption">
              <h4><?= $auxPortfolio->ProjectName?></h4>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </section>

  <!-- About -->
  <section class="page-section" id="about">
    <div class="container">
      <div class="row">
        <div class="fadeInUpBig col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Acerca de Nosotros</h2>
          <hr>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <ul class="timeline">
            <?php $change = true; ?>
            <?php foreach($ModelAboutUs as $auxAboutUs): ?>
            <li class="fadeInLeftBig <?= ($change)?'1':'timeline-inverted'; ?>">
              <?php $change = ($change)?false:true; ?>
              <div class="timeline-image">
                <img class="rounded-circle img-fluid" src="img/about/<?= $auxAboutUs->Image ?>" alt="<?= $auxAboutUs->Title ?>">
              </div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h4><?= $auxAboutUs->Year ?></h4>
                  <h4 class="subheading"><?= $auxAboutUs->Title ?></h4>
                </div>
                <div class="timeline-body">
                  <div class="text-muted"><?= $auxAboutUs->Description ?></div>
                </div>
              </div>
            </li>
            <?php endforeach ?>
            <li class="heartBeat timeline-inverted">
              <div class="timeline-image">
                <h4>¡Se Parte
                  <br>De Nuestra
                  <br>Historia!</h4>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Team -->
  <section class="bg-light page-section" id="team">
    <div class="container">
      <div class="row">
        <div class="fadeInUpBig col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Nuestro Equipo Creativo</h2>
          <hr>
        </div>
      </div>
      <div class="row" id="team-carousel">
        <?php foreach($ModelTeam as $auxTeam): ?>
        <div class="zoomInLeft col-sm-4">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="img/team/<?= $auxTeam->Photo ?>" alt="<?= $auxTeam->Name ?>">
            <h4><?= $auxTeam->Name ?></h4>
            <p class="text-muted"><?= $auxTeam->Job ?></p>
            <ul class="list-inline social-buttons">
              <?php if(!empty($auxTeam->SocialNetwork1)): ?>
              <li class="list-inline-item">
                <a href="<?= $auxTeam->SocialNetwork1 ?>">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <?php endif ?>
              <?php if(!empty($auxTeam->SocialNetwork2)): ?>
              <li class="list-inline-item">
                <a href="<?= $auxTeam->SocialNetwork2 ?>">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <?php endif ?>
              <?php if(!empty($auxTeam->SocialNetwork3)): ?>
              <li class="list-inline-item">
                <a href="<?= $auxTeam->SocialNetwork3 ?>">
                  <i class="fab fa-instagram"></i>
                </a>
              </li>
              <?php endif ?>
            </ul>
          </div>
        </div>
        <?php endforeach ?>
      </div>
    </div>
  </section>

  <!-- Clients -->
  <section class="py-5">
    <div class="container">
      <div class="row">
        <h2 class="col-12 text-center section-heading text-uppercase">Nuestros Clientes</h2>
        <hr>
      </div>
    </div>
    <hr>
    <div class="container">
      <div class="lightSpeedIn row" id="clients-carousel">
        <?php foreach($ModelClients as $auxClients): ?>
        <div class="col">
          <a href="javascript:void(0)">
            <img class="img-fluid d-block mx-auto" src="img/clients/<?= $auxClients->ClientImg ?>" alt="<?= $auxClients->ClientName ?>">
          </a>
        </div>
        <?php endforeach ?>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section class="page-section" id="contact">
    <div class="container">
      <div class="row">
        <div class="fadeInUpBig col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Contactanos</h2>
          <hr>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <form id="contactForm" name="sentMessage" novalidate="novalidate">
            <div class="row">
              <div class="col-md-6">
                <div class="slideInLeft form-group">
                  <input class="form-control" id="name" name="name" type="text" placeholder="Nombre *" required="required" data-validation-required-message="Por favor, escriba su nombre.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="slideInLeft form-group">
                  <input class="form-control" id="email" name="email" type="email" placeholder="Email *" required="required" data-validation-required-message="Por favor, introduzca su dirección de correo electrónico.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="slideInLeft form-group">
                  <input class="form-control" id="phone" name="phone" type="tel" placeholder="Telefono *" required="required" data-validation-required-message="Por favor, introduzca su número de teléfono.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="slideInRight form-group">
                  <textarea class="form-control" id="message" name="message" placeholder="Mensaje *" required="required" data-validation-required-message="Por favor ingrese un mensaje."></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-lg-12 text-center">
                <div id="success"></div>
                <!-- <div
                  class="g-recaptcha" 
                  data-sitekey="6Lf3TQoaAAAAAAA_PlR6tlvjS8bJXGs2mAeaF2sw"
                  data-theme="dark"
                  data-callback="capcha_filled"
                  data-expired-callback="capcha_expired">
                </div> -->
                <button class="g-recaptcha jackInTheBox btn btn-primary btn-xl text-uppercase"
                        id="sendMessageButton"
                        type="submit">Enviar Mensaje
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>