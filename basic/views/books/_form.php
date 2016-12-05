<?php

use app\models\Authors;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')
        ->textInput([
            'maxlength' => true,
            'placeholder' => 'Программист-прагматик. Путь от подмастерья к мастеру'
        ])
        ->label('Название')

    ?>

    <?= $form->field($model, 'preview')
        ->textInput([
            'maxlength' => true,
            'placeholder' => 'http://static1.ozone.ru/multimedia/books_covers/c300/1000543072.jpg'
        ])
        ->label($model->isNewRecord ? $model->getAttributeLabel('preview') : "<a class='view-preview' title='Показать/скрыть обложку'>" . $model->getAttributeLabel('preview') . "</a>")
    ?>

    <?php if (!$model->isNewRecord)
        echo "<img class='book-preview' src='$model->preview' />";
    ?>

    <?= $form->field($model, 'author_id')
        ->textInput()
        ->label('Автор')
        ->dropDownList(
            ArrayHelper::map(Authors::find()->all(), 'id', function ($element) {
                return $element['firstname'] . " " . $element['lastname'];
            }),
            ['prompt' => 'Выберите атвора...'])

    ?>

    <?= $form->field($model, 'date')
        ->textInput([
            'placeholder' => '01/10/1999'
        ])
        ->label('Дата выхода книги');
    DatePicker::widget([
        'attribute' => 'date',
        'dateFormat' => 'MM/dd/yyyy',
        'language' => 'ru',
        'model' => $model,
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
