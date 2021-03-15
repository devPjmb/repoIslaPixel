<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAssetLayoutAll;
    AppAssetLayoutAll::register($this);
use backend\assets\AppAsset;
    AppAsset::register($this);
    $this->title = ($ModelAboutUs->isNewRecord)? 'Añadir nuevo Imagen' : 'Editar Imagen';
 ?>
<div class="container-fluid">
    
    <h1><?=($ModelAboutUs->isNewRecord)? 'Añadir nuevo Imagen' : 'Editar Imagen'; ?> </h1>
     <div class="row-fluid">

            <div class="customer-form">

                <?php $form = ActiveForm::begin(['id' => 'dynamic-form-Post']); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($ModelAboutUs, 'Year')->textInput(['maxlength' => true,'id'=>'tittleid','required'=>true])->label('Año'); ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($ModelAboutUs, 'Title')->textInput(['maxlength' => true,'id'=>'tittleid','required'=>true])->label('Titulo'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($ModelAboutUs, 'TempImg')->fileInput(['class'=>'imgpostchang'])->label('Imagen'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?= $form->field($ModelAboutUs, 'Description')->textarea(['maxlength' => true,'style'=>'height:150;','id'=>'res-editor'])->label('Descripcion'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton($ModelAboutUs->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-primary click-confirm', 'style'=>'width:100%;',
                            "tittle-alert" => $ModelAboutUs->isNewRecord ? 'Crear Proyecto' : 'Actualizar Proyecto',
                            "text-alert" => $ModelAboutUs->isNewRecord ? 'Esta a punto de crear un nuevo proyecto. ¿Desea continuar?' : 'Esta a punto de actualizar el proyecto ['.$ModelAboutUs->Title.']. ¿Desea continuar?',

                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?php $imgrute = ($ModelAboutUs->Image)?  $ModelAboutUs->Image : 'default.png'; ?>
                     <img id="wrapper" src="<?= Yii::getAlias('@proyect').'/img/about/'.$imgrute ?>" class="img-responsive" style="margin: auto; width: auto; height: 200px;">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row-fluid">
                        <h1 id="prevTitle"><?= $ModelAboutUs->Year; ?></h1>
                        <h1 id="prevTitle"><?= $ModelAboutUs->Title; ?></h1>
                    </div>
                    <div class="row-fluid">
                        <span id="prevText">
                             <?= $ModelAboutUs->Description; ?>
                        </span>
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
        CKEDITOR.replace('res-editor');
        $(document).ready(function(){

            $('.imgpostchang').change(function(){
                readURL(this);
            });

            $('#tittleid').on('keyup',function(){
                    $('#prevTitle').html(this.value);
            });

            CKEDITOR.instances['res-editor'].on('instanceReady',function(){
                this.document.on('keyup', function(){
                     $('#prevText').html(CKEDITOR.instances['res-editor'].getData());
                });
            });
        });

    ";
    $this->registerJS($JS);
 ?>