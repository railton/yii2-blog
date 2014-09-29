<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Noticia */

$this->title = 'Atualizar Notícia: ' . ' ' . $model->noti_codigo;
$this->params['breadcrumbs'][] = ['label' => 'Notícias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->noti_codigo, 'url' => ['view', 'id' => $model->noti_codigo]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="noticia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
