<?php
/*
 * THE SIMPLE HTML INVOICE THEME
 */

// HTML HEADER & STYLES
// if($_SESSION["language"] == "ar_EG"){
// 	$this->data = "<!DOCTYPE html><html><head><link href=\"../../layout/css/report.css\" rel=\"stylesheet\"></head><body><div id='invoice'> <style> body{direction:rtl;}	.right{text-align:left;} </style>";
// } else {
// 	$this->data = "<!DOCTYPE html><html><head><link href=\"../../layout/css/report.css\" rel=\"stylesheet\"> </head><body><div id='invoice'></head><body><div id='invoice'><style>.right{text-align:right;} </style>";
// }
if($_SESSION["language"] == "ar_EG"){
$this->data = "<!DOCTYPE html><html><head><body><style>".
"html,
body {
  background: #525659;
  height:auto;
  font-family: sans-serif;
  direction:rtl;
}
#invoice {
  background: #fff;
//   height: 100%;
  max-width: 800px;
  margin: 20px auto;
  margin-top: 40px;
  padding:20px;
  padding-bottom:100px;
}#bigi{background: #e0f1ff;
  color: #212121;margin-bottom:20px;font-size:28px;font-weight:bold;padding:10px;display: flex;
	justify-content: space-between;
	align-items: center;}#company,#billship{margin-bottom:30px}#company img{max-width:180px;height:auto}#billship,#company,#items{width:100%;border-collapse:collapse}#billship td{width:33%}#billship td,#items td,#items th{padding:10px}#items th{text-align: right;border-bottom: 2px solid #000;height: 20px;display: block;width: 100%;}#items td{    border-bottom: 2px solid #000;width: 100%;display: inline-block;height: 20px;}.idesc{color:#999}.ttl{background:#fafafa;font-weight:700}.right{text-align:left}#notes{background:#efefef;padding:10px;margin-top:30px}tr.t_header {text-align: right;display: inline-block;float: right;width: 70%;border-left: 2px solid #000;border-top: 2px solid #000;border-right: 1px solid #000; !important;border-bottom: none !important;}tr.t_body {text-align: center;display: inline-block;overflow: hidden;float: left;width: 29.4%;border-left: 1px solid #000;border-top: 2px solid #000;border-right: none !important;border-bottom: none !important;}.ttl td {border-bottom: 1px solid #ccc !important;display: table-cell !important;} .print-btn {
	cursor: pointer;
	padding: 10px 50px;
	border-radius: 500px;
  }
  .main-btn {
	background: linear-gradient(#667eea, #64b6ff);
	color: #fff !important;
	border: none;
  }
</style></head><div id='invoice'> ";}
else{
$this->data = "<!DOCTYPE html><html><head><body><style>".
"html,
body {
  background: #525659;
  height: auto;
  font-family: sans-serif;
}
#invoice {
  background: #fff;
  height: inherit;
  max-width: 800px;
  margin: 20px auto;
  margin-top: 40px;
  padding:20px;
  padding-bottom:100px;
  outline:none;
}
#bigi{background: #e0f1ff;
  color: #212121;margin-bottom:20px;font-size:28px;font-weight:bold;padding:10px;display: flex;
	justify-content: space-between;
	align-items: center;}#company,#billship{margin-bottom:30px}#company img{max-width:180px;height:auto}#billship,#company,#items{width:100%;border-collapse:collapse}#billship td{width:33%}#billship td,#items td,#items th{padding:10px}#items th{text-align: left;border-bottom: 2px solid #000;height: 20px;display: block;width: 100%;}#items td{    border-bottom: 2px solid #000;width: 100%;display: inline-block;height: 20px;}.idesc{color:#999}.ttl{background:#fafafa;font-weight:700}.right{text-align:right}#notes{background:#efefef;padding:10px;margin-top:30px}tr.t_header {text-align: left;display: inline-block;float: left;width: 70%;border-left: 2px solid #000;border-top: 2px solid #000;border-right: none !important;border-bottom: none !important;}tr.t_body {text-align: center;display: inline-block;overflow: hidden;float: right;width: 29.4%;border-left: 1px solid #ccc;border-top: 2px solid #000;border-right: 1px solid #000 !important;border-bottom: none !important;}.ttl td {border-bottom: 1px solid #ccc !important;display: table-cell !important;}
.print-btn {
	cursor: pointer;
	padding: 10px 50px;
	border-radius: 500px;
  outline:none;
  }
  .main-btn {
	background: linear-gradient(#667eea, #64b6ff);
	color: #fff !important;
	border: none;
  }".
"</style></head><div id='invoice'> ";}

// hide url in bottom of the page and hide body background in print
$this->data.="<style type=\"text/css\" media=\"print\">
      @media print
      {
         @page {
           margin-top: 0;
           margin-bottom: 0;
         }
         body  {
           padding-top: 0px;
           padding-bottom:0px ;
		   background:#fff;
       margin:0;
         }
		 #invoice{
		   margin-top: 0;
           margin-bottom: 0;
	
		 }
		   table { page-break-inside:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
    thead { display:table-header-group }

      } 
</style>";



// COMPANY LOGO + INFORMATION
$this->data .= "<table id='company'><tr><td><img src='".$this->company[0]."'/></td><td class='right'>";
for ($i=1;$i<count($this->company);$i++) {
	$this->data .= "<div>".$this->company[$i]."</div>";
}
$this->data .= "</td></tr></table>";
// add print buttton

if($_SESSION["language"] == "ar_EG"){
$this->data .= "<div id='bigi'>
<p>تقرير الربح</p>
<button class='btn main-btn print-btn' onclick=\" 
                           printS()
                            \">   طباعة التقرير </button>
</div>";
}
else{
	$this->data .= "<div id='bigi'>
	<p> Profit Invoice</p>
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
	$this->data .= "<table id='items'><tr class='t_header'><th>إجمالي المبيعات</th><th>تكلفة المبيعات</th><th>إجمالي الربح/ الخسارة</th><th>المصاريف الكلية</th><th>صافي الربح / الخسارة </th></tr>";
} else {
	$this->data .= "<table id='items'><tr class='t_header'><th>Total Sales</th><th>Cost of sales</th><th>Cross profit/ loss</th><th>Total Expense</th><th>Net profit</th></tr>";
}

foreach ($this->items as $i) {
	$this->data .= "<tr class='t_body'><td><div>".$i[0]."</div>"."</td><td>".$i[1]."</td><td>".$i[2]."</td><td>".$i[3]."</td><td>".$i[4]."</td></tr>";
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