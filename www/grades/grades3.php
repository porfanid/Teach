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
#$isDD=true;
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
 $myName = $_POST["name"];
 $mySurname = $_POST["surname"];
 $lessonID = $_POST["lessonid"];
 $myField = $_POST["field"];

 $myCheck1 = $_POST["check1"];
 $myCheck2 = $_POST["check2"];
 $myCheck3 = $_POST["check3"];
 $myCheck4 = $_POST["check4"];
 $myCheck5 = $_POST["check5"];

 $myGrade1 = $_POST["grade1"];
 $myGrade2 = $_POST["grade2"];
 $myGrade3 = $_POST["grade3"];
 $myGrade4 = $_POST["grade4"];
 $myGrade5 = $_POST["grade5"];
 $myGrade6 = $_POST["grade6"];
 $myGrade7 = $_POST["grade7"];
 $myComments = $_POST["comments"];

   $totalError=FALSE;
   $error1=FALSE;
   $error2=FALSE;
   $error3=FALSE;
   $error4=FALSE;
   $error5=FALSE;
   $error6=FALSE;
   $error7=FALSE;
#----------------------------------------------------------------
# Check grades
#----------------------------------------------------------------
 if ($myGrade1 < 0 || $myGrade1 > 10) {
   $error1=TRUE;
   $totalError=TRUE;
 }
 if ($myGrade2 < 0 || $myGrade2 > 10) {
   $error2=TRUE;
   $totalError=TRUE;
 }
 if ($myGrade3 < 0 || $myGrade3 > 10) {
   $error3=TRUE;
   $totalError=TRUE;
 }
 if ($myGrade4 < 0 || $myGrade4 > 10) {
   $error4=TRUE;
   $totalError=TRUE;
 }
 if ($myGrade5 < 0 || $myGrade5 > 10) {
   $error5=TRUE;
   $totalError=TRUE;
 }
 if ($myGrade6 < 0 || $myGrade6 > 10) {
   $error6=TRUE;
   $totalError=TRUE;
 }
 if ($myGrade7 < 0 || $myGrade7 > 10) {
   $error7=TRUE;
   $totalError=TRUE;
 }

