<?php
 $PageID=7;
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

pageid('Ιστορικό');

$sql = "SELECT id, mytable, mycolumn, myrow, changed_by, old_value, new_value, changed_date FROM logs ORDER BY id DESC ;" ;
$retval = mysqli_query($conn, $sql);
if(! $retval ) { die('Could not get data: ' . mysqli_error($conn)); }

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
                             	    <th>Πίνακας</th>
                                    <th>Πεδίο</th>
                                    <th>Στήλη</th>
                                    <th>Προηγούμενη τιμή</th>
                                    <th>Νέα τιμή</th>
                                    <th>Αλλάχθηκε από</th>
                                    <th>Ημερομηνία</th>
                           	 </tr>
                              </thead>
                       	      <tbody>

<?php
while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
{
    $myID=$row['id'];
    $myTable=$row['mytable'];
    $myColumn=$row['mycolumn'];
    $myRow=$row['myrow'];
    $myOldValue=$row['old_value'];
    $myNewValue=$row['new_value'];
    $myChangedby=$row['changed_by'];
    $myDate=$row['changed_date'];
    $submit_date=date("d-m-Y H:i", strtotime($myDate));

    
    echo "<tr><th scope='row'>$myID</th> ";
    echo "<td style='font-size: 13px; text-align: left;'>$myTable </td> ";
    echo "<td style='font-size: 13px; text-align: left;'>$myColumn </td> ";
    echo "<td style='font-size: 13px; text-align: left;'>$myRow </td> ";
    echo "<td style='font-size: 13px; text-align: left;'>$myOldValue </td> ";
    echo "<td style='font-size: 13px; text-align: left;'>$myNewValue </td> ";
    echo "<td style='font-size: 13px; text-align: left;'>$myChangedby </td> ";
    echo "<td style='font-size: 13px; text-align: left;'>$submit_date</td> ";
}
?>
                       </tbody>
 		   </table>
                </div>
		 <hr>

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
