<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <?php echo \yii\widgets\ListView::widget([

            'dataProvider' => $dataProvider,
            
            'summary' => false,

            'itemView' => function ($model, $key, $index, $widget) {

                    return $this->render('_index',['model' => $model]);

            },

        ]); ?>

    </div>
</div>


