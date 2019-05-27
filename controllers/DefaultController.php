<?php

namespace artsoft\portfolio\controllers;
use himiklab\sortablegrid\SortableGridAction;
use Yii;


/**
 * DefaultController implements the CRUD actions for artsoft\portfolio\models\Items model.
 */
class DefaultController extends \backend\controllers\DefaultController
{
    public $modelClass       = 'artsoft\portfolio\models\Items';
    public $modelSearchClass = 'artsoft\portfolio\models\search\ItemsSearch';

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
    public function actionPasteLink() {

        $id = Yii::$app->request->post('id');
      
        if ($id != 0) {
            $model = \artsoft\media\models\Media::findById($id);
            // echo '<pre>' . print_r($model, true) . '</pre>';
            return $model->getThumbUrl('original');
            
        } else {
            return false;
        }
    }
}