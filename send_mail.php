<?
$name = 'aaa';
$message='aaaa';
$to="t_auchz@hotmail.com";
$subject="Theerawat has sent you a web page";
echo $message="Dear $name, <br><br>$message<br><br>";
mail ($to, $subject, $message ); 
?>