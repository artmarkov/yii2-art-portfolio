<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model artsoft\portfolio\models\Category */

$this->title = Yii::t('art','Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('art/portfolio','Portfolio Items'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('art/portfolio','Portfolio Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="category-create">
    <h3 class="lte-hide-title"><?=  Html::encode($this->title) ?></h3>
    <?=  $this->render('_form', compact('model')) ?>
</div>