if (!$totalError) {


#----------------------------------------------------------------
# Check boxes id names
#----------------------------------------------------------------
    $LessonSelected='1';
    $mark1='required'.$LessonSelected.'_'.$rankID.'_1';
    $mark2='required'.$LessonSelected.'_'.$rankID.'_2';
    $mark3='required'.$LessonSelected.'_'.$rankID.'_3';
    $mark4='required'.$LessonSelected.'_'.$rankID.'_4';
    $mark5='required'.$LessonSelected.'_'.$rankID.'_5';

    $mark6='mark'.$LessonSelected.'_'.$rankID.'_6';
    $mark7='mark'.$LessonSelected.'_'.$rankID.'_7';
    $mark8='mark'.$LessonSelected.'_'.$rankID.'_8';
    $mark9='mark'.$LessonSelected.'_'.$rankID.'_9';
    $mark10='mark'.$LessonSelected.'_'.$rankID.'_10';
    $mark11='mark'.$LessonSelected.'_'.$rankID.'_11';
    $mark12='mark'.$LessonSelected.'_'.$rankID.'_12';
    $mark_comments='mark'.$LessonSelected.'_'.$rankID.'_comments';
    $mark_date='mark'.$LessonSelected.'_'.$rankID.'_date';

    $date=date("Y-m-d H:i");

#----------------------------------------------------------------------------------
# Check differences for logging
#----------------------------------------------------------------------------------
$old_sql = "SELECT * FROM applications WHERE id = $myID" ;
$oldval = mysqli_query($conn, $old_sql);
if(! $oldval ) { die('Could not get data: ' . mysqli_error($conn)); }
while($row = mysqli_fetch_array($oldval, MYSQLI_ASSOC))
   {
     $oldCheck1=$row[$mark1];
     $oldCheck2=$row[$mark2];
     $oldCheck3=$row[$mark3];
     $oldCheck4=$row[$mark4];
     $oldCheck5=$row[$mark5];

     $oldGrade1=$row[$mark6];
     $oldGrade2=$row[$mark7];
     $oldGrade3=$row[$mark8];
     $oldGrade4=$row[$mark9];
     $oldGrade5=$row[$mark10];
     $oldGrade6=$row[$mark11];
     $oldGrade7=$row[$mark12];
}

  if ($oldCheck1 != $myCheck1){
     log_changes('applications',$mark1,$myID,$username,$oldCheck1,$myCheck1,$conn);
  } 
  if ($oldCheck2 != $myCheck2){
     log_changes('applications',$mark2,$myID,$username,$oldCheck2,$myCheck2,$conn);
  } 
  if ($oldCheck3 != $myCheck3){
     log_changes('applications',$mark3,$myID,$username,$oldCheck3,$myCheck3,$conn);
  } 
  if ($oldCheck4 != $myCheck4){
     log_changes('applications',$mark4,$myID,$username,$oldCheck4,$myCheck4,$conn);
  } 
  if ($oldCheck5 != $myCheck5){
     log_changes('applications',$mark5,$myID,$username,$oldCheck5,$myCheck5,$conn);
  } 

  if ($oldGrade1 != $myGrade1){
     log_changes('applications',$mark6,$myID,$username,$oldGrade1,$myGrade1,$conn);
  } 
  if ($oldGrade2 != $myGrade2){
     log_changes('applications',$mark7,$myID,$username,$oldGrade2,$myGrade2,$conn);
  } 
  if ($oldGrade3 != $myGrade3){
     log_changes('applications',$mark8,$myID,$username,$oldGrade3,$myGrade3,$conn);
  } 
  if ($oldGrade4 != $myGrade4){
     log_changes('applications',$mark9,$myID,$username,$oldGrade4,$myGrade4,$conn);
  } 
  if ($oldGrade5 != $myGrade5){
     log_changes('applications',$mark10,$myID,$username,$oldGrade5,$myGrade5,$conn);
  } 
  if ($oldGrade6 != $myGrade6){
     log_changes('applications',$mark11,$myID,$username,$oldGrade6,$myGrade6,$conn);
  } 
  if ($oldGrade7 != $myGrade7){
     log_changes('applications',$mark12,$myID,$username,$oldGrade7,$myGrade7,$conn);
  } 

#----------------------------------------------------------------------------------
# Write in database
#----------------------------------------------------------------------------------
$new_sql = "UPDATE applications SET $mark1=$myCheck1, $mark2=$myCheck2, $mark3=$myCheck3, $mark4=$myCheck4,  $mark5=$myCheck5,
    $mark6=$myGrade1, $mark7=$myGrade2,  $mark8=$myGrade3, $mark9=$myGrade4,
    $mark10=$myGrade5,  $mark11=$myGrade6, $mark12=$myGrade7,
    $mark_comments='$myComments',  $mark_date='$date' WHERE id = $myID " ;
$newval = mysqli_query($conn, $new_sql);
if(! $newval ) { die('Could not get data: ' . mysqli_error($conn)); }


#----------------------------------------------------------------------------------
# email admins
#----------------------------------------------------------------------------------
if ($myCheck1 == 1) { $humanCheck1='ΝΑΙ'; } else  { $humanCheck1='OXI'; }
if ($myCheck2 == 1) { $humanCheck2='ΝΑΙ'; } else  { $humanCheck2='OXI'; }
if ($myCheck3 == 1) { $humanCheck3='ΝΑΙ'; } else  { $humanCheck3='OXI'; }
if ($myCheck4 == 1) { $humanCheck4='ΝΑΙ'; } else  { $humanCheck4='OXI'; }
if ($myCheck5 == 1) { $humanCheck5='ΝΑΙ'; } else  { $humanCheck5='OXI'; }

$message="Βαθμολογήθηκε από: ".$username."\n";
$message=$message."Βαθμολογήθηκε o: ".$myName." ".$mySurname."\n";
$message=$message."Πεδίο:".$myField."\n\n";

#$message=$message."Συνάφεια ΔΔ: ".$humanCheck1."\n";
$message=$message."ΔΔ μετά το 2008: ".$humanCheck2."\n";
$message=$message."Σχεδιάγραμμα: ".$humanCheck3."\n";
$message=$message."ΔΔ στο εξωτερικό: ".$humanCheck4."\n";
$message=$message."ΔΟΑΤΑΠ: ".$humanCheck5."\n\n";

$message=$message."Συνάφεια ΔΔ:".$myGrade1."\n";
$message=$message."Συνάφεια δημοσιευμένου έργου:".$myGrade2."\n";
#$message=$message."Διδακτική ή εργαστηριακή εμπειρία:".$myGrade3."\n";
$message=$message."Δημοσιεύσεις:".$myGrade4."\n";
$message=$message."Συνάφεια με την περιγραφή κάθε μαθήματος:".$myGrade5."\n";
$message=$message."Καινοτόμων μεθοδολογιών:".$myGrade6."\n";
$message=$message."Δομή:".$myGrade7."\n";
$message=$message."Σχόλια:".$myComments."\n";

$subject='Βαθμολόγηση υποψηφίου';

send_mail($subject, $message, $mail_from);
#----------------------------------------------------------------------------------
# Criteria OK -> Grades
#----------------------------------------------------------------------------------
?>
 <h3 class="text-primary text-white bg-success">Υποβλήθηκε με επιτυχία</h3>
 <div class="container-fluid">
    <div class="row">
       <div class="col-12">

	 <div class="card">
	    <div class="card-body">
    		<?php echo "<h3 class='text-primary'>$myField</h3> "; ?>
   		<div class="card card-outline-info">
      		    <div class="card-header">
          	         <?php echo "<h4 class='m-b-0 text-white'>$myID - $mySurname $myName</h4>"; ?>
      		    </div>

              <div class="form-body">
                  <hr class="m-t-0 m-b-40">

                  <div class="row">
		     <div class="col-md-8">
                         <div class="form-group row">
                             <label class="control-label text-right col-md-6">Συνάφεια ΔΔ</label>
                             <div class="col-md-2">
          			<?php echo $myGrade1; ?>
                             </div>
                         </div>
                     </div>   
                  </div>         

                  <div class="row">
                     <div class="col-md-8">
                         <div class="form-group has-danger row">
                            <label class="control-label text-right col-md-6">Συνάφεια δημοσιευμένου έργου</label>
                                <div class="col-md-2">
          			   <?php echo $myGrade2; ?>
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
          			   <?php #echo $myGrade3; ?>
                                </div>
                          </div>
                      </div>
                  </div>   
-->

                  <div class="row">
                     <div class="col-md-8">
                         <div class="form-group has-danger row">
                            <label class="control-label text-right col-md-6">Δημοσιεύσεις/Ανακοινώσεις</label>
                                <div class="col-md-2">
          			   <?php echo $myGrade4; ?>
                                </div>
                          </div>
                      </div>
                  </div>   

                  <div class="row">
                     <div class="col-md-8">
                         <div class="form-group has-danger row">
                            <label class="control-label text-right col-md-6">Συνάφεια με την περιγραφή κάθε μαθήματος</label>
                                <div class="col-md-2">
          			   <?php echo $myGrade5; ?>
                                </div>
                          </div>
                      </div>
                  </div>  

                  <div class="row">
                     <div class="col-md-8">
                         <div class="form-group has-danger row">
                            <label class="control-label text-right col-md-6">Ενσωμάτωση καινοτόμων μεθοδολογιών</label>
                                <div class="col-md-2">
          			   <?php echo $myGrade6; ?>
                                </div>
                          </div>
                      </div>
                  </div>   

 	          <div class="row">
                     <div class="col-md-8">
                         <div class="form-group has-danger row">
                            <label class="control-label text-right col-md-6">Δομή</label>
                                <div class="col-md-2">
          			   <?php echo $myGrade7; ?>
                                </div>
                          </div>
                      </div>
                  </div>   

 	          <div class="row">
                     <div class="col-md-8">
                         <div class="form-group has-danger row">
                            <label class="control-label text-right col-md-6">Σχόλια</label>
                                <div class="col-md-2">
          			   <?php echo $myComments; ?>
                                </div>
                          </div>
                      </div>
                  </div>   

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

              </div>   <!-- form body -->      
                      
      </div>  <!--  card body --> 
  </div>    <!-- card outline  -->

       </div>
    </div>
 </div>


<?php
  
} else {
# Print Errors
  echo "<h3 class='text-primary text-white bg-danger'>Λάθος βαθμολογία</h3>";
  if ($error1) {
     echo "<h4 class='text-danger'>Συνάφεια ΔΔ:&nbsp $myGrade1</h4>";
  }
  if ($error2) {
     echo "<h4 class='text-danger'>Συνάφεια δημοσιευμένου έργου:&nbsp $myGrade2</h4>";
  }
  if ($error3) {
     echo "<h4 class='text-danger'>Διδακτική ή εργαστηριακή εμπειρία:&nbsp $myGrade3</h4>";
  }
  if ($error4) {
     echo "<h4 class='text-danger'>Δημοσιεύσεις:&nbsp $myGrade4</h4>";
  }
  if ($error5) {
     echo "<h4 class='text-danger'>Συνάφεια με την περιγραφή κάθε μαθήματος:&nbsp $myGrade5</h4>";
  }
  if ($error6) {
     echo "<h4 class='text-danger'>Καινοτόμων μεθοδολογιών:&nbsp $myGrade6</h4>";
  }
  if ($error7) {
     echo "<h4 class='text-danger'>Δομή:&nbsp $myGrade7</h4>";
  }


} #totalError
   include_once $root.'/common/footer.php';
 } else {
       session_unset();
       session_destroy();
       header( "Location:/unauthorized.php");
   } #isDD
} #session
?>

