

<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAssetLayoutAll;
    AppAssetLayoutAll::register($this);
use backend\assets\AppAsset;
    AppAsset::register($this);
    $this->title = ($ModelServices->isNewRecord)? 'Añadir nuevo servicio' : 'Editar servicio';
 ?>
<div class="container-fluid">
    
    <h1><?=($ModelServices->isNewRecord)? 'Añadir nuevo servicio' : 'Editar servicio'; ?> </h1>
     <div class="row-fluid">

            <div class="customer-form">

                <?php $form = ActiveForm::begin(['id' => 'dynamic-form-Post']); ?>
                  <div class="col-md-6">
                      <?= $form->field($ModelServices, 'ServiceName')
                          ->textInput([
                            'class'=>'form-control',
                            'id'=>'servicename'
                          ])
                          ->label('Nombre del Servicio') ?>
                  </div>
                  <div class="col-md-6">
                      <?= $form->field($ModelServices, 'TempImg')
                          ->fileInput(['class'=>'imgpostchang'])
                          ->label('Imagen del Servicio'); ?>
                  </div>
                  <div class="col-md-12">
                      <?= $form->field($ModelServices, 'ServiceDescription')
                          ->textarea(['maxlength' => true,'style'=>'height:150','id'=>'res-editor'])
                          ->label('Descripcion del Servicio'); ?>
                  </div>
                <div class="form-group">
                    <?= Html::submitButton($ModelServices->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-primary click-confirm', 'style'=>'width:100%;',
                            "tittle-alert" => $ModelServices->isNewRecord ? 'Crear Servicio' : 'Actualizar Servicio',
                            "text-alert" => $ModelServices->isNewRecord ? 'Esta a punto de crear un nuevo servicio. ¿Desea continuar?' : 'Esta a punto de actualizar el servicio ['.$ModelServices->ServiceName.']. ¿Desea continuar?',

                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?php $imgrute = ($ModelServices->ServiceImg)?  $ModelServices->ServiceImg : 'default.png'; ?>
                     <img id="wrapper" src="<?= Yii::getAlias('@proyect').'/img/services/'.$imgrute ?>" class="img-responsive" style="margin: auto; width: auto; height: 200px;">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row-fluid">
                        <h1 id="prevTitle"><?= $ModelServices->ServiceName; ?></h1>
                    </div>
                    <div class="row-fluid">
                        <span id="prevText">
                             <?= $ModelServices->ServiceDescription; ?>
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

            $('#servicename').on('keyup',function(){
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