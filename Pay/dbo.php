<?php
$dbhost = 'localhost';
$dbase = 'mylo_db';
$dbuser = 'mylo_user';
$dbpass = 'pPyEM1ANahajhviF';
 
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbase);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}     

?>