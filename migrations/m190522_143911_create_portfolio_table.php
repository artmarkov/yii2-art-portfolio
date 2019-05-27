<?php

use yii\db\Migration;

class m190522_143911_create_portfolio_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
             $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

       $this->createTable('{{%portfolio_items}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'thumbnail' => $this->string()->notNull(),
            'img_alt' => $this->string(),
            'link_href' => $this->string(),
            'status' => $this->tinyInteger()->notNull(),
            'sortOrder' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('category_id', '{{%portfolio_items}}', 'category_id');
        $this->createIndex('created_by', '{{%portfolio_items}}', 'created_by');
        $this->createIndex('updated_by', '{{%portfolio_items}}', 'updated_by');
        $this->addForeignKey('portfolio_items_ibfk_1', '{{%portfolio_items}}', 'created_by', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('portfolio_items_ibfk_2', '{{%portfolio_items}}', 'updated_by', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
        
        $this->createTable('{{%portfolio_category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'type' => $this->tinyInteger()->notNull(),
            'description' => $this->text(),
            'status' => $this->tinyInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        
        $this->createIndex('created_by', '{{%portfolio_category}}', 'created_by');
        $this->createIndex('updated_by', '{{%portfolio_category}}', 'updated_by');
        $this->addForeignKey('portfolio_category_ibfk_1', '{{%portfolio_category}}', 'created_by', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('portfolio_category_ibfk_2', '{{%portfolio_category}}', 'updated_by', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
        
        $this->createTable('{{%portfolio_menu}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'status' => $this->tinyInteger()->notNull()->defaultValue('0'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'sortOrder' => $this->integer(),
        ], $tableOptions);
 
        $this->createIndex('created_by', '{{%portfolio_menu}}', 'created_by');
        $this->createIndex('updated_by', '{{%portfolio_menu}}', 'updated_by');
        $this->addForeignKey('portfolio_menu_ibfk_1', '{{%portfolio_menu}}', 'created_by', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('portfolio_menu_ibfk_2', '{{%portfolio_menu}}', 'updated_by', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
        
        $this->createTable('{{%portfolio_menu_category}}', [
            'id' => $this->primaryKey(),
            'menu_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ], $tableOptions);
         
        $this->createIndex('category_id', '{{%portfolio_menu_category}}', 'category_id');
        $this->createIndex('menu_id', '{{%portfolio_menu_category}}', 'menu_id');
    }

    public function down()
    {
        $this->dropTable('{{%portfolio_menu_category}}');
        $this->dropTable('{{%portfolio_menu}}');
        $this->dropTable('{{%portfolio_category}}');
        $this->dropTable('{{%portfolio_items}}');
    }
}
