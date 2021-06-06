<?php
 $myPage=4;
 include './header.php';

$next_page=false;

#--------------------------------------------------------------------------
# Retrieves input data
# Multipe lessons selected are stored in a comma delimited string
# lesson_id is an array conatinning lessons selected
#--------------------------------------------------------------------------
$myErrors="";
 $date=date("Y-m-d H:i");
 $recaptcha=$_POST["g-recaptcha-response"];
 $name = $_POST["name"];
 $surname = $_POST["surname"];
 $email = $_POST["email"];
 $phone = $_POST["phone"];
 $lesson_id = explode(",",$_POST['lesson']);
# deletes last comma
 array_splice($lesson_id, count($lesson_id)-1, count($lesson_id));

 $uploaddir="../documents/".$phone."/";

#--------------------------------------------------------------------------
# Get file name, type, size 
#--------------------------------------------------------------------------
 $ScheduleName = $_FILES["Schedule"]["name"];
 $ScheduleType = $_FILES["Schedule"]["type"];
 $ScheduleSize = $_FILES["Schedule"]["size"];

 $CVname = $_FILES["CV"]["name"];
 $CVtype = $_FILES["CV"]["type"];
 $CVsize = $_FILES["CV"]["size"];

 $APPname = $_FILES["Application"]["name"];
 $APPtype = $_FILES["Application"]["type"];
 $APPsize = $_FILES["Application"]["size"];

 $PHDname = $_FILES["PHD"]["name"];
 $PHDtype = $_FILES["PHD"]["type"];
 $PHDsize = $_FILES["PHD"]["size"];

 $StatementName = $_FILES["Statement"]["name"];
 $StatementType = $_FILES["Statement"]["type"];
 $StatementSize = $_FILES["Statement"]["size"];

#--------------------------------------------------------------------------
# Check if file selected and not zero 
#--------------------------------------------------------------------------
 $ScheduleSelected=false;
 $CVSelected=false;
 $APPSelected=false;
 $PHDSelected=false;
 $StatementSelected=false;

 if (! $ScheduleName) {
    $myErrors=$myErrors."Δεν έχετε επιλέξει αρχείο: Σχεδιάγραμμα Διδασκαλίας Μαθήματος.  <br />";
    $ScheduleSelected=true;
 }

 if (! $CVname) {
    $myErrors=$myErrors."Δεν έχετε επιλέξει αρχείο: Βιογραφικό.  <br />";
    $CVSelected=true;
 }

 if (! $APPname) {
    $myErrors=$myErrors."Δεν έχετε επιλέξει αρχείο: Αίτηση.  <br />";
    $APPSelected=true;
 }

 if (! $PHDname) {
    $myErrors=$myErrors."Δεν έχετε επιλέξει αρχείο: Διδακτορικό. <br />";
    $PHDSelected=true;
 }

 if (! $StatementName) {
    $myErrors=$myErrors."Δεν έχετε επιλέξει αρχείο: Υπεύθυνη Δήλωση. <br />";
    $StatementSelected=true;
 }


#--------------------------------------------------------------------------
# Check whether file already exists before uploading it
#--------------------------------------------------------------------------
 $ScheduleExists=false;
 $CVexists=false;
 $APPexists=false;
 $PHDexists=false;
 $StatementExists=false;

 if (file_exists($uploaddir."Schedule.pdf")) {
    $myErrors=$myErrors."Ο χρήστης έχει ήδη ανεβάσει: Σχεδιάγραμμα Διδασκαλίας Μαθήματος.  <br />";
    $ScheduleExists=true;
 }

 if (file_exists($uploaddir."CV.pdf")) {
    $myErrors=$myErrors."Ο χρήστης έχει ήδη ανεβάσει: Βιογραφικό.  <br />";
    $CVexists=true;
 }

 if (file_exists($uploaddir."Application.pdf")) {
    $myErrors=$myErrors."Ο χρήστης έχει ήδη ανεβάσει: Αίτηση.  <br />";
    $APPexists=true;
 }

 if (file_exists($uploaddir."Phd.pdf")) {
    $myErrors=$myErrors."Ο χρήστης έχει ήδη ανεβάσει: Διδακτορικό. <br />";
    $PHDexists=true;
 }

 if (file_exists($uploaddir."Statement.pdf")) {
    $myErrors=$myErrors."Ο χρήστης έχει ήδη ανεβάσει: Υπεύθυνη Δήλωση. <br />";
    $StatementExists=true;
 }

