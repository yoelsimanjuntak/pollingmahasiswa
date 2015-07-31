<?php
/* @var $this CandidateController */
/* @var $model Candidate */

$this->breadcrumbs=array(
	'Polling'=>array('index'),
	$model->poll->poll_title=>array('polling/view','id'=>$model->poll->poll_id),
	'Perbaharui Kandidat',
);
?>

<h1>Perbaharui Kandidat</h1><hr>

<p>Silahkan perbaharui data sesuai field di bawah ini.</p>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>