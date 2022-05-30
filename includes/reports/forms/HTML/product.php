<?php
/*
 * THE SIMPLE HTML INVOICE THEME
 */
$test = explode('|',  $_REQUEST["products"]);
// HTML HEADER & STYLES
if($_SESSION["language"] == "ar_EG"){
	$this->data = "<!DOCTYPE html><html><head><link href=\"../../layout/css/report.css\" rel=\"stylesheet\"><title>".$test[1] ."</title></head><body><div id='invoice'> <style> body{direction:rtl;}	.right{text-align:left;} </style>";
} else {
	$this->data = "<!DOCTYPE html><html><head><link href=\"../../layout/css/report.css\" rel=\"stylesheet\"><title>".$test[1] ."</title> </head><body><div id='invoice'></head><body><div id='invoice'><style>.right{text-align:right;} </style>";
}

// $this->data .= 
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
// BILL TO
// $this->data .= "<table id='billship'><tr><td><strong>BILL TO</strong><br>";
// foreach ($this->billto as $b) { $this->data .= $b."<br>"; }

// SHIP TO
// $this->data .= "</td><td><strong>SHIP TO</strong><br>";
// foreach ($this->shipto as $s) { $this->data .= $s."<br>"; }

// INVOICE INFO
$this->data .= "</td><td>";
foreach ($this->invoice as $i) {
	$this->data .= "<strong>$i[0]:</strong> $i[1]<br>";
}
$this->data .= "</td></tr></table>";

// ITEMS
if($_SESSION["language"] == "ar_EG"){
	if($_REQUEST["typeOf"]=="service")
	$this->data .= "<table id='items'><tr><th>التاريخ</th><th>الكمية</th><th>السعر</th><th>الإجمالي</th><th>اسم المستخدم</th></tr>
	";
	else
	$this->data .= "<table id='items'><tr><th>التاريخ</th><th>الكمية</th><th>السعر</th><th>الإجمالي</th><th>اسم المستخدم</th><th>نوع العملية
	</th></tr>
	";
} else {
	if($_REQUEST["typeOf"]=="service")
$this->data .= "<table id='items'><tr><th>Date</th><th>Quantity</th><th>Price</th><th>Total</th><th>User Name</th></tr>";
	else
	$this->data .= "<table id='items'><tr><th>Date</th><th>Quantity</th><th>Price</th><th>Total</th><th>User Name</th><th>Type of Trans
	</th></tr>";
}
foreach ($this->items as $i) {
	$this->data .= "<tr><td><div>".date('Y-m-d', strtotime($i[0]))."</div>"."</td><td>".$i[1]."</td><td>".$i[2]."</td><td>".(intval($i[1]) *intval($i[2])) ."</td><td>".$i[3]."</td>";
	if($_REQUEST["typeOf"]!="service"){
		$this->data .="<td>";
	if($_SESSION["language"] == "ar_EG"){
		if($i[4]=="sale")
		$this->data .= "بيع";
		else if($i[4]=="refund")
		$this->data .= "إرجاع";
		else if($i[4]=="purchase"){
			if($i[5]==5)
			$this->data .="ارجاع شراء";
			else if($i[5]==6)
			$this->data .="ارجاع شراء جزئي";
			else $this->data .="شراء";
		}
		
}else {
   if($i[4]=="purchase"){
	   	if($i[5]==5)
			$this->data .="purchase refund";
			else if($i[5]==6)
			$this->data .="partial purchase refund";
			else 
		$this->data .= $i[4];
   }
   else
	$this->data .= $i[4];
}
$this->data .="</td>";
}
	$this->data .="</tr>";
}

// TOTALS
if (count($this->totals)>0) { foreach ($this->totals as $t) {
	$this->data .= "<tr class='ttl'><td class='right' colspan='2'>$t[0]</td><td>$t[1]</td><td>$t[2]</td></tr>";
}}
$this->data .= "</table>";
// ITEMS
foreach ($this->item as $i) {
	if($_SESSION["language"] == "ar_EG"){
	if($_REQUEST["typeOf"]=="service")
	$this->data .= "<div class='bottom-total'><div class='ttl'><p> الإجمالي:</p><p> ".$i[2]."</p></div>";
	else
	$this->data .= "<div class='bottom-total'><div class='ttl'><p>اجمالي المشتريات: </p><p>".$i[0]."</p></div> <div class='ttl'><p>اجمالي المبيعات:</p><p>".$i[1]."</p></div><div class='ttl'><p>اجمالي الربح:</p><p>".$i[2]."</p></div></div>";
} else {
		if($_REQUEST["typeOf"]=="service")
		$this->data .= "<div class='bottom-total'><div class='ttl'><p>Total:</p><p> ".$i[2]."</p></div>";
		else
	$this->data.= "<div class='bottom-total'><div class='ttl'><p>Total Purchase: </p><p>".$i[0]."</p></div> <div class='ttl'><p>Total Sales:</p><p>".$i[1]."</p></div><div class='ttl'><p>Profit:</p><p>".$i[2]."</p></div></div>";
}
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