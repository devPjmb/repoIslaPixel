<?php 
use yii\helpers\Html;
use backend\assets\AppAssetLayoutAll;
AppAssetLayoutAll::register($this);
use common\components\datatables\DataTables;
$this->title = 'Promociones Ejecutivas';
?>

<div class="container-fluid">

    <h1>Promociones Ejecutivas</h1>
    <hr>
<?= Html::a('<i class="fa fa-plus"></i> Create New Promotion', ['/executivepromotions/promotion'], ['class'=>'btn btn-success']) ?>
<br><br><br>
<div class="row-fluid">
<?php 
echo DataTables::widget([
    'dataProvider' => $executivepromotionProvider,
    'columns' => [

        ['class' => 'yii\grid\SerialColumn'],
        // Simple columns defined by the data contained in $dataProvider.
        // Data from the model's column will be used.
        [
            'attribute' => 'Name',
            'format' => 'text',
            'contentOptions'=>['style'=>'vertical-align:middle;'],
        ],
        [
            'attribute' => 'Cost',
            'value' => function ($model) {
                return $model->Cost." Q";
            },
            'format' => 'text',
            'contentOptions'=>['style'=>'vertical-align:middle;'],
        ],
        [
            'attribute' => 'Bonus',
            'value' => function ($model) {
                return $model->Bonus." Q";
            },
            'format' => 'text',
            'contentOptions'=>['style'=>'vertical-align:middle;'],
        ],
        [
            'attribute' => 'Duration',
            'format' => 'text',
            'contentOptions'=>['style'=>'vertical-align:middle;'],
        ],
        [
            'attribute' => 'Status',
            'format' => 'text',
            'contentOptions'=>['style'=>'vertical-align:middle;'],
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '<div class="btn-group" > {update} {delete} </div>',
            'buttons' => [
                'delete' => function($url, $model){
                    return Html::a('<span class="fa fa-trash"></span>', ['deletepromotion', 'id' => $model->primaryKey()], [
                        'class' => 'btn btn-danger click-confirm',
                        'tittle-alert' => 'Delete Information',
                        'text-alert'  => 'Are You Sure? When you delete the promotion ['.$model->Name.'], you will not be able to retrieve it later',
                    ]);
                },
                'update' => function($url, $model){
                    return Html::a('<span class="fa fa-edit"></span>', ['promotion', 'id' => $model->primaryKey(),], [
                        'class' => 'btn btn-info',
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
        "aButtons"=> [  
            [
            "sExtends"=> "copy",
            "sButtonText"=> Yii::t('app',"Copy to clipboard")
            ],
            [
            "sExtends"=> "csv",
            "sButtonText"=> Yii::t('app',"Save to CSV")
            ],
            [
            "sExtends"=> "xls",
            "oSelectorOpts"=> ["page"=> 'current'],
            ],[
            "sExtends"=> "pdf",
            "sButtonText"=> Yii::t('app',"Save to PDF")
            ],[
            "sExtends"=> "print",
            "sButtonText"=> Yii::t('app',"Print")
            ],
        ]
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