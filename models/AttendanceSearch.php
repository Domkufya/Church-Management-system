<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Attendance;

<<<<<<< HEAD
class AttendanceSearch extends Attendance
{
=======
/**
 * AttendanceSearch represents the model behind the search form of `app\models\Attendance`.
 */
class AttendanceSearch extends Attendance
{
    /**
     * {@inheritdoc}
     */
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
    public function rules()
    {
        return [
            [['id', 'event_id', 'member_id'], 'integer'],
            [['status', 'recorded_at'], 'safe'],
        ];
    }

<<<<<<< HEAD
    public function search($params)
    {
        $query = Attendance::find()->joinWith(['member', 'event']);
=======
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Attendance::find();

        // add conditions that should always apply here
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

<<<<<<< HEAD
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        
        $query->andFilterWhere([
            'attendance.id' => $this->id,
            'attendance.event_id' => $this->event_id,
            'attendance.member_id' => $this->member_id,
        ]);

        $query->andFilterWhere(['like', 'attendance.status', $this->status]);

        return $dataProvider;
    }
}
=======
        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'event_id' => $this->event_id,
            'member_id' => $this->member_id,
            'recorded_at' => $this->recorded_at,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
>>>>>>> 0d46a0fcdcb6d4281e54097fa87b0072ffa3986e
