<?php
  include("includes/template/header.php");
  include("includes/template/functions.php");
  include("connect.php");
?>


<div id="product_table" class="col-12 white-background">
    <h3 class="page-title reportsTitle"><?php echo _("Page_Title_Reports");?></h3>
    <div class="row">

        <div data-toggle="modal" href="#" data-toggle="modal" data-target=".product-modal"
            class="col-xl-3 col-md-4 col report">
            <div class="report-box">
                <img src="layout/images/tag.png">
                <p><?php echo _("reports_product"); echo " | "; echo _("reports_service");?></p>
            </div>
        </div>

        <div data-toggle="modal" data-target=".purchase-modal" class="col-xl-3 col-md-4 col report">
            <div class="report-box">
                <img src="layout/images/shopping-cart.png">
                <p><?php echo _("reports_purchase");?></p>
            </div>
        </div>

        <div data-toggle="modal" data-target=".sales-modal" class="col-xl-3 col-md-4 col report">
            <div class="report-box">
                <img src="layout/images/sale.png">
                <p><?php echo _("reports_sales");?></p>
            </div>
        </div>

        <div data-toggle="modal" data-target=".stock-modal" class="col-xl-3 col-md-4 col report">
            <div class="report-box">
                <img src="layout/images/storage.png">
                <p><?php echo _("reports_stock");?></p>
            </div>
        </div>

        <div data-toggle="modal" data-target=".category-modal" class="col-xl-3 col-md-4 col report">
            <div class="report-box">
                <img src="layout/images/list.png">
                <p><?php echo _("reports_category");?></p>
            </div>
        </div>

        <div data-toggle="modal" data-target=".profit-modal" class="col-xl-3 col-md-4 col report">
            <div class="report-box">
                <img src="layout/images/stats.png">
                <p><?php echo _("reports_profit");?></p>
            </div>
        </div>

        <div data-toggle="modal" data-target=".supplier-modal" class="col-xl-3 col-md-4 col report">
            <div class="report-box">
                <img src="layout/images/supplier.png">
                <p><?php echo _("reports_supplier");?></p>
            </div>
        </div>

        <div data-toggle="modal" data-target=".debt-modal" class="col-xl-3 col-md-4 col report">
            <div class="report-box">
                <img src="layout/images/azorauser.png">
                <p><?php echo _("reports_debt");?></p>
            </div>
        </div>

        <div data-toggle="modal" data-target=".cash-modal" class="col-xl-3 col-md-4 col report">
            <div class="report-box">
                <img src="layout/images/Cash.png">
                <p><?php echo _("cash_report");?></p>
            </div>
        </div>

    </div>
</div>


<!------- products -------->
<div class="modal fade product-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModlLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <?php echo _("reports_product") ; echo " |" ; ?>
                    <?php echo _("reports_service");?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="GET" id="productId" target="_blank" action="includes/reports/product.php">
                    <div class="row">
                        <div class="col-sm-12">
                            <label
                                for="typeOf"><?php echo _("reports_product"); echo " | " ?><?php echo _("reports_service");?></label>
                            <select name="typeOf" class="form-control selectpicker" id="typeOf" data-live-search="true"
                                onchange="changeTypeOf(this.value);">
                                <option value="product">
                                    <?php echo _("reports_product");?>
                                </option>
                                <option value="service">
                                    <?php echo _("reports_service");?>
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label for="product"><?php echo _("reports_product");?></label>
                            <select name="products" class="form-control selectpicker" id="products"
                                data-live-search="true">
                                <option value="">
                                    <?php echo _("reports_all_user");?>
                                </option>
                                <?php                 
                  $sqlPr = "SELECT id as productId, name as ProductName ,name_ar as ProductNameAr  FROM product";                      
                  $resultPr = $mysqli->query($sqlPr);
                  
                  while ($rowProd = $resultPr->fetch_assoc()) { 
                    //$name = $rowProd['productName'];
                    $name=checkProductsNames($rowProd['ProductName'],$rowProd['ProductNameAr']);
                    $id = $rowProd['productId'];
                    ?>
                                <option value="<?php echo $id."|".$name; ?>">
                                    <?php echo $name;?>
                                </option>
                                <?php }                    
                ?>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label for="users"><?php echo _("reports_choose_user"); ?></label>
                            <select name="users" class="form-control selectpicker" id="users" data-live-search="true">
                                <option value="">
                                    <?php echo _("reports_all_user");?>
                                </option>
                                <?php                 
                  $sqlUser = "SELECT id as UserId, full_name as userName  FROM user";                      
                  $resultUser = $mysqli->query($sqlUser);
                  
                  while ($rowUser = $resultUser->fetch_assoc()) { 
                    //$name = $rowProd['productName'];
                    $name=$rowUser ['userName'];
                    $id =$rowUser ['UserId'];
                    ?>
                                <option value="<?php echo $id; ?>">
                                    <?php echo $name;?>
                                </option>
                                <?php }                    
                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="from"><?php echo _("reports_from"); ?></label>
                                <input type="datetime-local" class="form-control" id="from" name="from">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="to"><?php echo _("reports_to"); ?></label>
                                <input type="datetime-local" class="form-control" id="to" name="to">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" value="?id=<?php echo $id;?>"
                    class="btn main-btn"><?php echo _("reports_generate_report"); ?></button>
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal"><?php echo _("reports_close"); ?></button>
            </div>
            </form>
        </div>
    </div>
