<?php
// Initialize the session
session_start();


// detect the language of browser
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
//echo $lang;


// Check if the user is already logged in, if yes then redirect him to Home page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: index.php");
  exit;
}
if($lang=='ar'){
  $locale = "ar_EG";
 
}
else{
  $locale="en_US";
}



if (defined('LC_MESSAGES')) {
    setlocale(LC_MESSAGES, $locale); // Linux
    //putenv("LC_MESSAGES={$locale}");
    bindtextdomain("messages", "./locale");
    bind_textdomain_codeset("messages", 'UTF-8');
} else {
    putenv("LC_ALL={$locale}"); // windows
    bindtextdomain("messages", ".\locale");
    bind_textdomain_codeset("messages", 'UTF-8');
}

textdomain("messages");

include("connect2.php");


// Define variables and initialize with empty values
$password = $phone = "";
$phone_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Check if login field is empty
  if (empty(trim($_POST["phone"]))) {
    $phone_err = _("missing_phone_number");
  } else {
    $phone = trim($_POST["phone"]);
  }

  // Check if password is empty
  if (empty(trim($_POST["password"]))) {
    $password_err = _("missing_password");
  } else {
    $password_post = $_POST["password"];
  }

  // Validate credentials
  if (empty($phone_err) && empty($password_err)) {

    if ($stmt = $mysqli->prepare('SELECT id, phone, password, salt, address, shopName,language,type_of_shop FROM users WHERE phone = "'.$phone.'"')) {
      $stmt->execute();
      $stmt->store_result();    
      if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $phone, $password, $salt, $address, $shopName,$lang,$type);
        $stmt->fetch();

        $check_pass = $salt . $password_post;
        $check_hash = hash('sha512',$check_pass);

        // $check_hash = $password_post;

        if ($check_hash === $password) {
          session_start();
          // Store data in session variables
          $_SESSION["loggedin"] = true;
          $_SESSION["id"] = $id;
          $_SESSION["phone"] = $phone;
           $_SESSION["type_of_shop"] = $type;
          if($lang === 'arabic') {
            $_SESSION["language"] = "ar_EG";
          }else {
            $_SESSION["language"] = "en_US";
          }
          $_SESSION["shopName"] = $shopName;
          $_SESSION["address"] = $address;
          $_SESSION['start'] = time();
          // Ending a session in 6 hours from the starting time.
          $_SESSION['expire'] = $_SESSION['start'] + (60 * 60);
        //   function getUserIpAddr(){
        //     if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //         //ip from share internet
        //         $ip = $_SERVER['HTTP_CLIENT_IP'];
        //     }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //         //ip pass from proxy
        //         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        //     }else{
        //         $ip = $_SERVER['REMOTE_ADDR'];
        //     }
        //     return $ip;
        // }

        //   $_SESSION['ip'] = getUserIpAddr();

          // Redirect user to home page
          header("location: index.php");
        } else {
          $password_err = _("invalid_password");
        }
      } else {
          $phone_err = _("check_phone_or_password");
      }
      $stmt->close();
    }    
  }

  // Close connection
  mysqli_close($mysqli);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'>
    <title><?php echo _("login_header"); ?></title>
    <link rel="shortcut icon" type="image/png" href="layout/images/tramsparent-Icon.png">
    <link rel='stylesheet' href='layout/css/all.css'>
    <?php 
  if($lang=='ar'){
    echo '<link rel="stylesheet" href="layout/css/login-rtl.css">';
    
  }
  else{
    echo '<link rel="stylesheet" href="layout/css/login.css">';
  }
  
  ?>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="form-body">
                <div class="login-form">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                        name="signin-form">

                        <div class="sign-logo">
                            <div class="sign-image">
                                <img src="layout/images/tramsparent-Icon.png">
                            </div>
                        </div>
                        <h2><?php echo _("login_header"); ?></h2>

                        <!-- phone Container -->
                        <div class="col-sm-12">

                            <div class="input-container <?php echo (!empty($$phone_err)) ? 'has-error' : ''; ?>">
                                <?php 
                if($lang=='en'){
                  echo '<i class="fas fa-phone-alt" id="sign-icon"></i>';
                }
                else{
                  echo '<i class="fas fa-phone" id="sign-icon"></i>';
                }
                
                ?>

                                <input class="input-field" type="phone" class="form-control" name="phone"
                                    placeholder="<?php echo _("phone_number"); ?>">


                            </div>
                        </div>


                        <!-- Password Container -->
                        <div class="col-sm-12">
                            <div class="input-container <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                <i class="fas fa-lock" id="sign-icon"></i>
                                <input class="input-field" id="password-field" type="password" class="form-control"
                                    name="password" placeholder="<?php echo _("password"); ?>">
                                <span toggle="#password-field"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                        </div>
                        <!-- Error Container -->
                        <div class="err">
                            <span class="help-block"><?php echo  $phone_err; ?></span>
                            <span class="help-block"><?php echo $password_err; ?></span>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn" value="login"><?php echo _("login_button"); ?></button>
                        <div class="btn-shadow">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="login-footer">
            <p>Powerd by Azora</p>

        </div>
    </div>
    <!-- Footer Js -->
    <script src="layout/js/jquery.js"></script>
    <script src="../Dashboard/layout/js/new/login/script.js"></script>
    <script src="layout/js/fontawesome.js"></script>
</body>

</html>