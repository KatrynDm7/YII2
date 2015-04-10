<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php if(Yii::$app->requestedAction->id != 'create' && Yii::$app->requestedAction->id != 'update'): ?>
        <?php
            NavBar::begin([
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);

            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            }
            else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->email . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>
        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="cur_user_id"><?=Yii::$app->user->identity->getId(); ?></div>
        <?php endif; ?>
        <?php endif; ?>
        <div class="container">
             <?= $content ?>
        </div>
    </div>
    <?php if(Yii::$app->requestedAction->id != 'create' && Yii::$app->requestedAction->id != 'update'): ?>
        <footer class="footer">
            <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            </div>
        </footer>
    <?php endif; ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
