<?php
 $PageID=3;
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

pageid('Αιτήσεις');


$click1="<a href='https://CUCMPub.duth.gr:8443/webdialer/Webdialer?destination=0";
$click2="'target='_blank' rel='noreferrer' >";
$click3="</a>";
$Subject='Γραμματεία Προγράμματος Απόκτησης Ακαδημαϊκής Εμπειρίας';

 $myType = $_POST["type"];

 if ($myType == 0) {
    $typeName='Ανενεργές';
 } else if ($myType == 1) {
    $typeName='Eνεργές';
 } else if ($myType == 2) {
    $typeName='Ακυρωμένες';
 } else {
    $typeName='Όλες';
 }


 if ($myType >=0) {
    $sql = "SELECT id, name, surname, email, phone, field1, submit_date FROM applications WHERE active='$myType' ORDER BY id DESC ;" ;
 } else {
    $sql = "SELECT id, name, surname, email, phone, field1, submit_date FROM applications ORDER BY id DESC ;" ;
 }


$retval = mysqli_query($conn, $sql);
if(! $retval ) { die('Could not get data: ' . mysqli_error($conn)); }

?>
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">

		<h2> <?php echo $typeName; ?> </h2>
		<form action="alter.php"  name='approve' method="post" >
                  <input type="submit" class="btn btn-primary" name="formSubmit" value="Συνέχεια" />
			<div class="table-responsive">

                   	   <table class="table table-hover ">
                              <thead>
                                 <tr>
                                    <th>#</th>
                             	    <th>Όνοματεπώνυμο</th>
                                    <th>Τηλέφωνο</th>
                                    <th>Email</th>
                                    <th>Ημερομηνία</th>
                                    <th>Τμήμα</th>
                                    <th>Επιστημονικό Πεδίο</th>
				    <th>Επιλογή</th>
                           	 </tr>
                              </thead>
                       	      <tbody>

<?php
$count=0;
while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
{
    $count++;
    $myID=$row['id'];
    $myName=$row['name'];
    $mySurname=$row['surname'];
    $myPhone=$row['phone'];
    $myEmail=$row['email'];
    $myDate=$row['submit_date'];
    $submit_date=date("d-m-Y H:i", strtotime($myDate));

    $myLesson=$row['field1'];
    $myButton=$myID.".".$myPhone;
    
#Extract Field from myLesson
$field_sql = "SELECT department, field FROM lessons WHERE id='$myLesson' ;" ;
$field_val = mysqli_query($conn, $field_sql);
if(! $field_val ) {  die('Could not get data: ' . mysqli_error($conn)); }

while($row = mysqli_fetch_array($field_val, MYSQLI_ASSOC))
{
    $myDepartment=$row['department'];
    $myField=$row['field'];
}
    echo "<tr><th scope='row'>$myID</th> ";
    echo "<td style='font-size: 13px; text-align: left;'>$mySurname $myName </td> ";
    echo "<td style='font-size: 13px; text-align: left;'>$click1$myPhone$click2$myPhone$click3</td> ";

    echo "<td style='font-size: 13px; text-align: left;'> 
<a href='mailto:$myEmail?Subject=$Subject&body=Κύριε/α $mySurname $myName' target='_top'>$myEmail</a> </td>";
    echo "<td style='font-size: 13px; text-align: left;'>$submit_date</td> ";
    echo "<td style='font-size: 13px; text-align: left;'>$myDepartment</td>";
    echo "<td style='font-size: 13px; text-align: left;'>$myField</td>";
    if ($count==1) {
       echo "<td><input type='radio' name='selectedID' value='$myID' checked='checked' ></td>";
    } else {
       echo "<td><input type='radio' name='selectedID' value='$myID' ></td>";
    }
}
?>
                       </tbody>
 		   </table>
                </div>
		 <hr>
                  <input type="submit" class="btn btn-primary" name="formSubmit" value="Συνέχεια" />
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
