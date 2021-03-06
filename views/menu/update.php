<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model artsoft\portfolio\models\Menu */

$this->title = Yii::t('art', 'Update "{item}"', ['item' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('art/portfolio','Portfolio Items'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('art/portfolio','Portfolio Menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('art','Update');
?>
<div class="menu-update">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>