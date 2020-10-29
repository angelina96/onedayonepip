<?php

include "../serverdb/server.php";

//mysql_connect("localhost", "root", "") or die(mysql_error());
 
//mysql_select_db("bitpro") or die(mysql_error());
 
$x=$_GET['q'];
$select=mysqli_query($conn,"SELECT * FROM masterctrl ORDER BY created_date DESC LIMIT 1");
$fetch=mysqli_fetch_array($select);
$data_x=$fetch['planroi'];

//planroi * amount / 100
$dapat=(($data_x*$x)/100);
$dapat=number_format((float)$dapat, 2, '.', '');
//echo "<center><h2 class='glow4'><font color='#21AE16'>$ ".$dapat."USD</font></h2></center>";
echo "<center><h2 class='glow4'>$ ".$dapat."USD</h2></center>";
?>