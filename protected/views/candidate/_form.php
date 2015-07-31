<?php
/* @var $this CandidateController */
/* @var $model Candidate */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'candidate-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">NB : Fields dengan tanda <span class="required">*</span> wajib diisi.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nama'); ?>
		<?php echo $form->textField($model,'nama',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'nama'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nim'); ?>
		<?php echo $form->textField($model,'nim',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'nim'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'motivasi'); ?>
		<?php echo $form->textArea($model,'motivasi',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'motivasi'); ?>
	</div>
        
        <?php //echo $form->FileFieldRow($model, 'pasfoto', array('size'=>60, 'class'=>'span2', 'maxlength'=>60)); ?>

	<div class="row">
            <?php echo $form->labelEx($model,'foto'); ?>
            <?php echo $form->fileField($model,'foto'); ?>
            <?php echo $form->error($model,'foto'); ?>
        </div>

        <div class="row">
        <br><hr>
        </div>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Tambah Kandidat' : 'Perbaharui'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->