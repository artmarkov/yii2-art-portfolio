<?php

namespace artsoft\portfolio\controllers;

use Yii;
use backend\controllers\DefaultController;
use himiklab\sortablegrid\SortableGridAction;

/**
 * MenuController implements the CRUD actions for artsoft\portfolio\models\Menu model.
 */
class MenuController extends DefaultController 
{
    public $modelClass       = 'artsoft\portfolio\models\Menu';
    public $modelSearchClass = 'artsoft\portfolio\models\search\MenuSearch';

    protected function getRedirectPage($action, $model = null)
    {
        switch ($action) {
            case 'update':
                return ['update', 'id' => $model->id];
                break;
            case 'create':
                return ['update', 'id' => $model->id];
                break;
            default:
                return parent::getRedirectPage($action, $model);
        }
    }
    /**
     * action sort for himiklab\sortablegrid\SortableGridBehavior
     * @return type
     */
    public function actions()
    {
        return [
            'grid-sort' => [
                'class' => SortableGridAction::className(),
                'modelName' => $this->modelClass,
            ],
        ];
    }
}