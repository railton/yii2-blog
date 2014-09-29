<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Comentario */
/* @var $form yii\widgets\ActiveForm */
?>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php $form = ActiveForm::begin(); ?>  
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Notícia</h4>
      </div>
      <div class="modal-body">
        <?= $form->field($model, 'come_texto')->textArea(['maxlength' => 240]) ?>
      </div>
      <div class="modal-footer">        
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <?= Html::submitButton('Postar', ['class' => 'btn btn-success']) ?>
      </div>
      <?php ActiveForm::end(); ?>  
    </div>
  </div>
</div>