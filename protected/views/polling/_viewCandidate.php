<?php
/* @var $this PollingController */
/* @var $data Polling */
?>

<div class="view">
    <table border="0"> 
        <tr>
            <td width="40"><b><?php echo CHtml::encode($data->getAttributeLabel('nama')); ?></b></td>
            <td width="20"><b>:</b></td>
            <td><?php echo CHtml::link(CHtml::encode($data->nama), array('candidate/view', 'id'=>$data->id)); ?></td>
        </tr>
        
        <tr>
            <td width="40"><b><?php echo CHtml::encode($data->getAttributeLabel('nim')); ?></b></td>
            <td width="20"><b>:</b></td>
            <td><?php echo CHtml::encode($data->nim); ?></td>
        </tr>
        
        <tr>
            <td width="40"><b><?php echo CHtml::encode($data->getAttributeLabel('foto')); ?></b></td>
            <td width="20"><b>:</b></td>
            <td><?php echo CHtml::image('a/../images/candidates/'.$data->foto,'Foto',array("width"=>100, "height"=>120)); ?></td>
        </tr>
        
        <tr>
            <td width="40"><b><?php echo 'Options' ?></b></td>
            <td width="20"><b>:</b></td>
            <td><?php echo CHtml::link('Perbaharui', array('candidate/update', 'id'=>$data->id)); ?> | 
                <?php echo CHtml::link('Hapus', array('candidate/remove', 'id'=>$data->id, 'poll_id'=>$data->poll_id)); ?>
            </td>
        </tr>
    </table>
</div>