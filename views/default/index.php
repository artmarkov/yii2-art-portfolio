<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use artsoft\grid\SortableGridView;
use artsoft\grid\GridQuickLinks;
use artsoft\portfolio\models\Items;
use artsoft\portfolio\models\Category;
use artsoft\helpers\Html;
use artsoft\grid\GridPageSize;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel artsoft\portfolio\models\search\ItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('art/portfolio', 'Portfolio Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="lte-hide-title page-title"><?=  Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('art', 'Add New'), ['/portfolio/default/create'], ['class' => 'btn btn-sm btn-success']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-6">
                    <?php 
                    /* Uncomment this to activate GridQuickLinks */
                     echo GridQuickLinks::widget([
                        'model' => Items::className(),
                        'searchModel' => $searchModel,
                    ])
                    ?>
                </div>

                <div class="col-sm-6 text-right">
                    <?=  GridPageSize::widget(['pjaxId' => 'items-grid-pjax']) ?>
                </div>
            </div>

            <?php 
            Pjax::begin([
                'id' => 'items-grid-pjax',
            ])
            ?>

            <?= SortableGridView::widget([
                'id' => 'items-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'sortableAction' => ['grid-sort'],
                'bulkActionOptions' => [
                    'gridId' => 'items-grid',
//                    'actions' => [ Url::to(['bulk-delete']) => 'Delete'] //Configure here you bulk actions
                ],
                'columns' => [
                    ['class' => 'artsoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    ['class' => 'yii\grid\SerialColumn', 'options' => ['style' => 'width:20px']],
                    [
                        'class' => 'artsoft\grid\columns\TitleActionColumn',
                        'attribute' => 'thumbnail',
                        'options' => ['style' => 'width:250px'],
                        'controller' => '/portfolio/default',
                        'title' => function(Items $model) {
                            !empty($model->thumbnail) ? $img = $model->thumbnail : $img = '/images/noimg.png';
                            return Html::img($img, ['class'=> 'dw-media-image']);
                        },
                        'buttonsTemplate' => '{update} {delete}',
                    ],
                [
                    'attribute' => 'category_id',
                    'value' => 'categoryName',
                    'label' => Yii::t('art/portfolio', 'Portfolio Category'),
                    'filter' => Category::getCategories(),
                    'options' => ['style' => 'width:350px'],
                ],
                                
            'link_href',
                                
                [
                    'class' => 'artsoft\grid\columns\StatusColumn',
                    'attribute' => 'status',
                    'optionsArray' => [
                        [Items::STATUS_ACTIVE, Yii::t('art', 'Active'), 'primary'],
                        [Items::STATUS_INACTIVE, Yii::t('art', 'Inactive'), 'info'],
                    ],
                    'options' => ['style' => 'width:250px']
                ],
            // 'created_at',
            // 'updated_at',

                ],
            ]);
            ?>

            <?php Pjax::end() ?>
        </div>
    </div>
</div>


