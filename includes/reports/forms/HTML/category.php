<?php
/*
 * THE SIMPLE HTML INVOICE THEME
 */

// HTML HEADER & STYLES
$test = explode('|',  $_REQUEST["category"]);
if($_SESSION["language"] == "ar_EG"){
	$this->data = "<!DOCTYPE html><html><head><link href=\"../../layout/css/report.css\" rel=\"stylesheet\"><title>".$test[1] ."</title></head><body><div id='invoice'> <style> body{direction:rtl;}	.right{text-align:left;} </style>";
} else {
	$this->data = "<!DOCTYPE html><html><head><link href=\"../../layout/css/report.css\" rel=\"stylesheet\"> <title>".$test[1] ."</title></head><body><div id='invoice'></head><body><div id='invoice'><style>.right{text-align:right;} </style>";
}


// COMPANY LOGO + INFORMATION
$this->data .= "<table id='company'><tr><td><img src='".$this->company[0]."'/></td><td class='right'>";
for ($i=1;$i<count($this->company);$i++) {
	$this->data .= "<div>".$this->company[$i]."</div>";
}
$this->data .= "</td></tr></table>";

if($_SESSION["language"] == "ar_EG"){
	$this->data .= "<div id='bigi'>
<p> تقرير ";
	$this->data .=$test[1] .
	 " </p>
	 <button class='btn main-btn print-btn' onclick=\" 
	 printS()
	  \">   طباعة التقرير </button>
</div>";
	

}else {
		$this->data .= "<div id='bigi'><p>";
			$this->data .=$test[1] ;
	$this->data .= " report</p>
	<button class='btn main-btn print-btn' onclick=\" 
	printS()
		\">Print Report </button>
	</div>";
}

// INVOICE INFO
$this->data .= "</td><td>";
foreach ($this->invoice as $i) {
	$this->data .= "<strong>$i[0]:</strong> $i[1]<br>";
}
$this->data .= "</td></tr></table>";

// ITEMS
if($_SESSION["language"] == "ar_EG"){
	$this->data .= "<table id='items'><tr><th>اسم المنتج</th><th>الكميةالمشتراه</th><th>سعر الشراء</th><th>الكميه المباعة</th><th>سعر البيع</th><th> الربح</th></tr>
	";
} else {
	$this->data .= "<table id='items'><tr><th>Product Name</th><th>Purchase Quantity</th><th>Purchase Price</th><th>Sale Quantity</th><th>Sale Price</th><th>Profit</th></tr>";
}
foreach ($this->items as $i) {
	$this->data .= "<tr><td><div>".$i[0]."</div>"."</td><td><div>".$i[1]."</div>"."</td><td>".$i[2]."</td><td>".$i[3]."</td><td>".$i[4]."</td><td>". (floatval($i[4])-floatval($i[2]) )."</td></tr>";
}
$this->data .= "</table>";
// TOTALS

if (count($this->totals)>0) { 
	$purchase_price=0;
	$sale_price=0;
	$refund_price=0;

	$this->data .= "<div class='bottom-total'>";
	foreach ($this->totals as $t) {
	if($t[0]=="purchase"){
		$purchase_price=$t[1];	
		}else if($t[0]=="refund")
		$refund_price=$t[1];
			else{
			$sale_price=$t[1];
			}
}
// floatval($sale_price)-floatval($purchase_price)
if($_SESSION["language"] == "ar_EG"){
	$this->data .= "<div class='ttl'><p >اجمالي المشتريات:</p><p >".number_format($purchase_price)."</p></div>";
	$this->data .= "<div class='ttl'><p >اجمالي المبيعات:</p><p >".number_format($sale_price-$refund_price)."</p></div>";
	$this->data .= "<div class='ttl'><p > الربح:</p><p>".number_format((floatval($sale_price)-floatval($purchase_price)-floatval($refund_price)))."</p></div>";
}
else{	
	$this->data .= "<div class='ttl'><p >Total Purchase:</p><p >".number_format($purchase_price)."</p></div>";
	$this->data .= "<div class='ttl'><p >Total Sales:</p><p >".number_format($sale_price-$refund_price)."</p></div>";
$this->data .= "<div class='ttl'><p > Profit:</p><p>".number_format((floatval($sale_price)-floatval($purchase_price)-floatval($refund_price)))."</p></div>";
		$this->data .= "</div>";}
}



// NOTES
if (count($this->notes)>0) {
	$this->data .= "<div id='notes'>";
	foreach ($this->notes as $n) {
		$this->data .= $n."<br>";
	}
	$this->data .= "</div>";
}

// CLOSE
$this->data .= "</div>"; ?>
<script>
function printS() {
    window.PPClose = false; // Clear Close Flag
    window.onbeforeunload = function() { // Before Window Close Event
        if (window.PPClose === false) { // Close not OK?
            return 'Leaving this page will block the parent window!\nPlease select "Stay on this Page option" and use the\nCancel button instead to close the Print Preview Window.\n';
        }
    }
    var printButton = document.querySelector(".print-btn");
    //Set the print button visibility to 'hidden' 
    printButton.style.visibility = 'hidden';
    window.print();
    printButton.style.visibility = 'visible'; // Print preview
    window.PPClose = true;
}
</script>
<?php $this->data .= "</body></html>";
?>