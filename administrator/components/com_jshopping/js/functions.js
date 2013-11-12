function Round(value, numCount){
    var ret = parseFloat(Math.round(value * Math.pow(10, numCount)) / Math.pow(10, numCount)).toString();
    return (isNaN(ret)) ? (0) : (ret);
}

function changeCategory(){
    var catid = jQuery("#category_parent_id").val();
    var url = 'index.php?option=com_jshopping&controller=categories&task=sorting_cats_html&catid='+catid+"&ajax=1";
    function showResponse(data){
        jQuery('#ordering').html(data);
    }
    jQuery.get(url, showResponse);
}

function verifyStatus(orderStatus, orderId, message, extended, limit){
   if (extended == 0){
       var statusNewId = $F_('select_status_id' + orderId);
       if (statusNewId == orderStatus){
            alert (message);
            return;
       } else {
         var isChecked = ($_('order_check_id_' + orderId ).checked) ? ('&notify=1') : ('');
         location.href = 'index.php?option=com_jshopping&controller=orders&task=update_status&js_nolang=1&order_id=' + orderId + '&order_status=' + statusNewId + limit + isChecked;
       }
   } else {
       var statusNewId = $F_('order_status');
       if (statusNewId == orderStatus){
              alert (message);
              return;
       } else {
         var isChecked = ($_('notify').checked) ? ('&notify=1') : ('&notify=0');
         var includeComment = ($_('include').checked) ? ('&include=1') : ('&include=0');

         location.href = 'index.php?option=com_jshopping&controller=orders&task=update_one_status&js_nolang=1&order_id=' + orderId + '&order_status=' + statusNewId + isChecked + includeComment + '&comments=' + $F_('comments');
       }
   }
}


function updatePrice(display_price_admin){
    var repl = new RegExp("\,", "i");
    var percent = $_('product_tax_id')[$_('product_tax_id').selectedIndex].text;
    var pattern = /(\d*\.?\d*)%\)$/
    pattern.test(percent);
    percent = RegExp.$1; 
    var price2 = $F_('product_price2');
    if (display_price_admin==0){
        $_('product_price').value = Round(price2 * (1 + percent / 100), 2);
    }else{
        $_('product_price').value = Round(price2 / (1 + percent / 100), 2);
    }
    
    reloadAddPriceValue();
}

function updatePrice2(display_price_admin){
    var repl = new RegExp("\,", "i");
    var percent = $_('product_tax_id')[$_('product_tax_id').selectedIndex].text;
    var pattern = /(\d*\.?\d*)%\)$/
    pattern.test(percent);
    percent = RegExp.$1; 
    var price = $F_('product_price');
    if (display_price_admin==0){
        $_('product_price2').value = Round (price / (1 + percent / 100), 2);
    }else{
        $_('product_price2').value = Round (price * (1 + percent / 100), 2);    
    }
    
    reloadAddPriceValue();
}

function addNewPrice(){
    add_price_num++;
    var html;    
    html = '<tr id="add_price_'+add_price_num+'">';
    html += '<td><input type = "text" name = "quantity_start[]" id="quantity_start_'+add_price_num+'" value = "" /></td>';
    html += '<td><input type = "text" name = "quantity_finish[]" id="quantity_finish_'+add_price_num+'" value = "" /></td>';
    html += '<td><input type = "text" name = "product_add_discount[]" id="product_add_discount_'+add_price_num+'" value = "" onkeyup="productAddPriceupdateValue('+add_price_num+')" /></td>';
    html += '<td><input type = "text" id="product_add_price_'+add_price_num+'" value = "" onkeyup="productAddPriceupdateDiscount('+add_price_num+')" /></td>';    
    html += '<td align="center"><a href="#" onclick="delete_add_price('+add_price_num+');return false;"><img src="components/com_jshopping/images/publish_r.png" border="0"/></a></td>';
    html += '</tr>';
    jQuery("#table_add_price").append(html);       
}

function delete_add_price(num){
    jQuery("#add_price_"+num).remove();
}

