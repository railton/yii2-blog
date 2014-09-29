<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comentario".
 *
 * @property integer $come_codigo
 * @property string $come_texto
 * @property string $come_data_criacao
 * @property integer $noti_codigo
 * @property integer $usua_codigo
 * @property integer $cosi_codigo
 *
 * @property ComentarioSituacao $cosiCodigo
 * @property Usuario $usuaCodigo
 * @property Noticia $notiCodigo
 */
class Comentario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['come_texto', 'noti_codigo', 'usua_codigo', 'cosi_codigo'], 'required'],
            [['come_data_criacao'], 'safe'],
            [['noti_codigo', 'usua_codigo', 'cosi_codigo'], 'integer'],
            [['come_texto'], 'string', 'max' => 240]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'come_codigo' => 'Código',
            'come_texto' => 'Comentário',
            'come_data_criacao' => 'Data de Criação',
            'noti_codigo' => 'Notícia',
            'usua_codigo' => 'Usuário',
            'cosi_codigo' => 'Situação',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSituacao()
    {
        return $this->hasOne(ComentarioSituacao::className(), ['cosi_codigo' => 'cosi_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['usua_codigo' => 'usua_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticia()
    {
        return $this->hasOne(Noticia::className(), ['noti_codigo' => 'noti_codigo']);
    }
    
    public function behaviors() {
        return [ 
            // Behaviour responsavel por atualizar os campos de data da tabela
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::className(), 
                    'attributes' => [
                        // Atualiza data de criacao quando o evento for o insert
                        \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['come_data_criacao'],
                    ],
                    'value' => new \yii\db\Expression('NOW()'), 
            ],
           
        ];     
    }    
}
