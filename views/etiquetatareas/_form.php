<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Etiquetatareas */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="etiquetatareas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'etiqueta_id')->textInput() ?>

    <?= $form->field($model, 'tarea_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
