<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$this->breadcrumbs=array(
	'Lihat Polling'=>array('allpolling'),
	'Hasil Polling'=>array('polling/result', 'id'=>$id),
        'Daftar yang belum memilih',
);
?>

<h1>Daftar pengguna yang belum memilih:</h1><hr>
<table>
<?php
$i = 0;
    foreach($golput as $data)
    {
        echo '<tr>';
        $i++;
        echo '<td width="20">'.$i.'.</td>';
        echo '<td>'.$data->username.'</td>';
        //echo $i.'. '.$data->username.'<br>';
        echo '</tr>';
    }
?>
</table>
