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

   include_once $root.'/common/header.php';
   include $root.'/common/functions.pages.php';
   include $root.'/common/functions.inc.php';
   include $root.'/config/config.inc.php';

  pageid('Αποτελέσματα');
#-------------------------------------------------------------------------------------
# LDAP search
#-------------------------------------------------------------------------------------
# $info=ldapBind($login);
# $rankName=$info[0]["displayname;lang-el"][0];
 
#-------------------------------------------------------------------------------------
# DATABASE search
#-------------------------------------------------------------------------------------
 $sql = "SELECT user, fullname FROM users WHERE user='$login' " ;
 $retval = mysqli_query($conn, $sql);
 if(! $retval ) { die('Could not get data: ' . mysqli_error($conn)); }
 while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
  {
     $rankName=$row['fullname'];
  }
#-------------------------------------------------------------------------------------
 
?>
 <div class="container-fluid">
    <div class="row justify-content-center">
       <div class="col-12">
	  <h3 class='text-success'>Συνδεθήκατε ως: <?php echo $rankName; ?></h3> 
	  <h3 class='text-success'>Τα μαθήματα που σας ανατέθηκαν και έχουν βαθμολογηθεί είναι τα παρακάτω:</h3> 

 <div class="card">
      <div class="card-body">


      <form action="results1.php"  name='approve' method="post" >

 	  <div class="table-responsive">
	    <table class="table table-hover ">
	       <thead>
                  <tr>
                    <th>A/A</th>
                    <th>Τμήμα</th>
                    <th>Πεδίο</th>
                    <th>Βαθμολογήθηκε</th>
                  </tr>
	       </thead>
	       <tbody>
<?php

#Loop if all three cat print results
#for ($rankID= 1; $rankID <= 3; $rankID++) {
$rankID= 1; 

  $rank="examiner".$rankID;

  $count=0;
  $sql = "SELECT id, LessonID, department, field  FROM lessons WHERE $rank='$login' ORDER BY department ASC" ;
  $retval = mysqli_query($conn, $sql);
  if(! $retval ) { die('Could not get data: ' . mysqli_error($conn)); }
  while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
   {
     $ID=$row['id'];
     $lessonID=$row['LessonID'];
     $myDepartment=$row['department'];
     $myField=$row['field'];


# For each field Retrieve applicants from lessonID and check rated date 
        $checkDate1=1;
        $checkDate2=1;
        $checkDate3=1;
        $app_sql = "SELECT * FROM applications WHERE field1=$ID AND active='1' ;" ;
        $app_val = mysqli_query($conn, $app_sql);
        if(! $app_val ) { die('Could not get data: ' . mysqli_error($conn)); }
        while($row = mysqli_fetch_array($app_val, MYSQLI_ASSOC))
        {
	    $Date1=$row['mark1_1_date'];
            $Date2=$row['mark1_2_date'];
            $Date3=$row['mark1_3_date'];
        }

        if (!isset($Date1)) { $checkDate1=0; }
        if (!isset($Date2)) { $checkDate2=0; }
        if (!isset($Date3)) { $checkDate3=0; }

	if ( $checkDate1==1 && $checkDate2==1 && $checkDate3==1 ) {
	   $count++;
     	   echo "<tr>";
     	   echo "<td>$lessonID</td>";
     	   echo "<td>$myDepartment</td>";
     	   echo "<td>$myField</td>";
	   if ($count == 1) {
	      echo "<td><input type='radio' name='selectedID' value='$ID' checked='checked'></td>";
	   } else {
	      echo "<td><input type='radio' name='selectedID' value='$ID' ></td>";
	   }
     	   echo "</tr>";
	} # if dates

   } #While lessons

#} #End for loop
?>
                        </tbody>
                       </table>
                  </div>
                  <hr>
                  <input type="submit" class="btn btn-primary" name="formSubmit" value="Επεξεργασία" />
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
