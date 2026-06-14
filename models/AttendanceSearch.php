<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Attendance;

class AttendanceSearch extends Attendance
{
    public function rules()
    {
        return [
            [['id', 'event_id', 'member_id'], 'integer'],
            [['status', 'recorded_at'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Attendance::find()->joinWith(['member', 'event']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

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