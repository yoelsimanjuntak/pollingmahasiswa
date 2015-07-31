<?php
/* @var $this PollingController */
/* @var $model Polling */

$this->breadcrumbs=array(
	'Polling'=>array('index'),
	'Buat Polling',
);
?>

<h1>Buat Polling</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>