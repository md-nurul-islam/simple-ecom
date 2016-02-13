<?php

use yii\db\Schema;
use yii\db\Migration;

class m160208_114208_create_product_table extends Migration {

    public function up() {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => 'VARCHAR(255) NOT NULL',
            'display_name' => 'VARCHAR(255) NOT NULL',
            'description' => 'LONGTEXT NULL DEFAULT NULL',
            'purchase_price' => 'DECIMAL(13,2) NOT NULL DEFAULT 0.00',
            'selling_price' => 'DECIMAL(13,2) NOT NULL DEFAULT 0.00',
            'in_home_slider' => 'TINYINT(1) NOT NULL DEFAULT 0',
            'top_rated' => 'TINYINT(1) NOT NULL DEFAULT 0',
            'is_private' => 'TINYINT(1) NOT NULL DEFAULT 0',
            'created_date' => 'DATETIME NOT NULL',
            'updated_date' => 'DATETIME NOT NULL',
            'status' => 'TINYINT(1) NOT NULL DEFAULT 1',
                ], $tableOptions);
    }

    public function down() {
        $this->dropTable('{{%product}}');
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
