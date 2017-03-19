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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO employee (id, name, `position`, salary) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['position'], "int"),
                       GetSQLValueString($_POST['salary'], "int"));

  mysql_select_db($database_conntest18, $conntest18);
  $Result1 = mysql_query($insertSQL, $conntest18) or die(mysql_error());

  $insertGoTo = "main.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<table width="400" border="1" align="center">
  <tr>
    <th scope="col"><h2>เพิ่มข้อมูล</h2>
    </th>
  </tr>
  <tr>
    <td><a href="main.php">หน้าหลัก</a>| <a href="search.php">ค้นหา</a> | <a href="insert.php">เพิ่มข้อมูล</a> | <a href="update.php">แก้ไขข้อมูล</a> | <a href="delete.php">ลบข้อมูล</a></td>
  </tr>
  <tr>
    <td><form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <p>&nbsp;</p>
      <table width="100%" align="center">
        <tr valign="baseline">
          <td align="right" nowrap="nowrap" bgcolor="#00FF66">รหัส:</td>
          <td><input type="text" name="id" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap="nowrap" bgcolor="#00FF66">ชื่อ</td>
          <td><input type="text" name="name" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap="nowrap" bgcolor="#00FF66">ตำแหน่ง:</td>
          <td>
          <select name="position">
          <option value="1">พนักงาน</option>
          <option value="2">ผู้จัดการ</option>
          </select>
          
          
          </td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap="nowrap" bgcolor="#00FF66">เงินเดือน:</td>
          <td><input type="number" name="salary" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="เพิ่มข้อมูล" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1" />
    </form></td>
  </tr>
</table>
<p>&nbsp;</p>
