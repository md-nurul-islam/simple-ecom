<?php

use yii\db\Schema;
use yii\db\Migration;

class m160208_192404_create_manufacturer extends Migration {

    public function up() {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%manufacturer}}', [
            'id' => $this->primaryKey(),
            'name' => 'VARCHAR(255) NOT NULL',
            'address' => 'TEXT NULL',
            'contact_number' => 'VARCHAR(20) NULL DEFAULT NULL',
            'created_date' => 'DATETIME NOT NULL',
            'updated_date' => 'DATETIME NOT NULL',
            'status' => 'TINYINT(1) NOT NULL DEFAULT 1',
                ], $tableOptions);
    }

    public function down() {
        $this->dropTable('{{%manufacturer}}');
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