function productAddPriceupdateValue(num){
    var price;
    var origin = jQuery("#product_price").val();
    if (origin=="") return 0;
    var discount = jQuery("#product_add_discount_"+num).val();
    if (discount=="") return 0;
    if (config_product_price_qty_discount==1)
        price = origin - discount;
    else
        price = origin - (origin * discount/100);
    jQuery("#product_add_price_"+num).val(price);
}

function productAddPriceupdateDiscount(num){
    var price;
    var origin = jQuery("#product_price").val();
    if (origin=="") return 0;
    var price = jQuery("#product_add_price_"+num).val();
    if (price=="") return 0;
    if (config_product_price_qty_discount==1)
        discount = origin - price;
    else
        discount = 100 - (price / origin * 100);
    jQuery("#product_add_discount_"+num).val(discount);
}

function reloadAddPriceValue(){
    var discount;
    var origin = jQuery("#product_price").val();    
    jQuery("#attr_price").val(origin);
    
    if (origin=="") return 0;
    
    for(i=0;i<=add_price_num;i++){
        if (jQuery("#product_add_discount_"+i)){
            discount = jQuery("#product_add_discount_"+i).val();
            if (config_product_price_qty_discount==1)
                price = origin - discount;
            else
                price = origin - (origin * discount/100);
            jQuery("#product_add_price_"+i).val(price);
        }    
    }    
}

function updateEanForAttrib(){
    jQuery("#attr_ean").val(jQuery("#product_ean").val());
}

function addFieldShPrice(){    
    shipping_weight_price_num++;
    var html;    
    html = '<tr id="shipping_weight_price_row_'+shipping_weight_price_num+'">';
    html += '<td><input type = "text" class = "inputbox" name = "shipping_weight_from[]" value = "" /></td>';    
    html += '<td><input type = "text" class = "inputbox" name = "shipping_weight_to[]" value = "" /></td>';
    html += '<td><input type = "text" class = "inputbox" name = "shipping_price[]" value = "" /></td>';
    html += '<td><input type = "text" class = "inputbox" name = "shipping_package_price[]" value = "" /></td>';
    html += '<td style="text-align:center"><a href="#" onclick="delete_shipping_weight_price_row('+shipping_weight_price_num+');return false;"><img src="components/com_jshopping/images/publish_r.png" border="0"/></a></td>';    
    html += '</tr>';
    jQuery("#table_shipping_weight_price").append(html);
}

function delete_shipping_weight_price_row(num){
    jQuery("#shipping_weight_price_row_"+num).remove();   
}

function checkDirectory(id, directory){
    var url = 'index.php?option=com_jshopping&controller=config&task=check_directory&directory=' + directory+"&ajax=1";
    function showResponse(json){       
       $_(id).innerHTML = json.text;
       $_(id).className = (json.isWrite == 1) ? ('jshop_green') : ('jshop_red');              
    }
    jQuery.getJSON(url, showResponse);
}

function setDefaultSize(width, height, param){
   $_(param + '_width_image').value = width;
   $_(param + '_height_image').value = height;
   $_(param + '_width_image').disabled = true;
   $_(param + '_height_image').disabled = true;
}

function setOriginalSize(param){
   $_(param + '_width_image').disabled = true;
   $_(param + '_height_image').disabled = true;
   $_(param + '_width_image').value = 0;
   $_(param + '_height_image').value = 0;
}

function setManualSize(param){
   $_(param + '_width_image').disabled = false;
   $_(param + '_height_image').disabled = false;
}

function setFullOriginalSize(param){
   $_(param + '_width_image').disabled = true;
   $_(param + '_height_image').disabled = true;
   $_(param + '_width_image').value = 0;
   $_(param + '_height_image').value = 0;
}

function setFullManualSize(param){
   $_(param + '_width_image').disabled = false;
   $_(param + '_height_image').disabled = false;
}

