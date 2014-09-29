<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Cadastrar Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'usua_codigo',
            'usua_nome',
            'usua_email:email',
            [
                'attribute' => 'usua_habilitado',
                'filter'=>[0=>'Desabilitado', 1=>'Habilitado'],    
            ],
            [
                'attribute' => 'usua_tipo',
                'filter'=>[1=>'Autor', 2=>'Leitor'],    
                'value' => function ($data) { 
                    return $data->usua_tipo ? 'Autor' : 'Leitor';
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
