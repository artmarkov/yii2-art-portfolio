<?php

use artsoft\widgets\ActiveForm;
use artsoft\portfolio\models\Menu;
use artsoft\helpers\Html;

/* @var $this yii\web\View */
/* @var $model artsoft\portfolio\models\Menu */
/* @var $form artsoft\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php
    $form = ActiveForm::begin([
        'id' => 'menu-form',
        'validateOnBlur' => false,
    ])
    ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'categories_list')->widget(nex\chosen\Chosen::className(), [
                        'items' => artsoft\portfolio\models\Category::getCategories(),
                        'multiple' => true,
                        'placeholder' => Yii::t('art/portfolio', 'Select Categories...'),
                    ])
                    ?>

                    <?= $form->field($model->loadDefaultValues(), 'status')->dropDownList(Menu::getStatusList()) ?>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="form-group">
                    <?= Html::a(Yii::t('art', 'Go to list'), ['/portfolio/menu/index'], ['class' => 'btn btn-default']) ?>
                    <?= Html::submitButton(Yii::t('art', 'Save'), ['class' => 'btn btn-primary']) ?>
                <?php if (!$model->isNewRecord): ?>
                    <?= Html::a(Yii::t('art', 'Delete'),
                        ['/portfolio/menu/delete', 'id' => $model->id], [
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
