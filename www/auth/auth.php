<?php
session_start();
#==============================================================================
# Includes
#==============================================================================
 $root=$_SERVER['DOCUMENT_ROOT'];
 include $root.'/common/functions.inc.php';
 require_once $root."/config/config.inc.php";
 require_once($root.'/myUniversity/el.inc.php');

#==============================================================================
# PHP configuration tuning
#==============================================================================
# Disable output_buffering, to not send cookie information after headers
ini_set('output_buffering', '0');

# Initiate vars
$result = "isok";
$login = "";
$password = "";
$ldap = "";
$userdn = "";

if (isset($_POST["password"]) and $_POST["password"]) { $password = $_POST["password"]; }
 else { $result = "passwordrequired"; }

if (isset($_REQUEST["login"]) and $_REQUEST["login"]) { $login = $_REQUEST["login"]; }
 else { $result = "loginrequired"; }

# Strip slashes added by PHP
$login = stripslashes_if_gpc_magic_quotes($login);
$password = stripslashes_if_gpc_magic_quotes($password);



#==============================================================================
# Check password
#==============================================================================
if ( $result === "isok" ) {



	#==============================================================================
	# USe DATABASE
	#==============================================================================
	 $sql = "SELECT user, password FROM users WHERE user='$login' " ;
	 print $sql;
	 $retval = mysqli_query($conn, $sql);
	 if(! $retval ) { die('Could not get data: ' . mysqli_error($conn)); }
	 while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
	    {
	         $user=$row['user'];
	         $hashed_password=$row['password'];
	    }
	 if(password_verify($password, $hashed_password)) {
    		$result = "loggedin";
	 } 
	 echo "<h1>".$result."</h1>";

	#==============================================================================
	# USE LDAP
	#==============================================================================
/*
    # Connect to LDAP
    $ldap = ldap_connect($ldap_url);
    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    # Bind with password
    $userdn = "uid=$login,ou=people,dc=duth,dc=gr";
    $bind = ldap_bind($ldap, $userdn, $password);
    $errno = ldap_errno($ldap);
    if ( $errno ) {
        $result = "badcredentials";
        error_log("LDAP - Bind user error $errno  (".ldap_error($ldap).")");
    }
*/
}

#if ( $result === "isok" ) {
#    $result = "loggedin";
#}

#error_log("user_login=".$login." Result=".$result, 0);


#==============================================================================
# 1. Not Logged in
#==============================================================================
if ( $result !== "loggedin" ) {
#$myPage=0;
 include_once $root.'/common/header.php';
?>
    <div id="main-wrapper">
        <div class="unix-login">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="login-content card">
			   <div class="alert alert-<?php echo get_criticity($result) ?>">
				<h2 class="text-center"><?php echo $messages[$result]; ?></h2>
			   </div>

                            <div class="login-form">
                                 <h4><?php echo $messages['loginrequired']; ?> </h4>
                                <form method="post"  action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <div class="form-group">
                                        <label><?php echo $messages['login']; ?></label>
                                        <input  type="text" name="login" class="form-control" placeholder="<?php echo $messages['login']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $messages['password']; ?></label>
                                        <input type="password" name="password" class="form-control" placeholder="<?php echo $messages['password']; ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30"><?php echo $messages['submit']; ?></button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
 include_once $root.'/common/footer.php';

} else {
#==============================================================================
# 2. Logged in
#==============================================================================
        echo "<p>logged</p>\n";
        $username=$_POST['login'];
        setcookie("authorization","nok" );
        setcookie('username', $_POST['login'],false);
        setcookie('password', md5($_POST['password'],false) );
        $_SESSION['user_id']=$_POST['login'];
        $_SESSION['logged_id']=True;

#----------------------------------------------
# If is admin
#----------------------------------------------
#log
error_log("user_login=".$login." Result=".$result, 0);

$myAdmins = "../config/admins.php";
$isAdmin=false;

       if(exec('grep '.escapeshellarg($username).' '.$myAdmins)) {
	     $isAdmin=true;
       }


# 	echo "<p> Page_ID=" . $_SESSION['page_id'] . "</p>\n";

        if ($_SESSION['page_id'] == '101') {
                header( "Location:../grades/");
                exit();
        }elseif ($_SESSION['page_id'] == '102') {
                header( "Location:../results/");
                exit();
        }elseif ($_SESSION['page_id'] == '2' && $isAdmin) {
                header( "Location:../admin/index.php");
                exit();
        }elseif ($_SESSION['page_id'] == '3' && $isAdmin) {
                header( "Location:../admin/applications/");
                exit();
        }elseif ($_SESSION['page_id'] == '4' && $isAdmin) {
                header( "Location:../admin/fields/");
                exit();
        }elseif ($_SESSION['page_id'] == '5' && $isAdmin) {
                header( "Location:../admin/rated/");
                exit();
        }elseif ($_SESSION['page_id'] == '6' && $isAdmin) {
                header( "Location:../admin/lessons/");
                exit();
        }elseif ($_SESSION['page_id'] == '7' && $isAdmin) {
                header( "Location:../admin/logs/");
                exit();
        }else{
        	$_SESSION['logged_id']=false;
                header( "Location:/unauthorized.php");
                exit();
        }

}
?>

