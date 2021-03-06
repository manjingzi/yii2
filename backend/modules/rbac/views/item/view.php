<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use common\extensions\Btn;
use yii\widgets\DetailView;

$labels = $this->context->labels();
$title = Yii::t('app/rbac', $labels['Items']);
$label = Yii::t('app', 'View');
$this->title = $title . ' - ' . $label;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $label;
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
$opts = Json::htmlEncode(['items' => $model->getItems()]);
$this->registerJs('var _opts = ' . $opts . ';');
$this->registerJs($this->render('_script.js'));
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="pull-right">
            <?= Btn::deleteHrefButton($model->name) ?>
            <?= Btn::updateHrefButton($model->name) ?>
            <?= Btn::createHrefButton() ?>
        </div>
        <h3 class="box-title"><?= $label ?></h3>
    </div>
    <div class="box-body">
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'description:ntext',
                'ruleName',
                'data:ntext',
            ]
        ]);
        ?>
    </div>
</div>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Yii::t('app', 'Operation') ?></h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-5">
                <input class="form-control search" data-target="available" placeholder="<?= Yii::t('app/rbac', 'Search for available') ?>">
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <input class="form-control search" data-target="assigned" placeholder="<?= Yii::t('app/rbac', 'Search for assigned') ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <select size="15" class="form-control list" data-target="available" multiple="multiple"></select>
            </div>
            <div class="col-md-2">
                <div class="text-center">
                    <p>
                        <?=
                        Html::button('&gt;&gt;' . $animateIcon, [
                            'class' => 'btn btn-success btn-assign',
                            'data-href' => Url::to(['assign', 'id' => $model->name]),
                            'data-target' => 'available',
                            'title' => Yii::t('app/rbac', 'Assign'),
                        ]);
                        ?>
                    </p>
                    <p>
                        <?=
                        Html::button('&lt;&lt;' . $animateIcon, [
                            'class' => 'btn btn-danger btn-assign',
                            'data-href' => Url::to(['remove', 'id' => $model->name]),
                            'data-target' => 'assigned',
                            'title' => Yii::t('app', 'Remove'),
                        ]);
                        ?>
                    </p>
                </div>
            </div>
            <div class="col-md-5">
                <select size="15" class="form-control list" data-target="assigned" multiple="multiple"></select>
            </div>
        </div>
    </div>
</div>