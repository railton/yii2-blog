<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Noticia */

$this->title = $model->noti_codigo;
$this->params['breadcrumbs'][] = ['label' => 'Notícias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noticia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->noti_codigo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->noti_codigo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'noti_codigo',
            'noti_titulo',
            'noti_texto:html',
            [
                'label' => 'Categoria',
                'value' => $model->categoria->cate_nome,
            ],
            [
                'label' => 'Usuário',
                'value' => $model->usuario->usua_nome,
            ],
            [
                'label' => 'Situação',
                'value' => $model->situacao->nosi_nome,
            ],            
            [
                'label' => 'Imagem',
                'value' => Yii::$app->urlManagerFrontend->createUrl("/images/$model->noti_codigo.png"),
                'format' => 'image',
                'visible' => $model->noti_imagem
            ],
            [
                'attribute' => 'noti_data_criacao',
                'format' => ['datetime', 'HH:mm:ss dd/MM/yyyy']
            ],
            [
                'attribute' => 'noti_data_alteracao',
                'format' => ['datetime', 'HH:mm:ss dd/MM/yyyy']
            ],
            [
                'attribute' => 'noti_data_publicacao',
                'format' => ['datetime', 'HH:mm:ss dd/MM/yyyy']
            ],
        ],
    ]) ?>

    
    <?php
    
    echo dirname(__FILE__); ?>
</div>
