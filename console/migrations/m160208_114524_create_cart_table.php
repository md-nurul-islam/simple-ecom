<?php

use yii\db\Schema;
use yii\db\Migration;

class m160208_114524_create_cart_table extends Migration {

    public function up() {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cart}}', [
            'id' => $this->primaryKey(),
            'order_id' => 'INT(11) NOT NULL',
            'product_id' => 'INT(11) NOT NULL',
            'unit_selling_price' => 'DECIMAL(13,2) NOT NULL DEFAULT 0.00',
            'quantity_sold' => 'INT(11) NOT NULL DEFAULT 0',
            'vat' => 'DECIMAL(13,2) NOT NULL DEFAULT 0.00',
            'discount' => 'DECIMAL(13,2) NOT NULL DEFAULT 0.00',
            'subtotal_payable' => 'DECIMAL(13,2) NOT NULL DEFAULT 0.00',
            'subtotal_paid' => 'DECIMAL(13,2) NOT NULL DEFAULT 0.00',
            'created_date' => 'DATETIME NOT NULL',
            'updated_date' => 'DATETIME NOT NULL',
                ], $tableOptions);

        $this->addForeignKey('fk7', '{{%cart}}', 'product_id', '{{%product}}', 'id', 'NO ACTION', 'NO ACTION');        
        $this->addForeignKey('fk8', '{{%cart}}', 'order_id', '{{%order}}', 'id', 'NO ACTION', 'NO ACTION');
    }

    public function down() {
        $this->dropTable('{{%cart}}');
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
