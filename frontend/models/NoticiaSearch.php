<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Noticia;
use \DateTime;
use \DateInterval;

/**
 * NoticiaSearch represents the model behind the search form about `common\models\Noticia`.
 */
class NoticiaSearch extends Noticia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['noti_codigo', 'cate_codigo', 'nosi_codigo'], 'integer'],
            [['noti_titulo', 'noti_texto', 'noti_data_criacao', 'noti_data_alteracao', 'noti_data_publicacao', 'usua_codigo'], 'safe'],
            [['noti_imagem'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search()
    {
        $query = Noticia::find();
        
        $query->andFilterWhere(['nosi_codigo' => 2]);
        
        $query->orderBy('noti_data_publicacao DESC');       

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }
}
