<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use backend\assets\AppAssetLayoutAll;
        AppAssetLayoutAll::register($this);
    use common\components\datatables\DataTables;
    $this->title = 'Seccion de Servicios';
?>

<div class="container-fluid">

    <h1>Contenido de la Seccion de Servicios</h1>
    <hr>
    <?= 
        Html::a('<i class="fa fa-plus"></i> Añadir Nuevo Servicio',
            ['create'],
            ['class'=>'btn btn-success']
        )
    ?>
<br><br><br>
<div class="row-fluid">
<?= DataTables::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'ServiceName',
            'format' => 'text',
            'contentOptions'=>['style'=>'vertical-align:middle;'],
            'label'=>'Nombre del Servicio'
        ],
        [
            'attribute' => 'ServiceDescription',
            'label'=> 'Descripcion del Servicio',
            'format' => 'html',
            'contentOptions'=>['style'=>'vertical-align:middle;'],
        ],
        [
            'attribute' => 'ServiceImg',
            'label'=> 'Imagen del Servicio',
            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            'value' => function ($data) {
                $htm = "<img src='".Yii::getAlias("@proyect")."/img/services/".$data->ServiceImg."' style='margin: auto; width: auto; height: 60px;'>";
                return $htm; // $data['name'] for array data, e.g. using SqlDataProvider.
            },
            'format' => 'html',
            'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '<div class="btn-group" > {update} {delete} </div>',
            'buttons' => [
                'delete' => function($url, $model){
                    return Html::a('<span class="fa fa-trash"></span>', ['delete', 'id' => $model->ServiceID], [
                        'class' => 'btn btn-danger click-confirm',
                        'tittle-alert' => '¿Borrar Imagen?',
                        'text-alert'  => '¿Esta seguro de querer borrar esta imagen?. Esta accion no se puede revertir.',
                    ]);
                },
                'update' => function($url, $model){
                    return Html::a('<span class="fa fa-edit"></span>', ['create', 'id' => $model->ServiceID], [
                        'class' => 'btn btn-info',  
                        'value' => $model->ServiceID
                    ]);
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