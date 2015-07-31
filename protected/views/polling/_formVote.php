<?php
/* @var $this PollingController */
/* @var $pollResult PollResult */
/* @var $candidates Candidate */
/* @var $form CActiveForm */
?>

<div class="">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vote-form',
        'method'=>'POST',
	'enableAjaxValidation'=>false,
)); ?>
    
    <?php
        foreach($candidates as $candidate)
        {
    ?>
        <table border="1">
            <tr>
                <td rowspan="3" width="20"><input type="radio" name="kandidat" value=<?php echo $candidate->id; ?>></td>
                <td rowspan="3" width="120"><?php echo CHtml::image('a/../images/candidates/'.$candidate->foto,'Foto',array("width"=>100, "height"=>120)); ?></td>
                <td width="60"><b>Nama</b></td>
                <td width="20"><b>:</b></td>
                <td><u><?php echo $candidate->nama; ?></u></td>
            </tr>
            <tr>
                <td width="60"><b>NIM</b></td>
                <td width="20"><b>:</b></td>
                <td><?php echo $candidate->nim; ?></td>
            </tr>
            <tr>
                <td width="60"><b>Motivasi</b></td>
                <td width="20"><b>:</b></td>
                <td><?php echo $candidate->motivasi; ?></td>
            </tr>
        </table>
        
    <?php
        }
    ?>
    <br><hr>
    <input type="submit" name="submit" value="Vote"/> 

<?php $this->endWidget(); ?>

</div><!-- form -->