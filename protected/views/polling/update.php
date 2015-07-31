<?php
/* @var $this PollingController */
/* @var $model Polling */

$this->breadcrumbs=array(
	'Pollings'=>array('index'),
	$model->poll_title=>array('view','id'=>$model->poll_id),
	'Perbaharui',
);
?>

<h1>Perbaharui Polling <?php echo $model->poll_title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>