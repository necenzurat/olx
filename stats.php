<?php
include "vendor/autoload.php";
$oras = @$_GET["oras"];

$locatii = R::getAll('SELECT locatia, COUNT( * ) AS nr
FROM cars
GROUP BY locatia
ORDER BY  `nr` DESC ');
?>
<form>
<select name='oras' onchange='this.form.submit()'>
<option value='toate'>Alege judetul</option>
<?php
foreach ($locatii as $locatie){
	echo '<option value="'.$locatie["locatia"].'">'.$locatie["locatia"].' - '.$locatie["nr"].' </option>';
}
?>
<select>
<?
$stats = R::getAll("SELECT locatia, model, COUNT( * ) AS modelnr
FROM cars
WHERE locatia = '$oras'
GROUP BY model
ORDER BY COUNT( * ) DESC " );
echo "<table border=1>";
foreach ($stats as $stat){ ?>
<tr>
<td><?=substr($stat["model"], 15);?></td>
<td><?=$stat["modelnr"];?></td>
</tr>
<?php } ?>
</table>