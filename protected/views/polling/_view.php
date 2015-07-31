<?php
/* @var $this PollingController */
/* @var $data Polling */
?>

<div class="view">
    <table border="0" padding="0"> 
        <tr height="30">
            <td width="120"><b><?php echo CHtml::encode($data->getAttributeLabel('poll_title')); ?></b></td>
            <td width="20"><b>:</b></td>
            <td width="240"><u><?php echo CHtml::encode($data->poll_title); ?></u></td>
        </tr>
        
        <tr>
            <td width="120"><b><?php echo CHtml::encode($data->getAttributeLabel('poll_desc')); ?></b></td>
            <td width="20"><b>:</b></td>
            <td width="480"><?php echo CHtml::encode($data->poll_desc); ?></td>
        </tr>
        
        <tr height="30">
            <td width="120"><b><?php echo 'Options' ?></b></td>
            <td width="20"><b>:</b></td>
            <?php
                echo '<td>';
                echo CHtml::link('Lihat Hasil', array('polling/result', 'id'=>$data->poll_id));
                if(!$data->poll_status == 0)
                {
                    echo ' | ';
                    echo '<b><blink>'.CHtml::link('VOTE', array('polling/vote', 'id'=>$data->poll_id)).'</blink></b>';
                    echo '</td>';
                }
            ?>
        </tr>
        
    </table>
</div>