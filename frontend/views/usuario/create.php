<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Usuario */

$this->title = 'Cadastrar Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Login', 'url' => ['site/login']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
