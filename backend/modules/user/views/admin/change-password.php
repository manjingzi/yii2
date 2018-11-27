<?php

use backend\widgets\ActiveForm;

$this->title = Yii::t('app', 'Change password');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'System user'), 'url' => ['index']];
?>
<div class="box">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= ActiveForm::staticText(Yii::t('app', 'Username'), $model->username) ?>
        <?= $form->password('newPassword', $model) ?>
        <?= $form->password('confirmPassword', $model) ?>
    </div>
    <div class="box-footer">
        <?= ActiveForm::staticSubmitButton() ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>