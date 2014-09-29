<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComentarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comentários';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Notícia',
                'attribute' => 'noti_codigo',
                'value' => function($data){
                    return $data->noticia->noti_titulo;
                },                
            ],
            'come_texto',     
            [
                'label' => 'Usuário',
                'attribute' => 'usua_codigo',
                'value' => function($data){
                    return $data->usuario->usua_nome;
                },                
            ],      
            [
                'label' => 'Situação',
                'attribute' => 'cosi_codigo',
                'format' => 'raw',
                'value' => function($data){
                    if($data->cosi_codigo == 1)
                        return '<span class="label label-default">Pendente</span>';
                    else if($data->cosi_codigo == 2)
                        return '<span class="label label-success">Aprovado</span>';
                    else if($data->cosi_codigo == 3)
                        return '<span class="label label-danger">Desabilitado</span>';
                },   
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\ComentarioSituacao::find()->all(), 'cosi_codigo', 'cosi_nome'),        
            ],              
            [
                'attribute' => 'come_data_criacao',
                'format' => ['datetime', 'HH:mm:ss dd/MM/yyyy']
            ],                      

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn', 
                'headerOptions' => ['width' => '180px'], 
                'template' => '{aprovar} {desabilitar}',
                'buttons' => [
                    'aprovar' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-ok-circle"></span> Aprovar', $url, 
                                    [ 
                                        //'title' => 'Visualizar',
                                        'data-pjax' => '0',
                                        'class' => 'btn btn-primary  btn-xs',
                                        'data-confirm' => Yii::t('yii', 'Deseja realmente aprovar este comentário?'),
                                        'data-method' => 'post',
                                        'disabled' => $model->cosi_codigo == 2 ? 'disabled' : false,
                                    ] 
                                );                    
                    },
                    'desabilitar' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-ban-circle"></span> Desabilitar', $url, 
                                    [ 
                                        //'title' => 'Visualizar',
                                        'data-pjax' => '0',
                                        'class' => 'btn btn-danger  btn-xs',
                                        'data-confirm' => Yii::t('yii', 'Deseja realmente desabilitar este comentário?'),
                                        'data-method' => 'post',
                                        'disabled' => $model->cosi_codigo == 3 ? 'disabled' : false,
                                    ] 
                                );                    
                    },                            
                ], 
            ],
        ],
    ]); ?>

</div>
