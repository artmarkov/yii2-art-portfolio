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

    <div class="row">
        <div class="col-md-8">

            <div class="panel panel-default">
                <div class="panel-body">
                    
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

        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="record-info">
                            <div class="form-group clearfix">
                                <label class="control-label" style="float: left; padding-right: 5px;"><?=  $model->attributeLabels()['id'] ?>: </label>
                                <span><?=  $model->id ?></span>
                            </div>
                            <?php if (!$model->isNewRecord): ?>

                            <div class="form-group clearfix">
                                <label class="control-label" style="float: left; padding-right: 5px;">
                             <?= $model->attributeLabels()['created_at'] ?> :
                                </label>
                                <span><?= $model->createdDatetime ?></span>
                            </div>

                            <div class="form-group clearfix">
                                <label class="control-label" style="float: left; padding-right: 5px;">
                            <?= $model->attributeLabels()['updated_at'] ?> :
                                </label>
                                <span><?= $model->updatedDatetime ?></span>
                            </div>
                        
                            <div class="form-group clearfix">
                                    <label class="control-label" style="float: left; padding-right: 5px;">
                                        <?= $model->attributeLabels()['updated_by'] ?> :
                                    </label>
                                    <span><?= $model->updatedBy->username ?></span>
                            </div>
                            <?php endif; ?>
                        
                        <div class="form-group">
                            <?php  if ($model->isNewRecord): ?>
                                <?= Html::submitButton(Yii::t('art', 'Create'), ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('art', 'Cancel'), ['/portfolio/menu/index'], ['class' => 'btn btn-default']) ?>
                            <?php  else: ?>
                                <?= Html::submitButton(Yii::t('art', 'Save'), ['class' => 'btn btn-primary']) ?>
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
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php  ActiveForm::end(); ?>

</div>
