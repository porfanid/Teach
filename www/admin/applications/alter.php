<?php
 $PageID=3;
 $root=$_SERVER['DOCUMENT_ROOT'];
session_start();
#--------------------------------------------------------------------
# Check auth
#--------------------------------------------------------------------
if(!$_SESSION['logged_id']){
   $_SESSION['page_id']=$PageID;
   header('Location:'.$root.'/auth/auth.php');
} else {
   $login = $_SESSION['user_id'] ;
   error_log("teach $login-$PageID");

#--------------------------------------------------------------------
# Check ADMIN and PageID
#--------------------------------------------------------------------
   $isDD=false;
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

     include $root.'/common/header.php';
     include $root.'/common/functions.pages.php';
     include $root.'/common/functions.inc.php';
     include $root.'/config/config.inc.php';

 $date=date("Y-m-d H:i");

#-------------------------------------------------------------------------------------
# Retrieve data from previous page
#-------------------------------------------------------------------------------------
$ID = $_POST["selectedID"];

 $sql = "SELECT * from applications WHERE  id='$ID'; ";
       $retval = mysqli_query($conn, $sql);
       if(! $retval ) { die('Could not get data: ' . mysqli_error($conn)); }
       while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
           $myName=$row['name'];
           $mySurname=$row['surname'];
           $myEmail=$row['email'];
           $myPhone=$row['phone'];
           $submit_date=$row['submit_date'];
           $myField1=$row['field1'];
           $myType=$row['active'];
       }
           $submit_day=date("d-m-Y", strtotime($submit_date));
 if ($myType == 0) {
    $typeName='Ανενεργή';
 } else if ($myType == 1) {
    $typeName='Eνεργή';
 } else if ($myType == 2) {
    $typeName='Ακυρωμένη';
 } else {
    $typeName='???';
 }

 $fieldsql = "SELECT field, department FROM lessons WHERE id='$myField1'; ";
       $fieldval = mysqli_query($conn, $fieldsql);
       if(! $fieldval ) { die('Could not get data: ' . mysqli_error($conn)); }
       while($row = mysqli_fetch_array($fieldval, MYSQLI_ASSOC)) {
           $myFieldName=$row['field'];
           $myDepartment=$row['department'];
       }

   pageid('Αιτήσεις');
?>
<div class="container-fluid">
      <div class="row justify-content-center">
         <div class="col-lg-7">
            <div class="card">
               <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Πεδίο</th>
                    <th>Υποβλήθηκε</th>
                </tr>
            </thead>
                <tr>
                    <td>1- Αριθμός Αίτησης:</td>
                    <td><?php echo "$ID/$submit_day";?> </td>
                </tr>
                <tr>
                    <td>2- Ονοματεπώνυμο:</td>
                    <td><?php echo "$myName $mySurname";?> </td>
                </tr>
                <tr>
                    <td>3- eMail:</td>
                    <td><?php echo "$myEmail"; ?> </td>
                </tr>
                <tr>
                    <td>4- Τηλέφωνο:</td>
                    <td><?php echo "$myPhone";?> </td>
                </tr>
                <tr>
                    <td>5- Ημερομηνία Υποβολής:</td>
                    <td><?php echo "$submit_date";?> </td>
                </tr>
                <tr>
                    <td>6- Επιστημονικό Πεδίο:</td>
                    <td><?php echo "$myFieldName";?> </td>
                </tr>
                <tr>
                    <td>7- Τμήμα:</td>
                    <td><?php echo "$myDepartment";?> </td>
                </tr>
                <tr>
                    <td>8- Κατάσταση:</td>
                    <td><?php echo "$typeName";?> </td>
                </tr>
             </table>
             </div>
            <hr>
            <form action="alter2.php" method="post" name="submited" >
                <input type="hidden" name="selectedID"  value=<?php echo "$ID"; ?> />
		<div class="col-md-4">
                   <div class="form-group has-danger">
                      <label class="control-label">Αλλαγή Κατάστασης</label>
                      <select class="form-control" name="type" id="type">
                           <option value="-1" selected="selected">-</option>
                           <option value="1">Ενεργή</option>
                           <option value="0">Ανενεργή</option>
                           <option value="2">Ακυρωμένη</option>
                      </select>
                   </div>
                </div>

                <div class="col-md-12">
                    <input type="submit" name="active" class="btn btn-success"  value="Συνέχεια" />
                </div>
            </form>
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

