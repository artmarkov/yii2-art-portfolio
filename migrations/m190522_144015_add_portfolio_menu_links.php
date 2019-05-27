<?php

use yii\db\Migration;

class m190522_144015_add_portfolio_menu_links extends Migration
{

    public function up()
    {
        $this->insert('{{%menu_link}}', ['id' => 'portfolio', 'menu_id' => 'admin-menu', 'image' => 'film', 'created_by' => 1, 'order' => 1]);
        $this->insert('{{%menu_link}}', ['id' => 'portfolio-portfolio', 'menu_id' => 'admin-menu', 'link' => '/portfolio/default/index', 'parent_id' => 'portfolio', 'created_by' => 1, 'order' => 2]);
        $this->insert('{{%menu_link}}', ['id' => 'portfolio-category', 'menu_id' => 'admin-menu', 'link' => '/portfolio/category/index', 'parent_id' => 'portfolio', 'created_by' => 1, 'order' => 3]);
        $this->insert('{{%menu_link}}', ['id' => 'portfolio-menu', 'menu_id' => 'admin-menu', 'link' => '/portfolio/menu/index', 'parent_id' => 'portfolio', 'created_by' => 1, 'order' => 4]);

        $this->insert('{{%menu_link_lang}}', ['link_id' => 'portfolio', 'label' => 'Portfolio', 'language' => 'en-US']);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'portfolio-portfolio', 'label' => 'Portfolio Items', 'language' => 'en-US']);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'portfolio-category', 'label' => 'Portfolio Categories', 'language' => 'en-US']);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'portfolio-menu', 'label' => 'Portfolio Menu', 'language' => 'en-US']);
    }

    public function down()
    {
        $this->delete('{{%menu_link}}', ['like', 'id', 'portfolio-menu']);
        $this->delete('{{%menu_link}}', ['like', 'id', 'portfolio-category']);
        $this->delete('{{%menu_link}}', ['like', 'id', 'portfolio-portfolio']);
        $this->delete('{{%menu_link}}', ['like', 'id', 'portfolio']);
    }
}