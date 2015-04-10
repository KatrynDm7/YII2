<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="jumbotron">
        <?php if (!Yii::$app->user->isGuest): ?>
            <p class="lead">Hello, <?= Yii::$app->user->identity->email; ?></p>
            <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to(['/products/index']) ?>">My products</a></p>
            <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to(['/products/view']); ?>">All products</a></p>
        <?php else: ?>
            <p class="lead">We don't know you</p>
            <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to(['/site/signup']); ?>">Registration</a></p>
            <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to(['/site/login']) ?>">Authorization</a></p>
        <?php endif; ?>
    </div>
    <div class="body-content"></div>
</div>
