<?php
include("includes/template/header.php");
include("connect.php");
?>


<div class="white-color">
    <h5>From 01/03/2019 To 20/03/2019</h5>
    <h5>Branch Name</h5>

    <div>
    <table class="table table-hover ">
        <thead>
            <tr>
            <th scope="col">Product</th>
            <th scope="col">Total</th>
            <th scope="col">Supplier</th>
            <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>

        <tr>
            <td>Product Name</td>
            <td>$100</td>
            <td>Supplier Name</td>
            <td>01/03/2019</td>
        </tr>

        <tr>
            <td>Product Name</td>
            <td>$100</td>
            <td>Supplier Name</td>
            <td>01/03/2019</td>
        </tr>

        <tr>
            <td>Product Name</td>
            <td>$100</td>
            <td>Supplier Name</td>
            <td>01/03/2019</td>
        </tr>

        <tr>
            <td>Product Name</td>
            <td>$100</td>
            <td>Supplier Name</td>
            <td>01/03/2019</td>
        </tr>

        <tr>
            <td>Product Name</td>
            <td>$100</td>
            <td>Supplier Name</td>
            <td>01/03/2019</td>
        </tr>

        <tr>
            <td>Product Name</td>
            <td>$100</td>
            <td>Supplier Name</td>
            <td>01/03/2019</td>
        </tr>

        <tr>
            <td>Product Name</td>
            <td>$100</td>
            <td>Supplier Name</td>
            <td>01/03/2019</td>
        </tr>

        <tr>
            <td>Product Name</td>
            <td>$100</td>
            <td>Supplier Name</td>
            <td>01/03/2019</td>
        </tr>

        <tr>
            <td>Product Name</td>
            <td>$100</td>
            <td>Supplier Name</td>
            <td>01/03/2019</td>
        </tr>

        </tbody>
    </table>
    </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
                </li>
            </ul>
        </nav>
        <div class="col-sm-12 d-flex justify-content-end top-margin-sm">
            <button type="submit" class="btn main-btn save">Save</button>
            <button type="button" class="btn btn-secondary  cancel">Cancel</button>
        </div>
    </div>
</div>



<?php
include("includes/template/footer.php");
?>