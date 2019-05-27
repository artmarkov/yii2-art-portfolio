<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use artsoft\grid\SortableGridView;
use artsoft\grid\GridQuickLinks;
use artsoft\portfolio\models\Menu;
use artsoft\helpers\Html;
use artsoft\grid\GridPageSize;
use artsoft\portfolio\models\Category;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel artsoft\portfolio\models\search\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('art/portfolio', 'Portfolio Menu');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="lte-hide-title page-title"><?=  Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('art', 'Add New'), ['/portfolio/menu/create'], ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-6">
                    <?php 
                    /* Uncomment this to activate GridQuickLinks */
                     echo GridQuickLinks::widget([
                        'model' => Menu::className(),
                        'searchModel' => $searchModel,
                    ])
                    ?>
                </div>

                <div class="col-sm-6 text-right">
                    <?=  GridPageSize::widget(['pjaxId' => 'menu-grid-pjax']) ?>
                </div>
            </div>

            <?php 
            Pjax::begin([
                'id' => 'menu-grid-pjax',
            ])
            ?>

            <?= SortableGridView::widget([
                'id' => 'menu-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'sortableAction' => ['grid-sort'],
                'bulkActionOptions' => [
                    'gridId' => 'menu-grid',
//                    'actions' => [ Url::to(['bulk-delete']) => 'Delete'] //Configure here you bulk actions
                ],
                'columns' => [
                    ['class' => 'artsoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    [
                        'class' => 'artsoft\grid\columns\TitleActionColumn',
                        'attribute' => 'name',
                        'controller' => '/portfolio/menu',
                        'title' => function(Menu $model) {
                            return Html::encode($model->name);
                        },
                        'buttonsTemplate' => '{update} {delete}',
                    ],
                    [
                        'attribute' => 'gridCategorySearch',
                        'filter' => Category::getCategories(),
                        'value' => function (Menu $model) {
                            return implode(', ',
                                ArrayHelper::map($model->categories, 'id', 'name'));
                        },
                        'options' => ['style' => 'width:350px'],
                        'format' => 'raw',
                    ],                          
                   [
                    'class' => 'artsoft\grid\columns\StatusColumn',
                    'attribute' => 'status',
                    'optionsArray' => [
                        [Menu::STATUS_ACTIVE, Yii::t('art', 'Active'), 'primary'],
                        [Menu::STATUS_INACTIVE, Yii::t('art', 'Inactive'), 'info'],
                    ],
                    'options' => ['style' => 'width:250px']
                    ],         
//            'sort',
            // 'created_at',
            // 'updated_at',

                ],
            ]);
            ?>

            <?php Pjax::end() ?>
        </div>
    </div>
</div>


