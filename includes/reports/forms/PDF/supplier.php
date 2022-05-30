<?php

// HTML HEADER & STYLES
if($_SESSION["language"] == "ar_EG"){
	$this->data = "<!DOCTYPE html><html><head><style>".
"html,body{font-family:sans-serif}#invoice{direction: rtl;max-width:800px;margin:0 auto}#company {direction: ltr;}#bigi{background: #efefef;margin-bottom:20px;font-size:28px;font-weight:bold;color:#ad132f;padding:10px}#company,#billship{margin-bottom:30px}#company img{max-width:180px;height:auto}#billship,#company,#items{width:100%;border-collapse:collapse}#billship td{width:33%}#billship td,#items td,#items th{padding:10px}#items th{text-align:right;border-top: 2px solid #64c6ff;border-bottom: 2px solid #64c6ff;background: #89beff;color: #fff;}#items td{border-bottom:1px solid #ccc}.idesc{color:#999}.ttl{background:#fafafa;font-weight:700}.right{text-align:right;}.left{text-align:left;}#notes{background:#efefef;padding:10px;margin-top:30px} .red1 {color: #660000;}.red2 {color: #8f0000;}.red3 {color: #cd0000;}.t-paddig {padding-top:10px;}}".
"</style></head><body><div id='invoice'>";
} else {
	$this->data = "<!DOCTYPE html><html><head><style>".
"html,body{font-family:sans-serif}#invoice{max-width:800px;margin:0 auto}#bigi{background: #efefef;margin-bottom:20px;font-size:28px;font-weight:bold;color:#ad132f;padding:10px}#company,#billship{margin-bottom:30px}#company img{max-width:180px;height:auto}#billship,#company,#items{width:100%;border-collapse:collapse}#billship td{width:33%}#billship td,#items td,#items th{padding:10px}#items th{text-align:left;border-top: 2px solid #64c6ff;border-bottom: 2px solid #64c6ff;background: #89beff;color: #fff;}#items td{border-bottom:1px solid #ccc}.idesc{color:#999}.ttl{text-align: left;background:#fafafa;font-weight:700}.right{text-align:right}#notes{background:#efefef;padding:10px;margin-top:30px} .red1 {color: #660000;}.red2 {color: #8f0000;}.red3 {color: #cd0000;}.t-paddig {padding-top:10px;}".
"</style></head><body><div id='invoice'>";
}

// COMPANY LOGO + INFORMATION
$this->data .= "<table id='company'><tr><td><img src='".$this->company[0]."'/></td><td class='right'>";
for ($i=2;$i<count($this->company);$i++) {
	$this->data .= "<div>".$this->company[$i]."</div>";
}
$this->data .= "</td></tr></table>";

if($_SESSION["language"] == "ar_EG"){
	$this->data .= "<div id='bigi'>تقرير المورد</div>";
}else {
	$this->data .= "<div id='bigi'>Supplier Report</div>";
}

// BILL TO
// $this->data .= "<table id='billship'><tr><td><strong>BILL TO</strong><br>";
// foreach ($this->billto as $b) { $this->data .= $b."<br>"; }

// SHIP TO
// $this->data .= "</td><td><strong>SHIP TO</strong><br>";
// foreach ($this->shipto as $s) { $this->data .= $s."<br>"; }

// // INVOICE INFO
// $this->data .= "<div id='supplier-info'>";
//  foreach ($this->suppliers as $s) {
// 	$this->data .= "<div class='supplier-desc'>
// 	$s[0]: <br><strong> $s[1]</strong><br>
// 	 $s[2]: <br><strong> $s[3]</strong>
// 	 </div>
// 	 <div class='supplier-debt'>
// 	 <p>debt</p>
// 	 </div>
// 	 ";
//  }
// $this->data .= "</div>";

// BILL TO
if($_SESSION["language"] == "ar_EG"){
	$this->data .= "<table id='billship'><tr><td><strong>اسم المورد</strong><br>";
	} else {
		$this->data .= "<table id='billship'><tr><td><strong>Supplier Name</strong><br>";	
	}
	foreach ($this->billto as $b) { $this->data .= $b[0]."<br>"; }
	
	// SHIP TO
	if($_SESSION["language"] == "ar_EG"){
	$this->data .= "</td><td><strong>تفاصيل المورد</strong><br>";
	} else {
		$this->data .= "</td><td><strong>Supplier Details</strong><br>";
	}
	foreach ($this->billto as $s) { $this->data .= $s[1]."<br>"; }
	
	// INVOICE INFO
	$this->data .= "</td><td style='color: #fff;text-align:center;font-weight:bold;font-size:22px;margin-buttom: 32px;background: #89beff;'>";
	foreach ($this->totals as $i) {
		$this->data .= "<div class='any'>$i[1]</div> <div class='price any' style='font-size:18px'>$i[0]</div>
		
		";
	
	}
	$this->data .= "</td></tr></table>";


// ITEMS
if($_SESSION["language"] == "ar_EG"){
	$this->data .= "<table id='items'><tr><th>التاريخ</th><th>مبلغ الشراء</th><th>المدفوع</th><th>إجمالي الدين</th><th>الحالة</th></tr>";
} else {
	$this->data .= "<table id='items'><tr><th>"._("supplier_date")."</th><th>"._("supplier_amount_of_purchse")."</th><th>"._("supplier_paid")."</th><th>"._("supplier_total_debit")."</th><th>Status</th></tr>";

}
foreach ($this->items as $i) {
	$this->data .= "<tr><td><div>".$i[0]."</div>"."</td><td>".$i[1]."</td><td>".$i[2]."</td><td>".$i[3]."</td><td>".$i[4]."</td></tr>";
}
// TOTALS
// if (count($this->totals)>0) { foreach ($this->totals as $t) {
// 	$this->data .= "<tr class='ttl'><td></td><td class='left' colspan='3'>$t[0]</td><td>$t[1]</td></tr>";
// }}
$this->data .= "</table>";


// NOTES
if (count($this->notes)>0) {
	$this->data .= "<div id='notes'>";
	foreach ($this->notes as $n) {
		$this->data .= $n."<br>";
	}
	$this->data .= "</div>";
}
// CLOSE
$this->data .= "</div></body></html>";
$mpdf->WriteHTML($this->data);
?>