#--------------------------------------------------------------------------
# Verify file extension
#--------------------------------------------------------------------------
 $CVext=false;
 $APPext=false;
 $PHDext=false;
 $ScheduleExt=false;
 $StatementExt=false;
 $allowed = array("pdf" => "application/pdf");

 $ext = pathinfo($ScheduleName, PATHINFO_EXTENSION);
 if(!array_key_exists($ext, $allowed)) {
    $ScheduleExt=true;
    $myErrors=$myErrors."To αρχείο 'Σχεδιάγραμμα Διδασκαλίας Μαθήματος' δεν είναι της επιτρεπτής μορφής (pdf). <br />";
 }

 $ext = pathinfo($CVname, PATHINFO_EXTENSION);
 if(!array_key_exists($ext, $allowed)) {
    $CVext=true;
    $myErrors=$myErrors."To αρχείο 'Βιογραφικό' δεν είναι της επιτρεπτής μορφής (pdf). <br />";
 }

 $ext = pathinfo($APPname, PATHINFO_EXTENSION);
 if(!array_key_exists($ext, $allowed)) {
    $APPext=true;
    $myErrors=$myErrors."To αρχείο 'Πρόταση Υποψηφιότητας' δεν είναι της επιτρεπτής μορφής (pdf). <br />";
 }

 $ext = pathinfo($PHDname, PATHINFO_EXTENSION);
 if(!array_key_exists($ext, $allowed)) {
    $PHDext=true;
    $myErrors=$myErrors."To αρχείο 'Διδακτορικό' δεν είναι της επιτρεπτής μορφής (pdf). <br />";
 }

 $ext = pathinfo($StatementName, PATHINFO_EXTENSION);
 if(!array_key_exists($ext, $allowed)) {
    $StatementExt=true;
    $myErrors=$myErrors."To αρχείο 'Υπεύθυνη Δήλωση' δεν είναι της επιτρεπτής μορφής (pdf). <br />";
 }


#--------------------------------------------------------------------------
# Verify file size - 5MB maximum
#--------------------------------------------------------------------------
 $ScheduleOversize=false;
 $CVoversize=false;
 $APPoversize=false; 
 $PHDoversize=false;
 $StatementOversize=false;
 $maxsize = 30 * 1024 * 1024;

 if($ScheduleSize > $maxsize) {
    $ScheduleOversize=true;
    $myErrors=$myErrors."Το αρχείο 'Σχεδιάγραμμα Διδασκαλίας Μαθήματος' υπεβαίνει το μέγιστο επιτρεπτό όριο. <br />";
 }

 if($CVsize > $maxsize) {
    $CVoversize=true;
    $myErrors=$myErrors."Το αρχείο 'Βιογραφικό' υπεβαίνει το μέγιστο επιτρεπτό όριο. <br />";
 }

 if($APPsize > $maxsize) {
    $APPoversize=true;
    $myErrors=$myErrors."Το αρχείο 'Αίτηση' υπεβαίνει το μέγιστο επιτρεπτό όριο. <br />";
 }

 if($PHDsize > $maxsize) {
    $PHDoversize=true;
    $myErrors=$myErrors."Το αρχείο 'Διδακτορικό' υπεβαίνει το μέγιστο επιτρεπτό όριο. <br />";
 }

 if($StatementSize > $maxsize) {
    $StatementOversize=true;
    $myErrors=$myErrors."Το αρχείο 'Υπεύθυνη Δήλωση' υπεβαίνει το μέγιστο επιτρεπτό όριο. <br />";
 }


