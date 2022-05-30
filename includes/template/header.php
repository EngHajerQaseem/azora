<?php

  session_start();

  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }

  include_once("connect2.php");
  $phone = $_SESSION["phone"];
  $userId=$_SESSION["id"];
  $locale = $_SESSION["language"];
  $expire_session = $_SESSION['expire'];
  // $ip_session = $_SESSION['ip'];
  // function getUserIpAddress(){
  //   if(!empty($_SERVER['HTTP_CLIENT_IP'])){
  //       //ip from share internet
  //       $ip = $_SERVER['HTTP_CLIENT_IP'];
  //   }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
  //       //ip pass from proxy
  //       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  //   }else{
  //       $ip = $_SERVER['REMOTE_ADDR'];
  //   }
  //   return $ip;
  // }
  // $ip = getUserIpAddress();

  // Distroy sesstion after x time.
  $now = time();
  if ($now > $_SESSION['expire']) {
    unset($_SESSION["loggedin"]);
  }

  // // Distroy session if IP change.
  // if ($ip != $ip_session) {
  //   unset($_SESSION["loggedin"]);
  // }

  $query = "SELECT * FROM users where id=$userId";  
  $result = mysqli_query($mysqli, $query) or die ( mysqli_error());
  $row = mysqli_fetch_assoc($result);
  $img= !empty($row['local_image_path']) ? '../dashboard/upload/'.$row['local_image_path'] : 'layout/images/user.png';  


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

  if($row['language'] === 'arabic') {
    $_SESSION["language"] = "ar_EG";
  }else {
    $_SESSION["language"] = "en_US";
  }

  $activePage = basename($_SERVER['PHP_SELF'], ".php");
?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo _("azora_system"); ?></title>
    <link rel="shortcut icon" type="image/png" href="images/tramsparent-Icon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <!-- Bootstrap -->

    <link href="layout/css/bootstrap.min.css" rel="stylesheet">
    <link href="layout/css/bootstrap-select.min.css" rel="stylesheet">

    <link rel="stylesheet" href="layout/css/all.css">
    <link rel="stylesheet" href="layout/css/slick.css">
    <link rel="stylesheet" type="text/css" href="layout/css/slick-theme.css" />
    <?php 
    if($_SESSION["language"] == "ar_EG"){
      echo '<link href="layout/css/style-rtl.css" rel="stylesheet">';
    } else {
      echo '<link href="layout/css/style.css" rel="stylesheet">';
    }
   ?>

    <!-- <link href="layout/css/style-rtl.css" rel="stylesheet"> -->
    <script src="layout/js/jquery.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;800&family=Tajawal:wght@500;800&display=swap"
        rel="stylesheet">
    <script src="layout/js/Chart.min.js"></script>
    <script src="layout/js/popper.min.js"></script>
    <script src="layout/js/bootstrap.min.js"></script>
    <script src="layout/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>



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

<body class="">
    <!-- <?php echo $now?>
