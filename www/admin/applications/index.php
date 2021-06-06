<?php
 $PageID=3;
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
 error_log("teach $login-$PageID");
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

 include_once $root.'/common/header.php';
 include $root.'/common/functions.pages.php';
 include $root.'/config/config.inc.php';

pageid('Αιτήσεις');
?>

      <div class="container-fluid">
         <div class="row">
             <div class="col-lg-12">
                <div class="card card-outline-primary">
                    <div class="card-body">
		      <p>Αιτήσεις που υποβλήθηκαν.</p>
			<form class='form-valide' name='applications_data' action='applications.php' method='post'>
                         <div class="form-body">
                            <div class="row">

                                <div class="col-md-4">
                                   <div class="form-group has-danger">
                                      <label class="control-label">Είδος αίτησης</label>
				      <select class="form-control" name="type" id="type">
      					                 <option value="-1" selected="selected">Όλες</option>
      					                 <option value="1">Ενεργές</option>
      					                 <option value="0">Ανενεργές</option>
      					                 <option value="2">Ακυρωμένες</option>
    				      </select>
                                   </div>
                                </div>

                            </div>
                         </div>
	 		    <input type="submit" name="approve" class="btn btn-success"  value="Επιλογή" />
		       </form>
	            </div>
            </div>
         </div>
       </div>
<?php
   include $root.'/common/footer.php';
   } else {
       session_unset();
       session_destroy();
       header( "Location:/unauthorized.php");
   } #isDD
} #session
?>
