<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\NoticiaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="noticia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'noti_codigo') ?>

    <?= $form->field($model, 'noti_titulo') ?>

    <?= $form->field($model, 'noti_texto') ?>

    <?= $form->field($model, 'noti_data_criacao') ?>

    <?= $form->field($model, 'noti_data_alteracao') ?>

    <?php // echo $form->field($model, 'noti_data_publicacao') ?>

    <?php // echo $form->field($model, 'cate_codigo') ?>

    <?php // echo $form->field($model, 'usua_codigo') ?>

    <?php // echo $form->field($model, 'nosi_codigo') ?>

    <?php // echo $form->field($model, 'noti_imagem')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
