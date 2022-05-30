<?php
 session_start();

 // Check if the user is logged in, if not then redirect him to login page
 if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
     header("location: ../login.php");
     exit;
 }

 include_once("../connect2.php");
 
 $userId=$_SESSION["id"];
 $locale = $_SESSION["language"];
 $expire_session = $_SESSION['expire'];
 
 $now = time();
 if ($now > $_SESSION['expire']) {
   unset($_SESSION["loggedin"]);
 }

 
 if (defined('LC_MESSAGES')) {
    setlocale(LC_MESSAGES, $locale); // Linux
    bindtextdomain("messages", "./locale");
    bind_textdomain_codeset("messages", 'UTF-8');
} else {
    putenv("LC_ALL={$locale}"); // windows
    bindtextdomain("messages", ".\locale");
    bind_textdomain_codeset("messages", 'UTF-8');
}
 
textdomain("messages");
 
 $activePage = basename($_SERVER['PHP_SELF'], ".php");

 $query = "SELECT * FROM users where id=$userId";  
 $result = mysqli_query($mysqli, $query) or die ( mysqli_error());
 $row = mysqli_fetch_assoc($result);

 if($row['language'] === 'arabic') {
    $_SESSION["language"] = "ar_EG";
  }else {
    $_SESSION["language"] = "ar_EG";
  }

?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo _("azora_system"); ?></title>
    <link rel="shortcut icon" type="image/png" href="images/tramsparent-Icon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <!-- Bootstrap -->

    <link href="../layout/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../layout/css/all.css">

    <?php 
    if($_SESSION["language"] == "ar_EG"){
      echo ' <link href="../layout/css/docs-rtl.css" rel="stylesheet">';
    } else {
      echo ' <link href="../layout/css/docs.css" rel="stylesheet">';
    }
   ?>


    <script src="../layout/js/jquery.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;800&family=Tajawal:wght@500;800&display=swap"
        rel="stylesheet">
    <!-- <script src="../js/popper.min.js"></script> -->
    <script src="../layout/js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and
media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page
 via file:// -->
    <!--[if lt IE 9]>
 <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/
 html5shiv.js"></script>
 <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/
 respond.min.js"></script>
 <![endif]-->







</head>

<body>
    <header>
        <div class="container">
            <nav>

                <a href="../index.php" class="brand">
                    <img src="../layout/images/transparent-HQ.png" alt="azora pos" />
                </a>

                <div class="menu-burger">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>




                <ul class="main-menu mobile-menu">
                    <li class="<?= ($activePage == 'index') ? 'active':''; ?>"><a
                            href="index.php"><?php echo _("Docs_header_menu_Home");?></a></li>
                    <li class="<?= ($activePage == 'FAQ') ? 'active':''; ?>"><a
                            href="FAQ.php"><?php echo _("Docs_header_menu_FAQ");?></a></li>
                    <li class="<?= ($activePage == 'userManual') ? 'active':''; ?> "><a
                            href="userManual.php"><?php echo _("Docs_header_menu_Manual");?></a></li>
                    </li>

                </ul>


            </nav>
            <div class='header-title'>
                <h1>
                    <?php 
    if($_SESSION["language"] == "ar_EG"){
     
      if($activePage ==="FAQ"){
        echo $activePage="الأسئلة الشائعة";
      }
      elseif($activePage ==="userManual"){
        echo $activePage="دليل المستخدم";
      }
      else{
        echo $activePage="" ;
      }
    } else {
      echo 
      $activePage!='index'? substr($activePage,0,4).' '.substr($activePage,4,10) :'';
    }
   ?>
                </h1>
            </div>

        </div>
    </header>
    <script src="../layout/js/custom.js"></script>
</body>

</html>