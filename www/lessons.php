<?php
 $root=$_SERVER['DOCUMENT_ROOT'];
 include_once $root.'/common/header.php';
 include $root.'/common/functions.pages.php';
 include $root.'/config/config.inc.php';

  pageid('Επιστημονικά πεδία');
?>
 <div class="container-fluid">
    <div class="row">
       <div class="col-12">
          <div class="card">
             <div class="card-body">

            <p class="t-left">
              <a class="button small show-hide-all" href="javascript:void(0)">Εμφάνιση / Απόκρυψη όλων των περιγραφών</a>
            </p>

 		<div class="table-responsive">
   		   <table class="courses-table">
		      <thead>
           		<tr>
              		   <th>#</th>
              		   <th>Tμήμα</th>
              		   <th>Επιστημονικό Πεδίο</th>
              		   <th>Λεπτομέρειες</th>
           		</tr>
        	      </thead>
<?php
 $sql = "SELECT * FROM lessons WHERE active=1 ORDER BY lessonID ASC" ;
$retval = mysqli_query($conn, $sql);
if(! $retval ) { die('Could not get data: ' . mysqli_error($conn)); }
while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
   {
     $myID=$row['id'];
     $lessonID=$row['lessonID'];
     $myDepartment=$row['department'];
     $myField=$row['field'];

     $myTitleA=$row['titleA'];
     $mySemesterA=$row['semesterA'];
     $myEctsA=$row['ectsA'];
     $myHoursA=$row['hoursA'];
     $myDescriptionA=$row['descriptionA'];
     $myCategoryA=$row['categoryA'];

     $myTitleB=$row['titleB'];
     $mySemesterB=$row['semesterB'];
     $myEctsB=$row['ectsB'];
     $myHoursB=$row['hoursB'];
     $myDescriptionB=$row['descriptionB'];
     $myCategoryB=$row['categoryB'];


     $myTitleC=$row['titleC'];
     $mySemesterC=$row['semesterC'];
     $myEctsC=$row['ectsC'];
     $myHoursC=$row['hoursC'];
     $myDescriptionC=$row['descriptionC'];
     $myCategoryC=$row['categoryC'];
?>

<!-- Shown -->
       <tr class="field-row">
	  <td><?php echo $lessonID; ?> </td>
	  <td><?php echo $myDepartment; ?> </td>
	  <td><?php echo $myField; ?> </td>
	  <td colspan="1" style="width:239px;text-align:right;">
<?php
	echo "<a class='show-hide-head' id='show-hide-head-f$lessonID'><b>Μαθήματα και περιγραφή</b></a>";
?>
	  </td>
       </tr>

<!-- Hidden -->
       <tr class="show-hide-content-row">
	 <td></td>
	 <td colspan="5">
<?php
             echo " <div class='show-hide-content t-justify' id='show-hide-content-f$lessonID'> ";
?>

	     	<table class="courses-table inner">
		     <tr class="th">
			<td>
			    <b>Τίτλος Μαθήματος</b>
			</td>
			<td>
			    <b>Εξάμηνο</b>
			</td>
		        <td>
			    <b>ECTS</b> 
	      		</td>
			<td>
			    <b>Ώρες</b>
			</td>
			<td>
			    <b>Τύπος</b>
			</td>
		     </tr>

		     <tr id="tr-114" class="hover">
			<td><b><?php echo $myTitleA; ?></b></td>
			<td class="t-left" style="width:30px;"><?php echo $mySemesterA; ?></td>
			<td class="t-left" style="width:140px;"><div><?php echo $myEctsA; ?></div></td>
			<td class="t-left" style="width:200px;"><div><?php echo $myHoursA; ?></div></td>
			<td style="width:60px;"><?php echo $myCategoryA; ?></td>
		     </tr>

		     <tr>
			<td colspan="5">
			    <div class="no-show-hide-content t-left" id="show-hide-content-114">
				<?php echo $myDescriptionA; ?>
			    </div>
			</td>
			<td></td>  
		     </tr>

		     <tr id="tr-115" class="hover">
			<td><b><?php echo $myTitleB; ?></b></td>
			<td class="t-left" style="width:30px;"><?php echo $mySemesterB; ?></td>
			<td class="t-left" style="width:140px;"><div><?php echo $myEctsB; ?></div></td>
			<td class="t-left" style="width:200px;"><div><?php echo $myHoursB; ?></div></td>
			<td style="width:60px;"><?php echo $myCategoryB; ?></td>
		     </tr>
		     <tr class="no-show-hide-content-row">
			<td colspan="5">
			   <div class="no-show-hide-content t-justify" id="show-hide-content-115">
			       <p><?php echo $myDescriptionB; ?> </p>
			   </div>
			</td>
			<td></td>  
		     </tr>

		     <tr id="tr-116" class="hover">
			<td><b><?php echo $myTitleC; ?></b></td>
			<td class="t-left" style="width:30px;"><?php echo $mySemesterC; ?></td>
			<td class="t-left" style="width:140px;"><div><?php echo $myEctsC; ?></div></td>
			<td class="t-left" style="width:200px;"><div><?php echo $myHoursC; ?></div></td>
			<td style="width:60px;"><?php echo $myCategoryC; ?></td>
		     </tr>
	   	     <tr class="no-show-hide-content-row">
			<td colspan="5">
			    <div class="no-show-hide-content t-justify" id="show-hide-content-116">
			       <p><?php echo $myDescriptionC; ?> </p>
		             </div>
			</td>
			<td></td>  
		      </tr>
		  </table>
		</div>
	   </td>
      </tr>
<?php
 }
?>
<!-- Hidden -->

   </table>
   <br /><br />
   <p class="t-right"><a class="button small show-hide-all" href="javascript:void(0)">Εμφάνιση / Απόκρυψη όλων των περιγραφών</a></p>
 		<div>
             <div>
          <div>
       <div>
  <div>
<div>
<div id="noscript" class="alert-wrap">Η Javascript πρέπει να είναι ενεργοποιημένη για να συνεχίσετε!</div>
	
   <footer class="footer"><?php echo $messages['footermessage']; ?> </footer>
        </div>
</div>  
    <script src="/config/js/lib/bootstrap/js/popper.min.js"></script>
    <script src="/config/js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="/config/js/jquery.slimscroll.js"></script>
    <script src="/config/js/sidebarmenu.js"></script>
    <script src="/config/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="/config/js/scripts.js"></script>
</body>
</html>

