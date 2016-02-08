<?php

use yii\db\Schema;
use yii\db\Migration;

class m160208_192405_create_product_manufacturer extends Migration {

    public function up() {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product_manufacturer}}', [
            'id' => $this->primaryKey(),
            'manufacturer_id' => 'INT(11) NOT NULL DEFAULT 0',
            'product_id' => 'INT(11) NOT NULL DEFAULT 0',
                ], $tableOptions);

        
        $this->addForeignKey('fk12', '{{%product_manufacturer}}', 'product_id', '{{%product}}', 'id', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('fk13', '{{%product_manufacturer}}', 'manufacturer_id', '{{%manufacturer}}', 'id', 'NO ACTION', 'NO ACTION');
    }

    public function down() {
        $this->dropTable('{{%product_manufacturer}}');
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
