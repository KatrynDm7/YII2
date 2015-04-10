<?php

use yii\helpers\Html;
use yii\web\UnauthorizedHttpException;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
?>
<?php if (!Yii::$app->user->isGuest): ?>
    <?php $this->title = 'Update Products: ' . ' ' . $model->name; ?>
    <div class="products-update">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
<?php else: ?>
    <?php throw new UnauthorizedHttpException('You must log in'); ?>
<?php endif; ?>
