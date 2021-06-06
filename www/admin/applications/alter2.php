<?php
 $PageID=3;
 $root=$_SERVER['DOCUMENT_ROOT'];
session_start();
#--------------------------------------------------------------------
# Check auth
#--------------------------------------------------------------------
if(!$_SESSION['logged_id']){
   $_SESSION['page_id']=$PageID;
   header('Location:'.$root.'/auth/auth.php');
} else {
   $login = $_SESSION['user_id'] ;
   error_log("teach $login-$PageID");
#--------------------------------------------------------------------
# Check ADMIN and PageID
#--------------------------------------------------------------------
   $isDD=false;
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

     include $root.'/common/header.php';
     include $root.'/common/functions.pages.php';
     include $root.'/common/functions.inc.php';
     include $root.'/config/config.inc.php';

 $date=date("Y-m-d H:i");

#-------------------------------------------------------------------------------------
# Retrieve data from previous page
#-------------------------------------------------------------------------------------
$ID = $_POST["selectedID"];
$myType = $_POST["type"];

if ($myType >= 0) {
 $sql = "UPDATE applications SET active='$myType'  WHERE  id='$ID'; ";
       $retval = mysqli_query($conn, $sql);
       if(! $retval ) { die('Could not get data: ' . mysqli_error($conn)); }
}

   pageid('Αιτήσεις');
?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-lg-12">
                                        <div class="card-content">
					    <div class="alert alert-danger">
						<h2>Η αλλαγή κατάστασης έγινε.</h2>
					    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

            <form action="index.php" method="post" name="submited" >
                <div class="col-md-12">
                    <input type="submit" name="active" class="btn btn-success"  value="Επιστροφή" />
                </div>
            </form>
<?php
   include $root.'/common/footer.php';

  } else {
       session_unset();
       session_destroy();
       header( "Location:/unauthorized.php");
   } #isDD


} #session
?>

