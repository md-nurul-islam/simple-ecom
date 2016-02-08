<?php

use yii\db\Schema;
use yii\db\Migration;

class m160208_114302_create_product_category_table extends Migration {

    public function up() {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product_category}}', [
            'id' => $this->primaryKey(),
            'product_id' => 'INT(11) NOT NULL',
            'category_id' => 'INT(11) NOT NULL',
                ], $tableOptions);

        $this->addForeignKey('fk3', '{{%product_category}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk4', '{{%product_category}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down() {
        $this->dropTable('{{%product_category}}');
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
