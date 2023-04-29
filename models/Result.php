<?php

namespace app\models;

use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class Result extends ActiveRecord
{
    public static function tableName()
    {
        return 'result';
    }

    public function rules()
    {
        return [
            [['date', 'hours', 'start', 'number_of_lines', 'result'], 'required'],
            [['date', 'start'], 'safe'],
            [['hours', 'number_of_lines'], 'integer'],
            [['result'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'hours' => 'Hours',
            'start' => 'Start',
            'number_of_lines' => 'Number Of Lines',
            'result' => 'Result',
        ];
    }

    public function search($params)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'hours' => $this->hours,
            'start' => $this->start,
            'number_of_lines' => $this->number_of_lines,
            'result' => $this->result,
        ]);

        return $dataProvider;
    }
}