<br>
<?php echo $expire_session?> -->
    <section class="vbox">
        <!-- <svg class="c-wave" viewBox="0 0 600 280" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"
            xmlns:svg="http://www.w3.org/2000/svg">
            <path
                d="m-2,-52.30547c213.92539,-164.88947 427.85073,164.88946 641.77607,0l0,296.80101c-145.92534,122.88948 -463.85068,-190.88945 -641.77607,0l0,-296.80101z" />
        </svg> -->
        <header class="navbar-header bg-white-only header header-md navbar navbar-fixed-top-xs nav-xs d-flex">
            <div class="aside">
                <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
                    <i class="icon-list"></i>
                </a>
                <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
                    <i class="icon-settings"></i>
                </a>
            </div>

            <ul class="nav navbar-head navbar-nav hidden-xs">
                <li>
                    <a href="#nav,.navbar-header" data-toggle="class:nav-xs,nav-xs" class="text-muted">
                        <i class="fa fa-indent"></i>
                        <i class="fas fa-outdent"></i>
                        <!-- <i class="fas fa-outdent"></i> -->
                    </a>
                </li>

            </ul>
            <div class="logoSmall">
                <a href="index.php" class="text-lt">
                    <img width="150" class=" p-2" src="layout/images/transparent-HQ.png" alt=".">
                </a>
            </div>
            <div class="navbar-right">
                <ul class="nav navbar-nav m-n hidden-xs nav-user user">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">
                            <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">

                                <img src="<?php echo $img; ?>" alt=".">
                            </span>
                            <!-- <span class="profile-img"><?php echo $row["full_name"];?> </span><b class="caret"></b> -->
                        </a>
                        <ul class="dropdown-menu animated fadeInRight">
                            <li>
                                <span class="arrow top"></span>
                                <a href="general_settings.php"><?php echo _("user_settings"); ?></a>
                            </li>


                            <li class="divider"></li>
                            <li>
                                <a href="logout.php" data-toggle="ajaxModal"><?php echo _("user_logout"); ?></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </header>
        <section>
            <section class="hbox stretch">
                <!-- .aside -->
                <aside class="bg-menu aside hidden-print" id="nav">
                    <span class="asideOverlay"></span>

                    <section class="vbox">
                        <section class="w-f-md scrollable">
                            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0"
                                data-size="10px" data-railOpacity="0.2">
                                <!-- nav -->
                                <nav class="nav-primary hidden-xs">
                                    <a href="index.php" class="navbar-brand text-lt">
                                        <img src="layout/images/transparent-HQ.png" alt=".">
                                    </a>
                                    <a href="index.php" class="navbar-brand-small text-lt nav-xs">
                                        <img src="layout/images/transparent-small-HQ.png" alt=".">
                                    </a>
                                    <ul class="nav bg clearfix" data-ride="collapse">
                                        <li class="<?php echo $activePage === "index" ? "active" : "" ?>">

                                            <a href=" index.php" class="hvr-bounce-to-right">
                                                <i class="fas fa-home"></i>
                                                <span class="font-bold"><?php  echo _("menu_dashboard");?></span>
                                            </a>
                                        </li>
                                        <!-- <li>
                      <a href="#" class="hvr-bounce-to-right">
                        <i class="fas fa-home"></i>
                        <span class="font-bold">Pos</span>
                      </a>
                    </li> -->

                                        <li class="<?php echo $activePage === "products" ? "active" : "" ?>">
                                            <a href="products.php" class="hvr-bounce-to-right">
                                                <i class="fas fa-clone"></i>
                                                <span class="font-bold"><?php  echo _("reports_product");?></span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $activePage === "categories" ? "active" : "" ?>">
                                            <a href="categories.php" class="hvr-bounce-to-right">
                                                <i class="fas fa-clone"></i>
                                                <span class="font-bold"><?php  echo _("menu_category");?></span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $activePage === "sales" ? "active" : "" ?>">
                                            <a href="sales.php" class="hvr-bounce-to-right">
                                                <i class="fas fa-store-alt"></i>
                                                <span class="font-bold"><?php  echo _("menu_sales");?></span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $activePage === "purchase_order" ? "active" : "" ?>">
                                            <a href="purchase_order.php" class="hvr-bounce-to-right">
                                                <i class="fas fa-cart-arrow-down"></i>
                                                <span class="font-bold"> <?php  echo _("menu_purchase");?></span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $activePage === "expense" ? "active" : "" ?>">
                                            <a href="expense.php" class="hvr-bounce-to-right">
                                                <i class="fas fa-file-export"></i>
                                                <span class="font-bold"> <?php  echo _("menu_expense");?></span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $activePage === "services" ? "active" : "" ?>">
                                            <a href="service.php" class="hvr-bounce-to-right">
                                                <i class="fas fa-file"></i>
                                                <span class="font-bold"> <?php echo _("menu_services");?></span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $activePage === "inventory" ? "active" : "" ?>">
                                            <a href="inventory.php" class="hvr-bounce-to-right">
                                                <i class="fas fa-dolly-flatbed"></i>
                                                <span class="font-bold"><?php echo _("menu_inventory");?></span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $activePage === "transaction" ? "active" : "not" ?>">
                                            <a href="transaction.php" class="hvr-bounce-to-right">
                                                <i class="far fa-clone"></i>
                                                <span class="font-bold"><?php  echo _("menu_transaction");?></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="auto hvr-bounce-to-right">
                                                <span class="pull-right fix-arrow-rtl">
                                                    <i class="fa fa-angle-right text"></i>
                                                    <i class="fa fa-angle-down text-active"></i>
                                                </span>
                                                <i class="fas fa-users"></i>
                                                </i>
                                                <span class="font-bold"><?php  echo _("menu_people");?></span>
                                            </a>
                                            <ul class="nav text-sm">
                                                <li class="<?php echo $activePage === "users" ? "active" : "" ?>">
                                                    <a href="users.php" class="auto">
                                                        <i class="fas fa-circle"></i>
                                                        <span><?php echo _("menu_users");?></span>
                                                    </a>
                                                </li>
                                                <li class="<?php echo $activePage === "cusomers" ? "active" : "" ?>">
                                                    <a href="customers.php" class="auto">
                                                        <i class="fas fa-circle"></i>
                                                        <span><?php echo _("menu_customers");?></span>
                                                    </a>
                                                </li>
                                                <li class="<?php echo $activePage === "suppliers" ? "active" : "" ?>">
                                                    <a href="suppliers.php" class="auto">
                                                        <i class="fas fa-circle"></i>
                                                        <span><?php echo _("menu_suppliers");?></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="<?php echo $activePage === "reports" ? "active" : "" ?>">
                                            <a href="reports.php" class="hvr-bounce-to-right">
                                                <i class="fas fa-flag"></i>
                                                <span class="font-bold"><?php echo _("menu_reports");?></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="auto hvr-bounce-to-right">
                                                <span class="pull-right fix-arrow-rtl">
                                                    <i class="fa fa-angle-right text"></i>
                                                    <i class="fa fa-angle-down text-active"></i>
                                                </span>
                                                <i class="fas fa-user-cog"></i>
                                                </i>
                                                <span class="font-bold"><?php echo _("menu_settings");?></span>
                                            </a>
                                            <ul class="nav text-sm">
                                                <li
                                                    class="<?php echo $activePage === "general_settings" ? "active" : "" ?>">
                                                    <a href="general_settings.php" class="auto">
                                                        <i class="fas fa-circle"></i>
                                                        <span><?php echo _("menu_generel");?></span>
                                                    </a>
                                                </li>
                                                <!-- <li >
                                <a href="product_settings.php" class="auto">                                                        
                                  <i class="fas fa-circle"></i>
                                  <span>Product Settings</span>
                                </a>
                              </li> -->
                                                <li class="<?php echo $activePage === "about" ? "active" : "" ?>">
                                                    <a href="about.php" class="auto">
                                                        <i class="fas fa-circle"></i>
                                                        <span><?php echo _("menu_about");?></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="Docs/index.php" class="auto">
                                                        <i class="fas fa-circle"></i>
                                                        <span><?php echo _("menu_docs");?></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                    </ul>
                                </nav>
                                <!-- / nav -->
                            </div>
                        </section>
                    </section>
                </aside>
                <!-- /.aside -->
                <section id="content">
                    <section class="vbox">
                        <section class="scrollable wrapper content">