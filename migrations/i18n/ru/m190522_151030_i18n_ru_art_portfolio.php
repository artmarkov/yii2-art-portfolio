<?php

use artsoft\db\TranslatedMessagesMigration;

class m190522_151030_i18n_ru_art_portfolio extends TranslatedMessagesMigration
{

    public function getLanguage()
    {
        return 'ru';
    }

    public function getCategory()
    {
        return 'art/portfolio';
    }

    public function getTranslations()
    {
        return [
            'Link Href' => 'Ссылка на действие',
            'Portfolio Category' => 'Категория портфолио',
            'Portfolio Items' => 'Портфолио',
            'Portfolio Menu' => 'Меню портфолио',            
            'Select Categories...' => 'Выберите Категории...',
            'Thumbnail' => 'Миниатюра',
        ];
        
    }
}