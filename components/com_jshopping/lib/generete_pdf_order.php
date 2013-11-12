<?php
/**
* @version      3.2.2 12.03.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

define('K_TCPDF_EXTERNAL_CONFIG', true);
// Installation path
define("K_PATH_MAIN", JPATH_SITE.DS."components".DS."com_jshopping".DS."lib".DS."tcpdf");
// URL path
define("K_PATH_URL", JPATH_SITE);
// Fonts path
define("K_PATH_FONTS", JPATH_SITE.DS."components".DS."com_jshopping".DS."lib".DS."tcpdf".DS."fonts".DS);
// Cache directory path
define("K_PATH_CACHE", K_PATH_MAIN.DS."cache");
// Cache URL path
define("K_PATH_URL_CACHE", K_PATH_URL.DS."cache");
// Images path
define("K_PATH_IMAGES", K_PATH_MAIN.DS."images");
// Blank image path
define("K_BLANK_IMAGE", K_PATH_IMAGES.DS."_blank.png");

/*
* Format options
*/
// Cell height ratio
define("K_CELL_HEIGHT_RATIO", 1.5);
// Magnification scale for titles
define("K_TITLE_MAGNIFICATION", 1);
// Reduction scale for small font
define("K_SMALL_RATIO", 2/3);
// Magnication scale for head
define("HEAD_MAGNIFICATION", 1);

include(JPATH_SITE."/components/com_jshopping/lib/tcpdf/tcpdf.php");
error_reporting(1);

class MYPDF extends TCPDF{
	function addNewPage(){
		$this->addPage();
		$this->addTitleHead();	
	}
	function addTitleHead(){
		$jshopConfig = &JSFactory::getConfig();
        $vendorinfo = $this->_vendorinfo;
		$this->Image($jshopConfig->path . '/images/header.jpg',1,1,$jshopConfig->pdf_header_width,$jshopConfig->pdf_header_height);
		$this->Image($jshopConfig->path . '/images/footer.jpg',1,265,$jshopConfig->pdf_footer_width,$jshopConfig->pdf_footer_height);
        $this->SetFont('freesans','',8);
        $this->SetXY(155,12);
        $this->SetTextColor(155,155,155);
        $_vendor_info = array();
        $_vendor_info[] = $vendorinfo->adress;
        $_vendor_info[] = $vendorinfo->zip . " " . $vendorinfo->city;
        if ($vendorinfo->phone) $_vendor_info[] = _JSHOP_CONTACT_PHONE . ": " . $vendorinfo->phone;
        if ($vendorinfo->fax) $_vendor_info[] = _JSHOP_CONTACT_FAX . ": " . $vendorinfo->fax;
        if ($vendorinfo->email) $_vendor_info[] = _JSHOP_EMAIL . ": " . $vendorinfo->email;
        $str_vendor_info = implode("\n",$_vendor_info);
        $this->MultiCell(40, 3, $str_vendor_info, 0, 'R');
        $this->SetTextColor(0,0,0);
	}	
}

