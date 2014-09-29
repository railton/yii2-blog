<?php

namespace backend\models;

use Yii;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['usua_codigo' => $id, 'usua_habilitado' => true, 'usua_tipo' => 1]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['usua_email' => $username, 'usua_habilitado' => true, 'usua_tipo' => 1]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->usua_codigo;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->usua_auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->usua_auth_key === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->usua_senha);
    }
}
