<?php

// HTML HEADER & STYLES
if($_SESSION["language"] == "ar_EG"){
$this->data = "<!DOCTYPE html><html><head><style>".
"html,body{direction: rtl;font-family:DejaVuSans}#bigi{background: #efefef;margin-bottom:20px;font-size:28px;font-weight:bold;color:#ad132f;padding:10px}#company,#billship{margin-bottom:30px}#company img{max-width:180px;height:auto}#billship,#company,#items{width:100%;}#billship td{width:33%}#items th{text-align: right;padding: 10px;border-top: 2px solid #64c6ff;border-bottom: 2px solid #64c6ff;background: #89beff;color: #fff;}#items td{padding:10px;border-bottom:1px solid #ccc}.idesc{color:#999}.ttl{background:#fafafa;font-weight:700}.right{text-align:right}#notes{background: #e6e6e6;padding: 10px;margin-top: 30px;height: 12px;display:flex;}#billship td {border-bottom: 1px solid #efefef;padding: 40px 20px;}.small-sq {float: left;background-color: #f00;position: relative;content: '';display: inline-block;width: 8px;height: 8px;top: 2px;margin-right: 4px;}.color-container {display: flex;margin-right: 10px;}.red_hex {width:100%;height:auto;display: flex;font-size: 11px;color: #fff;}.oneday .small-sq {background-color: #fff;}.oneThirtyday .small-sq {background-color: #ffc4c4;}.thirtySixtyday .small-sq {background-color: #ff8989;}.red1 {color: #660000;}.red2 {color: #8f0000;}.red3 {color: #cd0000;}.t-paddig {padding-top:10px;}.color-desc{float:left;width:10%}.any:first-child{background:#000}"."</style></head><body><div id='invoice'>";
} else {
	$this->data = "<!DOCTYPE html><html><head><style>".
"html,body{font-family:DejaVuSans}#bigi{background: #efefef;margin-bottom:20px;font-size:28px;font-weight:bold;color:#ad132f;padding:10px}#company,#billship{margin-bottom:30px}#company img{max-width:180px;height:auto}#billship,#company,#items{width:100%;}#billship td{width:33%}#items th{text-align: left;padding: 10px;border-top: 2px solid #64c6ff;border-bottom: 2px solid #64c6ff;background: #89beff;color: #fff;}#items td{padding:10px;border-bottom:1px solid #ccc}.idesc{color:#999}.ttl{background:#fafafa;font-weight:700}.right{text-align:right}#notes{background: #e6e6e6;padding: 10px;margin-top: 30px;height: 12px;display:flex;}#billship td {border-bottom: 1px solid #efefef;padding: 40px 20px;}.small-sq {float: left;background-color: #f00;position: relative;content: '';display: inline-block;width: 8px;height: 8px;top: 2px;margin-right: 4px;}.color-container {display: flex;margin-right: 10px;}.red_hex {width:100%;height:auto;display: flex;font-size: 11px;color: #fff;}.oneday .small-sq {background-color: #fff;}.oneThirtyday .small-sq {background-color: #ffc4c4;}.thirtySixtyday .small-sq {background-color: #ff8989;}.red1 {color: #660000;}.red2 {color: #8f0000;}.red3 {color: #cd0000;}.t-paddig {padding-top:10px;}.color-desc{float:left;width:10%}.any:first-child{background:#000}"."</style></head><body><div id='invoice'>";
}
// COMPANY LOGO + INFORMATION
$this->data .= "<table dir='ltr' id='company'><tr><td><img src='".$this->company[0]."'/></td><td class='right'>";
for ($i=2;$i<count($this->company);$i++) {
	$this->data .= "<div>".$this->company[$i]."</div>";
}
$this->data .= "</td></tr></table>";

if($_SESSION["language"] == "ar_EG"){
	$this->data .= "<div id='bigi'>تقارير العملاء</div>";
}else {
	$this->data .= "<div id='bigi'>Customer reports</div>";
}

// BILL TO
if($_SESSION["language"] == "ar_EG"){
$this->data .= "<table id='billship'><tr><td><strong>اسم العميل</strong><br>";
} else {
	$this->data .= "<table id='billship'><tr><td><strong>Customer Name</strong><br>";	
}
foreach ($this->billto as $b) { $this->data .= $b."<br>"; }

// SHIP TO
if($_SESSION["language"] == "ar_EG"){
$this->data .= "</td><td><strong>تفاصيل العميل</strong><br>";
} else {
	$this->data .= "</td><td><strong>Customer Details</strong><br>";
}
foreach ($this->shipto as $s) { $this->data .= $s."<br>"; }

// INVOICE INFO
$this->data .= "</td><td style='color: #fff;text-align:center;font-weight:bold;font-size:22px;margin-buttom: 32px;background: #89beff;'>";
foreach ($this->invoice as $i) {
	$this->data .= "<div class='any'>$i[1]</div> <div class='price any' style='font-size:18px'>$i[0]</div>
	
	";

}
$this->data .= "</td></tr></table>";


// ITEMS
if($_SESSION["language"] == "ar_EG"){
	$this->data .= "<table id='items'><tr><th>رقم الفاتورة</th><th>التاريخ</th><th>الإجمالي</th><th>المدفوع</th><th>الحالة</th></tr>";
} else {
	$this->data .= "<table id='items'><tr><th>Invoice.No</th><th>Date</th><th>Total</th><th>Paid</th><th>Status</th></tr>";
}
foreach ($this->items as $i) {
	$this->data .= "<tr><td>".$i[0].""."</td><td>".$i[1]."</td><td>".$i[2]."</td><td>".$i[3]."</td><td>".$i[4]."</td></tr>";
}
// TOTALS
if (count($this->totals)>0) { foreach ($this->totals as $t) {
	$this->data .= "<tr class='ttl'><td class='right' colspan='3'>$t[0]</td><td>$t[1]</td></tr>";
}}
$this->data .= "</table>";



// NOTES
if (count($this->notes)>0) {
	$this->data .= "<div id='notes' style='display: flex;'>";
	foreach ($this->notes as $n) {
		if($_SESSION["language"] == "ar_EG"){
			$this->data .= $n."<div class='red_hex' style='flex-direction: row;flex-wrap: nowrap'>		
			<div dir='rtl' class='right color-desc' style='color:000;inline-block;float: right; '>
				اليوم
			</div>	          
			<div class=' right color-desc' style='color:#660000;inline-block;float: right; '>
				1-30 أيام
			</div>		          
			<div class='right color-desc' style='color:#8f0000;inline-block;float: right;'>
				31-60 أيام
			</div>		          
			<div class='right color-desc' style='color:#cd0000;inline-block;float: right; '>
				+60 أيام
			</div>		
			</div>";
		} else {
			$this->data .= $n."<div class='red_hex' style='flex-direction: row;flex-wrap: nowrap'>		
			<div class='color-desc' style='color:000;inline-block;float: right; '>
				Current day
			</div>	          
			<div class='color-desc' style='color:#660000;inline-block;float: right; '>
				1-30 days
			</div>		          
			<div class='color-desc' style='color:#8f0000;inline-block;float: right;'>
				31-60 days
			</div>		          
			<div class='color-desc' style='color:#cd0000;inline-block;float: right; '>
				+60 days
			</div>		
			</div>";
		}
	}
	$this->data .= "</div>";
}
// CLOSE
$this->data .= "</div></body></html>";
$mpdf->WriteHTML($this->data);
?>