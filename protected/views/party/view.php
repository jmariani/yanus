<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>


<?php $this->widget('bootstrap.widgets.BootDetailView', array(
	'data' => $model,
        'type' => array('striped','bordered'),
	'attributes' => array(
        'name',
	),
)); ?>
<?php
$partyName = new PartyName();
$partyName->Party_id = $model->id;
$this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'party-name-grid',
	'dataProvider'=>  $partyName->search(),
        'type'=>'striped bordered condensed',
//	'filter'=>$model,
	'columns'=>array(
		'fullName',
		'effDt',
                array(
                    'class'=>'bootstrap.widgets.BootButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                ),
	),
)); ?>
<?php
$partyIdentifier = new PartyIdentifier();
$partyIdentifier->Party_id = $model->id;
$this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'party-identifier-grid',
	'dataProvider'=>  $partyIdentifier->search(),
        'type'=>'striped bordered condensed',
//	'filter'=>$model,
	'columns'=>array(
		'name',
		'value',
		'effDt',
                array(
                    'class'=>'bootstrap.widgets.BootButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                ),
	),
)); ?>
<?php
$partyPhoneLocator = new PartyPhoneLocator();
$partyPhoneLocator->Party_id = $model->id;
$this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'party-phone-grid',
	'dataProvider'=>  $partyPhoneLocator->search(),
        'type'=>'striped bordered condensed',
//	'filter'=>$model,
	'columns'=>array(
		'value',
		'effDt',
		array(
				'name'=>'Party_id',
				'value'=>'GxHtml::valueEx($data->party)',
				'filter'=>GxHtml::listDataEx(Party::model()->findAllAttributes(null, true)),
				),
                array(
                    'class'=>'bootstrap.widgets.BootButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                ),
	),
)); ?>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>yii::t('app', 'Identifiers'), 'url'=>'#',
//            'active'=>true
            ),
        array('label'=>yii::t('app', 'Names'), 'url'=>'#'),
        array('label'=>yii::t('app', 'Addresses'), 'url'=>'#'),
        array('label'=>yii::t('app', 'Phone'), 'url'=>'#'),
        array('label'=>yii::t('app', 'Payment options'), 'url'=>'#'),
        array('label'=>yii::t('app', 'Required addendas'), 'url'=>'#'),
        array('label'=>yii::t('app', 'Issued Cfds'), 'url'=>'#'),
        array('label'=>yii::t('app', 'SAT Certificates'), 'url'=>'#'),
    ),
)); ?>
<fieldset>
    <legend><?php echo yii::t('app', 'Identifiers'); ?></legend>
</fieldset>

