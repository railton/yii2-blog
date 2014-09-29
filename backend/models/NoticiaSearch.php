<?php

namespace backend\models;

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
    public function search($params)
    {
        $query = Noticia::find();
        
        $query->joinWith(['categoria', 'usuario', 'situacao']);
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        
        // Adicionar o sort
        $dataProvider->sort->attributes['cate_codigo'] = [
            'asc' => ['categoria.cate_nome' => SORT_ASC],
            'desc' => ['categoria.cate_nome' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['nosi_codigo'] = [
            'asc' => ['situacao.nosi_codigo' => SORT_ASC],
            'desc' => ['situacao.nosi_codigo' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['usua_codigo'] = [
            'asc' => ['usuario.usua_nome' => SORT_ASC],
            'desc' => ['usuario.usua_nome' => SORT_DESC],
        ];
        

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'noti_codigo' => $this->noti_codigo,
            'noti_data_criacao' => $this->noti_data_criacao,
            'noti_data_alteracao' => $this->noti_data_alteracao,
            //'noti_data_publicacao' => $this->noti_data_publicacao,
            'categoria.cate_codigo' => $this->cate_codigo,
            //'usua_codigo' => $this->usua_codigo,
            'situacao.nosi_codigo' => $this->nosi_codigo,
            'noti_imagem' => $this->noti_imagem,
        ]);
        
        // Pesquisa por data
        $dataInicio = DateTime::createFromFormat('d/m/Y', $this->noti_data_publicacao)->format('Y-m-d');
        $dataFim = DateTime::createFromFormat('d/m/Y', $this->noti_data_publicacao)->add(new DateInterval('P1D'))->format('Y-m-d');
        $query->andFilterWhere(['between', 'noti_data_publicacao', $dataInicio, $dataFim]);        

        // Pesquisar por usuario
        $query->andFilterWhere(['ilike', 'usuario.usua_nome', $this->usua_codigo]);
        
        $query->andFilterWhere(['ilike', 'noti_titulo', $this->noti_titulo])
            ->andFilterWhere(['ilike', 'noti_texto', $this->noti_texto]);

        return $dataProvider;
    }
}
