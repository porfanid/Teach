<?php
$PageID=5;
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

 include $root.'/config/config.inc.php';
 include $root.'/common/functions.pages.php';
 include $root.'/common/functions.inc.php';
 include_once $root.'/common/header.php';

  pageid('Βαθμολογήθηκαν');
?>


<style>

DIV.table
   {
    display:table;
   }
FORM.tr, DIV.tr
   {
    display:table-row;
   }
SPAN.td
   {
    display:table-cell;
   }
</style>

 <div class="container-fluid">
    <div class="row">
       <div class="col-12">
          <div class="card">
             <div class="card-body">

        <div class="table-responsive">
          <div class="table">
              <div class="tr">
                 <span class="td">A/A</span>
                 <span class="td">Tμήμα</span>
                 <span class="td">Επιστημονικό Πεδίο</span>
                 <span class="td">Αιτήσεις</span>
                 <span class="td">&nbsp</span>
                 <span class="td">ΔΕΠ-1</span>
                 <span class="td">&nbsp</span>
                 <span class="td">ΔΕΠ-2</span>
                 <span class="td">&nbsp</span>
                 <span class="td">ΔΕΠ-3</span>
              </div>

<?php
$sql = "SELECT * FROM lessons ORDER BY lessonID ASC" ;
$retval = mysqli_query($conn, $sql);
if(! $retval ) {  die('Could not get data: ' . mysqli_error($conn)); }

