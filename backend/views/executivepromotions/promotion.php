<?php  

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\components\datepicker\DatePicker;
use common\components\DinamycForm\DynamicFormWidget;
// use common\components\chosen\Chosen;
use backend\assets\AppAssetLayoutAll;
AppAssetLayoutAll::register($this);
$this->title = 'Promoción Ejecutiva';	

?>

<style>
	


</style>

<section class="container-fluid flex flex-column flex-align-center">

	<section class="col-sm-12 col-md-11">

		<header>
			<h1>Nueva Promoción Ejecutiva</h1>
		</header>

		<hr>
		
		<?php 
		$form = ActiveForm::begin([
		    'id' => 'login-form',
		    'options' => ['class' => 'form-horizontal'],
		]); 

		?>

			<div class="row">
				<div class="col-md-6">
					<?= $form->field($ExecutivePromotion, 'Name')->textInput() ?>
				</div>
				<div class="col-md-6">
					<?php echo $form->field($ExecutivePromotion,'Duration')->textInput(['type' => 'number']); ?>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<?php echo $form->field($ExecutivePromotion,'Cost')->textInput(['type' => 'number']); ?>
				</div>
				<div class="col-md-6">
					<?php echo $form->field($ExecutivePromotion,'Bonus')->textInput(['type' => 'number']); ?>
				</div>
			</div>

			<hr>

			<div class="row">
	            <?= Html::submitButton('GUARDAR', ['class' => 'btn btn-primary btn-block']) ?>
		    </div>

		<?php ActiveForm::end() ?>

	</section>

</section>

<script>

	<?php 

		$this->registerJS("
		

		"); 

	?>

</script>

<?php 
if (Yii::$app->session->hasFlash('success')):
	$this->registerJS('
		$(document).ready(function(){
			_Message("success","Success!","'.Yii::$app->session->getFlash('success').'");
		});

		');
endif;

if (Yii::$app->session->hasFlash('error')):

	$this->registerJS('
		$(document).ready(function(){
			_Message("error","Error!","'.Yii::$app->session->getFlash('error').'");
		});

		');
endif;
 ?>