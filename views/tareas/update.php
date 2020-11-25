<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tareas */

$this->title = 'Update Tareas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tareas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tareas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php 
    $form = ActiveForm::begin(); ?>

        <?=$form->field($model, 'esrealizada')->checkbox()?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
