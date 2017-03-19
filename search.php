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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "-1";
if (isset($_POST['key'])) {
  $colname_Recordset1 = $_POST['key'];
}
mysql_select_db($database_conntest18, $conntest18);
$query_Recordset1 = sprintf("SELECT * FROM employee WHERE (id LIKE %s or name LIKE %s )", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"),GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $conntest18) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<style type="text/css">
#form1 table tr th {
	text-align: center;
	font-size: 24px;
}
#form1 table tr td a {
	text-align: center;
}
#form1 table tr td p label {
	text-align: center;
}
#form1 table tr td a {
	text-align: center;
}
#form1 table {
	text-align: center;
}
</style>

<form id="form1" name="form1" method="post" action="">
  <table width="400" border="1" align="center">
    <tr>
      <th scope="col">ค้นหา</th>
    </tr>
    <tr>
      <td><a href="main.php">หน้าหลัก</a>| <a href="search.php">ค้นหา</a> | <a href="insert.php">เพิ่มข้อมูล</a> | <a href="update.php">แก้ไขข้อมูล</a> | <a href="delete.php">ลบข้อมูล</a></td>
    </tr>
    <tr>
      <td><p>
        <label for="key">ค้นหา รหัส-ชื่อ :</label>
          <input type="search" name="key" id="key" />
          <input type="submit" name="btn" id="btn" value="ค้นหา" />
        </p>
    
      <table width="100%" border="0" align="center">
        <tr>
          <td bgcolor="#33FF99">id</td>
          <td bgcolor="#33FF99">name</td>
          <td bgcolor="#33FF99">position</td>
          <td bgcolor="#33FF99">salary</td>
        </tr>
        <?php do { ?>
          <tr>
            <td><?php echo $row_Recordset1['id']; ?></td>
            <td><?php echo $row_Recordset1['name']; ?></td>
            <td><?php 
			  
			  $p1 = 'พนักงาน';
			  $p2 = 'ผู้จัดการ';
			  
			  if($row_Recordset1['position'] == 1){
				  
				  echo $p1;
				  
				  }elseif($row_Recordset1['position'] == 2){
					  echo  $p2;
				  }
			  
			  
			  ?></td>
            <td><?php echo $row_Recordset1['salary']; ?></td>
          </tr>
          <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </table></td>
    </tr>
  </table>
</form>
<?php
mysql_free_result($Recordset1);
?>
