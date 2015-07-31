<?php
/* @var $this PollingController */
/* @var $model Polling */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'poll_id'); ?>
		<?php echo $form->textField($model,'poll_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'poll_title'); ?>
		<?php echo $form->textField($model,'poll_title',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'poll_desc'); ?>
		<?php echo $form->textArea($model,'poll_desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'poll_status'); ?>
		<?php echo $form->textField($model,'poll_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'winner'); ?>
		<?php echo $form->textField($model,'winner'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->