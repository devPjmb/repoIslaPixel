<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\bootstrap\ActiveForm;
    $this->title = 'Isla Pixel C.A.';
?>

<!-- Header -->
  <style>
    header.masthead{
      background-image:url(img/start/<?= $ModelStart[0]->ImgBackground ?>);
      background-repeat:no-repeat;
      background-position:center;
      background-attachment:fixed;
      background-size: cover;
    }
    section#contact{
      background-image:url(img/contact/<?= $ModelContact[0]->imgBackground ?>);
      background-repeat:no-repeat;
      background-position:center;
      background-attachment:fixed;
      background-size: cover;
    }
  </style>
  <header class="masthead">
    <div class="container">
      <div class="intro-text">
       <!-- <div class="intro-lead-in">Welcome To Our Studio!</div>
        <div class="intro-heading text-uppercase">It's Nice To Meet You</div> -->
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
          <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
        </div>
      </div>
      <div class="row text-center">
        <?php foreach($ModelServices as $auxServices): ?>
          <div class="slideInLeft col-md-4">
            <img alt="<?= $auxServices->ServiceImg?>" class="img-fluid imgServices" src="img/services/<?= $auxServices->ServiceImg?>">
            <h4 class="service-heading"><?= $auxServices->ServiceName?></h4>
            <p class="text-muted"><?= $auxServices->ServiceDescription?></p>
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
          <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
        </div>
      </div>
      <div class="row" id="portfolio-carousel">
        <?php foreach($ModelPortfolio as $auxPortfolio): ?>
          <?php $dataModal = str_replace(' ', '_', $auxPortfolio->ProjectName) ?>
          <div class="rotateInDownLeft col-md-4 col-sm-6 portfolio-item">
            <a class="portfolio-link" data-toggle="modal" href="#<?= $dataModal.$auxPortfolio->PortfolioID?>">
              <div class="portfolio-hover">
                <div class="portfolio-hover-content">
                  <i class="fas fa-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid img-thumbnail" src="img/portfolio/<?= $auxPortfolio->ProjectImg?>" alt="<?= $auxPortfolio->ProjectImg?>">
            </a>
            <div class="portfolio-caption">
              <h4><?= $auxPortfolio->ProjectName?></h4>
              <!-- <p class="text-muted">Illustration</p> -->
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
          <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
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
                <img class="rounded-circle img-fluid" src="img/about/<?= $auxAboutUs->Image ?>" alt="<?= $auxAboutUs->Image ?>">
              </div>
              <div class="timeline-panel">
                <div class="timeline-heading">
                  <h4><?= $auxAboutUs->Year ?></h4>
                  <h4 class="subheading"><?= $auxAboutUs->Title ?></h4>
                </div>
                <div class="timeline-body">
                  <p class="text-muted"><?= $auxAboutUs->Description ?></p>
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
          <h2 class="section-heading text-uppercase">Nuestro Increible Equipo</h2>
          <hr>
          <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
        </div>
      </div>
      <div class="row" id="team-carousel">
        <?php foreach($ModelTeam as $auxTeam): ?>
        <div class="zoomInLeft col-sm-4">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="img/team/<?= $auxTeam->Photo ?>" alt="<?= $auxTeam->Photo ?>">
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
      <!-- <div class="row">
        <div class="zoomIn col-lg-8 mx-auto text-center">
          <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
        </div>
      </div>
    </div> -->
  </section>

  <!-- Clients -->
  <section class="py-5">
    <div class="container">
      <div class="lightSpeedIn row" id="clients-carousel">
        <?php foreach($ModelClients as $auxClients): ?>
        <div class="col-md-3 col-sm-6">
          <a href="javascript:void(0)">
            <img class="img-fluid d-block mx-auto" src="img/clients/<?= $auxClients->ClientImg ?>" alt="<?= $auxClients->ClientImg ?>">
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
          <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
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
                <button id="sendMessageButton" class="jackInTheBox btn btn-primary btn-xl text-uppercase" type="submit">Enviar Mensaje</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>