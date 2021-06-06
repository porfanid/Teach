<?php
  $myPage=1; 
  include './header.php';
?>

<br \>
    <form class="form-valide" name="personal_data" action="my2.php" method="post" id="theForm" accept-charset="foobar utt-8" onsubmit="return validateSubmit();" >
         <h4 class="text-primary"><input type="checkbox" name="gdpr" value="" required>   
	     <a href="/submit/gdpr.php"> Αποδέχομαι τους όρους προσωπικών δεδομένων </a>
	 </h4>
         <br />
         <!-- Trigger the modal with a button -->
         <div class="form-group row">
             <label class="col-lg-4 col-form-label" for="val-username">Όνομα <span class="text-danger">*</span></label>
                 <div class="col-lg-6">
                      <input type="text" class="form-control" id="val-username" name="name" placeholder="Πληκτρολογήστε το όνομά σας.." required>
                 </div>
         </div>
         <div class="form-group row">
             <label class="col-lg-4 col-form-label" for="val-password">Επώνυμο <span class="text-danger">*</span></label>
             <div class="col-lg-6">
                  <input type="text" class="form-control" id="val-password" name="surname" placeholder="Το επίθετο.." required>
             </div>
         </div>
         <div class="form-group row">
             <label class="col-lg-4 col-form-label" for="val-email">Email <span class="text-danger">*</span></label>
             <div class="col-lg-6">
                 <input type="email" class="form-control" id="val-email" name="email" placeholder="Το email.." required>
             </div>
         </div>
         <div class="form-group row">
             <label class="col-lg-4 col-form-label" for="val-phoneus">Phone <span class="text-danger">*</span></label>
                 <div class="col-lg-6">
                 <input type="text" class="form-control" id="val-phoneus" name="phone" placeholder="και το τηλέφωνό σας..." required>
             </div>
         </div>
         <div class="form-group row">
              <div class="col-lg-8 ml-auto">
                   <script src='https://www.google.com/recaptcha/api.js'></script>
		   <div class="g-recaptcha" data-callback="capcha_filled" data-expired-callback="capcha_expired" data-sitekey=<?php echo $captcha_site ?> ></div>

                   <br />
              </div>
         </div>
         <button type="submit" class="btn btn-primary">Συνέχεια</button>
     </form>

  		      </div>
                    </div>
                 </div>
              </div>
           </div>

<script>
   var allowSubmit = false;
</script>
<?php include $root.'/common/footer.php';?>
