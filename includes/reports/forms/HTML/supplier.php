<?php
/*
 * THE SIMPLE HTML INVOICE THEME
 */

// HTML HEADER & STYLES
if($_SESSION["language"] == "ar_EG"){
	$this->data = "<!DOCTYPE html><html><head><link href=\"../../layout/css/report.css\" rel=\"stylesheet\"><title>تقرير المورد </title></head><body><div id='invoice'> <style> body{direction:rtl;}	.right{text-align:left;} </style>";
} else {
	$this->data = "<!DOCTYPE html><html><head><link href=\"../../layout/css/report.css\" rel=\"stylesheet\"> <title>Supplier Report </title></head><body><div id='invoice'></head><body><div id='invoice'><style>.right{text-align:right;} </style>";
}


// COMPANY LOGO + INFORMATION
$this->data .= "<table id='company'><tr><td><img src='".$this->company[0]."'/></td><td class='right'>";
for ($i=1;$i<count($this->company);$i++) {
	$this->data .= "<div>".$this->company[$i]."</div>";
}
$this->data .= "</td></tr></table>";
if($_SESSION["language"] == "ar_EG"){
	$this->data .= "<div id='bigi'>تقرير المورد";
	$this->data .= "

<button class='btn main-btn print-btn' onclick=\" 
                           printS()
                            \">   طباعة التقرير </button> </div>";
}else {
	$this->data .= "<div id='bigi'>Supplier Report";
	$this->data .= "
	<button class='btn main-btn print-btn' onclick=\" 
	printS()
		\">Print Report </button>
	</div>";
}

// BILL TO
if($_SESSION["language"] == "ar_EG"){
	$this->data .= "<div id='billship'><div><strong>اسم المورد</strong><br>";
	} else {
		$this->data .= "<div id='billship'><div><strong>Supplier Name</strong><br>";	
	}
	foreach ($this->billto as $b) { $this->data .= $b[0]."<br>"; }

// SHIP TO
if($_SESSION["language"] == "ar_EG"){
	$this->data .= "</div><div><strong>تفاصيل المورد</strong><br>";
	} else {
		$this->data .= "</div><div><strong>Supplier Details</strong><br>";
	}
foreach ($this->shipto as $s) { $this->data .= $s."<br>"; }


	// INVOICE INFO
	$this->data .= "</div><div style='color: #fff;text-align:center;font-weight:bold;font-size:22px;margin-buttom: 32px;background: #64b6ff; padding:30px;border:1px solid #667eea; border-radius:10px'>";
	foreach ($this->totals as $i) {
		$this->data .= "<div class='any'>$i[1]</div> <div class='price any' style='font-size:18px'>$i[0]</div>
		
		";
	
	}
	$this->data .= "</div></div>";

// ITEMS
if($_SESSION["language"] == "ar_EG"){
	$this->data .= "<table id='items'><tr><th>رقم المرجع</th<tr><th>التاريخ</th><th>مبلغ الشراء</th><th>المدفوع</th><th>إجمالي الدين</th><th>الحالة</th></tr>";
} else {
	$this->data .= "<table id='items'><tr><th>Invoice.No</th><th>Date</th><th>Total</th><th>Paid</th><th>Total Debt</th><th>Status</th></tr>";

}
foreach ($this->items as $i) {
	$this->data .= "<tr><td><div>".$i[0]."</div>"."</td><td>".$i[1]."</td><td>".$i[2]."</td><td>".$i[3]."</td><td>".$i[4]."</td><td>".$i[5]."</td></tr>";
}


// TOTALS
// if (count($this->totals)>0) { foreach ($this->totals as $t) {
// 	$this->data .= "<tr class='ttl'><td class='right' colspan='2'>$t[0]</td><td>$t[1]</td></tr>";
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