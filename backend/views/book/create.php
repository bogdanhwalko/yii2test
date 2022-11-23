<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Book $model */
/** @var \backend\models\UploadForm $fileModel */

$this->title = 'Добавление книги';
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'fileModel' => $fileModel
    ]) ?>

</div>
