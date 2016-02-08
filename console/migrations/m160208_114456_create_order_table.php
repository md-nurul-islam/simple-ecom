<?php

use yii\db\Schema;
use yii\db\Migration;

class m160208_114456_create_order_table extends Migration {

    public function up() {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'bill_number' => 'INT(11) NOT NULL',
            'member_id' => 'INT(11) NOT NULL',
            'total_amount' => 'DECIMAL(13,2) NOT NULL DEFAULT 0.00',
            'total_payable' => 'DECIMAL(13,2) NOT NULL DEFAULT 0.00',
            'total_paid' => 'DECIMAL(13,2) NOT NULL DEFAULT 0.00',
            'total_advance' => 'DECIMAL(13,2) NOT NULL DEFAULT 0.00',
            'total_due' => 'DECIMAL(13,2) NOT NULL DEFAULT 0.00',
            'total_changes' => 'DECIMAL(13,2) NOT NULL DEFAULT 0.00',
            'has_due' => 'TINYINT(1) NOT NULL DEFAULT 1',
            'created_date' => 'DATETIME NOT NULL',
            'updated_date' => 'DATETIME NOT NULL',
            'status' => 'TINYINT(1) NOT NULL DEFAULT 1',
            // 0 = new order, 1 = preparing to deliver, 2 = delivered, -1 = cancelled
                ], $tableOptions);
        
        $this->addForeignKey('fk6', '{{%order}}', 'member_id', '{{%member}}', 'id', 'NO ACTION', 'NO ACTION');
    }

    public function down() {
        $this->dropTable('{{%order}}');
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