</div>


<!------- Purchase -------->
<div class="modal fade purchase-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModlLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo _("reports_purchase");?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="GET" id="purchaseId" target="_blank" action="includes/reports/purchase.php">

                    <div class="row">

                        <div class="col-sm-12">
                            <label for="users"><?php echo _("reports_choose_user"); ?></label>
                            <select name="users" class="form-control selectpicker" id="users" data-live-search="true">
                                <option value="">
                                    <?php echo _("reports_all_user");?>
                                </option>
                                <?php 
                                                
                            $sqlUser = "SELECT id,full_name  FROM user ";                      
                            $resultUser = $mysqli->query($sqlUser);
                            
                            while ($rowUser = $resultUser->fetch_assoc()) { 
                            
                                $name=$rowUser['full_name'];
                                $id = $rowUser['id'];
                    ?>
                                <option value="<?php echo $id; ?>">
                                    <?php echo $name;?>
                                </option>
                                <?php }                    
                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="from"><?php echo _("reports_from"); ?></label>
                                <input type="datetime-local" class="form-control" id="from_purchase" name="from_purchase">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="to"><?php echo _("reports_to"); ?></label>
                                <input type="datetime-local" class="form-control" id="to_purchase" name="to_purchase">
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn main-btn"><?php echo _("reports_generate_report"); ?></button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"><?php echo _("reports_close"); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!------- Sales -------->
<div class="modal fade sales-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModlLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo _("reports_sales");?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="GET" id="salesId" target="_blank" action="includes/reports/sales.php">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="users"><?php echo _("reports_choose_user"); ?></label>
                            <select name="users" class="form-control selectpicker" id="users" data-live-search="true">
                                <option value="">
                                    <?php echo _("reports_all_user");?>
                                </option>
                                <?php                 
                  $sqlUser = "SELECT id as UserId, full_name as userName  FROM user";                      
                  $resultUser = $mysqli->query($sqlUser);
                  
                  while ($rowUser = $resultUser->fetch_assoc()) { 
                    //$name = $rowProd['productName'];
                    $name=$rowUser ['userName'];
                    $id =$rowUser ['UserId'];
                    ?>
                                <option value="<?php echo $id; ?>">
                                    <?php echo $name;?>
                                </option>
                                <?php }                    
                ?>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label for="typeOf"><?php echo _("type_of_cash");?></label>
                            <select name="typeOf" class="form-control selectpicker" id="typeOf" data-live-search="true">
                                <option value="">
                                    <?php echo _("reports_all_user");?>
                                </option>
                                <option value="Service">
                                    <?php echo _("Service");?>
                                </option>
                                <option value="Product">
                                    <?php echo _("reports_product");?>
                                </option>

                            </select>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="from"><?php echo _("reports_from"); ?></label>
                                <input type="datetime-local" class="form-control" id="from_sales" name="from_sales">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="to"><?php echo _("reports_to"); ?></label>
                                <input type="datetime-local" class="form-control" id="to_sales" name="to_sales">
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn main-btn"><?php echo _("reports_generate_report"); ?></button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"><?php echo _("reports_close"); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!------- Stock -------->

