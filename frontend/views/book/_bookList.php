<?php

/** @var Book $model */

use common\models\Book;
use yii\helpers\{ArrayHelper, Url};

?>

<div class="col">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= $model->name; ?></h5>
            <p class="card-text"><?= mb_strimwidth($model->description, 0, 28, '...'); ?></p>

            <p>
                <b><?= implode(', ', ArrayHelper::getColumn($model->genres, 'name')); ?></b>
            </p>

            <a href="<?= Url::to(['book/view', 'id' => $model->id]); ?>" class="btn btn-primary">Відкрити</a>
        </div>
    </div>
</div>
<br>

