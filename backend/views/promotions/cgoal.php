<?php  

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\components\datepicker\DatePicker;
use common\components\DinamycForm\DynamicFormWidget;
use backend\assets\AppAssetLayoutAll;
AppAssetLayoutAll::register($this);
$this->title = 'Meta de ingreso';	

?>

<section class="container-fluid flex flex-column flex-align-center">

	<section class="col-sm-12 col-md-11">
		
		<header>
			<h1>Meta de Ingreso</h1>
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
					<?= $form->field($cGoal, 'Name')->textInput() ?>
				</div>
				<div class="col-md-6">
					<?= $form->field($cGoal, 'Duration')->textInput(['type'=>'number']) ?>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<?= $form->field($cGoal, 'Prize')->textInput(['type'=>'number']) ?>
				</div>
				<div class="col-md-6">
					<?= $form->field($cGoal, 'Target')->textInput(['type'=>'number']) ?>
				</div>
			</div>

			<hr>

			<div class="row">
	            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success btn-block']) ?>
		    </div>

		<?php ActiveForm::end() ?>

	</section>

</section>

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