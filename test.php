<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
function alpha_chk(alpha)
{
	if(alpha.match(/^[a-zA-Z]+$/)){
        alert();
	} else {
        alert("english !!")
	}
}
</script>


</head>

<body>
<table>
<tr>
  <th>ชื่อ - นามสกุล (อังกฤษ)<span class="Txt_red_12">*</span></th>
  <td style="width:300px;"><input name="NameUser" type="text" id="NameUser" size="30" onBlur="alpha_chk(this.value)"> - <input name="lastname" type="text" id="lastname"  size="30" /></td>

</tr>
</table>
</body>
</html>
