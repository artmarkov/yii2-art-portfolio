<?php

use artsoft\db\SourceMessagesMigration;

class m190522_145020_i18n_art_portfolio_source extends SourceMessagesMigration
{

    public function getCategory()
    {
        return 'art/portfolio';
    }

    public function getMessages()
    {
        return [
            'Link Href' => 1,
            'Portfolio Category' => 1,
            'Portfolio Items' => 1,
            'Portfolio Menu' => 1,            
            'Select Categories...' => 1,
            'Thumbnail' => 1,
        ];
    }
}