<?php
/* @var $this PollingController */
/* @var $pollResult PollResult */
/* @var $candidates Candidate */

$this->breadcrumbs=array(
	'All Pollings'=>array('allpolling'),
	'Vote',
);
?>

<h1>Selamat datang di Polling <?php echo $pollResult->poll->poll_title; ?></h1><hr>

<p>Silahkan melakukan voting terhadap kandidat di bawah ini:<p>

<?php echo $this->renderPartial('_formVote', array('pollResult'=>$pollResult, 'candidates'=>$candidates)); ?>