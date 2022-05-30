<?php

// HTML HEADER & STYLES
if($_SESSION["language"] == "ar_EG"){
	$this->data = "<!DOCTYPE html><html><head><style>".
"html,body{font-family:sans-serif}#invoice{direction: rtl;max-width:800px;margin:0 auto}#company {direction: ltr;}#bigi{background: #efefef;margin-bottom:20px;font-size:28px;font-weight:bold;color:#ad132f;padding:10px}#company,#billship{margin-bottom:30px}#company img{max-width:180px;height:auto}#billship,#company,#items{width:100%;border-collapse:collapse}#billship td{width:33%}#billship td,#items td,#items th{padding:10px}#items th{text-align:right;border-top: 2px solid #64c6ff;border-bottom: 2px solid #64c6ff;background: #89beff;color: #fff;}#items td{border-bottom:1px solid #ccc}.idesc{color:#999}.ttl{background:#fafafa;font-weight:700}.right{text-align:right;}.left{text-align:left;}#notes{background:#efefef;padding:10px;margin-top:30px}".
"</style></head><body><div id='invoice'>";
} else {
	$this->data = "<!DOCTYPE html><html><head><style>".
"html,body{font-family:sans-serif}#invoice{max-width:800px;margin:0 auto}#bigi{background: #efefef;margin-bottom:20px;font-size:28px;font-weight:bold;color:#ad132f;padding:10px}#company,#billship{margin-bottom:30px}#company img{max-width:180px;height:auto}#billship,#company,#items{width:100%;border-collapse:collapse}#billship td{width:33%}#billship td,#items td,#items th{padding:10px}#items th{text-align:left;border-top: 2px solid #64c6ff;border-bottom: 2px solid #64c6ff;background: #89beff;color: #fff;}#items td{border-bottom:1px solid #ccc}.idesc{color:#999}.ttl{text-align: left;background:#fafafa;font-weight:700}.right{text-align:right}#notes{background:#efefef;padding:10px;margin-top:30px}".
"</style></head><body><div id='invoice'>";
}

// COMPANY LOGO + INFORMATION
$this->data .= "<table id='company'><tr><td><img src='".$this->company[0]."'/></td><td class='right'>";
for ($i=2;$i<count($this->company);$i++) {
	$this->data .= "<div>".$this->company[$i]."</div>";
}
$this->data .= "</td></tr></table>";

if($_SESSION["language"] == "ar_EG"){
	$this->data .= "<div id='bigi'>تقارير المشتريات</div>";
}else {
	$this->data .= "<div id='bigi'>Purchase Reports</div>";
}

// ITEMS
if($_SESSION["language"] == "ar_EG"){
$this->data .= "<table id='items'><tr><th>رقم المرجع</th><th>المورد</th><th>المنتج</th><th>الكمية</th><th>السعر</th><th>التاريخ</th></tr>";
} else {
	$this->data .= "<table id='items'><tr><th>Reference No</th><th>Supplier</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Date</th></tr>";
}
foreach ($this->items as $i) {
	$this->data .= "<tr><td><div>".$i[0]."</div>"."</td><td>".$i[1]."</td><td>".$i[2]."</td><td>".$i[3]."</td><td>".$i[4]."</td><td>".$i[5]."</td></tr>";
}
// TOTALS
if (count($this->totals)>0) { foreach ($this->totals as $t) {
	$this->data .= "<tr class='ttl'><td class='left' colspan='5'>$t[0]</td><td>$t[1]</td></tr>";
}}
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