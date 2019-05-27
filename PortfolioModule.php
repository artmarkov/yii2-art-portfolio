<?php

namespace artsoft\portfolio;

/**
 * portfolio module definition class
 */
class PortfolioModule extends \yii\base\Module
{
    /**
     * Version number of the module.
     */
    const VERSION = '0.1.0';
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'artsoft\portfolio\controllers';
    
    public $thumbnailSize = 'medium';
    /**
     * {@inheritdoc}
     */
    public function init()
    {
         if (in_array($this->thumbnailSize, [])) {
            $this->thumbnailSize = 'medium';
        }
        parent::init();
    }
}
