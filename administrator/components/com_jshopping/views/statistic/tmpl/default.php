<?php
include(JPATH_COMPONENT_ADMINISTRATOR."/views/otherpanel/tmpl/submenu.php");
$rows = $this->rows;
$paid_status = $this->paid_status;
?>
<div class="jshop_edit" style="width:100%; ">
<div style="width:60%; float:left;">
<fieldset class="adminform" >
<legend><?php echo _JSHOP_ORDERS_STATISTICS;?></legend>

<table class = "adminlist">
<thead>
  <tr>

    <th width = "140" align = "left" rowspan="2">
      <?php echo _JSHOP_STATUS;?>
    </th>
    <th width = "115" colspan="2">
      <?php echo _JSHOP_THIS_DAY;?>
    </th>
    <th width = "115" colspan="2">
        <?php echo _JSHOP_THIS_WEEK;?>
    </th>
    <th width = "115" colspan="2">
        <?php echo _JSHOP_THIS_MONTH;?>
    </th>
    <th width = "115" colspan="2">
        <?php echo _JSHOP_THIS_YEAR;?>
    </th>    
  </tr>
    <tr>

    <th width = "30">
      <?php echo _JSHOP_COUNT;?>
    </th>
    <th width = "85">
      <?php echo _JSHOP_PRICE;?>
    </th>    
    <th width = "30">
      <?php echo _JSHOP_COUNT;?>
    </th>
    <th width = "85">
      <?php echo _JSHOP_PRICE;?>
    </th> 
    <th width = "30">
      <?php echo _JSHOP_COUNT;?>
    </th>
    <th width = "85">
      <?php echo _JSHOP_PRICE;?>
    </th> 
    <th width = "30">
      <?php echo _JSHOP_COUNT;?>
    </th>
    <th width = "85">
      <?php echo _JSHOP_PRICE;?>
    </th>   
  </tr>
</thead> 
<?php $total_d=$total_sum_d=$total_w=$total_sum_w=$total_m=$total_sum_m=$total_y=$total_sum_y=0;
$ptotal_d=$ptotal_sum_d=$ptotal_w=$ptotal_sum_w=$ptotal_m=$ptotal_sum_m=$ptotal_y=$ptotal_sum_y=0;
?> 
<?php foreach($rows as $row){ 
      
    ?>
  <tr >
   <td>
     <b><?php echo $row['name'];?></b>
   </td>
   <td style="text-align:right;">
     <?php $k=0;  foreach($this->today as $res)
     {
     if ($row['status_id'] == $res['order_status']) 
        {
            $damount = $res['amount']; $dsum=$res['total_sum']; $k=1;
        }
     
     }
     if ($k==0) {$damount ='0';   $dsum='0';    }
     $total_d+=$damount;  $total_sum_d+=$dsum;
     if (in_array($row['status_id'] , $paid_status)) { $ptotal_d+=$damount;  $ptotal_sum_d+=$dsum; } 
     echo   $damount;
     ?> 
      
   </td>
   <td style="text-align:right;">

     <?php  echo formatprice( $dsum); ?>

   </td>   
	<td style="text-align:right;">
     <?php $k=0; foreach($this->week as $res)
     {
     if ($row['status_id'] == $res['order_status']) 
        {$damount = $res['amount']; $dsum=$res['total_sum']; $k=1;}
     
     }
     if ($k==0) {$damount ='0';   $dsum='0';    }
     $total_w+=$damount;  $total_sum_w+=$dsum;
     if (in_array($row['status_id'] , $paid_status)) { $ptotal_w+=$damount;  $ptotal_sum_w+=$dsum; }      
     echo   $damount;
     ?> 
   	</td>
    <td style="text-align:right;">
          <?php  echo formatprice( $dsum) ; ?>   
    </td>
    <td style="text-align:right;">
     <?php $k=0; foreach($this->month as $res)
     {
     if ($row['status_id'] == $res['order_status']) 
        {$damount = $res['amount']; $dsum=$res['total_sum']; $k=1;}
     
     }
     if ($k==0) {$damount ='0';   $dsum='0';    }
     $total_m+=$damount;  $total_sum_m+=$dsum;
     if (in_array($row['status_id'] , $paid_status)) { $ptotal_m+=$damount;  $ptotal_sum_m+=$dsum; }      
     echo   $damount;
     ?>         
    </td>
    <td style="text-align:right;">
     <?php  echo formatprice( $dsum); ?>  
    </td>
    <td style="text-align:right;">
     <?php $k=0; foreach($this->year as $res)
     {
     if ($row['status_id'] == $res['order_status']) 
        {$damount = $res['amount']; $dsum=$res['total_sum']; $k=1;}
     
     }
     if ($k==0) {$damount ='0';   $dsum='0';    }
     $total_y+=$damount;  $total_sum_y+=$dsum;
     if (in_array($row['status_id'] , $paid_status)) { $ptotal_y+=$damount;  $ptotal_sum_y+=$dsum; }      
     echo   $damount;
     ?>         
    </td>  
    <td style="text-align:right;">
    <?php  echo formatprice( $dsum); ?>
    </td>  
  </tr>
  <?php
      }
