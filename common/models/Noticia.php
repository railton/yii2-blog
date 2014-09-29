<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "noticia".
 *
 * @property integer $noti_codigo
 * @property string $noti_titulo
 * @property string $noti_texto
 * @property string $noti_data_criacao
 * @property string $noti_data_alteracao
 * @property string $noti_data_publicacao
 * @property integer $cate_codigo
 * @property integer $usua_codigo
 * @property integer $nosi_codigo
 * @property boolean $noti_imagem
 *
 * @property NoticiaSituacao $nosiCodigo
 * @property Categoria $cateCodigo
 * @property Usuario $usuaCodigo
 * @property Comentario[] $comentarios
 */
class Noticia extends \yii\db\ActiveRecord
{
    public $noti_texto_resumo;
    public $noti_imagem_upload;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'noticia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['noti_titulo', 'noti_texto', 'cate_codigo', 'nosi_codigo'], 'required'],
            [['noti_texto'], 'string'],
            [['noti_data_criacao', 'noti_data_alteracao', 'noti_data_publicacao', 'noti_imagem_upload', 'noti_texto_resumo'], 'safe'],
            [['cate_codigo', 'usua_codigo', 'nosi_codigo'], 'integer'],
            [['noti_imagem'], 'boolean'],
            [['noti_titulo'], 'string', 'max' => 120],
            [['noti_imagem_upload'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'noti_codigo' => 'Código',
            'noti_titulo' => 'Título',
            'noti_texto' => 'Texto',
            'noti_data_criacao' => 'Data de Criação',
            'noti_data_alteracao' => 'Data de Alteração',
            'noti_data_publicacao' => 'Data de Publicação',
            'cate_codigo' => 'Categoria',
            'usua_codigo' => 'Usuário',
            'nosi_codigo' => 'Situação',
            'noti_imagem' => 'Imagem',
            'noti_imagem_upload' => 'Imagem',
            'noti_texto_resumo' => 'Resumo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSituacao()
    {
        return $this->hasOne(NoticiaSituacao::className(), ['nosi_codigo' => 'nosi_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['cate_codigo' => 'cate_codigo']);
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
    public function getComentarios()
    {
        return $this->hasMany(Comentario::className(), ['noti_codigo' => 'noti_codigo']);
    }
    
    public function afterFind() {
        
        parent::afterFind();
        
        $this->noti_texto_resumo = $this->resumo($this->noti_texto, 240);
    }
    
    public function behaviors() {
        return [ 
            // Behaviour responsavel por atualizar os campos de data da tabela
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::className(), 
                    'attributes' => [
                        // Atualiza data de criacao e alteracao quando o evento for o insert
                        \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['noti_data_criacao', 'noti_data_alteracao', 'noti_data_publicacao'],
                        // Atualiza a data de alteracao quando o evento for update
                        \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['noti_data_alteracao'], 
                    ],
                    'value' => new \yii\db\Expression('NOW()'), 
            ],
            // Behavior responsavel por setar o codigo do usuario automaticamente quando o evento for insert ou update
            [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'usua_codigo',
                'updatedByAttribute' => 'usua_codigo',
            ],           
        ];     
    }
    
    public function beforeSave($insert) {
        
        if (parent::beforeSave($insert)) {
            if($insert){
            }                        
            
            // Se a situacao da noticia for alterada para 'publicada' sera alterada a data de publicacao
            if($this->nosi_codigo == 2)
                $this->noti_data_publicacao = new \yii\db\Expression('current_timestamp');
            
            return true; 
           
        } else {
            return false;     
        }
    
    }
    // funcao para delimitar os caracteres mostrados no frontend
    public static function resumo($string,$chars) {
        if (strlen($string) > $chars) {
            while (substr($string,$chars,1) <> ' ' && ($chars < strlen($string))){
                $chars++;
            };
        };
        return substr($string,0,$chars)."...";
    }
    
}
