<?php require_once('Connections/conntest18.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("DELETE FROM employee WHERE id=%s",GetSQLValueString($_POST['id'], "text"));

  mysql_select_db($database_conntest18, $conntest18);
  $Result1 = mysql_query($updateSQL, $conntest18) or die(mysql_error());

  $updateGoTo = "main.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_POST['key'])) {
  $colname_Recordset1 = $_POST['key'];
}
mysql_select_db($database_conntest18, $conntest18);
$query_Recordset1 = sprintf("SELECT * FROM employee WHERE id LIKE %s", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$Recordset1 = mysql_query($query_Recordset1, $conntest18) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<style type="text/css">
body table tr td p {
	text-align: center;
}
body table tr td {
	text-align: center;
}
#form1 label {
	text-align: center;
}
form {
	text-align: center;
}
#form1 label {
	text-align: left;
}
#form2 table tr td {
	text-align: left;
}
</style>


<table width="400" border="1" align="center">
    <tr>
      <th scope="col"><h2>ลบข้อมูล</h2></th>
    </tr>
    <tr>
      <td><a href="main.php">หน้าหลัก</a>| <a href="search.php">ค้นหา</a> | <a href="insert.php">เพิ่มข้อมูล</a> | <a href="update.php">แก้ไขข้อมูล</a> | <a href="delete.php">ลบข้อมูล</a></td>
    </tr>
    <tr>
      <td>
       
       <form id="form1" name="form1" method="post" action="">
         <label for="key">รหัส</label>
         <input type="search" name="key" id="key" />
         <input type="submit" name="btn" id="btn" value="ค้นหา" />
       </form>
        <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
       
        
          <table width="100%" align="center">
            <tr valign="baseline">
              <td align="right" nowrap="nowrap" bgcolor="#00FF99">รหัส</td>
              <td><?php echo $row_Recordset1['id']; ?></td>
            </tr>
            <tr valign="baseline">
              <td align="right" nowrap="nowrap" bgcolor="#00FF99">ชื่อ</td>
              <td><input type="text" name="name" value="<?php echo htmlentities($row_Recordset1['name'], ENT_COMPAT, ''); ?>" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td align="right" nowrap="nowrap" bgcolor="#00FF99">ตำแหน่ง</td>
              <td><select name="position">
			  <?php 
			  
			  $p1 = '<option value="1">พนักงาน</option>';
			  $p2 = '<option value="2">ผู้จัดการ</option>';
			  
			  if($row_Recordset1['position'] == 1){
				  
				  echo $p1;
				  
				  }elseif($row_Recordset1['position'] == 2){
					  echo  $p2;
				  }
			  
			  ?>
              </select></td>
            </tr>
            <tr valign="baseline">
              <td align="right" nowrap="nowrap" bgcolor="#00FF99">เงินเดือน</td>
              <td><input type="text" name="salary" value="<?php echo htmlentities($row_Recordset1['salary'], ENT_COMPAT, ''); ?>" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">&nbsp;</td>
              <td><input type="submit" value="ลบ" /></td>
            </tr>
          </table>
          <input type="hidden" name="MM_update" value="form2" />
          <input type="hidden" name="id" value="<?php echo $row_Recordset1['id']; ?>" />
        </form>
      </td>
    </tr>
</table>
<p>&nbsp;</p>
<?php
mysql_free_result($Recordset1);
?>