<div class="modal fade stock-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModlLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo _("reports_stock");?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="GET" id="stockId" target="_blank" action="includes/reports/stock.php">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="users"><?php echo _("reports_choose_user"); ?></label>
                            <select name="users" class="form-control selectpicker" id="users" data-live-search="true">
                                <option value="">
                                    <?php echo _("reports_all_user");?>
                                </option>
                                <?php                 
                  $sqlUser = "SELECT id as UserId, full_name as userName  FROM user";                      
                  $resultUser = $mysqli->query($sqlUser);
                  
                  while ($rowUser = $resultUser->fetch_assoc()) { 
                    //$name = $rowProd['productName'];
                    $name=$rowUser ['userName'];
                    $id =$rowUser ['UserId'];
                    ?>
                                <option value="<?php echo $id; ?>">
                                    <?php echo $name;?>
                                </option>
                                <?php }                    
                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="from"><?php echo _("reports_from"); ?></label>
                                <input type="datetime-local" class="form-control" id="from_stock" name="from_stock">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="to"><?php echo _("reports_to"); ?></label>
                                <input type="datetime-local" class="form-control" id="to_stock" name="to_stock">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn main-btn"><?php echo _("reports_generate_report"); ?></button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"><?php echo _("reports_close"); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!------- Category -------->
<div class="modal fade category-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModlLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo _("reports_category");?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="GET" id="categoryId" target="_blank" action="includes/reports/category.php">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="cate"><?php echo _("reports_category");?></label>
                            <select name="category" class="form-control selectpicker" id="category"
                                data-live-search="true" onchange="changeCata(this.value);">
                                <?php                 
                  $sqlCate = "SELECT id as categoryId, name AS 'categoryName', nameAR as 'categoryNameAR' FROM category";                      
                  $resultCate = $mysqli->query($sqlCate);
               $catIds=[];
                  while ($rowCate = $resultCate->fetch_assoc()) { 
                    $nameCat = checkProductsNames($rowCate['categoryName'],$rowCate['categoryNameAR']);
                    $idCat = $rowCate['categoryId'];
                    array_push( $catIds,$idCat);
                    ?>
                                <option value="<?php echo $idCat."|".$nameCat; ?>">
                                    <?php echo $nameCat;?>
                                </option>
                                <?php }                                  
                ?>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label for="sub"><?php echo _("reports_sub_category");?></label>
                            <select name="subcategory" class="form-control selectpicker" id="subcategory"
                                data-live-search="true">
                                <?php                 
                  $sqlSub = "SELECT id as subCategoryId, subcategory.name AS 'subCategoryName',subcategory.name_ar AS 'subCategoryNameAr' FROM subcategory where category_id=".$catIds[0];                      
                  $resultSub = $mysqli->query($sqlSub);
                  ?>
                                <option value=""><?php echo _("reports_all_user");?> </option>
                                <?php
                  while ($rowSub = $resultSub->fetch_assoc()) { 
                    $name_sub =checkProductsNames($rowSub['subCategoryName'],$rowSub['subCategoryNameAr']);
                    $id_sub = $rowSub['subCategoryId'];
                    ?>
                                <option value="<?php echo $id_sub; ?>">
                                    <?php echo $name_sub;?>
                                </option>
                                <?php }                  
                ?>
                            </select>
                        </div>

                        <div class="col-sm-12">
                            <label for="users"><?php echo _("reports_choose_user"); ?></label>
                            <select name="users" class="form-control selectpicker" id="users" data-live-search="true">
                                <option value="">
                                    <?php echo _("reports_all_user");?>
                                </option>
                                <?php                 
                  $sqlUser = "SELECT id as UserId, full_name as userName  FROM user";                      
                  $resultUser = $mysqli->query($sqlUser);
                  
                  while ($rowUser = $resultUser->fetch_assoc()) { 
                    //$name = $rowProd['productName'];
                    $name=$rowUser ['userName'];
                    $id =$rowUser ['UserId'];
                    ?>
                                <option value="<?php echo $id; ?>">
                                    <?php echo $name;?>
                                </option>
                                <?php }                    
                ?>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="from"><?php echo _("reports_from"); ?></label>
                                <input type="datetime-local" class="form-control" id="from_cate" name="from_cate">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="to"><?php echo _("reports_to"); ?></label>
                                <input type="datetime-local" class="form-control" id="to_cate" name="to_cate">
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn main-btn"><?php echo _("reports_generate_report"); ?></button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"><?php echo _("reports_close"); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!------- Profit  -------->
<div class="modal fade profit-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo _("reports_profit");?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="GET" id="pofitId" target="_blank" action="includes/reports/profit.php">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="from"><?php echo _("reports_from"); ?></label>
                                <input type="datetime-local" class="form-control" id="from_profit" name="from_profit">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="to"><?php echo _("reports_to"); ?></label>
                                <input type="datetime-local" class="form-control" id="to_profit" name="to_profit">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn main-btn"><?php echo _("reports_generate_report"); ?></button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"><?php echo _("reports_close"); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!------- Supplier -------->
