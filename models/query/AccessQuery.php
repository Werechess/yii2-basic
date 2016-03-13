<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Access]].
 *
 * @see \app\models\Access
 */
class AccessQuery extends \yii\db\ActiveQuery
{
    /**
     * Condition with calendar_id
     * @param $calendar_id
     * @return $this
     */
    public function withCalendar($calendar_id)
    {
        return $this->andWhere(
            'calendar_id = :calendar_id',
            [
                ":calendar_id" => $calendar_id
            ]
        );
    }

    /**
     * Condition with user_guest
     * @param $user_guest
     * @return $this
     */
    public function withUser($user_guest)
    {
        return $this->andWhere(
            'user_guest = :user_guest',
            [
                ":user_guest" => $user_guest
            ]
        );
    }

    /**
     * @inheritdoc
     * @return \app\models\Access[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Access|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}