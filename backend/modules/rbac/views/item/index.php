<?php

use common\extensions\Btn;
use backend\widgets\GridView;

$labels = $this->context->labels();
$title = Yii::t('app/rbac', $labels['Items']);
$label = Yii::t('app', 'List');
$this->title = $title . ' - ' . $label;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $label;
$rules = array_keys(Yii::$app->authManager->getRules());
$filter = array_combine($rules, $rules);
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-right"><?= Btn::createHrefButton() ?></div>
                <h3 class="box-title"><?= $label ?></h3>
            </div>
            <div class="box-body">
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'name',
                            'label' => Yii::t('app', 'Name'),
                        ],
                        [
                            'attribute' => 'ruleName',
                            'label' => Yii::t('app/rbac', 'Rule Name'),
                            'filter' => $filter
                        ],
                        [
                            'attribute' => 'description',
                            'label' => Yii::t('app', 'Description'),
                        ],
                        [
                            'class' => 'backend\widgets\ActionColumn',
                            'header' => Yii::t('app', 'Operation'),
                            'template' => '{delete} {update} {view}'
                        ],
                    ],
                ])
                ?>
            </div>
        </div>
    </div>
</div>