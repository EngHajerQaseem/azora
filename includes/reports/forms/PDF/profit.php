<?php

// HTML HEADER & STYLES
if($_SESSION["language"] == "ar_EG"){
	$this->data = "<!DOCTYPE html><html><head><style>".
	"html,body{direction: rtl;font-family:DejaVuSans}#bigi{background: #efefef;margin-bottom:20px;font-size:28px;
		font-weight:bold;color:#ad132f;padding:10px}#company,#billship{margin-bottom:30px}
		#company img{max-width:180px;height:auto}#billship,#company,#items{width:100%;border-collapse:collapse}#billship td{width:33%}#billship td,
		#items td,#items th{padding:10px}#items th{border-bottom: 2px solid #000;text-align:right;background: #89beff;color: #fff;}#items td{border-bottom: 2px solid #000;border-bottom:1px solid #ccc}
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
$this->data .= "<div id='bigi'>Profit INVOICE</div>";

// ITEMS

foreach ($this->items as $i) {
	if($_SESSION["language"] == "ar_EG"){
	$this->data .= "<table id='items'><thead><tr><td class='bold'>إجمالي المبيعات</td><td>$i[0]</td></tr></thead>";
	$this->data .= "<tbody><tr><td class='bold'>تكلفة المبيعات</td><td>".$i[1]."</td></tr>"."<tr><td class='bold'>إجمالي الربح/ الخسارة</td><td>".$i[2]."</td></tr>"."<tr><td class='bold'>المصاريف الكلية</td><td>".$i[3]."</td><tr>"."<tr><td class='bold'>صافي الربح / الخسارة قبل الضرائب</td><td>".$i[4]."</td></tr>"."<tr><td class='bold'>إجمالي الضرائب</td><td>".$i[5]."</td></tr>"."<tr><td class='bold'>صافي الربح / الخسارة بعد الضرائب</td><td>".$i[6]."</td></tr></tbody>";
	} else {
		$this->data .= "<table id='items'><thead><tr><td class='bold'>"._("profit_total_sales")."</td><td>$i[0]</td></tr></thead>";
	$this->data .= "<tbody><tr><td class='bold'>"._("profit_cost_of_sales")."</td><td>".$i[1]."</td></tr>"."<tr><td class='bold'>"._("profit_groos_profit_loss")."</td><td>".$i[2]."</td></tr>"."<tr><td class='bold'>"._("profit_total_expense")."</td><td>".$i[3]."</td><tr>"."<tr><td class='bold'>"._("profit_net_profit_before_tax")."</td><td>".$i[4]."</td></tr>"."<tr><td class='bold'>"._("profit_total_tax")."</td><td>".$i[5]."</td></tr>"."<tr><td class='bold'>"._("profit_net_profit_after_tax")."</td><td>".$i[6]."</td></tr></tbody>";
	}
}
// TOTALS
if (count($this->totals)>0) { foreach ($this->totals as $t) {
	$this->data .= "<tr class='ttl'><td class='right' colspan='4'>$t[0]</td><td>$t[1]</td></tr>";
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