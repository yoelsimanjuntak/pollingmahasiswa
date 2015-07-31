<?php
/* @var $this CandidateController */
/* @var $model Candidate */

$this->breadcrumbs=array(
	'Kandidat'=>array('index'),
	'Tambah Kandidat',
);
?>

<h1>Tambah Kandidat</h1>
<hr>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>