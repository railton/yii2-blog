<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property integer $cate_codigo
 * @property string $cate_nome
 *
 * @property Noticia[] $noticias
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cate_nome'], 'required'],
            [['cate_nome'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cate_codigo' => 'Código',
            'cate_nome' => 'Nome',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticias()
    {
        return $this->hasMany(Noticia::className(), ['cate_codigo' => 'cate_codigo']);
    }
}
