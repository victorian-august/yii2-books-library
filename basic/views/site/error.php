<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Во время выполнения вашего запроса возникла ошибка.
    </p>
    <p>
        Пожалуйста, свяжитесь с нами, если думаете, что это ошибка сервера. Спасибо.
    </p>

</div>
