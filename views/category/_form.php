<?php

use artsoft\widgets\ActiveForm;
use artsoft\portfolio\models\Category;
use artsoft\helpers\Html;

/* @var $this yii\web\View */
/* @var $model artsoft\portfolio\models\Category */
/* @var $form artsoft\widgets\ActiveForm */
?>

<div class="category-form">

    <?php
    $form = ActiveForm::begin([
        'id' => 'category-form',
        'validateOnBlur' => false,
    ])
    ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model->loadDefaultValues(), 'status')->dropDownList(Category::getStatusList()) ?>

                    <?= $form->field($model->loadDefaultValues(), 'type')->dropDownList(Category::getTypeList()) ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="form-group">
                <?= Html::a(Yii::t('art', 'Go to list'), ['/portfolio/category/index'], ['class' => 'btn btn-default']) ?>
                <?= Html::submitButton(Yii::t('art', 'Save'), ['class' => 'btn btn-primary']) ?>
                <?php if (!$model->isNewRecord): ?>
                    <?= Html::a(Yii::t('art', 'Delete'),
                        ['/portfolio/category/delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]) ?>
                <?php endif; ?>
            </div>
            <?= \artsoft\widgets\InfoModel::widget(['model' => $model]); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
