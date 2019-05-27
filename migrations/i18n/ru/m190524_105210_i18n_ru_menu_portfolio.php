<?php

use yii\db\Migration;

class m190524_105210_i18n_ru_menu_portfolio extends Migration
{

    public function up()
    {
        
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'portfolio', 'label' => 'Портфолио', 'language' => 'ru']);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'portfolio-portfolio', 'label' => 'Портфолио содержание', 'language' => 'ru']);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'portfolio-category', 'label' => 'Категории портфолио', 'language' => 'ru']);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'portfolio-menu', 'label' => 'Меню портфолио', 'language' => 'ru']);

    }

}