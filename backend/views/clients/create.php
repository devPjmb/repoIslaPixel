<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAssetLayoutAll;
    AppAssetLayoutAll::register($this);
use backend\assets\AppAsset;
    AppAsset::register($this);
    $this->title = ($ModelClients->isNewRecord)? 'Añadir nuevo Cliente' : 'Editar Cliente';
 ?>
<div class="container-fluid">
    
    <h1><?=($ModelClients->isNewRecord)? 'Añadir nuevo Cliente' : 'Editar Cliente'; ?> </h1>
     <div class="row-fluid">

            <div class="customer-form">

                <?php $form = ActiveForm::begin(['id' => 'dynamic-form-Post']); ?>
                <div class="row">
                    <div class="col-sm-12">
                        <?= $form->field($ModelClients, 'ClientName')->textInput(['maxlength' => true,'id'=>'tittleid','required'=>true])->label('Nombre del Cliente'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?= $form->field($ModelClients, 'TempImg')->fileInput(['class'=>'imgpostchang'])->label('Logo del Cliente'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton($ModelClients->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-primary click-confirm', 'style'=>'width:100%;',
                            "tittle-alert" => $ModelClients->isNewRecord ? 'Crear Cliente' : 'Actualizar Cliente',
                            "text-alert" => $ModelClients->isNewRecord ? 'Esta a punto de crear un nuevo cliente. ¿Desea continuar?' : 'Esta a punto de actualizar el cliente ['.$ModelClients->ClientName.']. ¿Desea continuar?',

                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?php $imgrute = ($ModelClients->ClientImg)?  $ModelClients->ClientImg : 'default.png'; ?>
                     <img id="wrapper" src="<?= Yii::getAlias('@proyect').'/img/clients/'.$imgrute ?>" class="img-responsive" style="margin: auto; width: auto; height: 200px;">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row-fluid">
                        <h1 id="prevTitle"><?= $ModelClients->ClientName; ?></h1>
                    </div>
                </div>
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
    endif;

    if (Yii::$app->session->hasFlash('error')):

        $this->registerJS('
            $(document).ready(function(){
                _Message("error","Error!","'.Yii::$app->session->getFlash('error').'");
            });

            ');
    endif;
    $JS = "
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#wrapper').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).ready(function(){

            $('.imgpostchang').change(function(){
                readURL(this);
            });

            $('#tittleid').on('keyup',function(){
                $('#prevTitle').html(this.value);
            });
        });

    ";
    $this->registerJS($JS);
 ?>