<?php
 $myPage=3;
 include './header.php';
#-----------------------------------------------------------
# Retrieve data from previous page
#-----------------------------------------------------------
$recaptcha=$_POST["g-recaptcha-response"];
$name =$_POST["name"];
$surname =$_POST["surname"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$lessonsSelected= $_POST['lesson'];

$next_page=false;

    if (!$name || !$surname || !$email || !$phone || !$lessonsSelected ){
      $url=$_SERVER['SERVER_NAME'];
      echo '<script type="text/javascript">
      window.location = "http://'.$url.'/submit/"
      </script>';
    }

$next_page=true;
?>

<h3>ΠΡΟΣΟΧΗ. Το μέγεθος του κάθε αρχείου πρέπει να είναι μέχρι 30MB.</br>
Μονο ένα αρχείο ανα πεδίο μπορεί να εισαχθεί.</h3>
      <!-- Form  -->
      <form action="my4.php" method="post"  class=".dropzone" enctype="multipart/form-data">

	  <input name="g-recaptcha-response" type="hidden" value="<?php echo $recaptcha; ?>" />
          <input name="name"    type="hidden" value="<?php echo $name; ?>" />
          <input name="surname" type="hidden" value="<?php echo $surname; ?>" />
          <input name="email"   type="hidden" value="<?php echo $email; ?>" />
          <input name="phone"   type="hidden" value="<?php echo $phone; ?>" />
          <input name="lesson"  type="hidden" value="<?php 
                if(!empty($lessonsSelected)) 
		    {
                     foreach($lessonsSelected as $myLesson) 
			{
                         echo $myLesson;
                         echo","; 
                        }
                     }
                     else
                     {
                        echo "empty";
                     }
?>
		" />
           <div class="card">
               <div class="card-body">
                   <h4 class="card-title">Πρόταση Υποψηφιότητας</h4>
                   <div class="fallback">
                        <input type="file" name="Application" id="APP" accept="application/pdf" multiple />
                   </div>
               </div>
           </div>

           <div class="card">
               <div class="card-body">
                   <h4 class="card-title">Σχεδιάγραμμα Διδασκαλίας Μαθήματος</h4>
                   <h3 class="card-title">Προσοχή: Ένα αρχείο για όλα τα σχεδιαγράμματα</h3>
                   <div class="fallback">
                        <input type="file" name="Schedule" id="Schedule" accept="application/pdf" multiple />
                   </div>
               </div>
           </div>

          <div class="card">
              <div class="card-body">
              <h4 class="card-title">Βιογραφικό</h4>
                  <div class="fallback">
                       <input type="file" name="CV" id="CV" accept="application/pdf" multiple />
                  </div>
              </div>
          </div>

          <div class="card">
              <div class="card-body">
                   <h4 class="card-title">Αντίγραφο Διδακτορικού</h4>
                   <div class="fallback">
                        <input type="file" name="PHD" id="PHD" accept="application/pdf" multiple />
                    </div>
              </div>
          </div>

          <div class="card">
              <div class="card-body">
                   <h4 class="card-title">Υπεύθυνη Δήλωση</h4>
                   <div class="fallback">
                        <input type="file" name="Statement" id="Statement" accept="application/pdf" multiple />
                    </div>
              </div>
          </div>

          <input type="submit" class="btn btn-primary" name="submit" value="Υποβολή" />
       </form>

                        </div>
                    </div>
                 </div>
              </div>
           </div>

<?php include $root.'/common/footer.php';?>
