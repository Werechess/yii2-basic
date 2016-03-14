<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Calendar;

/**
 * CalendarSearch represents the model behind the search form about `app\models\Calendar`.
 */
class CalendarSearch extends Calendar
{
    public $access;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'creator'], 'integer'],
            [['text', 'date_event', 'access'], 'safe'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['access']);
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
        $query = Calendar::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith(['access']);

        $dataProvider->sort->attributes['access'] = [
            'asc' => ['tbl_access.user_guest' => SORT_ASC],
            'desc' => ['tbl_access.user_guest' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'tbl_calendar.id' => $this->id,
            'tbl_calendar.creator' => $this->creator,
            'tbl_calendar.date_event' => $this->date_event,
            'tbl_access.user_guest' => $this->access['user_guest'],
        ]);

        $query->andFilterWhere(['like', 'tbl_calendar.text', $this->text]);

        return $dataProvider;
    }
}
