<?php

use yii\db\Schema;
use yii\db\Migration;

class m160208_114454_create_member_profile_table extends Migration {

    public function up() {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%member_profile}}', [
            'id' => $this->primaryKey(),
            'name' => 'VARCHAR(50) NOT NULL',
            'address' => 'LONGTEXT NOT NULL',
            'contact_number' => 'VARCHAR(30) NOT NULL',
            'avatar' => 'VARCHAR(255) NULL',
            'max_cart_amount' => 'DECIMAL( 13, 2 ) NULL DEFAULT NULL',
            'member_id' => 'INT(11) NOT NULL',
            'created_date' => 'DATETIME NOT NULL',
            'updated_date' => 'DATETIME NOT NULL',
            'status' => 'TINYINT(1) NOT NULL DEFAULT 1',
                ], $tableOptions);

        $this->addForeignKey('fk5', '{{%member_profile}}', 'member_id', '{{%member}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down() {
        $this->dropTable('{{%member_profile}}');
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
