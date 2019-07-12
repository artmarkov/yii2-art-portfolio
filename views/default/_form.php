<?php

use artsoft\widgets\ActiveForm;
use artsoft\portfolio\models\Items;
use artsoft\helpers\Html;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model artsoft\portfolio\models\Items */
/* @var $form artsoft\widgets\ActiveForm */

?>

<div class="items-form">

    <?php
    $form = ActiveForm::begin([
                'id' => 'items-form',
                'validateOnBlur' => false,
            ])
    ?>
    <?php
    $JSInsertLink = <<<EOF
        function(e, data) {
                      
            // console.log(data);

        $.ajax({
               url: '/admin/portfolio/default/paste-link',
               type: 'POST',
               data: {id : data.id},
               success: function (link) {
                  // console.log(link);

              document.getElementById("items-link_href").value = link; 
               },
               error: function () {
                   alert('Error!!!');
               }
           });

            $(".items-thumbnail").show();

       }
EOF;
    ?>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?= $form->field($model->loadDefaultValues(), 'status')->dropDownList(Items::getStatusList()) ?>

                        <?= $form->field($model, 'category_id')
                                ->dropDownList(artsoft\portfolio\models\Category::getCategories(), [
                                    'prompt' => Yii::t('art/portfolio', 'Select Categories...'),
                                    'id' => 'categories_id'
                                ])->label(Yii::t('art/portfolio', 'Portfolio Category'));
                        ?>

                        <?= $form->field($model, 'link_href')->textInput(['maxlength' => true]) ?>


                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="record-info">
                            <div class="form-group clearfix">
                                <label class="control-label" style="float: left; padding-right: 5px;"><?= $model->attributeLabels()['id'] ?>: </label>
                                <span><?= $model->id ?></span>
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
                            <?php if ($model->isNewRecord): ?>
                                <?= Html::submitButton(Yii::t('art', 'Create'), ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('art', 'Cancel'), ['/portfolio/default/index'], ['class' => 'btn btn-default']) ?>
                            <?php else: ?>
                                <?= Html::submitButton(Yii::t('art', 'Save'), ['class' => 'btn btn-primary']) ?>
                                <?=
                                Html::a(Yii::t('art', 'Delete'), ['/portfolio/default/delete', 'id' => $model->id], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                    ],
                                ])
                                ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    
                        <?= $form->field($model, 'thumbnail')->widget(\artsoft\media\widgets\FileInput::className(), [
                            'name' => 'image',
                            'buttonTag' => 'button',
                            'buttonName' => Yii::t('art', 'Browse'),
                            'buttonOptions' => ['class' => 'btn btn-primary btn-file-input'],
                            'options' => ['class' => 'form-control'],
                            'template' => '<div class="items-thumbnail thumbnail"></div><div class="input-group"><span class="input-group-btn">{button}</span>{input}</div>',
                            'thumb' => $this->context->module->thumbnailSize,
                            'imageContainer' => '.items-thumbnail',
                            'pasteData' => \artsoft\media\widgets\FileInput::DATA_URL,
                            'callbackBeforeInsert' => new JsExpression($JSInsertLink), 
                        ])
                        ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

$js = <<<JS
    var thumbnail = $("#items-thumbnail").val();
    if(thumbnail.length == 0){
        $('.items-thumbnail').hide();
    } else {
        $('.items-thumbnail').html('<img src="' + thumbnail + '" />');
    }
JS;

$this->registerJs($js, yii\web\View::POS_READY);
?>