while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
{
    $ID=$row['id'];
    $lessonID=$row['lessonID'];
    $myDepartment=$row['department'];
    $myField=$row['field'];
    $examiner1=$row['examiner1'];
    $examiner2=$row['examiner2'];
    $examiner3=$row['examiner3'];

#--------------------------------------------------------------------
# LDAP Searh   
#--------------------------------------------------------------------
/*
  $info=ldapBind($examiner1);
  $examiner1Name=$info[0]["displayname;lang-el"][0];
  $examiner1Email=$info[0]["mail"][0];
  $examiner1Phone=$info[0]["telephonenumber"][0];

  $info=ldapBind($examiner2);
  $examiner2Name=$info[0]["displayname;lang-el"][0];
  $examiner2Email=$info[0]["mail"][0];
  $examiner2Phone=$info[0]["telephonenumber"][0];

  $info=ldapBind($examiner3);
  $examiner3Name=$info[0]["displayname;lang-el"][0];
  $examiner3Email=$info[0]["mail"][0];
  $examiner3Phone=$info[0]["telephonenumber"][0];
*/  
#--------------------------------------------------------------------
# DATABASE Search
#--------------------------------------------------------------------
 $sqlE1 = "SELECT user, fullname,email, phone FROM users WHERE user='$examiner1' " ;
         $retvalE1 = mysqli_query($conn, $sqlE1);
         if(! $retvalE1 ) { die('Could not get data: ' . mysqli_error($conn)); }
         while($row = mysqli_fetch_array($retvalE1, MYSQLI_ASSOC))
	  {
	      $examiner1Name=$row['fullname'];
	      $examiner1Email=$row['email'];
	      $examiner1Phone=$row['phone'];
	  }	    

 $sqlE2 = "SELECT user, fullname,email, phone FROM users WHERE user='$examiner2' " ;
         $retvalE2 = mysqli_query($conn, $sqlE2);
         if(! $retvalE2 ) { die('Could not get data: ' . mysqli_error($conn)); }
         while($row = mysqli_fetch_array($retvalE2, MYSQLI_ASSOC))
	  {
	      $examiner2Name=$row['fullname'];
	      $examiner2Email=$row['email'];
	      $examiner2Phone=$row['phone'];
	  }	    

 $sqlE3 = "SELECT user, fullname,email, phone FROM users WHERE user='$examiner3' " ;
         $retvalE3 = mysqli_query($conn, $sqlE3);
         if(! $retvalE3 ) { die('Could not get data: ' . mysqli_error($conn)); }
         while($row = mysqli_fetch_array($retvalE3, MYSQLI_ASSOC))
	  {
	      $examiner3Name=$row['fullname'];
	      $examiner3Email=$row['email'];
	      $examiner3Phone=$row['phone'];
	  }	    

#--------------------------------------------------------------------
# Retrieve applicants from lessonID and count them
#--------------------------------------------------------------------
        $AppsCount=0;
        #$app_sql = "SELECT * FROM applications WHERE field1=$lessonID AND active='1' ;" ;
        $app_sql = "SELECT * FROM applications WHERE field1=$ID AND active='1' ;" ;
	#echo $app_sql;
        $app_val = mysqli_query($conn, $app_sql);
        if(! $app_val ) { die('Could not get data: ' . mysqli_error($conn)); }
        while($row = mysqli_fetch_array($app_val, MYSQLI_ASSOC))
        {
	        $AppsCount++;
	}


     echo "<div class='tr'>";
    if ($AppsCount == 0) {
       echo "<span class='td'><div class='alert alert-danger alert-dismissible fade show'>$lessonID</div></span>";
       echo "<span class='td'><div class='alert alert-danger alert-dismissible fade show'>$myDepartment</div></span>";
       echo "<span class='td'><div class='alert alert-danger alert-dismissible fade show'>$myField</div></span>";
       echo "<span class='td'><div class='alert alert-danger alert-dismissible fade show'>$AppsCount</div></span>";

echo "
                 <span class='td'>&nbsp</span>
        <span class='td'>
	  <form name='rated-info' action='rated-info.php' method='post'>
            <button type='submit' class='btn btn-danger'><i class='fa fa-ban'></i> </button>
            <input type='hidden' class='form-control' id='name' name='name' value='$examiner1Name' >
            <input type='hidden' class='form-control' name='email' value=$examiner1Email >
            <input type='hidden' class='form-control' name='phone' value=$examiner1Phone >
          </form>
        </span>";

echo "
                 <span class='td'>&nbsp</span>
        <span class='td'>
          <form name='rated-info' action='rated-info.php' method='post'>
            <button type='submit' class='btn btn-danger'><i class='fa fa-ban'></i> </button>
            <input type='hidden' class='form-control' id='name' name='name' value='$examiner2Name' >
            <input type='hidden' class='form-control' name='email' value=$examiner2Email >
            <input type='hidden' class='form-control' name='phone' value=$examiner2Phone >
          </form>
        </span>";


echo "
                 <span class='td'>&nbsp</span>
        <span class='td'>
          <form name='rated-info' action='rated-info.php' method='post'>
            <button type='submit' class='btn btn-danger'><i class='fa fa-ban'></i> </button>
            <input type='hidden' class='form-control' id='name' name='name' value='$examiner3Name' >
            <input type='hidden' class='form-control' name='email' value=$examiner3Email >
            <input type='hidden' class='form-control' name='phone' value=$examiner3Phone >
          </form>
        </span>";

    } else {
# Retrieve applicants from lessonID
        $checkDate1=1;
        $checkDate2=1;
        $checkDate3=1;
        $app_sql = "SELECT * FROM applications WHERE field1='$ID' AND active='1';" ;
        $app_val = mysqli_query($conn, $app_sql);
        if(! $app_val ) { die('Could not get data: ' . mysqli_error($conn)); }
        while($row = mysqli_fetch_array($app_val, MYSQLI_ASSOC))
        {
            $Date1=$row['mark1_1_date'];
            $Date2=$row['mark1_2_date'];
            $Date3=$row['mark1_3_date'];
        }
#if Date=null checkDate=0
        if (!$Date1) { $checkDate1=0; }
        if (!$Date2) { $checkDate2=0; }
        if (!$Date3) { $checkDate3=0; }
#echo "<h3>CHECK=$checkDate1, $checkDate2,  $checkDate3, $lessonID</h3>";

        if ( $checkDate1==1 && $checkDate2==1 && $checkDate3==1 ) {

# All examiners ar ok.
            echo "<span class='td'><div class='alert alert-primary alert-dismissible fade show'>$lessonID</div></span>";
            echo "<span class='td'><div class='alert alert-primary alert-dismissible fade show'>$myDepartment$checkDate2</div></span>";
            echo "<span class='td'><div class='alert alert-primary alert-dismissible fade show'>$myField</div></span>";
            echo "<span class='td'><div class='alert alert-primary alert-dismissible fade show'>$AppsCount</div></span>";

echo "
                 <span class='td'>&nbsp</span>
        <span class='td'>
          <form name='rated-info' action='rated-info.php' method='post'>
            <button type='submit' class='btn btn-success'><i class='fa fa-check'></i> </button>
            <input type='hidden' class='form-control' id='name' name='name' value='$examiner1Name' >
            <input type='hidden' class='form-control' name='email' value=$examiner1Email >
            <input type='hidden' class='form-control' name='phone' value=$examiner1Phone >
          </form>
        </span>";

	echo "
                 <span class='td'>&nbsp</span>
        <span class='td'>
          <form name='rated-info' action='rated-info.php' method='post'>
            <button type='submit' class='btn btn-success'><i class='fa fa-check'></i> </button>
            <input type='hidden' class='form-control' id='name' name='name' value='$examiner2Name' >
            <input type='hidden' class='form-control' name='email' value=$examiner2Email >
            <input type='hidden' class='form-control' name='phone' value=$examiner2Phone >
          </form>
        </span>";

	echo "
                 <span class='td'>&nbsp</span>
        <span class='td'>
          <form name='rated-info' action='rated-info.php' method='post'>
            <button type='submit' class='btn btn-success'><i class='fa fa-check'></i> </button>
            <input type='hidden' class='form-control' id='name' name='name' value='$examiner3Name' >
            <input type='hidden' class='form-control' name='email' value=$examiner3Email >
            <input type='hidden' class='form-control' name='phone' value=$examiner3Phone >
          </form>
        </span>";

        } else {

            echo "<span class='td'><div class='alert alert-warning alert-dismissible fade show'>$lessonID</div></span>";
            echo "<span class='td'><div class='alert alert-warning alert-dismissible fade show'>$myDepartment$checkDate2</div></span>";
            echo "<span class='td'><div class='alert alert-warning alert-dismissible fade show'>$myField</div></span>";
            echo "<span class='td'><div class='alert alert-warning alert-dismissible fade show'>$AppsCount</div></span>";

            if ( $checkDate1==1 ) {
	echo "
                 <span class='td'>&nbsp</span>
        <span class='td'>
          <form name='rated-info' action='rated-info.php' method='post'>
            <button type='submit' class='btn btn-success'><i class='fa fa-check'></i> </button>
            <input type='hidden' class='form-control' id='name' name='name' value='$examiner1Name' >
            <input type='hidden' class='form-control' name='email' value=$examiner1Email >
            <input type='hidden' class='form-control' name='phone' value=$examiner1Phone >
          </form>
        </span>";
            } else {
	echo "
                 <span class='td'>&nbsp</span>
        <span class='td'>
          <form name='rated-info' action='rated-info.php' method='post'>
            <button type='submit' class='btn btn-warning'><i class='fa fa-close'></i> </button>
            <input type='hidden' class='form-control' id='name' name='name' value='$examiner1Name' >
            <input type='hidden' class='form-control' name='email' value=$examiner1Email >
            <input type='hidden' class='form-control' name='phone' value=$examiner1Phone >
          </form>
        </span>";
            }
            if ( $checkDate2==1 ) {
        echo "
                 <span class='td'>&nbsp</span>
        <span class='td'>
          <form name='rated-info' action='rated-info.php' method='post'>
            <button type='submit' class='btn btn-success'><i class='fa fa-check'></i> </button>
            <input type='hidden' class='form-control' id='name' name='name' value='$examiner2Name' >
            <input type='hidden' class='form-control' name='email' value=$examiner2Email >
            <input type='hidden' class='form-control' name='phone' value=$examiner2Phone >
          </form>
        </span>";
            } else {
      echo "
                 <span class='td'>&nbsp</span>
        <span class='td'>
          <form name='rated-info' action='rated-info.php' method='post'>
            <button type='submit' class='btn btn-warning'><i class='fa fa-close'></i> </button>
            <input type='hidden' class='form-control' id='name' name='name' value='$examiner2Name' >
            <input type='hidden' class='form-control' name='email' value=$examiner2Email >
            <input type='hidden' class='form-control' name='phone' value=$examiner2Phone >
          </form>
        </span>";
            }
            if ( $checkDate3==1 ) {
        echo "
                 <span class='td'>&nbsp</span>
        <span class='td'>
          <form name='rated-info' action='rated-info.php' method='post'>
            <button type='submit' class='btn btn-success'><i class='fa fa-check'></i> </button>
            <input type='hidden' class='form-control' id='name' name='name' value='$examiner3Name' >
            <input type='hidden' class='form-control' name='email' value=$examiner3Email >
            <input type='hidden' class='form-control' name='phone' value=$examiner3Phone >
          </form>
        </span>";
            } else {
      echo "
                 <span class='td'>&nbsp</span>
        <span class='td'>
          <form name='rated-info' action='rated-info.php' method='post'>
            <button type='submit' class='btn btn-warning'><i class='fa fa-close'></i> </button>
            <input type='hidden' class='form-control' id='name' name='name' value='$examiner3Name' >
            <input type='hidden' class='form-control' name='email' value=$examiner3Email >
            <input type='hidden' class='form-control' name='phone' value=$examiner3Phone >
          </form>
        </span>";
            }

        } #end if checkdate  

    } # end if $AppsCount

    echo"</div> ";  # tr


} #end while for lessons

?>

                </div>

             </div>
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



