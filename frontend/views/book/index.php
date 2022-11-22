<?php

use yii\helpers\{Html, Url};
use yii\widgets\{Pjax, ListView};

/** @var yii\web\View $this */
/** @var frontend\models\BookSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/script.js', [
    'depends' => [\yii\web\JqueryAsset::class]
]);
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(['id' => 'book_list']); ?>

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_bookList',

            'layout' => "{summary}\n{items}\n <div class=''>{pager}",

            'options' => [
                'tag' => 'div',
                'class' => 'row',
            ],

            'itemOptions' => [
                'tag' => 'div',
                'class' => 'col-md-3',
            ],
        ]); ?>

    <div class="row">
        <div class="col-md-3">
            <b>Елементов на странице:</b>
            <?= Html::dropDownList('count_books', Yii::$app->request->get('per-page'), [
                    '16' => '16', '32' => '32', '48' => '48'
            ], [
                'class' => 'form-control',
                'id' => 'count_books_select'
            ]); ?>
        </div>
        <div class="col-md-3">

        </div>
    </div>



    <?php Pjax::end(); ?>

</div>
