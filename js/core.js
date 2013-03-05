function ConfirmDelete(pURL)
{
  if(confirm('ต้องการลบรายการนี้ ?'))
  {
     frmUpdate.location=pURL;
  }
}

function ConfirmLogout()
{
if (confirm('ต้องการออกจากระบบ?'))
window.location="logout.php"
}
