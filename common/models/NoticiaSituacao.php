<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "noticia_situacao".
 *
 * @property integer $nosi_codigo
 * @property string $nosi_nome
 *
 * @property Noticia[] $noticias
 */
class NoticiaSituacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'noticia_situacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nosi_nome'], 'required'],
            [['nosi_nome'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nosi_codigo' => 'Código',
            'nosi_nome' => 'Nome',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticias()
    {
        return $this->hasMany(Noticia::className(), ['nosi_codigo' => 'nosi_codigo']);
    }
}
