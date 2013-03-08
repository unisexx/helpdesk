<?php
  // include adodb libraly
  include "adodb5/adodb.inc.php";
  // adodb connect
  $db = &ADONewConnection('mysql');      
  $db->Connect('localhost','root', '1234', 'helpdesk'); //Connecting to your DBMS.
?>