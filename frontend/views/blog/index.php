<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\bootstrap\ActiveForm;
    use yii\widgets\LinkPager;
    $this->title = 'Blog de Isla Pixel Publicidad C.A. Empresa dedica al diseño grafico.';
?>

<!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <h1 class="my-4">IslaPixel Blog</h1>

      	<?php foreach ($ModelBlog as $auxBlog):?>
        	<!-- Blog Post -->
	        <div class="card mb-4">
	          <img class="card-img-top" src="<?= Yii::getAlias('@web').'/img/blog/'.$auxBlog['ImageUrl']?>" alt="Card image cap">
	          <div class="card-body">
	            <h2 class="card-title"><?= $auxBlog['Title'] ?></h2>
	            <div class="card-text"><?= strlen(strip_tags($auxBlog['Content']))>50 ? substr(strip_tags($auxBlog['Content']), 0, 100)."..." : strip_tags($auxBlog['Content']) ; ?></div>
	            <a href="<?= Yii::getAlias('@web').'/blog/post/'.$auxBlog['PostID'] ?>" class="btn btn-primary">Leer Más &rarr;</a>
	          </div>
	          <div class="card-footer text-muted">
	            <?= $auxBlog['PubDate'] ?>
	          </div>
	        </div>
    	<?php endforeach ?>

        <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
          <li class="page-item">
            <a class="page-link" href="#">&larr; Older</a>
          </li>
          <li class="page-item disabled">
            <a class="page-link" href="#">Newer &rarr;</a>
          </li>
        </ul>

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-append">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">Web Design</a>
                  </li>
                  <li>
                    <a href="#">HTML</a>
                  </li>
                  <li>
                    <a href="#">Freebies</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">JavaScript</a>
                  </li>
                  <li>
                    <a href="#">CSS</a>
                  </li>
                  <li>
                    <a href="#">Tutorials</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Side Widget</h5>
          <div class="card-body">
            You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->