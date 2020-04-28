<?php


namespace core\database;


class MigrationHelper
{
    public static function indexName(string $table, string $column): string
    {
        return '{{%idx-' . self::tableName($table) . '-' . $column. '}}';
    }

    public static function foreignKeyName(string $table, string $column): string
    {
        return '{{%fk-'. self::tableName($table). '-' . $column .'}}';
    }

    public static function primaryKeyName(string $table)
    {
        return '{{%pk-' . self::tableName($table). '}}';
    }

    public static function tableName(string $table)
    {
        return preg_replace('/([{%}]+)/', '', $table);
    }
}