?>
   <tr>

    <th colspan = "9" style="b">
      
    </th>
 
  </tr>
  <tr >
   <th>
     <?php echo _JSHOP_TOTAL_PAID;?>
   </th>
   <th style="text-align:right;">
     <?php   echo   $ptotal_d; ?> 
   </th>
   <th style="text-align:right;">

     <?php  echo formatprice( $ptotal_sum_d); ?>

   </th>   
    <th style="text-align:right;">
      <?php   echo   $ptotal_w; ?>  
    </th>
    <th style="text-align:right;">
      <?php  echo formatprice( $ptotal_sum_w); ?>  
    </th>
    <th style="text-align:right;">
       <?php   echo   $ptotal_m; ?> 
    </th>
    <th style="text-align:right;">
       <?php  echo formatprice( $ptotal_sum_m); ?>  
    </th>
    <th style="text-align:right;">
       <?php   echo   $ptotal_y; ?>  
    </th>  
    <th style="text-align:right;">
        <?php  echo formatprice( $ptotal_sum_y); ?>  
    </th>  
  </tr>
  <tr >
   <th>
     <?php echo _JSHOP_TOTAL;?>
   </th>
   <th style="text-align:right;">
     <?php   echo   $total_d; ?> 
   </th>
   <th style="text-align:right;">

     <?php  echo formatprice( $total_sum_d); ?>

   </th>   
    <th style="text-align:right;">
     <?php   echo   $total_w; ?>  
    </th>
    <th style="text-align:right;">
     <?php  echo formatprice( $total_sum_w); ?>  
    </th>
    <th style="text-align:right;">
      <?php   echo   $total_m; ?>  
    </th>
    <th style="text-align:right;">
      <?php  echo formatprice( $total_sum_m); ?> 
    </th>
    <th style="text-align:right;">
      <?php   echo   $total_y; ?>  
    </th>  
    <th style="text-align:right;">
       <?php  echo formatprice( $total_sum_y); ?>   
    </th>  
  </tr>
