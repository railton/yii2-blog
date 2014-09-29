<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NoticiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notícias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noticia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Cadastrar Notícia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'noti_codigo',
            'noti_titulo',     
            [
                'attribute' => 'noti_imagem',
                'format' => 'boolean',
                'filter' => [0=>'Não', 1=>'Sim'],
            ],            
            [
                'label' => 'Categoria',
                'attribute' => 'cate_codigo',
                'value' => function($data){
                    return $data->categoria->cate_nome;
                },
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\Categoria::find()->all(), 'cate_codigo', 'cate_nome'),
            ],
            [
                'label' => 'Usuário',
                'attribute' => 'usua_codigo',
                'value' => function($data){
                    return $data->usuario->usua_nome;
                },
            ],
            [
                'label' => 'Situação',
                'attribute' => 'nosi_codigo',
                'value' => function($data){
                    return $data->situacao->nosi_nome;
                },
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\NoticiaSituacao::find()->all(), 'nosi_codigo', 'nosi_nome'),
            ],
            [
                'attribute' => 'noti_data_publicacao',
                'format' => ['datetime', 'HH:mm:ss dd/MM/yyyy'],
                'filter' =>  \kartik\widgets\DatePicker::widget([                  
                    'name' => 'NoticiaSearch[noti_data_publicacao]',
                    'type' => \kartik\widgets\DatePicker::TYPE_INPUT,
                    //'value' => '09/09/1979',
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd/mm/yyyy'
                    ]
                ]),
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '80px'],
            ],
        ],
    ]);
    
    ?>

</div>
