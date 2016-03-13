<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_access".
 *
 * @property integer $id
 * @property integer $note_id
 * @property integer $user_owner
 * @property integer $user_guest
 * @property string $date
 *
 * @property TblUser $userOwner
 * @property TblUser $userGuest
 * @property TblCalendar $note
 */
class Access extends \yii\db\ActiveRecord
{
    const ACCESS_CREATOR = 1;
    const ACCESS_GUEST = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_access';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['note_id', 'user_owner', 'user_guest', 'date'], 'required'],
            [['note_id', 'user_owner', 'user_guest'], 'integer'],
            [['date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'note_id' => Yii::t('app', 'Note ID'),
            'user_owner' => Yii::t('app', 'User Owner'),
            'user_guest' => Yii::t('app', 'User Guest'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    /**
     * Check access current user by calendar
     * @param Calendar $model
     * @return bool|int
     */
    public static function checkAccess($model)
    {
        if($model->creator == Yii::$app->user->id)
        {
            return self::ACCESS_CREATOR;
        }
        $accessCalendar = self::find()
            ->withCalendar($model->id)
            ->withUser(Yii::$app->user->id)
            ->exists();
        if($accessCalendar)
            return self::ACCESS_GUEST;

        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserOwner()
    {
        return $this->hasOne(TblUser::className(), ['id' => 'user_owner']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGuest()
    {
        return $this->hasOne(TblUser::className(), ['id' => 'user_guest']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNote()
    {
        return $this->hasOne(TblCalendar::className(), ['id' => 'note_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\AccessQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\AccessQuery(get_called_class());
    }
}