#--------------------------------------------------------------------------
# Evaluate Checks & Upload
#--------------------------------------------------------------------------
$ScheduleUp=false;
$CVup=false;
$APPup=false;
$PHDup=false;
$StatementUp=false;


 if ( !$ScheduleExt && !$ScheduleOversize && !$ScheduleExists && !$ScheduleSelected 
   && !$CVext && !$CVoversize && !$CVexists && !$CVSelected 
   && !$APPext && !$APPoversize && !$APPexists && !$APPSelected 
   && !$PHDext && !$PHDoversize && !$PHDexists && !$PHDSelected 
   && !$StatementExt && !$StatementOversize && !$StatementExists && !$StatementSelected) {

#--------------------------------------------------------------------------
# a) Create upload DIR
#--------------------------------------------------------------------------

    if (file_exists($uploaddir)) {
       $myErrors=$myErrors."Έχετε ήδη ανεβάσει αρχεία. <br />";
       $myErrors=$myErrors.$messages['secrmail']."<br />";
       $response=chmod($uploaddir, 0775);
       if(!$response) {
            $DIRperms=true;
       }
     } else {
        $response=mkdir($uploaddir, 0775, true);
        if(!$response) {
           $DIRperms=true;
        }


    $ScheduleUp= move_uploaded_file($_FILES["Schedule"]["tmp_name"], $uploaddir."Schedule.pdf");
    $CVup= move_uploaded_file($_FILES["CV"]["tmp_name"], $uploaddir."CV.pdf");
    $APPup= move_uploaded_file($_FILES["Application"]["tmp_name"], $uploaddir."Application.pdf");
    $PHDup= move_uploaded_file($_FILES["PHD"]["tmp_name"], $uploaddir."Phd.pdf");
    $StatementUp= move_uploaded_file($_FILES["Statement"]["tmp_name"], $uploaddir."Statement.pdf");

     } # upload dir created 

 } #checks 


