<?php
$this->breadcrumbs = array(
    EntityType::label(2),
);

$this->menu = array(
    array('label' => Yii::t('app', 'Create') . ' ' . EntityType::label(), 'url' => array('create')),
    array('label' => Yii::t('app', 'Manage') . ' ' . EntityType::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(EntityType::label(2)); ?></h1>

<?php
$this->widget('bootstrap.widgets.BootListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'sortableAttributes' => array(
        'name',
        'htmlCode',
    ),
));
