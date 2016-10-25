<?php

use yii\db\Migration;

class m161025_112600_sokulskiy_passwordHash_change_length extends Migration
{
    public function safeUp()
    {
        $this->execute('
            ALTER TABLE `message` MODIFY COLUMN `passwordHash` CHAR(60)
        ');
    }

    public function safeDown()
    {
        $this->execute('
            ALTER TABLE `message` MODIFY COLUMN `passwordHash` CHAR(32)
        ');
    }
}
