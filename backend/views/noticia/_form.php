<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput

/* @var $this yii\web\View */
/* @var $model common\models\Noticia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="noticia-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php
        $items = \yii\helpers\ArrayHelper::map(\common\models\Categoria::find()->all(), 'cate_codigo', 'cate_nome'); 
        echo $form->field($model, 'cate_codigo')
            ->dropDownList($items, ['prompt'=>'Selecione uma categoria']);
    ?>
    
        <?php
        $items = \yii\helpers\ArrayHelper::map(\common\models\NoticiaSituacao::find()->all(), 'nosi_codigo', 'nosi_nome'); 
        echo $form->field($model, 'nosi_codigo')
            ->dropDownList($items, ['prompt'=>'Selecione uma situação']);
    ?>    
    
    <?= $form->field($model, 'noti_titulo')->textInput(['maxlength' => 120]) ?>

    
    <?php
    // Extensão yii2-redactor https://github.com/yiidoc/yii2-redactor
    echo $form->field($model, 'noti_texto')->widget(\yii\redactor\widgets\Redactor::className(),
        [    
            'clientOptions'=>[
                'buttonsHide' => ['image', 'file'],
                'minHeight' => 200,
                'plugins'=>['clips','fontcolor']
            ]
        ]
            )?>

    <?=  $form->field($model, 'noti_imagem_upload')->widget(FileInput::classname(), 
    [
        'options'=>['accept'=>'image/*'],
        'pluginOptions' => [
            'showPreview' => true,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => false
        ]
    ]) 

   ?>
    
    
                
    <?php

    if($model->noti_imagem):

    ?>

    <div class="form-group">            
        <?= Html::img(Yii::$app->urlManagerFrontend->createUrl("/images/$model->noti_codigo.png"),['class'=>'thumbnail']) ?>
    </div>
    <div class="form-group">
            <?= Html::a('Deletar imagem', ['delete-imagem', 'id' => $model->noti_codigo], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Deseja realmente deletar a imagem?',
                    'method' => 'post',
                ],
            ]);
            ?>
    </div>

    <?php

    endif;

    ?>   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
