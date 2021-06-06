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
     $myID= $_POST['id'];
     $lessonID= $_POST['lessonid'];

     $myDepartment=$_POST['department'];
     $myField=$_POST['field'];
     $myActive=$_POST['active'];
     if  ($myActive) {
		$myChecked=1;
	} else {
		$myChecked=0;
     };

     $myTitleA=$_POST['titleA'];
     $mySemesterA=$_POST['semesterA'];
     $myDescriptionA=$_POST['descriptionA'];
     $myCategoryA=$_POST['categoryA'];
     $myEctsA=$_POST['ectsA'];
     $myHoursA=$_POST['hoursA'];

     $myTitleB=$_POST['titleB'];
     $mySemesterB=$_POST['semesterB'];
     $myDescriptionB=$_POST['descriptionB'];
     $myCategoryB=$_POST['categoryB'];
     $myEctsB=$_POST['ectsB'];
     $myHoursB=$_POST['hoursB'];


     $myTitleC=$_POST['titleC'];
     $mySemesterC=$_POST['semesterC'];
     $myDescriptionC=$_POST['descriptionC'];
     $myCategoryC=$_POST['categoryC'];
     $myEctsC=$_POST['ectsC'];
     $myHoursC=$_POST['hoursC'];

     $myExaminer1=$_POST['examiner1'];
     $myExaminer2=$_POST['examiner2'];
     $myExaminer3=$_POST['examiner3'];


     $sql = "UPDATE lessons SET lessonID=$lessonID, department='$myDepartment', field='$myField', active=$myChecked,
 	titleA='$myTitleA', semesterA='$mySemesterA', descriptionA='$myDescriptionA', categoryA='$myCategoryA', ectsA='$myEctsA', hoursA='$myHoursA',
 	titleB='$myTitleB', semesterB='$mySemesterB', descriptionB='$myDescriptionB', categoryB='$myCategoryB', ectsB='$myEctsB', hoursB='$myHoursB',
 	titleC='$myTitleC', semesterC='$mySemesterC', descriptionC='$myDescriptionC', categoryC='$myCategoryC', ectsC='$myEctsC', hoursC='$myHoursC',
        examiner1='$myExaminer1', examiner2='$myExaminer2', examiner3='$myExaminer3'  
        WHERE id=$myID";


  $retval = mysqli_query($conn, $sql);
  if(! $retval ) { die('Could not get data: ' . mysqli_error($conn)); }

?>

<div class="container-fluid">                       
    <div class="col-md-12">
        <div class="card card-outline-info">
           <div class="card-body">

		<div class="form-body">
	   	   <div class="card-header">
           	     	<h4 class="m-b-0 text-white">Οι αλλαγές έγιναν!</h4>
           	</div>

<hr>
<a href="index.php" 
    <button type="button" class="btn btn-success m-b-10 m-l-5">Επιστροφή</button>
</a>
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
