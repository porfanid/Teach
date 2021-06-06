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

   include_once $root.'/common/header.php';
   include $root.'/common/functions.pages.php';
   include $root.'/common/functions.inc.php';
   include $root.'/config/config.inc.php';

  pageid('Βαθμολόγηση');
#-------------------------------------------------------------------------------------
# DEP LDAP search
#-------------------------------------------------------------------------------------
# $info=ldapBind($username);
# $rankName=$info[0]["displayname;lang-el"][0];
##$myEmail=$info[0]["mail"][0];


#-------------------------------------------------------------------------------------
# DEP DATABASE search
#-------------------------------------------------------------------------------------
 $sql = "SELECT user, fullname FROM users WHERE user='$username' " ;
 $retval = mysqli_query($conn, $sql);
 if(! $retval ) { die('Could not get data: ' . mysqli_error($conn)); }
 while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
  {
    $rankName=$row['fullname'];
  }
#-------------------------------------------------------------------------------------

?>
 <div class="container-fluid">
    <div class="row">
       <div class="col-12">
	  <h3 class='text-success'>Συνδεθήκατε ως: <?php echo $rankName; ?></h3> 
	  <h3 class='text-success'>Τα μαθήματα που σας ανατέθηκαν είναι τα παρακάτω:</h3> 

<?php

for ($rankID= 1; $rankID <= 3; $rankID++) {
  $rank="examiner".$rankID;

  $sql = "SELECT id, lessonID, department, field  FROM lessons WHERE $rank='$username' ORDER BY department ASC;" ;
  $retval = mysqli_query($conn, $sql);
  if(! $retval ) { die('Could not get data: ' . mysqli_error($conn)); }
  while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
   {
     $ID=$row['id'];
     $lessonID=$row['lessonID'];
     $myDepartment=$row['department'];
     $myField=$row['field'];
?>
    <div class="card">
      <div class="card-body">
<?php
     echo "<h3 class='text-primary'>$lessonID - $myField</h3> ";
?>

      <div class="table-responsive">
          <div class="table">
              <div class="tr">
	         <span class="td">#</span>
		 <span class="td">Ονοματεπώνυμο</span>
		 <span class="td">Πρόταση</span>
		 <span class="td">Σχεδιαγράμματα</span>
		 <span class="td">Βιογραφικό</span>
		 <span class="td">ΔΔ</span>
		 <span class="td">Δήλωση</span>
		 <span class="td">Βαθμολογήθηκε</span>
		 <span class="td"></span>
              </div>
<?php


#Extract applicants from lessonID
	$app_sql = "SELECT id, name, surname, phone, mark1_1_date, mark1_2_date, mark1_3_date FROM applications WHERE field1 = '$ID' AND active='1' ORDER BY surname ASC" ;
	$app_val = mysqli_query($conn, $app_sql);
	if(! $app_val ) { die('Could not get data: ' . mysqli_error($conn)); }
	while($row = mysqli_fetch_array($app_val, MYSQLI_ASSOC))
	{
      	   $myID=$row['id'];
      	   $myName=$row['name'];
      	   $mySurname=$row['surname'];
      	   $myPhone=$row["phone"];
      	   $uploaddir="/documents/".$myPhone."/";
           $CV=$uploaddir."CV.pdf";
      	   $APP=$uploaddir."Application.pdf";
      	   $PHD=$uploaddir."Phd.pdf";
      	   $Schedule=$uploaddir."Schedule.pdf";
      	   $Statement=$uploaddir."Statement.pdf";

      	   $mark[1]=$row["mark1_1_date"];
      	   $mark[2]=$row["mark1_2_date"];
      	   $mark[3]=$row["mark1_3_date"];

	   $myMark=$mark[$rankID];

       	   echo "<form class='tr' method='post' action='/grades/grades1.php'>";
       # hidden variables to the next page
       	   echo "<input name='id' type='hidden' value=$myID />";
           echo "<input name='rankid' type='hidden' value=$rankID />";
       	   echo "<input name='lessonid' type='hidden' value=$lessonID />";

       	   echo "<span class='td'>$myID</span> ";
       	   echo "<span class='td'>$mySurname $myName</span> ";
       	   echo "<span class='td'><a target='_blank' rel='noopener noreferrer' href='".$APP."' ><img src='/common/images/pdf-2127829_640.png'> </a></span>";
       	   echo "<span class='td'><a target='_blank' rel='noopener noreferrer' href='".$Schedule."' ><img src='/common/images/pdf-2127829_640.png'> </a></span>";
       	   echo "<span class='td'><a target='_blank' rel='noopener noreferrer' href='".$CV."' ><img src='/common/images/pdf-2127829_640.png'> </a></span>";
       	   echo "<span class='td'><a target='_blank' rel='noopener noreferrer' href='".$PHD."' ><img src='/common/images/pdf-2127829_640.png'> </a></span>";
       	   echo "<span class='td'><a target='_blank' rel='noopener noreferrer' href='".$Statement."' ><img src='/common/images/pdf-2127829_640.png'> </a></span>";

#Βαθμολογήθηκε
   	   if ($myMark) {
       	      echo "<span class='td'>NAI</span>";
 	   } else {
       	      echo "<span class='td'>OXI</span>";
 	   }

       	   echo "<span class='td'><button type='submit' class='btn btn-success'> <i class='fa fa-check'></i> </button></span>";
     	   echo "</form>"; 
	} #While applicants

?>

         </div> <!-- end of table  -->

                </div>
             </div>
          </div>
<?php
   } #While lessons

} #End for loop
?>
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
