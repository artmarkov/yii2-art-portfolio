<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model artsoft\portfolio\models\Items */

$this->title = Yii::t('art', 'Update "{item}"', ['item' => $model->id]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('art/portfolio','Portfolio Items'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = Yii::t('art','Update');
?>
<div class="items-update">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>