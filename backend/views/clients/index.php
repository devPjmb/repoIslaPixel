<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use backend\assets\AppAssetLayoutAll;
        AppAssetLayoutAll::register($this);
    use common\components\datatables\DataTables;
    $this->title = 'Seccion de Clientes';
?>

<div class="container-fluid">

    <h1>Contenido de la Seccion de Clientes</h1>
    <hr>
    <?= 
        Html::a('<i class="fa fa-plus"></i> Añadir Nuevo Cliente', ['create'], ['class'=>'btn btn-success'])
    ?>
<br><br><br>
<div class="row-fluid">
<?= DataTables::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'ClientName',
            'format' => 'text',
            'contentOptions'=>['style'=>'vertical-align:middle;'],
            'label'=>'Cliente'
        ],
        [
            'attribute' => 'ClientImg',
            'label'=> 'Logo',
            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            'value' => function ($data) {
                $htm = "<img src='".Yii::getAlias("@proyect")."/img/clients/".$data->ClientImg."' style='margin: auto; width: auto; height: 30px;'>";
                return $htm; // $data['name'] for array data, e.g. using SqlDataProvider.
            },
            'format' => 'html',
            'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '<div class="btn-group" > {update} {delete} </div>',
            'buttons' => [
                'update' => function($url, $model){
                    return Html::a('<span class="fa fa-edit"></span>', ['create', 'id' => $model->ClientsID], [
                        'class' => 'btn btn-primary',
                    ]);
                },
                'delete' => function($url, $model){
                    return Html::a('<span class="fa fa-trash"></span>', ['delete', 'id' => $model->ClientsID], [
                        'class' => 'btn btn-danger click-confirm',
                        'tittle-alert' => '¿Borrar Imagen?',
                        'text-alert'  => '¿Esta seguro de querer borrar esta imagen?. Esta accion no se puede revertir.',
                    ]);
                },
               
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