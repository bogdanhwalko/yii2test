<?php

use yii\helpers\{Html, Url, ArrayHelper};
use yii\grid\{ActionColumn, GridView};
use yii\widgets\Pjax;
use common\models\{Author, Genre, Book};

/** @var yii\web\View $this */
/** @var backend\models\BookSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'name',
            [
                'attribute' => 'date_release',
                'format' => ['datetime', 'd MMMM, yyyy']
            ],
            [
                'attribute' => 'author.name',
                'format' => 'ntext',
                'content' => function($model) {
                    return $model->author->surname .' '. $model->author->name;
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'author_id',
                    Author::getFormatNamesForSelect(),
                    ['prompt' => 'Любой автор', 'class' => 'form-control form-control-sm']
                ),
            ],
            [
                'attribute' => 'genres.name',
                'format' => 'ntext',
                'content' => function($model) {
                    return implode(', ', ArrayHelper::getColumn($model->genres, 'name'));
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'genres_id',
                    Genre::getFormatNamesForSelect(),
                    [
                        'prompt' => 'Все жанри',
                        'class' => 'form-control form-control-sm',
                    ]
                )
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Book $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
