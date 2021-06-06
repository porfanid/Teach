<?php
 $PageID=2;
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
  
 pageid('Επεξεργασία Μαθήματος');

#-------------------------------------------------------------------------------------
# Querries
#-------------------------------------------------------------------------------------
    $sql="SELECT * FROM lessons WHERE active='1';";
    $retval = mysqli_query($conn, $sql);
    $lesson_count = mysqli_num_rows($retval);
                                
# Check if application id = active (1)
    $sql1="SELECT * FROM lessons where applicants IS NULL OR applicants='';";
    $retval1 = mysqli_query($conn, $sql1);
    $lesson_count_no_applicants = mysqli_num_rows($retval1);


# Shows applications It should be Fields
    $sql2="SELECT * FROM applications where required1_1_1 IS NOT NULL AND required1_2_1 IS NOT NULL AND required1_3_1 IS NOT NULL;";
    $retval2 = mysqli_query($conn, $sql2);
    $application_count_finished = mysqli_num_rows($retval2);

    $sql3="SELECT * FROM applications;";
    $retval3 = mysqli_query($conn, $sql3);
    $application_count = mysqli_num_rows($retval3);                                
                                

#-------------------------------------------------------------------------------------
# TABS
#-------------------------------------------------------------------------------------
?>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-3">
                      <div  class="card p-30">
                        <a href="lessons.php">
                            <div  class="media">
                                <div class="media-left meida media-middle">
                                    <span><i  class="fa fa-book f-s-40 color-primary"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php echo $lesson_count;?></h2>
                                    <p class="m-b-0">Μαθήματα</p>
                                </div>
                            </div>
                        </a>
                       </div>
                    </div>


                    <div class="col-md-3">
                       <div class="card p-30">
                          <a href="applications.php">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-copy f-s-40 color-success"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php echo $application_count;?></h2>
                                    <p class="m-b-0">Αιτήσεις</p>
                                </div>
                            </div>
                          </a>
                       </div>
                     </div>

                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-archive f-s-40 color-warning"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php echo $lesson_count_no_applicants; ?></h2>
                                    <p class="m-b-0">Μαθήματα χωρίς αιτήσεις</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                       <div class="card p-30">
                          <a href="/admin/rated.php">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-user f-s-40 color-danger"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php echo $application_count_finished; ?></h2>
                                    <p class="m-b-0">Αιτήσεις που Βαθμολογήθηκαν</p>
                                </div>
                            </div>
                         </a>
                       </div>
                    </div>

                </div>   <!-- row -->

                <div class="row bg-white m-l-0 m-r-0 box-shadow ">
<!--  CHART -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Μαθήματα - Αιτήσεις</h4>
                                <div id="extra-area-chart"></div>
                            </div>
                        </div>
                    </div>
<!--  CALENDAR -->
		    <div class="col-lg-6">
			<div class="row">
			    <div class="col-lg-8">
				<div class="card">
				    <div class="card-body">
					<div class="calendar"></div>
				    </div>
				</div>
			    </div>
			</div>
	  	   </div>

               </div>
    <!-- Amchart -->
<?php
   include_once $root.'/common/footer.php';
?>
    <script src="chart.src"></script>
    <script src="../common/js/lib/morris-chart/raphael-min.js"></script>
    <script src="../common/js/lib/morris-chart/morris.js"></script>
    <!-- Calendar scripit init-->
    <script src="../common/js/lib/calendar-2/moment.latest.min.js"></script>
    <script src="../common/js/lib/calendar-2/pignose.calendar.min.js"></script>
    <script src="../common/js/lib/calendar-2/pignose.init.js"></script>
    <script src="../common/js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="../common/js/lib/owl-carousel/owl.carousel-init.js"></script>
    <!-- scripit init-->
    <script src="../common/js/scripts.js"></script>
<?php
 } else {
       session_unset();
       session_destroy();
       header( "Location:/unauthorized.php");
   } #isDD
} #session
?>