<div class="modal fade supplier-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo _("reports_supplier");?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="GET" id="supplier" target="_blank" action="includes/reports/supplier.php">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="suppliers"><?php echo _("reports_supplier");?></label>
                            <select name="supplier" class="form-control selectpicker" id="supplier"
                                data-live-search="true">
                                <?php    
                $sqlSup = "SELECT id as supplierId, fname AS fsupplier, lname AS lsupplier FROM suppliers";                              
                  $resultSup = $mysqli->query($sqlSup);
                  
                  while ($rowSup = $resultSup->fetch_assoc()) { 
                    $fname = $rowSup['fsupplier'];
                    $lname = $rowSup['lsupplier'];
                    $name_sup = $fname.' '.$lname;
                    $id_sup = $rowSup['supplierId'];
                    ?>
                                <option value="<?php echo $id_sup; ?>">
                                    <?php echo $name_sup;?>
                                </option>
                                <?php }                  
                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="from"><?php echo _("reports_from"); ?></label>
                                <input type="datetime-local" class="form-control" id="from_sup" name="from_sup">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="to"><?php echo _("reports_to"); ?></label>
                                <input type="datetime-local" class="form-control" id="to_sup" name="to_sup">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn main-btn"><?php echo _("reports_generate_report"); ?></button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"><?php echo _("reports_close"); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!------- Debt -------->
<div class="modal fade debt-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo _("reports_debt");?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="GET" id="customer" target="_blank" action="includes/reports/customer.php">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="debt"><?php echo _("reports_debt");?></label>
                            <select name="customer" class="form-control selectpicker" id="debt" data-live-search="true">
                                <?php    
                $query = "SELECT id as customerId, fname AS fname, lname AS lname FROM customer where id!=0";                              
                  $results = $mysqli->query($query);
                  
                  while ($row = $results->fetch_assoc()) { 
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                    $name_sup = $fname.' '.$lname;
                    $id_sup = $row['customerId'];
                    ?>
                                <option value="<?php echo $id_sup; ?>">
                                    <?php echo $name_sup;?>
                                </option>
                                <?php }                  
                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="from"><?php echo _("reports_from"); ?></label>
                                <input type="datetime-local" class="form-control" id="from_debt" name="from_debt">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="to"><?php echo _("reports_to"); ?></label>
                                <input type="datetime-local" class="form-control" id="to_debt" name="to_debt">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn main-btn"><?php echo _("reports_generate_report"); ?></button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"><?php echo _("reports_close"); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!------- Cash -------->

