<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DoctorTabel;

/**
 * DoctorTabelSearch represents the model behind the search form of `app\models\DoctorTabel`.
 */
class DoctorTabelSearch extends DoctorTabel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'docID', 'clientType', 'freeDay'], 'integer'],
            [['workingDayStart', 'workingDayEnd'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = DoctorTabel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'docID' => $this->docID,
            'clientType' => $this->clientType,
            'freeDay' => $this->freeDay,
        ]);

        $query->andFilterWhere(['like', 'workingDayStart', $this->workingDayStart])
            ->andFilterWhere(['like', 'workingDayEnd', $this->workingDayEnd]);

        return $dataProvider;
    }
}
