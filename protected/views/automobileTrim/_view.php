<div class="view">
	<?php echo GxHtml::encode(yii::t('app', 'Automobile Maker / Model')); ?>:
		<?php echo GxHtml::encode($data->automobileModel->MakerModel); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel($data->representingColumn())); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->__toString()), array('view', 'id' => $data->id)); ?>
	<br />

</div>