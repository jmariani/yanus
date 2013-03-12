<?php
//    $this->layout = '//layouts/column1';
    $this->breadcrumbs = array($model->label(2) => array('admin'),GxHtml::valueEx($model),);
?><?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => Yii::t('app', 'View') . ' ' . $model->label() . ' ' . GxHtml::encode(GxHtml::valueEx($model)),
        'headerIcon' => 'icon-folder-open',
        'headerButtons' => array(
            array(
                'class' => 'bootstrap.widgets.TbButtonGroup',
                'size' => 'mini',
                'buttons' => array(
                    array(
                        'icon' => 'icon-edit',
                        'url' => array('update', 'id' => $model->id),
                        'htmlOptions' => array(
                            'rel' => 'tooltip',
                            'title' => Yii::t('app', 'Update'),
                        ),
                    ),
                ),
            ),
         )

));
$this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
        'type' => array('striped','bordered'),
	'attributes' => array(
array(
            'name' => 'partyMailType',
            'type' => 'raw',
            'value' => $model->partyMailType !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->partyMailType)), array('partyMailType/view', 'id' => GxActiveRecord::extractPkValue($model->partyMailType, true))) : null,
        ),
            'value',
        'active:boolean',
array(
        'name' => 'customerId',
        'type' => 'raw',
    'value' => $model->party->customerId
//        'value' => $model->party !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->party)), array('party/view', 'id' => GxActiveRecord::extractPkValue($model->party, true))) : null,
        ),
array(
        'name' => 'party',
        'type' => 'raw',
    'value' => $model->party->primaryName . ' ' . '(' . $model->party->customerId . ')'
//        'value' => $model->party !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->party)), array('party/view', 'id' => GxActiveRecord::extractPkValue($model->party, true))) : null,
        ),
        'effDt',
    ),
));
?>
<?php $this->endWidget();?>