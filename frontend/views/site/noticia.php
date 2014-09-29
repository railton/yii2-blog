<?php
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1><?= $model->noti_titulo ?> <small><?= $model->categoria->cate_nome ?></small></h1>
        </div>
        <?= Html::decode($model->noti_texto) ?>
    </div>           
</div>

<?php
if($model->noti_imagem):
?>
    <div class="row">
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <?= Html::img("images/$model->noti_codigo.png") ?>
        </div>
      </div>
    </div>
<?php
endif;
?>

<div class="row">
    <div class="col-lg-12">
        <p><?= $model->usuario->usua_nome ?> - <?= Yii::$app->formatter->asDatetime($model->noti_data_publicacao, "HH:mm:ss dd/MM/yyyy"); ?> </p>
    </div>           
</div>

<div class="row">
    <div class="col-lg-12">
        <h3>Comentários
            <?= Yii::$app->user->isGuest ? "<small>Necessário estar logado para comentar</small>" : Html::button('Comentar', ['class'=>'btn btn-primary btn-xs','data-toggle'=>'modal', 'data-target'=>'#myModal']); ?>
        </h3>
    </div>           
</div>

<?php
if(!Yii::$app->user->isGuest){
    echo $this->render('_comentario', [
            'model' => $comentario,
    ]);
}
?>



<?php
foreach ($comentarioList as $c):
?>   
<div class="media">
    <div class="media-body">
        <h5 class="media-heading"><?= $c->usuario->usua_nome ?> <small><?= Yii::$app->formatter->asDatetime($c->come_data_criacao, "HH:mm:ss dd/MM/yyyy"); ?></small></h5>
        <?= $c->come_texto ?>
    </div>
</div>
<?php
endforeach;
?>


