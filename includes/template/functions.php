<?php
  if($_SESSION["language"] == "ar_EG"){
    echo "<style>
    #company .right div{
    margin-right: auto !important;
    margin-left:0 !important;
    }
    </style>";
  }

function checkProductsImages($images, $category){
  $imageSrc2="";
  // get the path of images to check if they exist in the folder
  if($images !="" && is_null($images)==false)
  {
   
    $ProductImageURL = '../dashboard/syncing/picture/images/'.$images;
    $check=glob($ProductImageURL.".*");
  
     if(!empty($check)){
    
      $extension=pathinfo($check[0],PATHINFO_EXTENSION);
  
      $imageSrc2=$ProductImageURL.'.'.$extension;

     }
     else{
      $imageSrc2="";
     }

  }
   
  

    if(is_null($images) || $images=="null" || file_exists($imageSrc2) ==false){
      $ProductImage="";
        if($_SESSION["type_of_shop"]==="grocery" || $_SESSION["type_of_shop"]==="Grocery"){
        switch($category){
        case 1:
        $ProductImage="bakery";
        break;

        case 2:
        $ProductImage="fresh_meat";
        break;
        
        case 3:
        $ProductImage="pasta_rice";
        break;

        case 4:
        $ProductImage="oils";
        break;

        case 5:
        $ProductImage="cereals";
        break;
        
        case 6:
        $ProductImage="canned";
        break;

        case 7:
        $ProductImage="frozen";
        break;

        case 8:
        $ProductImage="dairy";
        break;
        
        case 9:
        $ProductImage="crackers";
        break;

        case 10:
        $ProductImage="produce";
        break;

        case 11:
        $ProductImage="beverages";
        break;
        
        case 12:
        $ProductImage="cleaners";
        break;

        case 13:
        //$ProductImage="paper_plane";
        $ProductImage="other";
        break;

        case 14:
        $ProductImage="personal_care";
        break;
        
        case 15:
        $ProductImage="other";
        break;

        case 16:
        $ProductImage="spices";
        break;

        case 17:
        $ProductImage="refrigerated";
        break;
        
        case 18:
        $ProductImage="stationery";
        break;

        case 19:
        $ProductImage="cosmetics";
        break;

        case 20:
        $ProductImage="infants";
        break;

        default:
        $ProductImage="other";

        }

   }
   else{
    $ProductImage="Azora";
   }

}

  else{
  $ProductImage = $images;

}


 $ProductImageURL = '../dashboard/syncing/picture/images/'.$ProductImage;
 $check=glob($ProductImageURL.".*");
 $extension=pathinfo($check[0],PATHINFO_EXTENSION);
 $imageSrc=$ProductImageURL.'.'.$extension;


 
     return  $imageSrc;          
}


function checkProductsNames($productNameEn,$productNameAr){
    if($_SESSION["language"] == "ar_EG"){
        if(is_null($productNameAr) || $productNameAr=="null" || $productNameAr=="" ){

          $name= $productNameEn ;
        }
        else{
          $name=$productNameAr ;

        }
      }
      else{
    
        if(is_null($productNameEn) || $productNameEn=="null" || $productNameEn==""){

          $name= $productNameAr ;
        }
       
        else{
          $name =$productNameEn ;

        }
       
      
      }

   return $name;
}


function checkImages($imageColumn){


  if(empty($imageColumn) || is_null($imageColumn) || $imageColumn=="null"){
       $imageSrc='layout/images/user.png';
  }

  else{
    $UserImageURL = '../dashboard/syncing/picture/images/'.$imageColumn;
    $check=glob($UserImageURL.".*");
    $extension=pathinfo($check[0],PATHINFO_EXTENSION);
    $imageUrl=$UserImageURL.'.'.$extension;
    $imageSrc=$imageUrl;
  }

  
  return $imageSrc;

}


?>