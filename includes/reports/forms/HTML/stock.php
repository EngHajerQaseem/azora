<?php
/*
 * THE SIMPLE HTML INVOICE THEME
 */

 
// HTML HEADER & STYLES
$this->data = "<!DOCTYPE html><html><head><style>".
"/head><body><div id='invoice'>";

// COMPANY LOGO + INFORMATION
$this->data .= "<table id='company'><tr><td><img src='".$this->company[0]."'/></td><td class='right'>";
for ($i=1;$i<count($this->company);$i++) {
	$this->data .= "<div>".$this->company[$i]."</div>";
}
$this->data .= "</td></tr></table>";
// $this->data .= "<convas id='pie-chart' width='100%' height='100%'>SALES INVOICE</convas>";

// BILL TO
// $this->data .= "<table id='billship'><tr><td><strong>BILL TO</strong><br>";
// foreach ($this->billto as $b) { $this->data .= $b."<br>"; }

// SHIP TO
// $this->data .= "</td><td><strong>SHIP TO</strong><br>";
// foreach ($this->shipto as $s) { $this->data .= $s."<br>"; }

// INVOICE INFO
// $this->data .= "</td><td>";
// foreach ($this->invoice as $i) {
// 	$this->data .= "<strong>$i[0]:</strong> $i[1]<br>";
// }
// $this->data .= "</td></tr></table>";

// ITEMS
// $this->data .= "<table id='items'><tr><th>Stock Value (All Products)</th></tr>";
// foreach ($this->items as $i) {
// 	$this->data .= "<tr><td><div>".$i[0]."</div>"."</td><td>".$i[1]."</td><td>".$i[2]."</td></tr>";
// }

// // TOTALS
// if (count($this->totals)>0) { foreach ($this->totals as $t) {
// 	$this->data .= "<tr class='ttl'><td class='right' colspan='2'>$t[0]</td><td>$t[1]</td></tr>";
// }}
// $this->data .= "</table>";


// NOTES
if (count($this->notes)>0) {
	$this->data .= "<canvas id='pie-chart' width='100%' height='100%'>";	
	$this->data .= "</canvas>";
}

// CLOSE
$this->data .= "</div></body></html>";
?>