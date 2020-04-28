<?php

use core\database\Table;
use yii\db\Migration;

/**
 * Class m200428_093241_rename_table_user
 */
class m200428_093241_rename_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable(Table::USER, Table::USERS);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameTable(Table::USERS, Table::USER);
    }
}
