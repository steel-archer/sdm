<?php

namespace app\models\sdm;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class for working with TimeLimitMessage entity.
 */
class TimeLimitMessage extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'timelimitmessage';
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
            [['messageId', 'destroyAt'], 'required'],
            [['messageId'],  'match', 'pattern' => '/^[0-9a-f]{32}$/'],
            ['destroyAt', 'date', 'format' => 'php:Y-m-d H:i:s'],
        ];
    }

    /**
     * Returns if the message has been expired.
     * @return boolean
     */
    public function isExpired()
    {
        return time() > strtotime($this->destroyAt);
    }
}