</table>
</fieldset>
</div>
<div style="width:40%; float:left;">
<fieldset class="adminform" >
<legend><?php echo _JSHOP_INVENTORY;?></legend>
<table style="width:100%;">
    <tr>
        <th colspan="2" >
        <?php echo _JSHOP_CATEGORY_INVENTORY;?>:
        </th>
        <th colspan="2" >
        <?php echo _JSHOP_MANUFACTURE_INVENTORY;?>:
        </th>
    </tr>
    <tr>
        <td style="width:100px;">
        <?php echo _JSHOP_TOTAL;?>:
        </td>
        <td style="width:100px;">
         <?php $active_c=$nonactive_c=0; foreach($this->category as $res)
         {
         if ($res['category_publish']=='1')   $active_c = $res['amount'];
         if ($res['category_publish']=='0')   $nonactive_c = $res['amount'];     
         
         }
         ?>          
        <?php echo $active_c+$nonactive_c;?>
        </td>
        <td style="width:100px;">
        <?php echo _JSHOP_TOTAL;?>:
        </td>
        <td>
         <?php $active_m=$nonactive_m=0; foreach($this->manufacture as $res)
         {
         if ($res['manufacturer_publish']=='1')   $active_m = $res['amount'];
         if ($res['manufacturer_publish']=='0')   $nonactive_m = $res['amount'];     
         
         }
         ?>          
        <?php echo $active_m+$nonactive_m;?>
        </td>        
    </tr>
    <tr>
        <td>
        <?php echo _JSHOP_ACTIVE;?>:
        </td>
        <td>
        <?php echo $active_c;?> 
        </td>
        <td>
        <?php echo _JSHOP_ACTIVE;?>:
        </td>
        <td>
        <?php echo $active_m;?> 
        </td>        
    </tr>
    <tr>
        <th colspan="4"> </th>
    </tr>  
    <tr>
        <th colspan="4"><?php echo _JSHOP_PRODUCT_INVENTORY;?>:  </th>
    </tr> 
    <tr>
        <td>
        <?php echo _JSHOP_TOTAL;?>:
        </td>
        <td>
         <?php $active_p=$nonactive_p=0; foreach($this->product as $res)
         {
         if ($res['product_publish']=='1')   $active_p = $res['amount'];
         if ($res['product_publish']=='0')   $nonactive_p = $res['amount'];     
         
         }
         ?>          
        <?php echo $active_p+$nonactive_p;?>        
        </td>
        <td></td><td></td>        
    </tr>   
    <tr>
        <td>
        <?php echo _JSHOP_ACTIVE;?>:
        </td>
        <td>
        <?php echo $active_p;?> 
        </td>
        <td></td><td></td>        
    </tr>   
    <tr>
        <td>
        <?php echo _JSHOP_INSTOK;?>:
        </td>
        <td>
        <?php echo $this->pr_instok['0']['amount'];?> 
        </td>
        <td></td><td></td>        
    </tr>  
    <tr>
        <td>
        <?php echo _JSHOP_OUTOFSTOK;?>:
        </td>
        <td>
        <?php echo $this->pr_outstok['0']['amount'];?>  
        </td>
        <td></td><td></td>        
    </tr>  
    <tr>
        <td>
        <?php echo _JSHOP_DOWNLOAD;?>:
        </td>
        <td>
        <?php echo $this->pr_download['0']['amount'];?>  
        </td>
        <td></td><td></td>        
    </tr>                      
</table>     
</fieldset> 
</div> 
<div style="width:40%; float:left;">
<fieldset class="adminform" >
<legend><?php echo _JSHOP_USERS;?></legend>
<table style="width:100%;">
    <tr>
        <th colspan="2" >
        <?php echo _JSHOP_CUSTOMERS;?>:
        </th>
        <!--<th colspan="2" >
        <?php echo _JSHOP_STAFF;?>:
        </th>-->
    </tr>
    <tr>
        <td style="width:100px;">
        <?php echo _JSHOP_TOTAL;?>:
        </td>
        <td style="width:100px;">       
        <?php echo $this->customer;?>
        </td>
        <!--<td style="width:100px;">
        <?php echo $this->stuff1['usertype'];?>:
        </td>
        <td>        
        <?php echo $this->stuff1['amount'];?>
        </td>-->
    </tr>
    <tr>
        <td>
        <?php echo _JSHOP_ENABLED;?>:
        </td>
        <td>
        <?php echo $this->customer_enabled;?>  
        </td>
        <td>
        <!--<?php echo $this->stuff2['usertype'];?>:
        </td>
        <td>
        <?php echo $this->stuff2['amount'];?> 
        </td>-->
    </tr>
    <tr>
        <td>
        <?php echo _JSHOP_LOGGEDIN;?>:
        </td>
        <td>
        <?php echo $this->customer_loggedin;?>    
        </td>
        <td>
        <!--<?php echo $this->stuff3['usertype'];?>:
        </td>
        <td>
        <?php echo $this->stuff3['amount'];?>
        </td>-->        
    </tr>    
    <tr>
        <th colspan="4"> </th>
    </tr>  
    <tr>
        <th colspan="4"><?php echo _JSHOP_USERGROUPS;?>:  </th>
    </tr> 
    <?php foreach($this->usergroups as $res):?>
    <tr>
        <td>
        <?php echo $res['usergroup_name'];?>:
        </td>
        <td>       
        <?php echo $res['amount'];?>        
        </td>
        <td></td><td></td>        
    </tr> 
    <?php endforeach;?>                      
</table>     
</fieldset> 
</div> 
</div> 