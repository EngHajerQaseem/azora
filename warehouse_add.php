<?php
  include("connect.php");
  if(!empty($_POST))
  {
    $output = '';
    $name = $_POST["name"];  
    $address = $_POST["address"];  
    $capacity = $_POST["capacity"];  
    $size = $_POST["size"];  
    $type = $_POST["type"];
    $query = "INSERT INTO warehouse(name, address, capacity, size, type) VALUES('$name', '$address', '$capacity', '$size', '$type')";
    if(mysqli_query($mysqli, $query))
      {
        $select_query = "SELECT * FROM warehouse ORDER BY id DESC";
        $result = mysqli_query($mysqli, $select_query);
        $output .= '<div class="area-box-sections">';
        while($row = mysqli_fetch_array($result))
        {
          $output .= '
            <div class="box-sq">
              <a class="view_data" href="#" name="view" value="view" id='.$row["id"].'>
                <img src="./layout/images/camera.png">
                <div>'
                  . $row["name"] .'
                </div>
              </a>
            </div>  
          ';
        }
        $output .= '
            <div class="box-sq">
              <a name="add" id="add" class="warehouse-add" href="#" data-toggle="modal" data-target="#add_data_Modal">       
                <div class="box-recycle">
                  <i class="fas fa-plus"></i>            
                </div> 
                <div class="box-sq-title">'. _("inventory_area_add").'</div>               
              </a>
            </div>
          </div>';
      }
    echo $output;
  }
?>
