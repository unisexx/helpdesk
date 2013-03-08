<?php
  // include adodb libraly
  include "adodb5/adodb.inc.php";
  // adodb connect
  $db = &ADONewConnection('mysql');      
  $db->Connect('localhost','crmsql', 'EpHy2LJvrSHCZ9n7', 'crm_it'); //Connecting to your DBMS.
?>