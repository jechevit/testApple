<?php

use core\database\Column;
use core\database\Table;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%apples}}`.
 */
class m200428_120002_create_apples_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(Table::APPLES, [
            Column::ID => $this->primaryKey(),
            Column::COLOR => $this->string()->notNull(),
            Column::EATEN => $this->integer()->notNull(),
            Column::STATUS => $this->integer()->notNull(),
            Column::IS_ROTTEN => $this->integer()->null(),
            Column::FALLEN_AT => $this->integer()->null(),
            Column::CREATED_AT => $this->integer()->notNull(),
        ], Table::OPTIONS);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(Table::APPLES);
    }
}
