<?php

use core\database\Column;
use core\database\Table;
use yii\db\Migration;

/**
 * Class m200428_151902_delete_field_from_appl
 */
class m200428_151902_delete_field_from_appl extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn(Table::APPLES, Column::IS_ROTTEN);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200428_151902_delete_field_from_appl cannot be reverted.\n";

        return false;
    }
}
