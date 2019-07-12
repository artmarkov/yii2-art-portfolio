<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use artsoft\grid\GridView;
use artsoft\grid\GridQuickLinks;
use artsoft\portfolio\models\Category;
use artsoft\helpers\Html;
use artsoft\grid\GridPageSize;

/* @var $this yii\web\View */
/* @var $searchModel artsoft\portfolio\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('art/portfolio', 'Portfolio Category');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="lte-hide-title page-title"><?=  Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('art', 'Add New'), ['/portfolio/category/create'], ['class' => 'btn btn-sm btn-success']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-6">
                    <?php 
                    /* Uncomment this to activate GridQuickLinks */
                    echo GridQuickLinks::widget([
                        'model' => Category::className(),
                        'searchModel' => $searchModel,
                    ])
                    ?>
                </div>

                <div class="col-sm-6 text-right">
                    <?=  GridPageSize::widget(['pjaxId' => 'category-grid-pjax']) ?>
                </div>
            </div>

            <?php 
            Pjax::begin([
                'id' => 'category-grid-pjax',
            ])
            ?>

            <?= GridView::widget([
                'id' => 'category-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'bulkActionOptions' => [
                    'gridId' => 'category-grid',
//                    'actions' => [ Url::to(['bulk-delete']) => 'Delete'] //Configure here you bulk actions
                ],
                'columns' => [
                    ['class' => 'artsoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    [
                        'class' => 'artsoft\grid\columns\TitleActionColumn',
                        'attribute' => 'name',
                        'controller' => '/portfolio/category',
                        'title' => function(Category $model) {
                            return Html::encode($model->name);
                        },
                        'buttonsTemplate' => '{update} {delete}',
                    ],
            'slug',
            //'description',
                    [
                        'class' => 'artsoft\grid\columns\StatusColumn',
                        'attribute' => 'status',
                        'optionsArray' => [
                            [Category::STATUS_ACTIVE, Yii::t('art', 'Active'), 'primary'],
                            [Category::STATUS_INACTIVE, Yii::t('art', 'Inactive'), 'info'],
                        ],
                        'options' => ['style' => 'width:250px']
                    ],
                    [
                        'class' => 'artsoft\grid\columns\StatusColumn',
                        'attribute' => 'type',
                        'optionsArray' => [
                            [Category::TYPE_IMAGE, 'Image', 'primary'],
                            [Category::TYPE_IFRAME, 'Iframe', 'default'],
                            [Category::TYPE_LINK, 'Link', 'info'],
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


