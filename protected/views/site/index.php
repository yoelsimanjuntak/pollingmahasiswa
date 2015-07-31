<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php if(Yii::app()->user->hasFlash('contact')): ?>
 
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('contact'); ?>
        </div>
 
<?php endif; ?>


<h3>Selamat datang di <u><?php echo CHtml::encode(Yii::app()->name); ?></u></h3>

<p>Aplikasi ini dibuat untuk kebutuhan pemungutan suara organisasi Keluarga Mahasiswa IT Del. Jika memiliki saran dan pertanyaan, dapat menghubungi:
<table width="240">
    <tr>
        <td width="180"><li><b> Yoel Rolas Simanjuntak </b></td>
        <td><b> : if312087@students.del.ac.id </b></td>
    </tr>
    <tr>
        <td width="180"><li><b> Benni Luasti Sinurat </b></td>
        <td><b> : if312012@students.del.ac.id </b></td>
    </tr>
</table>
</p>

<hr>

<table align="center">
    <tr>
        <td width="160"><center><?php echo CHtml::image('a/../images/logo/logo_mpm.png', 'Logo MPM', array("width"=>150, "height"=>150)); ?></center></td>
        <td width="160"><center><?php echo CHtml::image('a/../images/logo/logo_del.png', 'Logo Del', array("width"=>150, "height"=>150)); ?></center></td>
        <td width="160"><center><?php echo CHtml::image('a/../images/logo/logo_bphkm.png', 'Logo BPHKM', array("width"=>150, "height"=>150)); ?></center></td>
    </tr>
</table>