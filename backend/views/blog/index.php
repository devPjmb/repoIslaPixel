<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use backend\assets\AppAssetLayoutAll;
        AppAssetLayoutAll::register($this);
    use common\components\datatables\DataTables;
    $this->title = 'Post del Blog de IslaPixel';
?>

<div class="container-fluid">

    <h1><?= $this->title; ?></h1>
    <hr>
    <?= 
        Html::a('<i class="fa fa-plus"></i> Añadir Nuevo Post', ['post'], ['class'=>'btn btn-success'])
    ?>
<br><br><br>
<div class="row-fluid">
<?= DataTables::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'Title',
            'format' => 'text',
            'contentOptions'=>['style'=>'vertical-align:middle;'],
            'label'=>'Titulo del Post'
        ],
        [
            'attribute' => 'Content',
            'format' => 'html',
            'contentOptions'=>['style'=>'vertical-align:middle;'],
            'label'=> 'Contenido',
        ],
        [
            'attribute' => 'ImageUrl',
            'label'=> 'Imagen',
            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            'value' => function ($data) {
                $img = (!empty($data->ImageUrl)) ? $data->ImageUrl : 'default.png';
                $htm = "<img src='".Yii::getAlias("@proyect")."/img/blog/".$img."' style='margin: auto; width: auto; height: 30px;'>";
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
                    return Html::a('<span class="fa fa-edit"></span>', ['post', 'id' => $model->PostID], [
                        'class' => 'btn btn-primary',
                    ]);
                },
                'delete' => function($url, $model){
                    return Html::a('<span class="fa fa-trash"></span>', ['delete', 'id' => $model->PostID], [
                        'class' => 'btn btn-danger click-confirm',
                        'tittle-alert' => '¿Borrar Post?',
                        'text-alert'  => '¿Esta seguro de querer borrar este Post?. Esta accion no se puede revertir.',
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