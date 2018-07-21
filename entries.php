<?

   $host="localhost";
   $dbusername="etsaggovdhsformd";
    $dbpassword="gfgyf0075ghfbv@";
    $database="estaggov-dhs";
   $connect=mysql_connect($host,$dbusername,$dbpassword);
   $select_db=mysql_select_db($database,$connect);
   
   $pagetitle="Entries";

   $query="select * from formdata order by id desc";
   $execute=mysql_query($query);
   $rows=mysql_num_rows($execute); 
  
?> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entries</title>
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

  <tr>
    <td style="padding-bottom:7px;padding-top:4px;border-bottom:1px solid #000000;">
     <span style="color:#bf0f02;font-weight:bold;font-size:18px;">Entries (<?=$rows;?>)</span>
    </td>
  </tr>

 
  <tr>
   <td style="height:20px;">
  </td>
 </tr>
  

 <? if($rows>0) { ?>
 
    <tr>
	 <td>
	  <table style="width:100%;" cellpadding="0" cellspacing="0">
	
	
	<tr>
 	    <td class="border_gray" style="width:150px;padding:7px;text-align:center;">
		<span class="text_black" style="font-size:11px;">Date</span>
		</td>

	<td style="width:1px;"></td>
 	    <td class="border_gray" style="width:150px;padding:7px;text-align:center;">
		<span class="text_black" style="font-size:11px;">Time</span>
		</td>


	<td style="width:1px;"></td>
 	    <td class="border_gray" style="width:60px;padding:7px;text-align:center;">
		<span class="text_black" style="font-size:11px;">Entry Details</span>
		</td>

		 
	  </tr>
  
    <tr>
	 <td style="height:10px;">
	 </td>
	</tr> 
  
     
     <?
	 
       for($loop=0;$loop<$rows;$loop++)
        {

		  
		  $entryId=stripslashes(mysql_result($execute,$loop,"id"));
		  $date=stripslashes(mysql_result($execute,$loop,"date"));
 		  $time=stripslashes(mysql_result($execute,$loop,"time"));
	      $expodedate=explode("-",$date);
		  $date=$expodedate[2]."-".$expodedate[1]."-".$expodedate[0];
          //$time=stripslashes(mysql_result($execute,$loop,"time"));
		  
		  
		  

      ?>
  
     <tr>

    	<td class="border_gray" style="text-align:center;width:80px;padding:7px;">
		 <span class="text" style="font-size:11px;"><?=$date;?></span>
		 </td>

         <td style="width:3px;"></td>
    	<td class="border_gray" style="text-align:center;width:40px;padding:7px;">
		 <span class="text" style="font-size:11px;"><?=$time;?></span>
		 </td>

         <td style="width:3px;"></td>
    	<td class="border_gray" style="text-align:center;width:40px;padding:7px;">
		 <span class="text" style="font-size:11px;"><a href="entrydetail.php?entryId=<?=$entryId;?>" target="_blank">Click Me</a></span>
		 </td>
		
		 
	  </tr>

      <tr>
	   <td style="height:10px;">
	   </td>
	  </tr> 

     
     

         <? } //end of loop ?>

 
	 </table>
   </td>
   </tr> 

 
  <? } // end of if condition  ?>
</table>
</div>
</body>
</html>