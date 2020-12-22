<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAssetLayoutAll;
    AppAssetLayoutAll::register($this);
use backend\assets\AppAsset;
    AppAsset::register($this);
    $this->title = ($ModelTeam->isNewRecord)? 'Añadir nuevo Integrante' : 'Editar Integrante';
 ?>
<div class="container-fluid">
    
    <h1><?=($ModelTeam->isNewRecord)? 'Añadir nuevo Integrante' : 'Editar Integrante'; ?> </h1>
     <div class="row-fluid">

            <div class="customer-form">

                <?php $form = ActiveForm::begin(['id' => 'dynamic-form-Post']); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($ModelTeam, 'Name')->textInput(['maxlength' => true,'id'=>'nameid','required'=>true])->label('Nombre'); ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($ModelTeam, 'Job')->textInput(['maxlength' => true,'id'=>'jobid','required'=>true])->label('Puesto'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($ModelTeam, 'TempImg')->fileInput(['class'=>'imgpostchang'])->label('Foto'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($ModelTeam, 'SocialNetwork1')->textInput(['maxlength' => true,'id'=>'tittleid','required'=>true])->label('Facebook'); ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($ModelTeam, 'SocialNetwork2')->textInput(['maxlength' => true,'id'=>'tittleid','required'=>true])->label('Twitter'); ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($ModelTeam, 'SocialNetwork3')->textInput(['maxlength' => true,'id'=>'tittleid','required'=>true])->label('Instagram'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton($ModelTeam->isNewRecord ? 'Añadir' : 'Actualizar', ['class' => 'btn btn-primary click-confirm', 'style'=>'width:100%;',
                            "tittle-alert" => $ModelTeam->isNewRecord ? 'Añadir Interante' : 'Actualizar Interante',
                            "text-alert" => $ModelTeam->isNewRecord ? 'Esta a punto de crear un nuevo proyecto. ¿Desea continuar?' : 'Esta a punto de actualizar el proyecto ['.$ModelTeam->Name.' '.$ModelTeam->Job.']. ¿Desea continuar?',

                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?php $imgrute = ($ModelTeam->Photo)?  $ModelTeam->Photo : 'default.png'; ?>
                     <img id="wrapper" src="<?= Yii::getAlias('@proyect').'/img/about/'.$imgrute ?>" class="img-responsive" style="margin: auto; width: auto; height: 200px;">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row-fluid">
                        <h1 id="prevName"><?= $ModelTeam->Name; ?></h1>
                        <h2 id="prevJob"><?= $ModelTeam->Job; ?></h2>
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
            $('#nameid').on('keyup',function(){
                $('#prevName').html(this.value);
            });
            $('#jobid').on('keyup',function(){
                $('#prevJob').html(this.value);
            });
        });

    ";
    $this->registerJS($JS);
 ?>