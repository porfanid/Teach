<?php
 $PageID=102;
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
   $isPageOk=false;
   if ( $_SESSION['page_id'] == $PageID ) {
      $isPageOk=true;
   }


  if ( $isPageOk ) {
   include $root.'/config/config.inc.php';
   include_once $root.'/common/header.php';
   include $root.'/common/functions.pages.php';
   include $root.'/common/functions.inc.php';

  pageid('Αποτελέσματα');
#-------------------------------------------------------
# Get data from form
#-------------------------------------------------------
   $ID = $_POST["selectedID"];
   $fileName='/ektyposeis/'.$login.'-'.$ID.'.pdf';
   $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

   exec("/usr/local/bin/wkhtmltopdf --lowquality $actual_link'/private/results2.php?selectedID='$ID'&login='$login $root.$fileName ");
?>

 	   <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-lg-12">
                                        <h4 class="card-title">Αποτελέσματα αξιολόγησης πρότασης.</h4>
                                        <div class="card-content">

		<form method='post' action="<?php echo $fileName; ?>" class="form-horizontal" target="_blank">
                   <div class="form-body">
		       <div class="form-actions">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                       <button type="submit" class="btn btn-success">Εμφάνιση-Αποθήκευση</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
       		    </div> 
   	       </form> 


       </div> 
       </div> 
       </div> 
       </div> 
       </div> 
   </div> 
</div> 

<?php
 include_once $root.'/common/footer.php';

 } else {
       session_unset();
       session_destroy();
       header( "Location:/unauthorized.php");
  } #isDD
} #session
?>


