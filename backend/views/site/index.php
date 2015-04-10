<?php
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="jumbotron">
        <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to(['/products/index']) ?>">My products</a></p>
        <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to(['/products/view']); ?>">All products</a></p>

    </div>
    <div class="body-content"> </div>
</div>