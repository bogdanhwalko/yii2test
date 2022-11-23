<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Author;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use backend\models\UploadForm;

/** @var yii\web\View $this */
/** @var common\models\Book $model */
/** @var UploadForm $fileModel */
/** @var yii\widgets\ActiveForm $form */

$img = $model->img ?? '/resource/img/no-image.jpg';

?>


<div class="book-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'author_id')
                    ->dropDownList(Author::getFormatNamesForSelect(), ['prompt' => '']
                ); ?>

                <?= $form->field($model, 'date_release')->widget(DatePicker::class, [
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]) ?>

            </div>
            <div class="col-md-6">
                <?= $form->field($fileModel, 'imageFile')->widget(FileInput::class, [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => [
                        'initialPreview' => ! empty($model->img) ? [Yii::$app->urlManager->getHostInfo() . $model->img] : [],
                        'initialPreviewAsData' => true,
                        'showUpload' => false,
                        'showRemove' => false,
                        'removeLabel' => '',
                        'allowedFileExtensions' => ['jpg', 'png', 'jpeg'],
                    ],
                ]); ?>
            </div>

            <div class="col-md-12">
                <hr>
                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