function addAttributValue2(id){
    var value_id = jQuery("#attr_ind_id_tmp_"+id+"  :selected").val();
    var attr_value_text = jQuery("#attr_ind_id_tmp_"+id+"  :selected").text();
    var mod_price = jQuery("#attr_price_mod_tmp_"+id).val();
    var price = jQuery("#attr_ind_price_tmp_"+id).val();    
    var existcheck = jQuery('#attr_ind_'+id+'_'+value_id).val();    
    if (existcheck){
        alert(lang_attribute_exist);
        return 0;
    }    
    if (value_id=="0"){
        alert(lang_error_attribute);
        return 0;
    }
    html = "<tr id='attr_ind_row_"+id+"_"+value_id+"'>"; 
    hidden = "<input type='hidden' id='attr_ind_"+id+"_"+value_id+"' name='attrib_ind_id[]' value='"+id+"'>";
    hidden2 = "<input type='hidden' name='attrib_ind_value_id[]' value='"+value_id+"'>";
    tmpimg="";
    if (value_id!=0 && attrib_images[value_id]!=""){
        tmpimg ='<img src="'+folder_image_attrib+'/'+attrib_images[value_id]+'" style="margin-right:5px;" width="16" height="16" class="img_attrib">';
    }
    html+="<td>" + hidden + hidden2 + tmpimg + attr_value_text + "</td>";
    html+="<td><input type='text' name='attrib_ind_price_mod[]' value='"+mod_price+"'></td>";
    html+="<td><input type='text' name='attrib_ind_price[]' value='"+price+"'></td>";
    html+="<td><a href='#' onclick=\"jQuery('#attr_ind_row_"+id+"_"+value_id+"').remove();return false;\"><img src='components/com_jshopping/images/publish_r.png' border='0'></a></td>";
    html += "</tr>";    
    jQuery("#list_attr_value_ind_"+id).append(html);    
}

