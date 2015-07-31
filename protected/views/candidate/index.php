<?php
/* @var $this CandidateController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kandidat',
);

$this->menu=array(
	array('label'=>'Tambah Kandidat', 'url'=>array('create')),
);
?>

<h1>Kandidat</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'candidate-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
                array(
                        'header' => 'No',
                        'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                    ),
		'nama',
                'nim',
                'motivasi',
                'foto',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
