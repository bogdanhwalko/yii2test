<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\Book $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

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
            [
                'attribute' => 'img',
                'format' => 'raw',
                'value' => function($model) {
                    $url = Yii::$app->urlManager->getHostInfo() . $model->img;
                    if (!empty($model->img)) {
                        return Html::img($url, [
                            'alt' => $model->name,
                            'width' => '200px'
                        ]);
                    }

                    return 'Изображение не загружено';
                },
            ],
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
