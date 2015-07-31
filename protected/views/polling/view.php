<?php
/* @var $this PollingController */
/* @var $model Polling */

$this->breadcrumbs=array(
	'Polling'=>array('index'),
	$model->poll_title,
);

$this->menu=array(
	array('label'=>'Tambah Kandidat', 'url'=>array('candidate/create', 'id'=>$model->poll_id)),
);

$dataProvider = new CActiveDataProvider('Candidate', array('criteria'=>array('condition'=>'poll_id='.$model->poll_id)));
?>

<h1>Polling <?php echo $model->poll_title; ?></h1><hr>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'poll_id',
		'poll_title',
		'poll_desc',
		//'poll_status',
                array(
                    'label'=>'Status',
                    'value'=>$model->poll_status==1?'Aktif':'Nonaktif',
                ),
		//'winner',
                array(
                    'label'=>'Pemenang',
                    'value'=>$model->winner==null?'-':$model->winner,
                ),
	),
));
?>
<br>
<h1>Kandidat untuk polling ini:</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewCandidate',
)); ?>
