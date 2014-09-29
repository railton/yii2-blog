<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => false]); ?>

    <?= $form->field($model, 'usua_nome')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'usua_email')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'usua_senha')->passwordInput(['maxlength' => 60]) ?>
    
    <?= $form->field($model, 'usua_senha_confirmacao')->passwordInput(['maxlength' => 60]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    
</div>
