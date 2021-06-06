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

#---------------------------------------
# select lesson from check boxes array
#---------------------------------------
$lessonsSelected= $_POST['lesson'];

                if(!empty($lessonsSelected))
                    {
                     foreach($lessonsSelected as $myLesson)
                        {
         #                echo $myLesson;
                        }
                     }
                     else
                     {
                        echo "empty";
                     }


  $sql = "SELECT * FROM lessons WHERE id='$myLesson' " ;
  $retval = mysqli_query($conn, $sql);
  if(! $retval ) { die('Could not get data: ' . mysqli_error($conn)); }


  while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
     $myID=$row['id'];
     $lessonID=$row['lessonID'];
     $myDepartment=$row['department'];
     $myField=$row['field'];
     $myActive=$row['active'];

     $myTitleA=$row['titleA'];
     $mySemesterA=$row['semesterA'];
     $myDescriptionA=$row['descriptionA'];
     $myCategoryA=$row['categoryA'];
     $myEctsA=$row['ectsA'];
     $myHoursA=$row['hoursA'];

     $myTitleB=$row['titleB'];
     $mySemesterB=$row['semesterB'];
     $myDescriptionB=$row['descriptionB'];
     $myCategoryB=$row['categoryB'];
     $myEctsB=$row['ectsB'];
     $myHoursB=$row['hoursB'];


     $myTitleC=$row['titleC'];
     $mySemesterC=$row['semesterC'];
     $myDescriptionC=$row['descriptionC'];
     $myCategoryC=$row['categoryC'];
     $myEctsC=$row['ectsC'];
     $myHoursC=$row['hoursC'];

     $myExaminer1=$row['examiner1'];
     $myExaminer2=$row['examiner2'];
     $myExaminer3=$row['examiner3'];
  }


 if  ($myActive) {
        $myChecked=1;
    } else {
        $myChecked=0;
     };

?>

<div class="container-fluid">                       
    <div class="col-md-12">
        <div class="card card-outline-info">
           <div class="card-body">

<form action="editlessons-3.php" class="form-horizontal" method="post" >
		<div class="form-body">

	   	   <div class="card-header">
           	     	<h4 class="m-b-0 text-white">Επιστημονικό Πεδίο</h4>
           	   </div>



		<div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">ID</label>
                              <div class="col-md-9"><br \><?php echo  $myID; ?>
                                  <input type="hidden" class="form-control" name="id" value='<?php echo  $myID; ?>'  />
                               </div>
                         </div>
                    </div>
                 </div>

		<div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">A/A</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="lessonid" value='<?php echo  $lessonID; ?>'  />
                               </div>
                         </div>
                    </div>
                 </div>
		<div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Τμήμα</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="department" size='100' maxlength='100' value='<?php echo $myDepartment; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>
		<div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Επιστημονικό Πεδίο</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="field" size='100' maxlength='100' value='<?php echo $myField; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>
		<div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Ενεργό</label>
                              <div class="col-md-9">

				  <div class="[ form-group ]">
<?php
                            if ($myChecked == 0) {
            			        echo "<input type='checkbox' name='active' id='active' value='1' autocomplete='off' />";
                            } else {
            			        echo "<input type='checkbox' name='active' id='active' value='1' checked='checked' autocomplete='off' />";
                            }
?>

            			     <div class="[ btn-group ]">
                			<label for="fancy-checkbox-default" class="[ btn btn-default ]">
                    			  <span class="[ glyphicon glyphicon-ok ]"></span>
                    			  <span> </span>
                			</label>
            			    </div>
        		          </div>

                               </div>
                         </div>
                    </div>
                 </div>


<!--  LESSON A -->
	   <div class="card-header">
           	<h4 class="m-b-0 text-white">Μάθημα - 1</h4>
           </div>

		<div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Τίτλος</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="titleA" size='100' maxlength='100' value='<?php echo $myTitleA; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>
		<div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Εξάμηνο</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="semesterA" size='100' maxlength='100' value='<?php echo $mySemesterA; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>
		<div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">ECTS</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="ectsA" size='100' maxlength='100' value='<?php echo $myEctsA; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>
		<div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Ώρες εβδομαδιαίας Διδασκαλίας</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="hoursA" size='100' maxlength='100' value='<?php echo $myHoursA; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>
		<div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Περιγραφή</label>
                              <div class="col-md-9">
				  <textarea cols="100" rows="12" name="descriptionA" maxlength='3000' value='<?php echo $myDescriptionA; ?>'  required /><?php echo $myDescriptionA; ?></textarea>
                               </div>
                         </div>
                    </div>
                 </div>
		<div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Κατηγορία</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="categoryA" size='100' maxlength='100' value='<?php echo $myCategoryA; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>

<!--  LESSON B -->
	   <div class="card-header">
           	<h4 class="m-b-0 text-white">Μάθημα - 2</h4>
           </div>


		 <div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Τίτλος</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="titleB" size='100' maxlength='100' value='<?php echo $myTitleB; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Εξάμηνο</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="semesterB" size='100' maxlength='100' value='<?php echo $mySemesterB; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>
		<div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">ECTS</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="ectsB" size='100' maxlength='100' value='<?php echo $myEctsB; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Ώρες εβδομαδιαίας Διδασκαλίας</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="hoursB" size='100' maxlength='100' value='<?php echo $myHoursB; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Περιγραφή</label>
                              <div class="col-md-9">
                                  <textarea cols="100" rows="12" name="descriptionB" maxlength='3000' value='<?php echo $myDescriptionB; ?>'  required /><?php echo $myDescriptionB; ?></textarea>
                               </div>
                         </div>
                    </div>
                 </div>
		<div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Κατηγορία</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="categoryB" size='100' maxlength='100' value='<?php echo $myCategoryB; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>

<!--  LESSON C -->
<div class="card-header">
                <h4 class="m-b-0 text-white">Μάθημα - 3</h4>
           </div>


                 <div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Τίτλος</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="titleC" size='100' maxlength='100' value='<?php echo $myTitleC; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Εξάμηνο</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="semesterC" size='100' maxlength='100' value='<?php echo $mySemesterC; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>
		<div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">ECTS</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="ectsC" size='100' maxlength='100' value='<?php echo $myEctsC; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Ώρες εβδομαδιαίας Διδασκαλίας</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="hoursC" size='100' maxlength='100' value='<?php echo $myHoursC; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Περιγραφή</label>
                              <div class="col-md-9">
                                  <textarea cols="100" rows="12" name="descriptionC" maxlength='3000' value='<?php echo $myDescriptionC; ?>'  required /><?php echo $myDescriptionC; ?></textarea>
                               </div>
                         </div>
                    </div>
                 </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Κατηγορία</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="categoryC" size='100' maxlength='100' value='<?php echo $myCategoryC; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>



	   <div class="card-header">
           	<h4 class="m-b-0 text-white">Βαθμολογητές</h4>
           </div>

		<div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Εξεταστής-1</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="examiner1" size='10' maxlength='9' value='<?php echo $myExaminer1; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>
		<div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Εξεταστής-2</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="examiner2" size='10' maxlength='9' value='<?php echo $myExaminer2; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>
		<div class="row">
                    <div class="col-md-9">
                        <div class="form-group row">
                              <label class="control-label text-right col-md-3">Εξεταστής-3</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="examiner3" size='10' maxlength='9' value='<?php echo $myExaminer3; ?>'  required />
                               </div>
                         </div>
                    </div>
                 </div>



 	<input type="submit" class="btn btn-primary" name="formSubmit" value="Συνέχεια" />
</div>
     </form>

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