<div class="modal fade cash-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModlLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo _("Cash");?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="GET" id="cashId" target="_blank" action="includes/reports/cash.php">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="users"><?php echo _("reports_choose_user"); ?></label>
                            <select name="users" class="form-control selectpicker" id="users" data-live-search="true">
                                <option value="">
                                    <?php echo _("reports_all_user");?>
                                </option>
                                <?php                 
                  $sqlUser = "SELECT id as UserId, full_name as userName  FROM user";                      
                  $resultUser = $mysqli->query($sqlUser);
                  
                  while ($rowUser = $resultUser->fetch_assoc()) { 
                    //$name = $rowProd['productName'];
                    $name=$rowUser ['userName'];
                    $id =$rowUser ['UserId'];
                    ?>
                                <option value="<?php echo $id.'|'.$name; ?>">
                                    <?php echo $name;?>
                                </option>
                                <?php }                    
                ?>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label for="type_of_report"><?php echo _("type_of_cash");?></label>
                            <select name="type_of_report" class="form-control selectpicker" id="type_of_report"
                                data-live-search="true">
                                <option value="Detailed">
                                    <?php echo _("type_of_cash_detailed");?>
                                </option>

                                <option value="NotDetailed">
                                    <?php echo _("type_of_cash_brief");?>
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="from"><?php echo _("reports_from"); ?></label>
                                <input type="datetime-local" class="form-control" id="from_stock" name="from_stock">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="to"><?php echo _("reports_to"); ?></label>
                                <input type="datetime-local" class="form-control" id="to_stock" name="to_stock">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn main-btn"><?php echo _("reports_generate_report"); ?></button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"><?php echo _("reports_close"); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
function changeCata(cata) {
    cata = cata.split("|");
    var xhr = new XMLHttpRequest();
    var optins = "";
    var subcategorySelect = document.getElementById("subcategory");
    xhr.open("GET", "getSubProCata.php?category=" + cata[0], true);
    xhr.onload = function() {

        if (this.status == 200) {
            var x = JSON.parse(this.responseText);
            optins += "<option value=''><?php echo _("reports_all_user");?></option>"
            x.forEach(function(val) {
                optins += "<option value=" + val["subCategoryId"] + ">";
                <?php if($_SESSION["language"] == "ar_EG"){ ?>
                if (val["subCategoryNameAr"] == null || val["subCategoryNameAr"] == "null" || val[
                        "subCategoryNameAr"] == "")
                    optins += val["subCategoryName"];
                else
                    optins += val["subCategoryNameAr"];
                <?php } else{ ?>

                if (val["subCategoryName"] == null || val["subCategoryName"] == "null" || val[
                        "subCategoryName"] == "")
                    optins += val["subCategoryNameAr"];
                else
                    optins += val["subCategoryName"];



                <?php } ?>
                optins += "</option>";
            });
            subcategorySelect.innerHTML = optins;
            $("select[name=subcategory]").selectpicker("refresh");


        }
    }
    xhr.send();

}

function changeTypeOf(typeOf) {
    var xhr = new XMLHttpRequest();
    var optins = "";
    optins= "<option value="+" " + "> <?php echo _("reports_all_user");?> </option>";
    var subcategorySelect = document.getElementById("products");
    xhr.open("GET", "getProServ.php?typeOf=" + typeOf, true);
    xhr.onload = function() {
        if (this.status == 200) {
            var x = JSON.parse(this.responseText);
            x.forEach(function(val) {
                var name = "";
                <?php if($_SESSION["language"] == "ar_EG"){ ?>
                if (val["name_ar"] == null || val["name_ar"] == "null" || val["name_ar"] == "")
                    name = val["name"];
                else
                    name = val["name_ar"];
                <?php } else{ ?>
                if (val["name"] == null || val["name"] == "null" || val["name"] == "")
                    name = val["name_ar"];
                else
                    name = val["name"];
                <?php } ?>
               
                optins += "<option value=" + val["id"] + "|" + name + ">" + name + "</option>";
            });
            subcategorySelect.innerHTML = optins;
            $("select[name=products]").selectpicker("refresh");


        }
    }
    xhr.send();


}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
</script>
<?php include("includes/template/footer.php"); ?>