function generatePDF($order){
        
    $jshopConfig = &JSFactory::getConfig();
    $vendorinfo = $order->getVendorInfo();
    
	$pdf = new MYPDF();
    $pdf->_vendorinfo = $vendorinfo;
    $pdf->SetFont('freesans','',8);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(0, 0, 0);
	$pdf->addNewPage();	
    
	$pdf->SetXY(20,55);
	$pdf->setfontsize(6);
	$pdf->SetTextColor(0,0,0);
	$pdf->MultiCell(80,3, $vendorinfo->company_name . ", " . $vendorinfo->adress . ", " . $vendorinfo->zip . " " . $vendorinfo->city,0,'L');
	
	$pdf->SetXY(110,55);
	$pdf->SetFont('freesansb','',11);
	$pdf->SetTextColor(0,0,0);
	$pdf->MultiCell(80,3,_JSHOP_EMAIL_BILL,0,'R');
	
	$pdf->SetFont('freesans','',11);
	$pdf->SetXY(20,60);
	$pdf->MultiCell(80,4.5,$order->firma_name . "\n" . $order->f_name . " " . $order->l_name . "\n" . $order->street . "\n" . $order->zip . " " . $order->city . "\n" . $order->country, 0,'L');
	
	$pdf->SetFont('freesansi','',11);
	$pdf->SetXY(110,65);
	$pdf->MultiCell(80,4.5,_JSHOP_ORDER_SHORT_NR . " " . $order->order_number . "\n" . _JSHOP_ORDER_FROM . " " . $order->order_date,0,'R');
    
    
	$pdf->SetDrawColor(0,0,0);
	$pdf->SetFont('freesans','',7);
    
    if ( $jshopConfig->identification_number){
        $pdf->SetXY(115,102);
        $pdf->MultiCell(35, 4, _JSHOP_IDENTIFICATION_NUMBER, 1, 'L');
        $pdf->SetXY(150,102);
        $pdf->MultiCell(40, 4, $jshopConfig->identification_number, 1, 'R');
    }
    if ($jshopConfig->tax_number){
        $pdf->SetXY(115,106);
        $pdf->MultiCell(35, 4, _JSHOP_TAX_NUMBER, 1, 'L');
        $pdf->SetXY(150,106);
        $pdf->MultiCell(40, 4, $jshopConfig->tax_number, 1, 'R');
    }
    
    $width_filename	= 65;
    if (!$jshopConfig->show_product_code_in_order) $width_filename = 87;
	$pdf->setfillcolor(200,200,200);
	$pdf->Rect(20,116,170,4,'F');
	$pdf->SetFont('freesansb','',7.5);
	$pdf->SetXY(20,116);
	$pdf->MultiCell($width_filename, 4, _JSHOP_NAME_PRODUCT, 1, 'L');
    
    if ($jshopConfig->show_product_code_in_order){
        $pdf->SetXY(85,116);
        $pdf->MultiCell(22, 4, _JSHOP_EAN_PRODUCT, 1, 'L');
    }
    
    $pdf->SetXY(107,116);
    $pdf->MultiCell(18, 4, _JSHOP_QUANTITY, 1, 'L');
    
    $pdf->SetXY(125,116);
    $pdf->MultiCell(25, 4, _JSHOP_SINGLEPRICE, 1, 'L');        
	$pdf->SetXY(150,116);
	$pdf->MultiCell(40, 4,_JSHOP_TOTAL, 1,'R');
    	
    $y = 120;	
	foreach ($order->products as $prod){
        
        $pdf->SetFont('freesans','',7);
        $pdf->SetXY(20, $y + 2);
        $pdf->MultiCell($width_filename, 4, $prod->product_name, 0 , 'L');
        if ($prod->product_attributes!="" || $prod->product_freeattributes!=""){
            $pdf->SetXY(23, $pdf->getY());            
            $pdf->SetFont('freesans','',6);
            $pdf->MultiCell(62, 4, $prod->product_attributes.$prod->product_freeattributes, 0 , 'L');
            $pdf->SetFont('freesans','',7);
        }
        $y2 = $pdf->getY() + 2;
        
        if ($jshopConfig->show_product_code_in_order){
            $pdf->SetXY(85, $y + 2);
            $pdf->MultiCell(22, 4, $prod->product_ean, 0 , 'L');
            $y3 = $pdf->getY() + 2;
        }else{
            $y3 = $pdf->getY();
        }
        
        $pdf->SetXY(107, $y + 2);
        $pdf->MultiCell(18, 4, $prod->product_quantity, 0 , 'L');
        $y4 = $pdf->getY() + 2;
        
        $pdf->SetXY(125, $y + 2);
        $pdf->MultiCell(25, 4, formatprice($prod->product_item_price, $order->currency_code), 0 , 'L');
        
        if ($jshopConfig->show_tax_product_in_cart && $prod->product_tax>0){
            $pdf->SetXY(125, $y + 6);
            $pdf->SetFont('freesans','',6);            
            $text = productTaxInfo($prod->product_tax, $order->display_price);
            $pdf->MultiCell(25, 4, $text, 0 , 'L');
        }
        $y5 = $pdf->getY() + 2;
        
        $pdf->SetFont('freesans','',7);
        $pdf->SetXY(150, $y + 2);
        $pdf->MultiCell(40, 4, formatprice($prod->product_quantity * $prod->product_item_price, $order->currency_code), 0 , 'R');
        
        if ($jshopConfig->show_tax_product_in_cart && $prod->product_tax>0){
            $pdf->SetXY(150, $y + 6);
            $pdf->SetFont('freesans','',6);            
            $text = productTaxInfo($prod->product_tax, $order->display_price);
            $pdf->MultiCell(40, 4, $text, 0 , 'R');
        }
        $y6 = $pdf->getY() + 2;
        
        $yn = max($y2, $y3, $y4, $y5, $y6);
        
        $pdf->Rect(20, $y, 170, $yn - $y );
        $pdf->Rect(20, $y, 130, $yn - $y );
        
        if ($jshopConfig->show_product_code_in_order){
            $pdf->line(85, $y, 85, $yn);
        }
        $pdf->line(107, $y, 107, $yn);
        $pdf->line(125, $y, 125, $yn);
        
        $y = $yn; 
		
        
        if ($y > 260){
            $pdf->addNewPage();
            $y = 60;
        }
	}
    
	if ($y > 240){
        $pdf->addNewPage();
        $y = 60;
    }
	
	$pdf->SetFont('freesansb','',10);
    
    if (($jshopConfig->hide_tax || count($order->order_tax_list)==0) && $order->order_discount==0 && $order->order_payment==0 && $jshopConfig->without_shipping) $hide_subtotal = 1; else $hide_subtotal = 0;
		
    if (!$hide_subtotal){
	    $pdf->SetXY(20,$y);
	    $pdf->Rect(20,$y,170,5,'F');
	    $pdf->MultiCell(130,5,_JSHOP_SUBTOTAL,'1','R');	
	    $pdf->SetXY(150,$y);	
	    $pdf->MultiCell(40,5,formatprice($order->order_subtotal, $order->currency_code),'1','R');
    }else{
        $y = $y - 5;
    }
    
    if ($order->order_discount > 0){
        $y = $y + 5;     
        $pdf->SetXY(20,$y);
        $pdf->Rect(20,$y,170,5,'F');
        $pdf->MultiCell(130,5,_JSHOP_RABATT_VALUE,'1','R');
        $pdf->SetXY(150,$y);
        $pdf->MultiCell(40,5, "-".formatprice($order->order_discount, $order->currency_code),'1','R');       
    }
	
    if (!$jshopConfig->without_shipping){
	    $pdf->SetXY(20,$y + 5);
	    $pdf->Rect(20,$y + 5,170,5,'F');
	    $pdf->MultiCell(130,5,_JSHOP_SHIPPING_PRICE,'1','R');
	    $pdf->SetXY(150,$y + 5);
	    $pdf->MultiCell(40,5,formatprice($order->order_shipping, $order->currency_code),'1','R');
    }else{
        $y = $y - 5;
    }
    
    if ($order->order_payment > 0){
        $y = $y + 5;     
        $pdf->SetXY(20,$y+5);
        $pdf->Rect(20,$y+5,170,5,'F');
        $pdf->MultiCell(130,5, $order->payment_name,'1','R');
        $pdf->SetXY(150,$y+5);
        $pdf->MultiCell(40,5, formatprice($order->order_payment, $order->currency_code), '1','R');
    }
        
    $show_percent_tax = 0;        
    if (count($order->order_tax_list)>1 || $jshopConfig->show_tax_in_product) $show_percent_tax = 1;
    if ($jshopConfig->hide_tax) $show_percent_tax = 0;
	
    if (!$jshopConfig->hide_tax){
        foreach($order->order_tax_list as $percent=>$value){
	        $pdf->SetXY(20,$y + 10);
	        $pdf->Rect(20,$y + 10,170,5,'F');
            $text = displayTotalCartTaxName($order->display_price);
            if ($show_percent_tax) $text = $text." ".formattax($percent)."%";
	        $pdf->MultiCell(130,5,$text ,'1','R');        
            $pdf->SetXY(150,$y + 10);
            $pdf->MultiCell(40,5,formatprice($value, $order->currency_code),'1','R');    
            $y = $y + 5;
        }
    }
    
    $text_total = _JSHOP_ENDTOTAL;
    if (($jshopConfig->show_tax_in_product || $jshopConfig->show_tax_product_in_cart) && (count($order->order_tax_list)>0)){
        $text_total = _JSHOP_ENDTOTAL_INKL_TAX;
    }
    
	$pdf->SetXY(20,$y + 10);
	$pdf->Rect(20,$y + 10,170, 5.1,'F');
	$pdf->MultiCell(130, 5 , $text_total,'1','R');
	
	$pdf->SetXY(150,$y + 10);
	$pdf->MultiCell(40,5,formatprice($order->order_total, $order->currency_code),'1','R');
	
	$y = $y + 30;
    
    if ($y > 240){
        $pdf->addNewPage();
        $y = 60;
    }
    
	$pdf->SetFont('freesans','',7);
    
    $y2 = 0;
    if ($jshopConfig->benef_bank_info || $jshopConfig->benef_bic || $jshopConfig->benef_conto || $jshopConfig->benef_payee || $jshopConfig->benef_iban || $jshopConfig->benef_swift){
	    $pdf->SetXY(115, $y);
	    $pdf->Rect(115, $y, 75,4,'F');
	    $pdf->MultiCell(75,4,_JSHOP_BANK,'1','L');
    }
    
    if ($jshopConfig->benef_bank_info){
        $y2 += 4;
	    $pdf->SetXY(115, $y2 + $y);
	    $pdf->MultiCell(75,4,_JSHOP_BENEF_BANK_NAME,'1','L');
    }
    
    if ($jshopConfig->benef_bic){
        $y2 += 4;
	    $pdf->SetXY(115, $y2 + $y);
	    $pdf->MultiCell(75,4,_JSHOP_BENEF_BIC,'1','L');
    }
    
    if ($jshopConfig->benef_conto){
        $y2 += 4;
	    $pdf->SetXY(115, $y2 + $y);
	    $pdf->MultiCell(75,4,_JSHOP_BENEF_CONTO,'1','L');
    }
    
    if ($jshopConfig->benef_payee){
        $y2 += 4;
        $pdf->SetXY(115, $y2 + $y);
        $pdf->MultiCell(75,4,_JSHOP_BENEF_PAYEE,'1','L');
    }
	
    if ($jshopConfig->benef_iban){
        $y2 += 4;
	    $pdf->SetXY(115, $y2 + $y);
	    $pdf->MultiCell(75,4,_JSHOP_BENEF_IBAN,'1','L');
    }
	
    if ($jshopConfig->benef_swift){
        $y2 += 4;
	    $pdf->SetXY(115, $y2 + $y);
	    $pdf->MultiCell(75,4,_JSHOP_BENEF_SWIFT,'1','L');
    }
	
    if ($jshopConfig->interm_name || $jshopConfig->interm_swift){
        $y2 += 4;
	    $pdf->Rect(115,$y2 + $y,75,4,'F');
	    $pdf->SetXY(115, $y2 + $y);
	    $pdf->MultiCell(75,4,_JSHOP_INTERM_BANK,'1','L');
    }
	
    if ($jshopConfig->interm_name){
        $y2 += 4;
	    $pdf->SetXY(115, $y2 + $y);
	    $pdf->MultiCell(75,4,_JSHOP_INTERM_NAME,'1','L');
    }
	
    if ($jshopConfig->interm_swift){
        $y2 += 4;
	    $pdf->SetXY(115, $y2 + $y);
	    $pdf->MultiCell(75,4,_JSHOP_INTERM_SWIFT,'1','L');
    }
    
    
    $y2 = 0;
    if ($jshopConfig->benef_bank_info){
        $y2 += 4;
        $pdf->SetXY(115, $y2 + $y);
        $pdf->MultiCell(75,4,$jshopConfig->benef_bank_info,'0','R');
    }
    
    if ($jshopConfig->benef_bic){
	    $y2 += 4;
        $pdf->SetXY(115, $y2 + $y);
	    $pdf->MultiCell(75,4,$jshopConfig->benef_bic,'0','R');
    }
	
    if ($jshopConfig->benef_conto){
	    $y2 += 4;
        $pdf->SetXY(115, $y2 + $y);
	    $pdf->MultiCell(75,4,$jshopConfig->benef_conto,'0','R');
    }
	
    if ($jshopConfig->benef_payee){
        $y2 += 4;
        $pdf->SetXY(115, $y2 + $y);
        $pdf->MultiCell(75,4,$jshopConfig->benef_payee,'0','R');
    }
    
    if ($jshopConfig->benef_iban){
	    $y2 += 4;
        $pdf->SetXY(115, $y2 + $y);
	    $pdf->MultiCell(75,4,$jshopConfig->benef_iban,'0','R');
    }
	
    if ($jshopConfig->benef_swift){
	    $y2 += 4;
        $pdf->SetXY(115, $y2 + $y);
	    $pdf->MultiCell(75,4,$jshopConfig->benef_swift,'0','R');
    }
	
    $y2 += 4;
	if ($jshopConfig->interm_name){
	    $y2 += 4;
        $pdf->SetXY(115, $y2 + $y);
	    $pdf->MultiCell(75,4,$jshopConfig->interm_name,'0','R');
    }
	
    if ($jshopConfig->interm_swift){
	    $y2 += 4;
        $pdf->SetXY(115, $y2 + $y);
	    $pdf->MultiCell(75,4,$jshopConfig->interm_swift,'0','R');
    }
    
	$name_pdf = $order->order_id."_".md5(uniqid(rand(0,100))) . ".pdf";
	$pdf->Output($jshopConfig->pdf_orders_path."/".$name_pdf ,'F');    
	return $name_pdf;
}
?>