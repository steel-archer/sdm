<?php

namespace app\models\backend\sdm;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class for working with VisitLimitMessage entity.
 */
class VisitLimitMessage extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visitlimitmessage';
    }

    /**
     * {@inheritdoc}
     */
    public static function primaryKey()
    {
        return ['messageId'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['messageId', 'visitsLeft'], 'required'],
            [['messageId'],  'match', 'pattern' => '/^[0-9a-f]{32}$/'],
            ['visitsLeft', 'integer', 'min' => 1],
        ];
    }

    /**
     * Returns if this view of the message is last.
     * @return boolean
     */
    public function isLastView()
    {
        return $this->visitsLeft === 1;
    }

    /**
     * Decrements count of visits before destroying message.
     * @return VisitLimitMessage Changed onject.
     */
    public function decrementVisitsLeft()
    {
        $this->visitsLeft--;
        $this->save();

        return $this;
    }
}
