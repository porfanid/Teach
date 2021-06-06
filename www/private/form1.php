<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="ITC NOC">
    <title> Απόκτησης Ακαδημαϊκής Εμπειρίας<</title>
    <link href="/common/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="/common/css/helper.css" rel="stylesheet">
    <link href="/common/css/style.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

		<style>
			.gap-10 {
				width:100%;
				height:10px;
			}
			.gap-20 {
				width:100%;
				height:20px;
			}
			.gap-30 {
				width:100%;
				height:30px;
			}
			.gap-100 {
				width:100%;
				height:100px;
			}
		</style>
</head>
<body class="fix-header fix-sidebar">
    <div id="main-wrapper">
        <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-8 align-self-center">
		<img style="float:left" src="/myUniversity/logo.png"/>
		<h3 class="text-primary"><?php echo $univName; ?></h3> 
		<h3 class="text-primary"><?php echo $rescom; ?></h3> 
		<h3 class="text-primary"><?php echo $programTitle; ?></h3> 
	        </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="invoice" class="effect2">
                           <h2  class="text-center">Πρακτικό βαθμολόγησης επιστημονικού πεδίου.</h2>
			      <div class="gap-20"></div>
Σήμερα <?php echo $myDate; ?>, οι παρακάτω αναφερόμενοι:
<div class="gap-10"></div>
<ul>
<li>1.	<?php echo $examiner1Name; ?>, ως Πρόεδρος</li>
<li>2.	<?php echo $examiner2Name; ?>,  ως μέλος</li>
<li>3.	<?php echo $examiner3Name; ?>,  ως μέλος</li>
</ul>
<div class="gap-10"></div>
οι οποίοι αποτελούν την Επιτροπή Αξιολόγησης των προτάσεων όπως αυτή ορίστηκε από τη Σύγκλητο του Πανεπιστημίου για το 
<div class="gap-30"></div>
<h4> Τμήμα: <?php echo $myDepartment; ?></h4> 
<h4> Επιστημονικό πεδίο: <?php echo $myField; ?></h4>
<ul>
Προτάσεις υπέβαλλαν οι παρακάτω:
<?php
 for ($i = 0; $i <= ($count-1); $i++) {
   echo "<li>".($i+1).") ". $mySurname[$i]. $myName[$i]. "</li>";
}
?>
</ul>
<div class="gap-30"></div>

Αξιολογήθηκαν και βαθμολογήθηκαν ως εξής:
 			    <div id="invoice-mid">
                                <table class="table">
<?php
 				for ($i = 0; $i <= ($count-1); $i++) {
   				    echo "<tr><td>".($i+1).") ". $mySurname[$i]. $myName[$i]. "</td><td>". $grade[$i]. "</td></tr>";
				}
?>
                                </table>
                            </div>



<div class="gap-100"></div>
                                <h2 class="text-center">Η επιτροπή</h2>
<div class="gap-100"></div>

<!-- Signs -->
                            <div id="invoice-mid">
				<table class="table">
                                   <tr>
                                        <td class="text-center">
                                    	   <h3><?php echo $examiner1Name; ?></h3>
                                        </td>
                                        <td class="text-center">
                                    	   <h3><?php echo $examiner2Name; ?></h3>
                                        </td>
                                        <td class="text-center">
                                    	   <h3><?php echo $examiner3Name; ?></h3>
                                        </td>
                                   </tr>
				</table>
                            </div>
	
<div class="gap-100"></div>
<div class="gap-100"></div>
<div class="gap-100"></div>

                            <h2 class="text-center">Αναλυτική βαθμολογία</h2>
