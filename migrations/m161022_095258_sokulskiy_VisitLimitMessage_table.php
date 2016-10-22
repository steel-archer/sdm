<?php

use yii\db\Migration;

class m161022_095258_sokulskiy_VisitLimitMessage_table extends Migration
{
    public function safeUp()
    {
        $this->execute('
            CREATE TABLE `visitLimitMessage` (
              `messageId` char(32) NOT NULL,
              `visitsLeft` smallint NOT NULL DEFAULT 1,
              PRIMARY KEY (messageId)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ');
    }

    public function safeDown()
    {
        $this->execute('
            DROP TABLE `visitLimitMessage`;
        ');
    }
}
