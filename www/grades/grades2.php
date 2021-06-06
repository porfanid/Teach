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
# Check PageID
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


#-------------------------------------------------------
# Get data from form
# myID-> applicant id
# rankID -> examiner id
#-------------------------------------------------------
 $myID = $_POST["id"];
 $rankID = $_POST["rankid"];
 $lessonID = $_POST["lessonid"];
# $myCheck1 = $_POST["check1"];
 $myCheck2 = $_POST["check2"];
 $myCheck3 = $_POST["check3"];
 $myCheck4 = $_POST["check4"];
 $myCheck5 = $_POST["check5"];

 $myCheck1='1'; 
 $newCheck1=1;
 #if ($myCheck1 == '1') { $newCheck1=1; } else {  $newCheck1=0; }
 if ($myCheck2 == '1') { $newCheck2=1; } else {  $newCheck2=0; }
 if ($myCheck3 == '1') { $newCheck3=1; } else {  $newCheck3=0; }
 if ($myCheck4 == '1') { $newCheck4=1; } else {  $newCheck4=0; }
 if ($myCheck5 == '1') { $newCheck5=1; } else {  $newCheck5=0; }


#-------------------------------------------------
# Find Field name and Department from lessonID
#-------------------------------------------------
$sql = "SELECT department, field  FROM lessons WHERE lessonID LIKE '$lessonID' " ;
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
$app_sql = "SELECT id, name, surname FROM applications WHERE id = '$myID' " ;
$app_val = mysqli_query($conn, $app_sql);
if(! $app_val ) {  die('Could not get data: ' . mysqli_error($conn)); }
while($row = mysqli_fetch_array($app_val, MYSQLI_ASSOC))
{
    $myID=$row['id'];
    $myName=$row['name'];
    $mySurname=$row['surname'];
}

#----------------------------------------------------------------
# Check boxes id names
#----------------------------------------------------------------
    $LessonSelected='1';
    $mark1='required'.$LessonSelected.'_'.$rankID.'_1';
    $mark2='required'.$LessonSelected.'_'.$rankID.'_2';
    $mark3='required'.$LessonSelected.'_'.$rankID.'_3';
    $mark4='required'.$LessonSelected.'_'.$rankID.'_4';
    $mark5='required'.$LessonSelected.'_'.$rankID.'_5';
    $mark_date='mark'.$LessonSelected.'_'.$rankID.'_date';

    $date=date("Y-m-d H:i");
#------------------------------------------------------------------
# HTML
#------------------------------------------------------------------
?>
<div class="page-wrapper">
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Βαθμολόγηση</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Βαθμολόγηση-3</li>
         </ol>
    </div>
 </div>
 <div class="container-fluid">
    <div class="row">
       <div class="col-12">

	  <div class="card">
    	     <?php echo "<h3 class='text-primary'>$myField</h3> "; ?>
   	     <div class="card card-outline-info">
      		<div class="card-header">
          	   <?php echo "<h4 class='m-b-0 text-white'>$myID - $mySurname $myName</h4>"; ?>
      		</div>

