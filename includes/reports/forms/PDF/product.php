<?php

// HTML HEADER & STYLES
if($_SESSION["language"] == "ar_EG"){
$this->data = "<!DOCTYPE html><html><head><style>".
"html,body{direction: rtl;font-family:DejaVuSans}#bigi{background: #efefef;margin-bottom:20px;font-size:28px;
	font-weight:bold;color:#ad132f;padding:10px}#company,#billship{margin-bottom:30px}
	#company img{max-width:180px;height:auto}#billship,#company,#items{width:100%;border-collapse:collapse}#billship td{width:33%}#billship td,
	#items td,#items th{padding:10px}#items th{text-align:right;border-top: 2px solid #64c6ff;border-bottom: 2px solid #64c6ff;background: #89beff;color: #fff;}#items td{border-bottom:1px solid #ccc}
	.idesc{color:#999}.header{display:block;}.header:not(:first){display:none;}.ttl{background:#fafafa;font-weight:700}.right{text-align:right}#notes{background:#efefef;padding:10px;margin-top:30px}".
"</style></head><body><div id='invoice'>";
}else {
	$this->data = "<!DOCTYPE html><html><head><style>".
	"html,body{font-family:DejaVuSans}#bigi{background: #efefef;margin-bottom:20px;font-size:28px;
		font-weight:bold;color:#ad132f;padding:10px}#company,#billship{margin-bottom:30px}
		#company img{max-width:180px;height:auto}#billship,#company,#items{width:100%;border-collapse:collapse}#billship td{width:33%}#billship td,
		#items td,#items th{padding:10px}#items th{text-align:left;border-top: 2px solid #64c6ff;border-bottom: 2px solid #64c6ff;background: #89beff;color: #fff;}#items td{border-bottom:1px solid #ccc}
		.idesc{color:#999}.header{display:block;}.header:not(:first){display:none;}.ttl{background:#fafafa;font-weight:700}.right{text-align:right}#notes{background:#efefef;padding:10px;margin-top:30px}".
	"</style></head><body><div id='invoice'>";
	}


// COMPANY LOGO + INFORMATION
$this->data .= "<table dir='ltr' id='company'><tr><td><img src='".$this->company[0]."'/></td><td class='right'>";
for ($i=2;$i<count($this->company);$i++) {
	$this->data .= "<div>".$this->company[$i]."</div>";
}
$this->data .= "</td></tr></table>";
if($_SESSION["language"] == "ar_EG"){
	$this->data .= "<div id='bigi'>تقارير المنتجات</div>";
}else {
	$this->data .= "<div id='bigi'>Products reports</div>";
}

// BILL TO
// $this->data .= "<table id='billship'><tr><td><strong>BILL TO</strong><br>";
// foreach ($this->billto as $b) { $this->data .= $b."<br>"; }

// SHIP TO
// $this->data .= "</td><td><strong>SHIP TO</strong><br>";
// foreach ($this->shipto as $s) { $this->data .= $s."<br>"; }

// // INVOICE INFO
// $this->data .= "</td><td>";
// foreach ($this->invoice as $i) {
// 	$this->data .= "<strong>$i[0]:</strong> $i[1]<br>";
// }
// $this->data .= "</td></tr></table>";


// ITEMS
if($_SESSION["language"] == "ar_EG"){
	$this->data .= "<table id='items'><tr><th>المنتج</th><th>المشتريات</th><th>المبيعات</th><th>الربح</th></tr>";
} else {
	$this->data .= "<table id='items'><tr><th>Product</th><th>Purchase</th><th>Sales</th><th>profit</th></tr>";
}
foreach ($this->items as $i) {
	$this->data .= "<tr><td><div>".$i[0]."</div>"."</td><td>".$i[1]."</td><td>".$i[2]."</td><td>".$i[3]."</td></tr>";
}
// TOTALS
if (count($this->totals)>0) { foreach ($this->totals as $t) {
	$this->data .= "<tr class='ttl'><td class='right' colspan='3'>$t[0]</td><td>$t[1]</td><td>$t[2]</td></tr>";
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