<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAssetLayoutAll;
    AppAssetLayoutAll::register($this);
    use common\components\datatables\DataTables;
    $this->title = 'Seccion Principal';
 ?>

<style type="text/css">
    .cm-toggle {
    -webkit-appearance: none;
    -webkit-tap-highlight-color: transparent;
    position: relative;
    border: 0;
    outline: 0;
    cursor: pointer;
    margin: 10px;
    }
    .cm-toggle:after {
    content: '';
    width: 60px;
    height: 28px;
    display: inline-block;
    background: rgba(196, 195, 195, 0.55);
    border-radius: 18px;
    clear: both;
    }
    .cm-toggle:before {
    content: '';
    width: 32px;
    height: 32px;
    display: block;
    position: absolute;
    left: 0;
    top: -3px;
    border-radius: 50%;
    background: rgb(255, 255, 255);
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
    }
    .cm-toggle:checked:before {
    left: 32px;
    box-shadow: -1px 1px 3px rgba(0, 0, 0, 0.6);
    }
    .cm-toggle:checked:after {
        background: #16a085;
    }
</style>

<div class="container-fluid">

    <h1>Imagenes de la Seccion Principal</h1>
    <hr>
    <?= 
        Html::button('<i class="fa fa-plus"></i> Anadir Nueva Imagen', [
            'class'=>'btn btn-success', 
            'data-toggle'=>'modal', 
            'data-target'=>'#myModal', 
            'id'=>'openModal'
        ])
    ?>
<br><br><br>
<div class="row-fluid">
<?= DataTables::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'Image',
            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            'value' => function ($data) {
                $htm = "<img src='".Yii::getAlias("@proyect")."/img/start/".$data->ImgBackground."' style='margin: auto; width: auto; height: 30px;'>";
                return $htm; // $data['name'] for array data, e.g. using SqlDataProvider.
            },
            'format' => 'html',
            'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
        ],
        [
            'attribute' => 'Status',
            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            'value' => function ($data) {
                switch ($data->Status) {
                    case '1':
                        $htm = "<span class='badge badge-success'><i class='fa fa-lock'></i> Activado</span>";
                        break;
                    case '0':
                        $htm = "<span class='badge badge-warning'><i class='fa fa-unlock'></i> Desactivado</span>";
                        break;
                    default:
                        $htm = '<span class="fa fa-circle"></span>';
                        break;
                }
                return $htm; // $data['name'] for array data, e.g. using SqlDataProvider.
            },
            'format' => 'html',
            'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '<div class="btn-group" > {enable} {delete} </div>',
            'buttons' => [
                'delete' => function($url, $model){
                    switch ($model->Status) {
                        case '1':
                            $icon = Html::button('<i class="fa fa-trash-alt"></i>', [
                                'class'=>'btn btn-danger click-confirm',
                                'tittle-alert' => 'ERROR',
                                'text-alert' => 'No puede eliminar esta imagen ya que esta activad. Tiene que habilitar otra imagen para que esta se puede eliminar.'
                            ]);
                            break;
                        case '0':
                            $icon = Html::a('<span class="fa fa-trash"></span>', ['delete', 'id' => $model->StartID], [
                                'class' => 'btn btn-danger click-confirm',
                                'tittle-alert' => '¿Borrar Imagen?',
                                'text-alert'  => '¿Esta seguro de querer borrar esta imagen?. Esta accion no se puede revertir.',
                            ]);
                            break;
                    }
                    return $icon;
                },
                'enable' => function($url, $model){
                    switch ($model->Status) {
                        case '1':
                            $icon = Html::button('<i class="fa fa-eye-slash"></i>', [
                                'class'=>'btn btn-warning click-confirm',
                                'tittle-alert' => 'ERROR',
                                'text-alert' => 'No puede deshabilitar esta imagen. Tiene que habilitar otra imagen para que esta se puede ocultar.'
                            ]);
                            break;
                        case '0':
                            $icon = Html::a("<span class='fa fa-eye'></span>", [
                                'enable',
                                'id' => $model->StartID
                                ],
                                [
                                    'class' => 'btn btn-warning click-confirm',
                                    'tittle-alert' => '¿Habilitar Imagen?',
                                    'text-alert' => 'Esta apunto de habilitar esta imagen. Esta accion desabilitara la imagen que se este mostrando en la pagina. ¿Desea continuar?'
                                ]
                            );
                            break;
                    }
                    return $icon;
                }
               
            ],
            'contentOptions'=>['style'=>'min-width: 100px; text-align: center; vertical-align:middle;'],
        ],
        
    ],
    'clientOptions' => [
    "lengthMenu"=> [[10,20,-1], [10,20,Yii::t('app',"All")]],
    "info"=>false,
    "retrieve" => true,
    "responsive"=>'true', 
    "dom"=> 'lfTrtip',
    "tableTools"=>[
        "aButtons"=> []
    ]
],
]);
?>
</div>
</div>
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Anadir Imagen</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <?php $form = ActiveForm::begin(['id' => 'dynamic-form-Post']); ?>
          <div class="modal-body row">
            <div class="col-md-2">
                <?= $form->field($ModelStart, 'Status')->checkBox(['class'=>'cm-toggle']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($ModelStart, 'TempImg')->fileInput(['class'=>'imgpostchang'])->label(false); ?>
            </div>
            <div class="col-md-4">
                <img id="blah" src="<?= Yii::getAlias("@proyect")."/img/start/default.png" ?>" alt="your image" class="img-responsive" />
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <?= Html::submitButton('Anadir', ['class' => 'btn btn-success']); ?>
          </div>
          <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
<?php 
    if (Yii::$app->session->hasFlash('success')):
        $this->registerJS('
            $(document).ready(function(){
            	_Message("success","¡Exito!","'.Yii::$app->session->getFlash('success').'");
            });
        ');
    elseif (Yii::$app->session->hasFlash('error')):
    	$this->registerJS('
    		$(document).ready(function(){
    			_Message("error","¡Error!","'.Yii::$app->session->getFlash('error').'");
    		});
    	');
    endif;
?>

<?php 
    $this->registerJS("
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
          }
        }
        $('.imgpostchang').change(function() {
          readURL(this);
        });
    ")
?>