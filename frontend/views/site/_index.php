<?php
use yii\helpers\Html;
?>
<div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1><?= $model->noti_titulo ?> <small><?= $model->categoria->cate_nome ?></small></h1>
                </div>

                <?= $model->noti_texto_resumo ?> <?=Html::a('Ler notícia', ['noticia', 'id'=>$model->noti_codigo]) ?>
                
                <p></p>
                <p><?= $model->usuario->usua_nome ?> - <?= Yii::$app->formatter->asDatetime($model->noti_data_publicacao, "HH:mm:ss dd/MM/yyyy"); ?> </p>
            </div>           
        </div>