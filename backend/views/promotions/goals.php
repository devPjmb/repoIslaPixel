<?php 
use yii\helpers\Html;
use backend\assets\AppAssetLayoutAll;
AppAssetLayoutAll::register($this);
use common\components\datatables\DataTables;
$this->title = 'Metas';
?>

<div class="container-fluid">

    <h1>Metas</h1>
    <hr>
    
    <?= Html::a('<i class="fa fa-plus"></i> Crear meta de ingreso', ['/promotions/cgoal'], ['class'=>'btn btn-success']) ?>

    <?= Html::a('<i class="fa fa-plus"></i> Crear meta de gasto', ['/promotions/pgoal'], ['class'=>'btn btn-success']) ?>

    <hr>

    <div class="">

        <h2>Metas de ingresos</h2>
        
        <?php 
            echo DataTables::widget([
                'dataProvider' => $cGoalsProvider,
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
                        'attribute' => 'Duration',
                        'format' => 'text',
                        'contentOptions'=>['style'=>'vertical-align:middle;'],
                    ],
                    [
                        'attribute' => 'Prize',
                        'format' => 'text',
                        'contentOptions'=>['style'=>'vertical-align:middle;'],
                    ],
                    [
                        'attribute' => 'Target',
                        'format' => 'text',
                        'contentOptions'=>['style'=>'vertical-align:middle;'],
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '<div class="btn-group" > {update} {delete} </div>',
                        'buttons' => [
                            'delete' => function($url, $model){
                                return Html::a('<span class="fa fa-trash"></span>', ['delete', 'id' => $model->primaryKey], [
                                    'class' => 'btn btn-danger click-confirm',
                                    'tittle-alert' => 'Delete Information',
                                    'text-alert'  => 'Are You Sure? When you delete the menu ['.$model->Name.'], you will not be able to retrieve it later',
                                ]);
                            },
                            'update' => function($url, $model){
                                return Html::a('<span class="fa fa-edit"></span>', ['cgoal', 'id' => $model->primaryKey,], [
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
    <div class="">
        
        <h2>Metas de gastos</h2>
        
        <?php 
            echo DataTables::widget([
                'dataProvider' => $pGoalsProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'Name',
                        'format' => 'text',
                        'contentOptions'=>['style'=>'vertical-align:middle;'],
                    ],
                    [
                        'attribute' => 'Duration',
                        'format' => 'text',
                        'contentOptions'=>['style'=>'vertical-align:middle;'],
                    ],
                    [
                        'attribute' => 'Prize',
                        'format' => 'text',
                        'contentOptions'=>['style'=>'vertical-align:middle;'],
                    ],
                    [
                        'attribute' => 'Target',
                        'format' => 'text',
                        'contentOptions'=>['style'=>'vertical-align:middle;'],
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '<div class="btn-group" > {update} {delete} </div>',
                        'buttons' => [
                            'delete' => function($url, $model){
                                return Html::a('<span class="fa fa-trash"></span>', ['delete', 'id' => $model->primaryKey], [
                                    'class' => 'btn btn-danger click-confirm',
                                    'tittle-alert' => 'Delete Information',
                                    'text-alert'  => 'Are You Sure? When you delete the menu ['.$model->Name.'], you will not be able to retrieve it later',
                                ]);
                            },
                            'update' => function($url, $model){
                                return Html::a('<span class="fa fa-edit"></span>', ['pgoal', 'id' => $model->primaryKey,], [
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