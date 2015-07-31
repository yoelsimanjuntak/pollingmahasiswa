<?php
/* @var $this PollingController */
/* @var $results PollResult */
/* @var $candidates Candidate */
/* @var $poll_id Poll_id */
/* @var $poll_title Poll_title */

$this->breadcrumbs=array(
	'Lihat Polling'=>array('allpolling'),
	'Hasil Polling',
);

$candidate_count = array();
$candidate_names = array();
$jumlahsuara = 0;

// Menghitung suara per kandidat
foreach($candidates as $candidate=>$ii)
{
    $votecount = 0;
    foreach($results as $result)
    {
        if($result->candidate_id == $ii->id)
        {
            $votecount++;
        }
    }
    $candidate_count[$candidate] = $votecount;
    $candidate_names[$candidate] = '<a href="index">'.$ii->nama.'</a>';
}

// Menghitung total suara
foreach($results as $result)
{
    $jumlahsuara++;
}

$this->Widget('ext.yii-highcharts.highcharts.HighchartsWidget', array(
   'options'=>array(
     'chart'=> array('defaultSeriesType'=>'column',),
      'title' => array('text' => $poll_title),
      'legend'=>array('enabled'=>false),
      'xAxis'=>array('categories'=>$candidate_names,),
      'yAxis'=> array(
            'min'=> 0,
            'title'=> array(
            'text'=>'Jumlah'
            ),
        ),
      'series' => array(
         array('data' => $candidate_count)
      ),
      'tooltip' => array('formatter' => 'js:function() {return "<b>"+ this.x +"</b><br/>"+"Jumlah : "+ this.y; }'),
      'plotOptions'=>array('pie'=>(array(
                    'allowPointSelect'=>true,
                    'showInLegend'=>true,
                    'cursor'=>'pointer',
                )
            )                       
        ),
      'credits'=>array('enabled'=>false),
   )
));

?>


<?php
// Hitung yang tidak ikut voting
$nonvote = 0;
    
$voters = Voter::model()->findAll(array('condition'=>'poll_id='.$poll_id));
foreach($voters as $voter)
    {
        if($voter->status == 0)
        {
            $nonvote++;
            //echo $voter->username.'<br>';
        }
    }
    //echo 'Jumlah yang tidak mengikuti voting = '.$nonvote.' orang';
?>

<fieldset>
    <table>
        <tr>
            <td><b>Total Suara</b></td>
            <td><b>:</b></td>
            <td><?php echo $jumlahsuara; ?> orang</td>
        </tr>
        <tr>
            <td><b>Jumlah yang tidak mengikuti polling</b></td>
            <td><b>:</b></td>
            <td><?php echo CHtml::link(CHtml::encode($nonvote.' orang'), array('polling/viewGolput', 'id'=>$poll_id)); ?></td>
        </tr>
    </table>
<fieldset>
