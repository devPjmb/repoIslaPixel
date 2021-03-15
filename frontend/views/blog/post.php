<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\bootstrap\ActiveForm;
    use yii\widgets\LinkPager;
    $this->title = $ModelBlog['Title'];
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-12 row d-flex justify-content-center">
        	<!-- Blog Post -->
	        <div class="col-8 mt-4">
	        	<img class="card-img-top" src="<?= Yii::getAlias('@web').'/img/blog/'.$ModelBlog['ImageUrl']?>" alt="<?= str_replace(' ', '_', $ModelBlog['Title']) ?>">
	        	<div class="card-body">
	        		<h2 class="card-title"><?= $ModelBlog['Title'] ?></h2>
	            	<div class="card-text"><?= $ModelBlog['Content'] ?></div>
	          	</div>
		        <div class="card-footer text-muted">
		        	<?= $ModelBlog['PubDate'] ?>
		        </div>
	        </div>
	        <!-- \- End Blog Post -->
		</div>
	</div>
</div>