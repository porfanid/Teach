<?php 
 $PageID=6;
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

pageid('Επεξεργασία Μαθήματος');

  $sql = "SELECT * FROM lessons ORDER BY id ASC" ;
  $retval = mysqli_query($conn, $sql);
  if(! $retval ) { die('Could not get data: ' . mysqli_error($conn)); }
?>

<div class="container-fluid">                       
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">

	    <div class="row">
    	       <div class="col-lg-12">
        	  <div class="card">
             	     <div class="card-title">

			<form action="editlessons-2.php" method="post" accept-charset="foobar utt-8" onsubmit="return NoSelection();" >
		   	   <input type="submit" class="btn btn-primary" name="formSubmit" value="Συνέχεια" />
			       <div class="table-responsive">
                        	  <table class="table table-hover ">
                           	     <thead>
                               		<tr>
                                   	   <th>#</th>
                                   	   <th>Τμήμα</th>
                                   	   <th>Επιστημονικό Πεδίο</th>
                                   	   <th>Επιλογή</th>
                                	</tr>
                            	     </thead>
                            	   <tbody>

<?php
  while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
    $myID=$row['id'];
    $lessonID=$row['lessonID'];
    $myDepartment=$row['department'];
    $myField=$row['field'];

	 echo "<tr><td>$lessonID</td>
           <td style='font-size: 13px; text-align: left;'>$myDepartment</td>
		   <td style='font-size: 13px; text-align: left;'> $myField</td> 
		   <td><input type='checkbox' name='lesson[]' value='$myID'  onClick='return KeepCount(this)' id=$myID></td>
		</tr> ";
  }
?>

                                   </tbody>
                       		</table>
	          	     </div>
 			<input type="submit" class="btn btn-primary" name="formSubmit" value="Συνέχεια" />
     		     </form>
	     </div>
	</div>
    </div>
</div>

                 </div>
              </div>
           </div>                

<script>
 var NewCount = 0;// global declaration

function KeepCount(a){
     var limit=1;
     if (a.checked){
          this.NewCount++;
     }

     if (!a.checked){
          this.NewCount=document.querySelectorAll('input[type="checkbox"]:checked').length;
     }

     if(NewCount>limit){
       alert('Παρακαλώ επιλέξτε μόνο ένα επιστημονικό πεδίο!!!');
       return false;
     }
}

function NoSelection(){
     if(NewCount<1){
       alert('Παρακαλώ επιλέξτε επιστημονικό πεδίο!!!');
       return false;
     }
}

</script>

<?php 
   include_once $root.'/common/footer.php';
 } else {
       session_unset();
       session_destroy();
       header( "Location:/unauthorized.php");
   } #isDD
} #session
?>
