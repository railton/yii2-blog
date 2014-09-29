<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $usua_codigo
 * @property string $usua_nome
 * @property string $usua_email
 * @property string $usua_senha
 * @property boolean $usua_habilitado
 * @property integer $usua_tipo
 * @property string $usua_auth_key
 *
 * @property Noticia[] $noticias
 * @property Comentario[] $comentarios
 */
class Usuario extends \yii\db\ActiveRecord
{
    public $usua_senha_confirmacao;
    public $senha_temp;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usua_nome', 'usua_email', 'usua_senha', 'usua_tipo', 'usua_senha_confirmacao'], 'required'],
            [['usua_habilitado'], 'boolean'],
            [['usua_tipo'], 'integer'],
            [['usua_nome', 'usua_email'], 'string', 'max' => 60],
            [['usua_senha'], 'string', 'max' => 60],
            [['usua_auth_key'], 'string', 'max' => 32],
            [['usua_email'],'email'],
            [['usua_email'],'unique'],
            [['usua_senha'], 'compare','compareAttribute'=>'usua_senha_confirmacao'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usua_codigo' => 'Código',
            'usua_nome' => 'Nome',
            'usua_email' => 'E-mail',
            'usua_senha' => 'Senha',
            'usua_habilitado' => 'Habilitado',
            'usua_tipo' => 'Tipo',
            'usua_auth_key' => 'Auth Key',
            'usua_senha_confirmacao' => 'Confirmação de senha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticias()
    {
        return $this->hasMany(Noticia::className(), ['usua_codigo' => 'usua_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::className(), ['usua_codigo' => 'usua_codigo']);
    }
    
    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\AttributeBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => 'usua_auth_key',
                ],
                'value' => function ($event) {
                    return Yii::$app->getSecurity()->generateRandomString();
                },
            ],
        ];
    }
    
    public function afterFind()
    {
            
        $this->usua_senha_confirmacao = $this->senha_temp = $this->usua_senha;          
    
    } 
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            
            if($this->usua_senha != $this->senha_temp)
                $this->usua_senha = Yii::$app->getSecurity()->generatePasswordHash($this->usua_senha);
            
            return true;
        }
        return false;
    }
}
