<?php
/*
 * THE SIMPLE HTML INVOICE THEME
 */

// HTML HEADER & STYLES
if($_SESSION["language"] == "ar_EG"){
	$this->data = "<!DOCTYPE html><html><head><link href=\"../../layout/css/report.css\" rel=\"stylesheet\"><title>تقرير المبيعات </title></head><body><div id='invoice'> <style> body{direction:rtl;}	.right{text-align:left;} </style>";
} else {
	$this->data = "<!DOCTYPE html><html><head><link href=\"../../layout/css/report.css\" rel=\"stylesheet\"> <title>Sale Report</title></head><body><div id='invoice'></head><body><div id='invoice'><style>.right{text-align:right;} </style>";
}



// COMPANY LOGO + INFORMATION
$this->data .= "<table id='company'><tr><td><img src='".$this->company[0]."'/></td><td class='right'>";
for ($i=1;$i<count($this->company);$i++) {
	$this->data .= "<div>".$this->company[$i]."</div>";
}
$this->data .= "</td></tr></table>";
if($_SESSION["language"] == "ar_EG"){
	$this->data .="<style>body{direction:rtl;} .right{text-align:left;}</style>";
	$this->data .= "<div id='bigi'>
<p> تقرير المبيعات </p>
<button class='btn main-btn print-btn' onclick=\" 
                           printS()
                            \">   طباعة التقرير </button>
</div>";
	

}else {
		$this->data .= "<div id='bigi'><p>";
		//	$this->data .=$test[1] ;
	$this->data .= " Sale report</p>
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
	$this->data .= "<table id='items'><tr><th>رقم الفاتورة</th><th>العميل</th><th> اسم الخدمة|المنتج </th><th>السعر</th><th>الكمية</th><th>الإجمالي</th><th>التاريخ</th><th>اسم المستخدم</th><th>النوع</th></tr>";
}
else
$this->data .= "<table id='items'><tr><th>Reference No</th><th>Customer</th><th>Product Name</th><th>Price</th><th>Quantity</th><th>Total Price</th><th>Date</th><th>User name</th><th>Type</th></tr>";
foreach ($this->items as $i) {
	$this->data .= "<tr><td><div>".$i[0]."</div>"."</td><td>".$i[1]."</td><td>".$i[2]."</td><td>".$i[3]."</td><td>".$i[4]."</td><td>".$i[5]."</td><td>".$i[6]."</td><td>".$i[7]."</td><td>";
	// ($i[8]=="S"?($_SESSION["language"] == "ar_EG"?"خدمة":"Service"):($_SESSION["language"] == "ar_EG"?"منتج":"Product"))
	if($_SESSION["language"] == "ar_EG"){
		if($i[8]=="PR")
		$this->data .="إرجاع";
		else if($i[8]=="S")
		$this->data .="خدمة";
		else
		$this->data .="منتج";
	}
	else{
		if($i[8]=="PR")
		$this->data .="Refund";
		else if($i[8]=="S")
		$this->data .="Service";
		else
		$this->data .="Product";
	}
	
	$this->data .="</td></tr>";
}

$this->data .= "</table>";


$this->data .= "<div class='bottom-total'>";
// TOTALS
if (count($this->totals)>0) { foreach ($this->totals as $t) {
	$this->data .= "<div class='ttl'><p>$t[0]</p><p>$t[1]</p></div>";
}}
$this->data .= "</div>";

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