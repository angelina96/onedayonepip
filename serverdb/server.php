<?php
   $hn      = 'localhost';
   $un      = 'root';
   $pwd     = ''; /* MyP@eYGB24 */
   $db      = 'onepip';
   $cs      = 'utf8';

   $conn=mysqli_connect($hn, $un, $pwd, $db) or die(mysqli_error());
?>