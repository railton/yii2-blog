<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Usuario;

/**
 * UsuarioSearch represents the model behind the search form about `common\models\Usuario`.
 */
class UsuarioSearch extends Usuario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usua_codigo', 'usua_tipo'], 'integer'],
            [['usua_nome', 'usua_email', 'usua_senha', 'usua_auth_key'], 'safe'],
            [['usua_habilitado'], 'boolean'],
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
        $query = Usuario::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'usua_codigo' => $this->usua_codigo,
            'usua_habilitado' => $this->usua_habilitado,
            'usua_tipo' => $this->usua_tipo,
        ]);

        $query->andFilterWhere(['like', 'usua_nome', $this->usua_nome])
            ->andFilterWhere(['like', 'usua_email', $this->usua_email])
            ->andFilterWhere(['like', 'usua_senha', $this->usua_senha])
            ->andFilterWhere(['like', 'usua_auth_key', $this->usua_auth_key]);

        return $dataProvider;
    }
}
