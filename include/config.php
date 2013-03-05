<? 
//global $title;
$title = "ระบบแจ้งปัญหาการใช้ระบบงาน";
$bf_title = "";
$footer = "&copy; Copyright  Co., Ltd.";
$per_page = 10;
$link = mysql_connect("127.0.0.1","root","1234");
//$port=(strlen($_SERVER['SERVER_PORT'])==4)?":".$_SERVER['SERVER_PORT']:"";
//$host=$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
$host="http://127.0.0.1/helpdesk_news/";
$hd="Location:".$host;


$alert_del="ไม่สามรถลบข้อมูลได้ !!!";
$alert_edit="ไม่สามรถแก้ไขข้อมูลได้ !!!";
$alert_add="ไม่สามรถเพิ่มข้อมูลได้ !!!";
$alert_view="ไม่สามรถดูข้อมูลได้ !!!";
$alert_export="ไม่สามารถพิมพ์ข้อมูลได้";

function db_connect()
{
	$link = mysql_connect("127.0.0.1","root","1234");
	if(!$link){echo "error";}
	mysql_select_db("c1fd_crm_new",$link);
	$charset = "SET NAMES 'utf8'";
	mysql_query($charset);
}
function db_close()
{
	mysql_close();
}

?>
