<?php
/*
 * THE SIMPLE HTML INVOICE THEME
 */

// HTML HEADER & STYLES
if($_SESSION["language"] == "ar_EG"){
	$this->data = "<!DOCTYPE html><html><head><link href=\"../../layout/css/report.css\" rel=\"stylesheet\"><title>تقرير العميل</title></head><body><div id='invoice'> <style> body{direction:rtl;}	.right{text-align:left;} </style>";
} else {
	$this->data = "<!DOCTYPE html><html><head><link href=\"../../layout/css/report.css\" rel=\"stylesheet\"><title>Customer Report</title> </head><body><div id='invoice'><style>.right{text-align:right;} </style>";
}


// COMPANY LOGO + INFORMATION
$this->data .= "<table id='company'><tr><td><img src='".$this->company[0]."'/></td><td class='right'>";
for ($i=1;$i<count($this->company);$i++) {
	$this->data .= "<div>".$this->company[$i]."</div>";
}
$this->data .= "</td></tr></table>";

if($_SESSION["language"] == "ar_EG"){
	$this->data .= "<div id='bigi'>تقرير العميل";
	
	$this->data .= "<button class='btn main-btn print-btn' onclick=\" 
	printS()
	 \">   طباعة التقرير </button>
</div>";
	

}else {
	$this->data .= "<div id='bigi'>Customer Report";
			
	$this->data .= "
	<button class='btn main-btn print-btn' onclick=\" 
	printS()
		\">Print Report </button>
	</div>";
}
// BILL TO
if($_SESSION["language"] == "ar_EG"){
$this->data .= "<div id='billship'><div><strong>اسم العميل</strong><br>";
foreach ($this->billto as $b) { $this->data .= $b."<br>"; }

// SHIP TO
$this->data .= "</div><div><strong>تفاصيل العميل</strong><br>";
foreach ($this->shipto as $s) { $this->data .= $s."<br>"; }
}
else{
	$this->data .= "<div id='billship'><div><strong>Customer Name</strong><br>";
foreach ($this->billto as $b) { $this->data .= $b."<br>"; }

// SHIP TO
$this->data .= "</div><div><strong>Customer Details</strong><br>";
foreach ($this->shipto as $s) { $this->data .= $s."<br>"; }
}


// INVOICE INFO
$this->data .= "</div>";
$this->data .= "<div style='color: #fff;text-align:center;font-weight:bold;font-size:22px;margin-buttom: 32px;background: #64b6ff; padding:30px;border:1px solid #667eea; border-radius:10px'>";
foreach ($this->invoice as $i) {
	$this->data .= "<div class=''>$i[1] <div class=''>$i[0]</div></div>";
}
$this->data .= "</div></div>";

// ITEMS
if($_SESSION["language"] == "ar_EG"){
	$this->data .= "<table id='items'><tr><th>رقم الفاتورة </th><th>التاريخ</th><th>الاجمالي</th><th>المدفوع</th><th>الدين</th><th>الحاله</th><th>نوع العملية</th></tr>";
	}
	else{
		$this->data .= "<table id='items'><tr><th>Invoice.No</th><th>Date</th><th>Total</th><th>Paid</th><th>Debt</th><th>Status</th><th>Transaction Type</th></tr>";
	}
	
foreach ($this->items as $i) {
	$this->data .= "<tr><td style='padding: 0'>".$i[0].""."</td><td style='padding: 0'>".$i[1]."</td><td style='padding: 0'>".$i[2]."</td><td style='padding: 0'>".$i[3]."</td><td style='padding: 0'>".$i[4]."</td><td style='padding: 0'>".$i[5]."</td><td style='padding: 0'>".$i[6]."</td></tr>";
}


// TOTALS
if (count($this->totals)>0) { foreach ($this->totals as $t) {
	$this->data .= "<tr class='ttl'><td class='right' colspan='2'>$t[0]</td><td>$t[1]</td></tr>";
}}
$this->data .= "</table>";


// NOTES
if (count($this->notes)>0) {
	$this->data .= "<div id='notes'>";
	foreach ($this->notes as $n) {
		$this->data .= $n."<br>";
	$this->data .= "</div>";
}
}
// $this->data .="
// <div> 
//  <div > 
//  <div background='#f0ad4e'> </div>
//   <span>30 days or more </span> 
//  </div>

// </div>

// ";

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