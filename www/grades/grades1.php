<?php
 $PageID=101;
 $root=$_SERVER['DOCUMENT_ROOT'];
 session_start();
#--------------------------------------------------------------------
# Check auth
#--------------------------------------------------------------------
if(!$_SESSION['logged_id']){
   $_SESSION['page_id']=$PageID;
   header('Location:/auth/auth.php');
} else {
   $username = $_SESSION['user_id'] ;
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

   pageid('Βαθμολόγηση');

#-------------------------------------------------------
# Get data from form
# myID-> applicant id
# rankID -> examiner id
#-------------------------------------------------------
 $myID = $_POST["id"];
 $rankID = $_POST["rankid"];
 $lessonID = $_POST["lessonid"];


#-------------------------------------------------
# Find Field name and Department from lessonID
#-------------------------------------------------
$sql = "SELECT department, field  FROM lessons WHERE lessonID='$lessonID' " ;
$retval = mysqli_query($conn, $sql);
if(! $retval ) {  die('Could not get data: ' . mysqli_error($conn)); }
while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
{
    $myDepartment=$row['department'];
    $myField=$row['field'];
}

#----------------------------------------------------------------
# Retrieve applicant data (id, name, surname) from applications
#----------------------------------------------------------------
$app_sql = "SELECT id, name, surname FROM applications WHERE id = '$myID' AND active='1';" ;
$app_val = mysqli_query($conn, $app_sql);
if(! $app_val ) {   die('Could not get data: ' . mysqli_error($conn)); }
while($row = mysqli_fetch_array($app_val, MYSQLI_ASSOC))
{
    $myName=$row['name'];
    $mySurname=$row['surname'];
}

    $date=date("Y-m-d H:i");
?>


 <div class="container-fluid">
    <div class="row">
       <div class="col-12">
	  <div class="card">
	     <div class="card-body">
<?php
    	        echo "<h3 class='text-primary'>$myField</h3> ";
?>

   		<div class="card card-outline-info">
      		   <div class="card-header">
          	      <?php echo "<h4 class='m-b-0 text-white'>$myID - $mySurname $myName</h4>"; ?>
      		   </div>
   	        </div>


		<form method='post' action="/grades/grades2.php" class="form-horizontal">
              	   <div class="form-body">
                       <hr class="m-t-0 m-b-40">

			<div class="table-responsive">
            		   <div class="table">
              		      <div class="tr">
<!--
                 		 <span class="td">Συνάφεια ΔΔ</span>
-->
                 		 <span class="td">ΔΔ μετά το 2009</span>
                 		 <span class="td">Σχεδιάγραμμα</span>
                 		 <span class="td">ΔΔ στο εξωτερικό</span>
                 		 <span class="td">ΔΟΑΤΑΠ</span>
              		      </div>

<?php
       # hidden variables to the next page
       echo "<input name='id' type='hidden' value=$myID />";
       echo "<input name='rankid' type='hidden' value=$rankID />";
       echo "<input name='lessonid' type='hidden' value=$lessonID />";

#       echo "<span class='td'><label class='checkbox-inline'> <input name='check1' type='checkbox' value='1'> </label> </span>";
       echo "<span class='td'><label class='checkbox-inline'> <input name='check2' type='checkbox' value='1'> </label> </span>";
       echo "<span class='td'><label class='checkbox-inline'> <input name='check3' type='checkbox' value='1'> </label> </span>";
       echo "<span class='td'><label class='checkbox-inline'> <input name='check4' type='checkbox' value='1'> </label> </span>";
       echo "<span class='td'><label class='checkbox-inline'> <input name='check5' type='checkbox' value='1'> </label> </span>";
?>
          		   </div> 
			</div> 

                  	<div class="form-actions">
                      	   <div class="row">
                              <div class="col-md-6">
                                 <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                       <button type="submit" class="btn btn-success">Συνέχεια</button>
                                       <button type="button" class="btn btn-inverse">Άκυρο</button>
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

<?php
   include_once $root.'/common/footer.php';
 } else {
       session_unset();
       session_destroy();
       header( "Location:/unauthorized.php");
   } #isDD
} #session
?>


