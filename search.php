<?php


include("connect.php");


$conn = $mysqli;

$output = '';

$searchName = $_POST['search'];

$searchResult = $conn->query("SELECT sales.id AS 'Invoice.No', sales.created_at AS 'date', transaction.total_cost_price AS 'total', transaction.paid AS 'paid', CONCAT(customer.fname, ' ', customer.lname) AS 'customer', user.full_name AS 'user'  
                              FROM (((sales 
                              INNER JOIN transaction ON sales.transaction_id = transaction.id)
                              INNER JOIN customer ON transaction.customer_id = customer.id) 
                              INNER JOIN user ON transaction.user_id = user.id)
                              WHERE customer.fname 
                              LIKE  '%$searchName%'
                              OR
                              customer.lname 
                              LIKE  '%$searchName%'
                              OR
                              user.full_name 
                              LIKE  '%$searchName%'
                              ");

if(mysqli_num_rows($searchResult) > 0) {
    $returnedSales = $searchResult->fetch_all(MYSQLI_ASSOC);
    foreach($returnedSales as $row){
        $output .= '
            <tr>
                <td>'.$row['Invoice.No'].'</td>
                <td>'.$row['date'].'</td>
                <td>'.$row['total'].'</td>
                <td>'.$row['paid'].'</td>
                <td>'.$row['customer'].'</td>
                <td>'.$row['user'].'</td>
                <td class="align-content-end">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="product_details.php"><i class="fa fa-eye"></i>  View Details </a>
                            <a class="dropdown-item" href="#"><i class="fa fa-trash"></i>  Delete </a>
                        </div>
                    </div>
                </td>
            </tr>
        ';
    }

    echo $output;
} else {
    echo 'Data Not Found';
}


?>