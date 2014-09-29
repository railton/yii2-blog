<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Usuario */

$this->title = 'Atualizar Usuario: ' . ' ' . $model->usua_codigo;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->usua_codigo, 'url' => ['view', 'id' => $model->usua_codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="usuario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
