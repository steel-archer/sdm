<?php

use yii\db\Migration;

class m161022_094606_sokulskiy_Message_table extends Migration
{
    public function safeUp()
    {
        $this->execute('
            CREATE TABLE `message` (
              `messageId` char(32) NOT NULL,
              `messageText` text NOT NULL,
              `passwordHash` char(32) NOT NULL,
              `destroyTrigger` enum ("time", "visit"),
              PRIMARY KEY (messageId)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ');
    }

    public function safeDown()
    {
        $this->execute('
            DROP TABLE `message`;
        ');
    }
}
