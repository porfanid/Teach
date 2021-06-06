<?php
 $PageID=5;
 $root=$_SERVER['DOCUMENT_ROOT'];
 session_start();
#--------------------------------------------------------------------
# Check auth
#--------------------------------------------------------------------
if(!$_SESSION['logged_id']){
   $_SESSION['page_id']=$PageID;
   header('Location:/auth/auth.php');
} else {
   $login = $_SESSION['user_id'] ;

#--------------------------------------------------------------------
# Check ADMIN and PageID
#--------------------------------------------------------------------
   $myDD = $root."/config/admins.php";
   $isDD=false;
   if(exec('grep '.escapeshellarg($login).' '.$myDD)) {
      $isDD=true;
   }
   $isPageOk=false;
   if ( $_SESSION['page_id'] == $PageID ) {
      $isPageOk=true;
   }

  if ( ($isDD) && ($isPageOk) ) {

 include $root.'/config/config.inc.php';
 include $root.'/common/functions.pages.php';
 include_once $root.'/common/header.php';


  $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";


  $click1="<a href='https://CUCMPub.duth.gr:8443/webdialer/Webdialer?destination=";
  $click2="'target='_blank' rel='noreferrer' >";
  $click3="</a>";
  $Subject="Γραμματεία Προγράμματος Απόκτησης Ακαδημαϊκής Εμπειρίας";
  $message ="%0D%0AΠαρακαλώ να βαθμολογήστε τα Επιστημονικά Πεδία στα οποία έχετε οριστεί ως βαθμολογητής. %0D%0A";
  $message .="Συνδεθείτε στη σελίδα ".$actual_link. "/grades/ για να τα βαθμολογήσετε.";

  $myName = $_POST["name"];
  $myEmail = $_POST["email"];
  $myPhone = $_POST["phone"];

  pageid('Στοιχεία Εξεταστών');
?>
   <div class="container-fluid">
      <div class="row">
         <div class="col-6">
            <div class="card">
               <div class="card-body">
<?php
		  echo "<h3>$myName</h3>";
		  echo "<h3>$click1$myPhone$click2$myPhone$click3</h3>";
		  echo "<h3><a href='mailto:$myEmail?Subject=$Subject&body=Κύριε/α $myName$message' target='_top'>$myEmail</a></td></h3>";
?>
          	</div>
            </div>
	    <form name='back' action='index.php' method='post'>
 		<input type="submit" class="btn btn-primary" name="formSubmit" value="Επιστροφή" />
     	    </form>
         </div>
       </div>
   </div>

<?php
 } else {
       session_unset();
       session_destroy();
       header( "Location:/unauthorized.php");
   } #isDD
} #session
?>
