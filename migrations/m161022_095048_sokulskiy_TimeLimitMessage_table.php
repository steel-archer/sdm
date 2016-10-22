<?php

use yii\db\Migration;

class m161022_095048_sokulskiy_TimeLimitMessage_table extends Migration
{
    public function safeUp()
    {
        $this->execute('
            CREATE TABLE `timeLimitMessage` (
              `messageId` char(32) NOT NULL,
              `destroyAt` datetime NOT NULL,
              PRIMARY KEY (messageId)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ');
    }

    public function safeDown()
    {
        $this->execute('
            DROP TABLE `timeLimitMessage`;
        ');
    }
}
