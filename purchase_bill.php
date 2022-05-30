<?php
include("includes/template/header.php");
include("connect.php");
?>


    <div class="white-color row">
        <h4 class="col-6">Company</h4>
        <h4 class="col-6 right-text">Bill</h4>
        <div class="col-6 adress-column">
            <p>Yemen-Sana'a</p>
            <p>P:(967) 456-7890</p>
        </div>

        <hr>

        <div class="col-6 default-p">
            <b>User Name</b>
            <p>User Name</p>
            <b>Bill from</b>
            <p>Supplier Name</p>
        </div>

        <div class="col-6 default-p right-text">
            <div class="bill-second-row-info">
                <p><b>Date: </b>March 15, 2016</p>
                <p><b>Status: </b><span>Paid</span></p>
                <p>Bill NO: <b>#1234567</b></p>
            </div>
        </div>


        <div class="col-12">
    <table class="table table-hover ">
        <thead class="bill-header">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Product</th>
            <th></th>
            <th scope="col">QUANTITY</th>
            <th scope="col">PRICE</th>
            <th scope="col">Total</th>
            <th scope="col">Discount</th>
            <th></th>
            </tr>
        </thead>
        <tbody>

        <tr>
            <td>1</td>
            <td>Product Name</td>
            <td></td>
            <td>432</td>
            <td>432</td>
            <td>432</td>
            <td>432</td>
            <td></td>
        </tr>

        <tr>
            <td>1</td>
            <td>Product Name</td>
            <td></td>
            <td>432</td>
            <td>432</td>
            <td>432</td>
            <td>432</td>
            <td></td>
        </tr>

        <tr>
            <td>1</td>
            <td>Product Name</td>
            <td></td>
            <td>432</td>
            <td>432</td>
            <td>432</td>
            <td>432</td>
            <td></td>
        </tr>

        </tbody>
    </table>
    </div>
    <div class="col-6">
        <br><br><br><br><br>
    </div>
    <div class="col-6 default-p right-text">
            <div class="bill-second-row-info">
                <p><b>Sub-total: </b>2930.00</p>
                <p><b>Discount: </b>12.9%</p>
                <p><b>TAX: </b>12.9%</p>
                <b class="font-size-1-5">YR 2930.00</b>
            </div>
        </div>


        <div class="col-sm-12 d-flex justify-content-end top-margin-sm">
            <button type="submit" class="btn main-btn save">Print</button>
            <button type="button" class="btn btn-secondary  cancel">Cancel</button>
        </div>

    </div>





<?php
include("includes/template/footer.php");
?>