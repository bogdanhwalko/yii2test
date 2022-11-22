<?php

use yii\helpers\{Html, ArrayHelper};
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Book $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            [
                'attribute' => 'author.name',
                'value' => fn($model) => $model->author->getFullName(),
            ],
            'img',
            [
                'attribute' => 'date_release',
                'format' => ['datetime', 'd MMMM, yyyy']
            ],
            [
                'attribute' => 'genres.name',
                'value' => fn($model) => implode(', ', ArrayHelper::getColumn($model->genres, 'name')),
            ],
        ],
    ]) ?>

</div>
