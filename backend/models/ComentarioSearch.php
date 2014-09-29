<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Comentario;

/**
 * ComentarioSearch represents the model behind the search form about `common\models\Comentario`.
 */
class ComentarioSearch extends Comentario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['come_codigo', 'noti_codigo', 'usua_codigo', 'cosi_codigo'], 'integer'],
            [['come_texto', 'come_data_criacao'], 'safe'],
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
    public function search($params)
    {
        $query = Comentario::find();        
        
        $query->orderBy('come_data_criacao DESC');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        
        
        $query->andFilterWhere([
            'come_codigo' => $this->come_codigo,
            'come_data_criacao' => $this->come_data_criacao,
            'noti_codigo' => $this->noti_codigo,
            'usua_codigo' => $this->usua_codigo,
            'cosi_codigo' => $this->cosi_codigo,
        ]);

        $query->andFilterWhere(['ilike', 'come_texto', $this->come_texto]);

        return $dataProvider;
    }
}
