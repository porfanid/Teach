<?php
#-------------------------------------------------------------
# FUNCTIONS
#-------------------------------------------------------------

#-------------------------------------------------------------
# FUNCTION table_row
# creating a function for a row of the table
# sql querry -> $lesson_list 
# $i = row number  
#-------------------------------------------------------------
function table_row($i,$lesson_list)
{
?>
  <tr>
    <th scope="row"><?php #echo $lesson_list[$i]["id"]; 
			   echo $lesson_list[$i]["lessonID"];?></th>

    <td><?php echo $lesson_list[$i]["field"]; ?></td>
    
<!-- KeepCount -> counts number of selections -->
    <td><span><input type="checkbox" onClick="return KeepCount(this)" id="<?php echo $lesson_list[$i]['id']; ?>" name="lesson[]" value="<?php echo $lesson_list[$i]['id']; ?>" ></span></td>
    </tr>
<?php
}
?>

<?php
#------------------------------------------------------------------------------
# FUNCTION lesson_list
# sql querry to "lessons" -> returns array "answer" containing lesson data
# eg. answer[1] row 1 of "lessons"
# used by: page2.php
#------------------------------------------------------------------------------
function lesson_list()
{
require "../config/config.inc.php";
    $result=false;
    $answer=array();

    $sql = "SELECT * FROM lessons WHERE active=1 ORDER BY department;";

    $result = mysqli_query($conn, $sql);
    if(! $result )
    {
      die('Could not get data: ' . mysqli_error($conn));
    }

# Check if there are NO lessons
      // output data of each row
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
           array_push($answer,$row);
        }
     return $answer;
}
?>

<?php
#-------------------------------------------------------------
# MAIN
#-------------------------------------------------------------
 $myPage=2;
 include './header.php';


#----------------------------------------------
# Captcha
#----------------------------------------------
 require_once "recaptchalib.php";
 include $root.'/config/config.inc.php';
$next_page=false;
$response = null;
$reCaptcha = new ReCaptcha($secret);


// if submitted check response
if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}

$captcha_response=($response != null && $response->success);
?>
   <form action="my3.php" method="post" accept-charset="foobar utt-8" onsubmit="return NoSelection();" >
<?php
    
#-------------------------------------------------------------------------------------
# Retrieve data from previous page
#-------------------------------------------------------------------------------------
    $recaptcha=$_POST["g-recaptcha-response"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];


#-------------------------------------------------------------------------------------
# Check if fields are empty
#-------------------------------------------------------------------------------------
    if (!$name || !$surname || !$email || !$phone || !$captcha_response ){ 
      $url=$_SERVER['SERVER_NAME'];
      echo '<script type="text/javascript">
      window.location = "http://'.$url.'/submit/"
      </script>';
    }


  ?>
     <input name="g-recaptcha-response" type="hidden" value="<?php echo $recaptcha; ?>" />
     <input name="name" type="hidden" value="<?php echo $name; ?>"/>
     <input name="surname" type="hidden"  value="<?php echo $surname; ?>"/>
     <input name="email" type="hidden"  value="<?php echo $email; ?>"/>
     <input name="phone" type="hidden"  value="<?php echo $phone; ?>"/>
<?php 

#------------------------------
#CALL function lesson_list
#------------------------------
    $lesson_list=lesson_list();
    $lessonNum=count($lesson_list);   
#-------------------------------------------------------------------------------------
# Lessons form
#-------------------------------------------------------------------------------------

  for($i=0;$i<$lessonNum;$i++)
    {
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
             <div class="card-title">
                   <h4>ΤΜΗΜΑ <?php echo $lesson_list[$i]["department"]; ?></h4>
              </div>
              <div class="card-body">
                   <div class="table-responsive">
                       <table class="table table-hover ">
                           <thead>
                               <tr>
                                   <th>#</th>
                                   <th>Επιστημονικό Πεδίο</th>
                                   <th>Επιλογή</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
//first row
			table_row($i,$lesson_list);
// rest of the rows
			while(($lesson_list[$i+1]["department"]==$lesson_list[$i]["department"]) && ($i<$lessonNum))
			     {
  				$i++;
  			       	table_row($i,$lesson_list);
  				if($i==$lessonNum)
  				    {
					// break while
     					break;
  				    } 
			     }
			     $depname=$lesson_list[$i]["department"];
?>
                             </tbody>
                        </table>
                     </div>
                  </div>
              </div>
           </div>
        </div>
<?php
    }  # for loop
?>
  <input type="submit" class="btn btn-primary" name="formSubmit" value="Συνέχεια" />
</form>

    			</div>
                    </div>
                 </div>
              </div>
           </div>

<script>
 var NewCount = 0;// global declaration

function KeepCount(a){
     var limit=1;
     if (a.checked){
          this.NewCount++;
     }

     if (!a.checked){
          this.NewCount=document.querySelectorAll('input[type="checkbox"]:checked').length;
     }

     if(NewCount>limit){
       alert('Παρακαλώ επιλέξτε μόνο ένα επιστημονικό πεδίο!!!');
       return false;
     }
}

function NoSelection(){
     if(NewCount<1){
       alert('Παρακαλώ επιλέξτε επιστημονικό πεδίο!!!');
       return false;
     }
}

</script>

<?php include $root.'/common/footer.php';?>