function addAttributValue(){    
    attr_tmp_row_num++;
    var id=0;
    var ide=0;
    var value = "";
    var text = "";
    var html="";
    var hidden="";
    var field="";
    var count_attr_sel = 0;    
    var tmpmass = {};
    var tmpimg = "";
    var selectedval = {};
    var num = 0;
    var current_index_list = [];
    var max_index_list = [];
    var combination = 1;
    var count_attributs = attrib_ids.length;
    var index = 0;
    var option = {};
            
    for (var i=0; i<count_attributs; i++){
        current_index_list[i] = 0;
        id = attrib_ids[i];
        ide = "value_id"+id;
        selectedval[id] = [];
        num = 0;
        jQuery("#"+ide+" :selected").each(function(j, selected){ 
          value = jQuery(selected).val(); 
          text = jQuery(selected).text();
          if (value!=0){           
              selectedval[id][num] = {"text":text, "value":value};
              num++;
          }
        });
                
        if (selectedval[id].length==0){            
            selectedval[id][0] = {"text":"-", "value":"0"};
        }else{
            count_attr_sel++;    
        }
        max_index_list[i] = selectedval[id].length;
        combination = combination * max_index_list[i];
    }
    
    var first_attr = jQuery("input:hidden","#list_attr_value tr:eq(1)");
    if (first_attr.length > 0) {
        for (var k=0; k<count_attributs; k++)
        {
            id = attrib_ids[k];
            if (first_attr[k].value==0) 
            {
                if (selectedval[id][0].value != 0) 
                {
                    alert(lang_error_attribute);
                    return 0;
                }
            }
            if (first_attr[k].value!=0) 
            {
                if (selectedval[id][0].value == 0) 
                {
                    alert(lang_error_attribute);
                    return 0;
                }
            }
        }
    }
    
    if (count_attr_sel==0){
        alert(lang_error_attribute);
        return 0;
    }
    
    var list_key = [];
    for(var j=0; j<combination; j++){
        list_key[j] = [];
        for (var i=0; i<count_attributs; i++){
            id = attrib_ids[i];
            num = current_index_list[i];
            list_key[j][i] = num;            
        }
        
        index = 0;                
        for (var i=0; i<count_attributs; i++){
            if (i==index){
                current_index_list[index]++;
                if (current_index_list[index] >= max_index_list[index]){
                    current_index_list[index] = 0;
                    index++;
                }
            }
        }        
    }
    
    var entered_price = jQuery("#attr_price").val();
    var entered_count = jQuery("#attr_count").val();
    var entered_ean = jQuery("#attr_ean").val();    
    var entered_weight = jQuery("#attr_weight").val();    
    var entered_weight_volume_units = jQuery("#attr_weight_volume_units").val();
    
    var count_added_rows = 0;
    for(var j=0; j<combination; j++){
        tmpmass = {};
        html = "<tr id='attr_row_"+attr_tmp_row_num+"'>";
        for (var i=0; i<count_attributs; i++){
            id = attrib_ids[i];
            num = list_key[j][i];
            option = selectedval[id][num];
            hidden = "<input type='hidden' name='attrib_id["+id+"][]' value='"+option.value+"'>";
            tmpimg="";
            if (option.value!=0 && attrib_images[option.value]!=""){
                tmpimg ='<img src="'+folder_image_attrib+'/'+attrib_images[option.value]+'" style="margin-right:5px;" width="16" height="16" class="img_attrib">';
            }
            html+="<td>" + hidden + tmpimg + option.text + "</td>";
            tmpmass[id] = option.value;
        }
           
        field="<input type='text' name='attrib_price[]' value='"+entered_price+"'>";
        html+="<td>"+field+"</td>";
        
        /*value = jQuery("#attr_buy_price").val();    
        field="<input type='text' name='attrib_buy_price[]' value='"+value+"'>";
        html+="<td>"+field+"</td>";*/
        
        field="<input type='text' name='attr_count[]' value='"+entered_count+"'>";
        html+="<td>"+field+"</td>";
        
        field="<input type='text' name='attr_ean[]' value='"+entered_ean+"'>";
        html+="<td>"+field+"</td>";
        
        field="<input type='text' name='attr_weight[]' value='"+entered_weight+"'>";
        html+="<td>"+field+"</td>";
        
        if (use_basic_price=="1"){
            field="<input type='text' name='attr_weight_volume_units[]' value='"+entered_weight_volume_units+"'>";
            html+="<td>"+field+"</td>";
        }
            
        html+="<td><a href='#' onclick=\"deleteTmpRowAttrib('"+attr_tmp_row_num+"');return false;\"><img src='components/com_jshopping/images/publish_r.png' border='0'></a></td>";
        
        html+="</tr>";
        html+="";
        
        var existcheck = 0;
        for ( var k in attrib_exist ){
            var exist = 1; 
            for(var i=0; i<count_attributs; i++){
                id = attrib_ids[i];
                if (attrib_exist[k][id]!=tmpmass[id]) exist=0;
            }
            if (exist==1) {
                existcheck = 1;
                break;
            }
        }
        
        if (!existcheck){
            jQuery("#list_attr_value").append(html);
            attrib_exist[attr_tmp_row_num] = tmpmass;        
            attr_tmp_row_num++;
            count_added_rows++;
        }
    }
    
    if (count_added_rows==0){
        alert(lang_attribute_exist);
        return 0;
    }   
    return 1; 
}

function deleteTmpRowAttrib(num){
    jQuery("#attr_row_"+num).remove();
    delete attrib_exist[num];
}

function changeAttrAdmin(aid, aval){
    if (aval==0) {
        jQuery("#preview_attr_img_"+aid).attr('src',"components/com_jshopping/images/blank.png"); 
        return 1;
    }
    if (attrib_images[aval]!="")
        jQuery("#preview_attr_img_"+aid).attr('src',folder_image_attrib+"/"+attrib_images[aval]);
    else
        jQuery("#preview_attr_img_"+aid).attr('src',"components/com_jshopping/images/blank.png");
}

function deleteFotoCategory(catid){
    var url = 'index.php?option=com_jshopping&controller=categories&task=delete_foto&catid='+catid;
    function showResponse(data){
        jQuery("#foto_category").hide();
    }
    jQuery.get(url, showResponse);
}

