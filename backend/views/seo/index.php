<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAssetLayoutAll;
    AppAssetLayoutAll::register($this);
use backend\assets\AppAsset;
    AppAsset::register($this);
    $this->title = 'Datos para el SEO';
 ?>
<div class="container-fluid">
	<div class="row">
		<h2>Meta Description y Meta Keywords para el SEO de la pagina web.</h2>
		<hr>
		<div class="row">
			<?php $form = ActiveForm::begin(['id' => 'dynamic-form-Post']); ?>
				<div class="col-md-12">
				  <?= $form->field($ModelSeo, 'metaKeywords')
				      ->textInput([
				        'id'=>'mKeywords',
				      ])
				      ->label('Meta Keywords _ Separadas Por Comas (,)') ?>
				</div>
				<div class="col-md-12">
				  <?= $form->field($ModelSeo, 'metaDescription')
				      ->textarea([
				        'id'=>'mKeywords',
				        'maxlength' => true,
				        'style'=>'height:150',
				      ])
				      ->label('Meta Description') ?>
				</div>
				<div class="form-group">
            		<?= Html::submitButton($ModelSeo->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-primary', 'style'=>'width:100%'])?>
                </div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
<?php 
	if (Yii::$app->session->hasFlash('success')):
        $this->registerJS('
            $(document).ready(function(){
                _Message("success","Success!","'.Yii::$app->session->getFlash('success').'");
            });
        ');
    elseif(Yii::$app->session->hasFlash('error')):
        $this->registerJS('
            $(document).ready(function(){
                _Message("error","Error!","'.Yii::$app->session->getFlash('error').'");
            });
        ');
    endif;

    $this->registerJS('
    	$("input#mKeywords").tagsinput({

    	})
    ')
?>