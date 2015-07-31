<?php
/* @var $this PollingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Polling',
);

$this->menu=array(
	array('label'=>'Tambah Polling', 'url'=>array('create')),
);
?>

<h1>Polling</h1><hr>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'polling-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
                array(
                        'header' => 'No',
                        'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                    ),
		//'poll_id',
		'poll_title',
		//'poll_desc',
		//'poll_status',
                array(
                    'header'=>'Status',
                    'type'=>'raw',
                    'value'=> '$data->poll_status==1?CHtml::encode("Aktif") : CHtml::encode("Nonaktif")',
                ),
		//'winner',
                array(
                        'header'=>'Pemenang',
                        'type'=>'raw',
                        'value'=> '$data->winner==null?CHtml::encode("-") : $data->winner',
                    ),
		array(
                        'header'=>'Options',
			'class'=>'CButtonColumn',
                        'template'=>'{view} {update} {delete} {ubahstatus}',
                        'htmlOptions'=>array('width'=>80),
                        'buttons'=>array(
                            'ubahstatus'=>array(
                                'label'=>'Ubah Status',
                                'url'=>'Yii::app()->createUrl("/polling/ubahStatus", array("id"=>$data->poll_id))',
                                'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/ubah.ico',
                            ),
                        ),
		),
	),
)); ?>
