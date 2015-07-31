<?php
/* @var $this PollingController */
/* @var $model Polling */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'polling-form',
	'enableAjaxValidation'=>false,
)); ?>
        <hr>
	<p class="note">Field dengan tanda <span class="required">*</span> wajib diisi.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'poll_title'); ?>
		<?php echo $form->textField($model,'poll_title',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'poll_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'poll_desc'); ?>
		<?php echo $form->textArea($model,'poll_desc',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'poll_desc'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Buat Polling' : 'Perbaharui'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->