function deleteFotoProduct(id){
    var url = 'index.php?option=com_jshopping&controller=products&task=delete_foto&id='+id;
    function showResponse(data){
        jQuery("#foto_product_"+id).hide();
    }
    jQuery.get(url, showResponse);
}

function deleteVideoProduct(id){
    var url = 'index.php?option=com_jshopping&controller=products&task=delete_video&id='+id;
    function showResponse(data){
        jQuery("#video_product_"+id).hide();
    }
    jQuery.get(url, showResponse);
}

function deleteFileProduct(id, type){
    var url = 'index.php?option=com_jshopping&controller=products&task=delete_file&id='+id+"&type="+type;
    function showResponse(data){
        if (type=="demo"){
            jQuery("#product_demo_"+id).html("");
        }
        if (type=="file"){
            jQuery("#product_file_"+id).html("");
        }
        if (data=="1") jQuery(".rows_file_prod_"+id).hide();
    }
    jQuery.get(url, showResponse);
}

function deleteFotoManufacturer(id){
    var url = 'index.php?option=com_jshopping&controller=manufacturers&task=delete_foto&id='+id;
    function showResponse(data){
        jQuery("#image_manufacturer").hide();
    }
    jQuery.get(url, showResponse);
}

function deleteFotoAttribValue(id){
    var url = 'index.php?option=com_jshopping&controller=attributesvalues&task=delete_foto&id='+id;
    function showResponse(data){
        jQuery("#image_attrib_value").hide();
    }
    jQuery.get(url, showResponse);
}

function deleteFotoLabel(id){
    var url = 'index.php?option=com_jshopping&controller=productlabels&task=delete_foto&id='+id;
    function showResponse(data){
        jQuery("#image_block").hide();
    }
    jQuery.get(url, showResponse);
}

function releted_product_search(start, no_id){
    var text = jQuery("#related_search").val();
    var url = 'index.php?option=com_jshopping&controller=products&task=search_related&start='+start+'&no_id='+no_id+'&text='+encodeURIComponent(text)+"&ajax=1";
    function showResponse(data){
        jQuery("#list_for_select_related").html(data);
    }
    jQuery.get(url, showResponse);
}

function add_to_list_relatad(id){
    var name = jQuery("#serched_product_"+id+" .name").html();
    var img =  jQuery("#serched_product_"+id+" .image").html();
    var html = '<div class="block_related" id="related_product_'+id+'">';
    html += '<div class="block_related_inner">';
    html += '<div class="name">'+name+'</div>';
    html += '<div class="image">'+img+'</div>';
    html += '<div style="padding-top:5px;"><input type="button" value="'+lang_delete+'" onclick="delete_related('+id+')"></div>';
    html += '<input type="hidden" name="related_products[]" value="'+id+'"/>';
    html += '</div>';
    html += '</div>';
    
    jQuery("#list_related").append(html);
}

function delete_related(id){
    jQuery("#related_product_"+id).remove();    
}

function reloadProductExtraField(product_id){
    var catsurl = "";
    jQuery("#category_id :selected").each(function(j, selected){ 
      value = jQuery(selected).val(); 
      text = jQuery(selected).text();
      if (value!=0){           
          catsurl += "&cat_id[]="+value;
          
      }
    });
    
    var url = 'index.php?option=com_jshopping&controller=products&task=product_extra_fields&product_id='+product_id+catsurl+"&ajax=1";
    function showResponse(data){
        jQuery("#extra_fields_space").html(data);
    }
    jQuery.get(url, showResponse);
}

function PFShowHideSelectCats(){
    var value = jQuery("input[@name=allcats]:checked").val();
    if (value=="0"){
        jQuery("#tr_categorys").show();
    }else{
        jQuery("#tr_categorys").hide();
    }
}

function ShowHideEnterProdQty(checked){
    if (checked){
        jQuery("#block_enter_prod_qty").hide();
    }else{
        jQuery("#block_enter_prod_qty").show();
    }
}