#--------------------------------------------------------------------------
# If upload without errors, insert data to database
#--------------------------------------------------------------------------
# Insert data to database
 if( $ScheduleUp && $CVup && $APPup && $PHDup && $StatementUp) {

     $sql = "INSERT INTO applications (name, surname, email, phone, field1, submit_date, active) VALUES ('$name', '$surname', '$email', '$phone', '$lesson_id[0]', '$date', '1' );";

     $result = mysqli_query($conn, $sql);
     if(! $result )
       {
          die('Could not get data: ' . mysqli_error($conn));
       }

# Read Data just inserted from database
     $check_sql = "SELECT id, name, surname, email, phone, field1, submit_date FROM applications WHERE name='$name' AND  surname='$surname' ;";

     $result = mysqli_query($conn, $check_sql);
     if(! $result )
       {
          die('Could not get data: ' . mysqli_error($conn));
       }

	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	  {
	     $id=$row['id'];
	     $name=$row['name'];
	     $surname=$row['surname'];
	     $email=$row['email'];
	     $phone=$row['phone'];
	     $field1=$row['field1'];
	     $myDate=$row['submit_date'];
	  }
	     $submit_date=date("d-m-Y H:i", strtotime($myDate));
    
# Append applicant id to "lessons"
     $old_sql = "SELECT lessonID, applicants FROM lessons WHERE id='$lesson_id[0]' ;";
     $old_result = mysqli_query($conn, $old_sql);
     if(! $old_result )
       {
          die('Could not get data: ' . mysql_error());
       }

	while($row = mysqli_fetch_array($old_result, MYSQLI_ASSOC))
	  {
	     $old_applicants=$row['applicants'];
	  }

 if (empty($old_applicants) || is_null($old_applicants))
        {
          $new_applicants=$id;
        }
        else
        {
          $new_applicants=$old_applicants.", ".$id;
        } 

     $new_sql = "UPDATE lessons SET applicants='$new_applicants' WHERE id='$lesson_id[0]';";
     $new_result = mysqli_query($conn, $new_sql);
     if(! $new_result )
     {
         die('Could not write data: ' . mysqli_error($conn));
      }



#-----------------------------------------------------------------------------------------------
# Write results
#-----------------------------------------------------------------------------------------------
    echo '<center><h2 class="text-primary"> Η αίτησή σας υποβλήθηκε με επιτυχία </h2></center>';
    
# 1- Print Table with submitted data
# Id, name, surname
?>
         <div class="table-responsive m-t-40">

                 <table id="example23" class="display nowrap table table-hover table-striped table-bordered dataTable" cellspacing="0" width="70%" role="grid" aria-describedby="example23_info" style="width: 100%;">
		    <thead>
	              <tr>
			 <th>Πεδίο</th>
	      	 	 <th>Υποβλήθηκε</th>
	              </tr>
		    </thead>
	              <tr>
			  <td>1- Αριθμός Αίτησης:</td>
	                  <td><?php echo "$id/$submit_date";?> </td>
		      </tr>
	              <tr>
			  <td>2- Ονοματεπώνυμο:</td>
	                  <td><?php echo "$surname $name";?> </td>
		      </tr>
	              <tr>
			   <td>3- Πρόταση Υποψηφιότητας:</td>
<?php
                        if($APPup){
                           echo"<td><span class='badge badge-success'>$APPname</span></td>";
                        } else {
                           echo"<td><span class='badge badge-warning'>$APPname</span></td>";
                        }
?>
		      </tr>

	              <tr>
			   <td>4- Σχεδιάγραμμα Διδασκαλίας Μαθήματος:</td>
<?php
                        if($ScheduleUp){
                           echo"<td><span class='badge badge-success'>$ScheduleName</span></td>";
                        } else {
                           echo"<td><span class='badge badge-warning'>$ScheduleName</span></td>";
                        }
?>
		      </tr>

	              <tr>
			   <td>5- Βιογραφικό:</td>
<?php
                	if($CVup){
                    	   echo"<td><span class='badge badge-success'>$CVname</span></td>";
                	} else {
                   	   echo"<td><span class='badge badge-warning'>$CVname</span></td>";
                	}
?>
		      </tr>

	              <tr>
			   <td>6- Αντίγραφο Διδακτορικού:</td>
<?php
                        if($PHDup){
                           echo"<td><span class='badge badge-success'>$PHDname</span></td>";
                        } else {
                           echo"<td><span class='badge badge-warning'>$PHDname</span></td>";
                        }
?>
		      </tr>

	              <tr>
			   <td>7- Υπεύθυνη Δήλωση:</td>
<?php
                        if($StatementUp){
                           echo"<td><span class='badge badge-success'>$StatementName</span></td>";
                        } else {
                           echo"<td><span class='badge badge-warning'>$StatementName</span></td>";
                        }
?>
		      </tr>


<!--
# 2- Print Table with submitted data
# Selected lessons
-->
<?php
$lesson_sql = "SELECT field, department FROM lessons WHERE id='$field1' ;";

$lesson_eval = mysqli_query($conn, $lesson_sql);
if(! $lesson_eval )
  {
     die('Could not get data: ' . mysqli_error($conn));
  }

while($row = mysqli_fetch_array($lesson_eval, MYSQLI_ASSOC))
  {
     $field=$row['field'];
     $department=$row['department'];
  }
?>
	              <tr>
			   <td>8- Επιστημονικό Πεδίο:</td>
			   <td><?php echo $field ?></td>
		      </tr>
	              <tr>
			   <td>9- Τμήμα:</td>
			   <td><?php echo $department ?></td>
		      </tr>
             </table>
         </div>
<?php    
    
 } else {
#---------------------------------------------------------------------------------
# Not Uploaded 
# Error message
#---------------------------------------------------------------------------------
 
    echo "<center>
            <h2 class='text-warning'> Δημιουργήθηκε πρόβλημα κατά την υποβολή της αίτησής σας </h2>
            <h5>$myErrors</h5>
	</center>";

 } //end if error check
     
?>

                        </div>
                    </div>
                 </div>
              </div>
           </div>
<?php include $root.'/common/footer.php';?>
