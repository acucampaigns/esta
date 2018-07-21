<?

   $host="localhost";
   $dbusername="etsaggovdhsformd";
    $dbpassword="gfgyf0075ghfbv@";
    $database="estaggov-dhs";
   $connect=mysql_connect($host,$dbusername,$dbpassword);
   $select_db=mysql_select_db($database,$connect);
   
   $pagetitle="Entry Detail";
   $entryId=$_REQUEST["entryId"];

   $query="select * from formdata where id='$entryId'";
   $execute=mysql_query($query);
   $rows=mysql_num_rows($execute); 
  
?> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entry Detail</title>
<style>
body  { padding:0px;margin:0px;font-family:arial;font-size:12px; }
.border_gray { border:1px solid #000000;}
.text_black { font-weight:bold;}

</style>
<body>
<div style="width:980px;margin-left:auto;margin-right:auto;">
<table style="width:100%;" cellpadding="0" cellspacing="0">
 
  <tr>
    <td  style="height:24px;">
   </td>
   </tr>
 

 <tr>
  <td style="height:20px;">
  </td>
  </tr>

  

 <? if($rows>0) { ?>
 
   
   <tr>
    <td>		  
		<? echo stripslashes(mysql_result($execute,0,"formdata")); ?>

   </td>
   </tr> 

 
  <? } // end of if condition  ?>
</table>
</div>
</body>
</html>