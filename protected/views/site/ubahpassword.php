<?php
/* @var $this SiteController */

$this->breadcrumbs=array(
	'Ubah Password',
);
?>

<h1>Ubah Password</h1><hr>

<p>Silahkan masukkan password baru anda:</p>

<div class="form">
<?php if(Yii::app()->user->hasFlash('error')): ?>
 
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('error'); ?>
        </div>
 
<?php endif; ?>
    
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vote-form',
        'method'=>'POST',
	'enableAjaxValidation'=>false,
)); ?>
    <table>
        <tr>
            <td>Password Baru</td>
            <td>:</td>
            <td><input type="password" name="newpassword" size="32"></td>
        </tr>
        <tr>
            <td>Confirm Password Baru</td>
            <td>:</td>
            <td><input type="password" name="retype" size="32"></td>
        </tr>
    </table>
    
    <input type="submit" name="submit" value="Ubah Password"/> 
    
<?php $this->endWidget(); ?>
</div><!-- form -->
