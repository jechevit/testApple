<?php

use core\database\Column;
use core\database\Table;
use yii\db\Migration;

/**
 * Class m200428_104854_add_user
 */
class m200428_104854_add_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert(Table::USERS, [
            Column::ID => '1',
            Column::USERNAME => 'admin',
            Column::AUTH_KEY => 'XvOrOOh9wWrZ5Fw-xBfV9NhSw3HliZDt',
            Column::PASSWORD_HASH => '$2y$13$aSrGxvynRRnPW9vwI4lHOOG9xWfcaIEQM0rV4/j73VqojMyyn3L9m',
            Column::PASSWORD_RESET_TOKEN => '',
            Column::EMAIL => 'admin@mail.ru',
            Column::STATUS => '10',
            Column::CREATED_AT => '0',
            Column::UPDATED_AT => '0',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200428_104854_add_user cannot be reverted.\n";

        return false;
    }
}