<?php
#---------------------------------------------------------------------------
# Check criteria.
#---------------------------------------------------------------------------
if ($myCheck1 == '1' && $myCheck2 == '1' && $myCheck3 == '1'  && $myCheck4 == $myCheck5  ) {

#----------------------------------------------------------------------------------
# Criteria OK -> Grades
#----------------------------------------------------------------------------------
?>
	     <div class="card-body">
   		<div class="card card-outline-info">
      		   <div class="alert alert-danger">
          	      <h5 class='m-b-0'> Η κλίμακα βαθμολόγησης ειναι 0-10 σε όλα τα πεδία.</h5>
          	   <h6 class='m-b-0'> Οι συντελεστές βαρύτητας υπολογίζονται αυτόματα.</h6>
      		</div>
             </div>
          <form class='form-horizontal' name='myForm' action='/grades/grades3.php'  method='post' onsubmit='return validateGrades()'>

<?php 
 # hidden variables to the next page
       echo "<input name='id' type='hidden' value=$myID />";
       echo "<input name='rankid' type='hidden' value=$rankID />";
       echo "<input name='name' type='hidden' value=$myName />";
       echo "<input name='surname' type='hidden' value=$mySurname />";
       echo "<input name='lessonid' type='hidden' value=$lessonID />";
       echo "<input name='field' type='hidden' value='$myField' />";

       echo "<input name='check1' type='hidden' value=$newCheck1 /> ";
       echo "<input name='check2' type='hidden' value=$newCheck2 /> ";
       echo "<input name='check3' type='hidden' value=$newCheck3 /> ";
       echo "<input name='check4' type='hidden' value=$newCheck4 /> ";
       echo "<input name='check5' type='hidden' value=$newCheck5 /> ";
?>
              <div class="form-body">
                  <hr class="m-t-0 m-b-40">

                  <div class="row">
		     <div class="col-md-8">
                         <div class="form-group row">
                             <label class="control-label text-right col-md-6">Συνάφεια ΔΔ</label>
                             <div class="col-md-2">
                                 <input name='grade1' id='grade1' type='text' id='grade1' class='form-control' placeholder='-' >
                             </div>
                         </div>
                     </div>   
                  </div>         

                  <div class="row">
                     <div class="col-md-8">
                         <div class="form-group has-danger row">
                            <label class="control-label text-right col-md-6">Συνάφεια δημοσιευμένου έργου</label>
                                <div class="col-md-2">
                                   <input name='grade2' id='grade2' type='text' class='form-control' placeholder='-' >
                                </div>
                          </div>
                      </div>
                  </div>        


<!--
                  <div class="row">
                     <div class="col-md-8">
                         <div class="form-group has-danger row">
                            <label class="control-label text-right col-md-6">Διδακτική ή εργαστηριακή εμπειρία</label>
                                <div class="col-md-2">
                                     <?php #echo "<input name='grade3' type='text' class='form-control' placeholder='-' >"; ?>
                                </div>
                          </div>
                      </div>
                  </div>  
-->
<input name='grade3' id='grade3' type='hidden' class='form-control' value=0 >

                  <div class="row">
                     <div class="col-md-8">
                         <div class="form-group has-danger row">
                            <label class="control-label text-right col-md-6">Δημοσιεύσεις/Ανακοινώσεις</label>
                                <div class="col-md-2">
                                   <input name='grade4' id='grade4' type='text' class='form-control' placeholder='-' >
                                </div>
                          </div>
                      </div>
                  </div>  

                  <div class="row">
                     <div class="col-md-8">
                         <div class="form-group has-danger row">
                            <label class="control-label text-right col-md-6">Συνάφεια με την περιγραφή κάθε μαθήματος</label>
                                <div class="col-md-2">
                                    <input name='grade5' id='grade5' type='text' class='form-control' placeholder='-' >
                                </div>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                     <div class="col-md-8">
                         <div class="form-group has-danger row">
                            <label class="control-label text-right col-md-6">Ενσωμάτωση καινοτόμων μεθοδολογιών</label>
                                <div class="col-md-2">
                                   <input name='grade6' id='grade6' type='text' class='form-control' placeholder='-' >
                                </div>
                          </div>
                      </div>
                  </div>   

 	          <div class="row">
                     <div class="col-md-8">
                         <div class="form-group has-danger row">
                            <label class="control-label text-right col-md-6">Δομή</label>
                                <div class="col-md-2">
                                    <input name='grade7' id='grade7' type='text' class='form-control' placeholder='-' >
                                </div>
                          </div>
                      </div>
                  </div> 

		  <div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Σχόλια</label>
                              <div class="col-md-9">
                                  <textarea cols="100" rows="12" name="comments" maxlength='3000'  /></textarea>
                               </div>
                         </div>
                    </div>
                 </div>

		  <div class="form-actions">
                      <div class="row">
                         <div class="col-md-6">
                             <div class="row">
                                 <div class="col-md-offset-3 col-md-9">
                                     <button type="submit" class="btn btn-success">Συνέχεια</button>
                                     <button type="button" class="btn btn-inverse">Cancel</button>
                                 </div>
                             </div>
                         </div>
                      </div> 
                  </div>
                      
              </div>        
                      
          </form>
<?php

#--------------------------------------------------------------------------------------
# Citeria rejected.
#--------------------------------------------------------------------------------------
} else {
?>
              <div class="col-md-6">
  		<h3>Δεν τηρούνται τα κριτήρια.</h3>
		<h4>Η περαιτέρω βαθμολόγηση παρέλκει.</h4>


	      <form class='form-horizontal' action='/grades/'  >
                <div class="form-actions">
                      <div class="row">
                         <div class="col-md-6">
                             <div class="row">
                                 <div class="col-md-offset-3 col-md-9">
                                     <button type="submit" class="btn btn-success">Επιστροφή</button>
                                 </div>
                             </div>
                         </div>
                      </div>
                  </div>
                </form>


<?php


#----------------------------------------------------------------------------------
# Write to databes & Check differences for logging
#----------------------------------------------------------------------------------
$old_sql = "SELECT * FROM applications WHERE id = $myID" ;
//debug
//print $sql;

$oldval = mysqli_query($conn, $old_sql);
if(! $oldval ) { die('Could not get data: ' . mysqli_error($conn)); }


while($row = mysqli_fetch_array($oldval, MYSQLI_ASSOC))
   {
#     $oldCheck1=$row[$mark1];
     $oldCheck2=$row[$mark2];
     $oldCheck3=$row[$mark3];
     $oldCheck4=$row[$mark4];
     $oldCheck5=$row[$mark5];
   }

/*
  if ($oldCheck1 != $newCheck1){
     log_changes('applications',$mark1,$myID,$username,$oldCheck1,$newCheck1,$conn);
  }
*/
  if ($oldCheck2 != $newCheck2){
     log_changes('applications',$mark2,$myID,$username,$oldCheck2,$newCheck2,$conn);
  }
  if ($oldCheck3 != $newCheck3){
     log_changes('applications',$mark3,$myID,$username,$oldCheck3,$newCheck3,$conn);
  }
  if ($oldCheck4 != $newCheck4){
     log_changes('applications',$mark4,$myID,$username,$oldCheck4,$newCheck4,$conn);
  }
  if ($oldCheck5 != $newCheck5){
     log_changes('applications',$mark5,$myID,$username,$oldCheck5,$newCheck5,$conn);
  }
#----------------------------------------------------------------------------------

  $new_sql = "UPDATE applications SET $mark1=$newCheck1, $mark2=$newCheck2, $mark3=$newCheck3, $mark4=$newCheck4, $mark5=$newCheck5, $mark_date='$date' WHERE id = $myID " ;
  $newval = mysqli_query($conn, $new_sql);
  if(! $newval ) { die('Could not get data: ' . mysqli_error($conn)); }


#----------------------------------------------------------------------------------
# email admins
#----------------------------------------------------------------------------------
#if ($myCheck1 == 1) { $humanCheck1='ΝΑΙ'; } else  { $humanCheck1='OXI'; }
if ($myCheck2 == 1) { $humanCheck2='ΝΑΙ'; } else  { $humanCheck2='OXI'; }
if ($myCheck3 == 1) { $humanCheck3='ΝΑΙ'; } else  { $humanCheck3='OXI'; }
if ($myCheck4 == 1) { $humanCheck4='ΝΑΙ'; } else  { $humanCheck4='OXI'; }
if ($myCheck5 == 1) { $humanCheck5='ΝΑΙ'; } else  { $humanCheck5='OXI'; }

$message="A-Βαθμολογήθηκε από: ".$username."\n";
$message=$message."Βαθμολογήθηκε o: ".$myName." ".$mySurname."\n";
$message=$message."Πεδίο:".$myField."\n\n";

#$message=$message."Συνάφεια ΔΔ: ".$humanCheck1."\n";
$message=$message."ΔΔ μετά το 2008: ".$humanCheck2."\n";
$message=$message."Σχεδιάγραμμα: ".$humanCheck3."\n";
$message=$message."ΔΔ στο εξωτερικό: ".$humanCheck4."\n";
$message=$message."ΔΟΑΤΑΠ: ".$humanCheck5."\n\n";

$message=$message."Δεν τηρούνται τα κριτήρια. \n";
$message=$message."Η περαιτέρω βαθμολόγηση παρέλκει. \n";

$subject='Βαθμολόγηση υποψηφίου';

send_mail($subject, $message, $mail_from);

} # End if Criteria check
?>
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
