<?php

namespace app\models\sdm;

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
            ['visitsLeft', 'integer'],
        ];
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
