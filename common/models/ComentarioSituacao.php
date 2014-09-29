<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comentario_situacao".
 *
 * @property integer $cosi_codigo
 * @property string $cosi_nome
 *
 * @property Comentario[] $comentarios
 */
class ComentarioSituacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comentario_situacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cosi_nome'], 'required'],
            [['cosi_nome'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cosi_codigo' => 'Cosi Codigo',
            'cosi_nome' => 'Cosi Nome',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::className(), ['cosi_codigo' => 'cosi_codigo']);
    }
}
