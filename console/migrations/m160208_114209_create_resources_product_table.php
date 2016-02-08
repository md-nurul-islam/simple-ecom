<?php

use yii\db\Schema;
use yii\db\Migration;

class m160208_114209_create_resources_product_table extends Migration {

    public function up() {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%resources_product}}', [
            'id' => $this->primaryKey(),
            'resources_id' => 'INT(11) NOT NULL',
            'product_id' => 'INT(11) NOT NULL',
                ], $tableOptions);
        
        $this->addForeignKey('fk1', '{{%resources_product}}', 'resources_id', '{{%resources}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk2', '{{%resources_product}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'CASCADE');
        
    }

    public function down() {
        $this->dropTable('{{%resources_product}}');
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
