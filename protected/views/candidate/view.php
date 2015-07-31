<?php
/* @var $this CandidateController */
/* @var $model Candidate */

if(Yii::app()->user->checkAccess('manage'))
{
    $this->breadcrumbs=array(
            'Polling'=>array('polling/index'),
            $model->poll->poll_title=>array('polling/view', 'id'=>$model->poll_id),
            'Kandidat',
    );
}
else if(Yii::app()->user->checkAccess('vote'))
{
    $this->breadcrumbs=array(
            'All Pollings'=>array('polling/allpolling'),
            'Vote'=>array('polling/vote', 'id'=>$model->poll_id),
            'Kandidat',
    );
}
?>

<h1>Kandidat <?php echo $model->nama; ?></h1><hr>

<table>
        <tr>
            <td rowspan="4" width="100"><?php echo CHtml::image('a/../images/candidates/'.$model->foto,'Foto',array("width"=>100, "height"=>120)); ?></td>
            <td width="100"><b><?php echo CHtml::encode($model->getAttributeLabel('poll.poll_title')); ?></b></td>
            <td width="20"><b>:</b></td>
            <td><?php echo CHtml::encode($model->poll->poll_title); ?></td>
        </tr>
        
        <tr>
            <td width="100"><b><?php echo CHtml::encode($model->getAttributeLabel('nama')); ?></b></td>
            <td width="20"><b>:</b></td>
            <td><?php echo CHtml::encode($model->nama); ?></td>
        </tr>
        
        <tr>
            <td width="100"><b><?php echo CHtml::encode($model->getAttributeLabel('nim')); ?></b></td>
            <td width="20"><b>:</b></td>
            <td><?php echo CHtml::encode($model->nim); ?></td>
        </tr>
        
        <tr>
            <td width="100"><b><?php echo CHtml::encode($model->getAttributeLabel('motivasi')); ?></b></td>
            <td width="20"><b>:</b></td>
            <td><?php echo CHtml::encode($model->motivasi); ?></td>
        </tr>
</table>
