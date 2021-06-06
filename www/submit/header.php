<?php
 $root=$_SERVER['DOCUMENT_ROOT'];
 include_once $root.'/common/header.php';
 include $root.'/common/functions.pages.php';
 include $root.'/config/config.inc.php';

  pageid('Υποβολή');
?>
<div class="container-fluid">                       
    <div class="col-md-8">
        <div class="card">
           <div class="card-body">
<!--
<h4>ΠΡΟΣΟΧΗ. Το μέγεθος του κάθε αρχείου που θα υποβάλετε πρέπει να είναι μέχρι 30MB.</br>
Μονο ένα αρχείο ανα πεδίο μπορεί να εισαχθεί.</h4>
-->

              <h4 class="card-title">Ακαδημαϊκή Εμπειρία</h4> 
                 <!-- Nav tabs -->
                  <ul class="nav nav-tabs customtab2" role="tablist">
                     <li class="nav-item"> <a class="nav-link active" >Προσωπικά Στοιχεία</a> </li>
<?php 
		if ( $myPage > 1) {
                     echo "<li class='nav-item'> <a class='nav-link active' >Επιλογή Μαθήματος </a></li>";
		} else {
                     echo "<li class='nav-item'> <a class='nav-link' >Επιλογή Μαθήματος </a></li>";
		}

		if ( $myPage > 2) {
                     echo "<li class='nav-item'> <a class='nav-link active' >Δικαιολογητικά</a></li>";
		} else {
                     echo "<li class='nav-item'> <a class='nav-link' >Δικαιολογητικά</a></li>";
		}

		if ( $myPage > 3) {
                     echo "<li class='nav-item'> <a class='nav-link active' >Υποβολή</a></li>";
		} else {
                     echo "<li class='nav-item'> <a class='nav-link' >Υποβολή</a></li>";
		}

?>
                  </ul>
                  <div class="tab-content">
		     <div class="tab-pane active" id="home7" role="tabpanel">
