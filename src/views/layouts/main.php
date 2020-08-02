<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
    <?php
    NavBar::begin([
        'brandLabel' => 'Бюджет',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Отчет', 'url' => ['/report/index']],
            ['label' => 'Транзакции', 'url' => ['transaction/index']],
            ['label' => 'Курсы валют', 'url' => ['currency-rates/index']],
            ['label' => 'Типы счетов', 'url' => ['type-accounts/index']],
            ['label' => 'Счета', 'url' => ['accounts/index']],
            ['label' => 'Типы расходов/доходов', 'url' => ['type-debit-credit/index']],
            ['label' => 'Валюта', 'url' => ['currency/index']],
            ['label' => 'Пользователи', 'url' => ['client/index']],
            [
                'label' => 'Проекты',
                'items' =>[
                    ['label' => 'Список', 'url' => ['project/index']],       
                    ['label' => 'Группы', 'url' => ['project-group/index']],
                    ['label' => 'Транзакции', 'url' => ['project-transaction/index']],
                    ['label' => 'Тип транзакции', 'url' => ['project-transaction-type/index']],
                ]
            ],
            
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Бюджет <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
