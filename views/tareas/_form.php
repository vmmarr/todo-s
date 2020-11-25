<?php

use kartik\date\DatePicker;
use kartik\datecontrol\DateControl;
use kartik\datetime\DateTimePicker;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tareas */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="tareas-form">

    <?php 
    $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usuario_id')->textInput()->hiddenInput(['value' => Yii::$app->user->id])->label(false); ?>

    <?= $form->field($model, 'vencimiento')->widget(DatePicker::classname(), [
        'options' => [
            'value' => date('Y-m-d'),
            'startDate' => date('Y-m-d'),
        ],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
