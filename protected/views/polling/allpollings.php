<?php
/* @var $this PollingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lihat Polling',
);
?>

<h1>Daftar Polling</h1><hr>

<?php if(Yii::app()->user->hasFlash('error')): ?>
 
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('error'); ?>
        </div>
 
<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('contact')): ?>
 
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('contact'); ?>
        </div>
 
<?php endif; ?>


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>