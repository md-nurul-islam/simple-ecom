<?php

use yii\db\Schema;
use yii\db\Migration;

class m160208_114542_create_transaction_table extends Migration
{
    public function up() {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%transaction}}', [
            'id' => $this->primaryKey(),
            'order_id' => 'INT(11) NOT NULL',
            'amount' => 'INT(11) NOT NULL',
            'payment_method' => 'TINYINT(1) NOT NULL DEFAULT 0',
            // 0 = bank transfer, 1 - cash on delivery
            'created_date' => 'DATETIME NOT NULL',
            'updated_date' => 'DATETIME NOT NULL',
            'status' => 'TINYINT(1) NOT NULL DEFAULT 1',
                ], $tableOptions);
        
        $this->addForeignKey('fk11', '{{%transaction}}', 'order_id', '{{%order}}', 'id', 'NO ACTION', 'NO ACTION');
    }

    public function down() {
        $this->dropTable('{{%transaction}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
