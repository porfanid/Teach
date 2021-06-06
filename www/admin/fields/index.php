<?php
 $PageID=4;
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

 pageid('Επιστημονικά Πεδία');
?>

 <div class="container-fluid">
    <div class="row">
       <div class="col-12">
          <div class="card">
             <div class="card-body">

                <div class="table-responsive">
                   <table class="table table-hover ">
                       <thead>
                          <tr>
                             <th>#</th>
                             <th>Tμήμα</th>
                             <th>Επιστημονικό Πεδίο</th>
                             <th>Υπέβαλαν</th>
                           </tr>
                       </thead>
                       <tbody>
<?php
$sql = "SELECT * FROM lessons ORDER BY lessonID ASC" ;
$retval = mysqli_query($conn, $sql);
if(! $retval )
{
  die('Could not get data: ' . mysqli_error($conn));
}

while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
{
    $ID=$row['id'];
    $lessonID=$row['lessonID'];
    $myDepartment=$row['department'];
    $myField=$row['field'];


# Retrieve applicants from lessonID and count them
        $AppsCount=0;
        $app_sql = "SELECT * FROM applications WHERE field1='$ID' AND active='1';" ;
        $app_val = mysqli_query($conn, $app_sql);
        if(! $app_val ) {  die('Could not get data: ' . mysqli_error($conn)); }
        while($row = mysqli_fetch_array($app_val, MYSQLI_ASSOC))
        {
	    $AppsCount++;
	}


    echo "<tr>";
    $span=$AppsCount+1;
    if ($AppsCount == 0) {
       echo"<th bgcolor='#FF0000'  scope='row'>$lessonID</th> ";
    } else {
       echo"<th bgcolor='#00FF00' rowspan=$span scope='row'>$lessonID</th> ";
    }

    echo "<td rowspan=$span style='font-size: 13px; text-align: left;'>$myDepartment</td> ";
    echo "<td rowspan=$span style='font-size: 13px; text-align: left;'>$myField</td>";
    echo "<td></td>";
    echo "<td></td>";
    echo"</tr> ";
    //
# Retrieve applicants from lessonID
	$AppsCount=0;
	$app_sql = "SELECT * FROM applications WHERE field1='$ID' AND active='1';" ;
	$app_val = mysqli_query($conn, $app_sql);
	if(! $app_val )
	{
  	    die('Could not get data: ' . mysqli_error($conn));
	}
	while($row = mysqli_fetch_array($app_val, MYSQLI_ASSOC))
	{
    	    $mySurname=$row['surname'];
    	    $myName=$row['name'];
	    $AppsCount++;
    	    echo "<tr><td>$AppsCount</td><td style='font-size: 13px; text-align: left;'>$mySurname $myName</td></tr> ";
	}
}

?>
                       </tbody>
 		   </table>
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
