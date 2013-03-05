<div id="login">
<form  name="frmlogin" id="frmlogin" enctype="multipart/form-data" action="index.php?act=query" method="post">
<table width="383" height="206" background="images/login.png" border="0" align="center" >
      <tr>
        <td class="text"><p>&nbsp;</p>
          				 <p>&nbsp;</p>
          				 <p>ชื่อผู้ใช้ :  &nbsp;&nbsp;&nbsp;
            				<input name="Email" type="text" id="Email" size="30">
          				 </p>
          				 <p>รหัสผ่าน : &nbsp;&nbsp;
             				<input name="Password" type="password" id="Password" size="30">
          				 </p>
          <table width="383" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="240"></td>
              <td width="143"><input type="submit" name="submit" class="btn_login" value=""></td>
            </tr>
          </table>
        </td>
      </tr>
</table>
<?php unset($_SESSION['id']); ?>
</form>
</div>

