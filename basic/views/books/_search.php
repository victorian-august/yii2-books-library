<?php

use app\models\Authors;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\BookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline'
        ]
    ]); ?>

    <?= $form->field($model, 'author_id')
        ->dropDownList(
            ArrayHelper::map(Authors::find()->all(), 'id', function ($element) {
                return $element['firstname'] . " " . $element['lastname'];
            }),
            ['prompt' => 'автор'])
        ->label(false);
    ?>

    <?= $form->field($model, 'name')
        ->textInput([
            'placeholder' => 'название книги'
        ])->label(false); ?>

    <?= '<br/>' . $form->field($model, 'date_from')
        ->label('Дата выхода книги')
        ->textInput([
            'placeholder' => '31/12/2014'
        ]);
    DatePicker::widget([
        'attribute' => 'date_from',
        'dateFormat' => 'MM/dd/yyyy',
        'language' => 'ru',
        'model' => $model,
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true
        ]
    ]);
    ?>

    <?= $form->field($model, 'date_to')
        ->label('до')
        ->textInput([
            'placeholder' => '28/02/2015'
        ]);
    DatePicker::widget([
        'attribute' => 'date_to',
        'dateFormat' => 'MM/dd/yyyy',
        'language' => 'ru',
        'model' => $model,
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true
        ],
    ]);
    ?>

    <?= Html::submitButton('искать', ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end(); ?>

</div>
