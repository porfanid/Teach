<?php
 $root=$_SERVER['DOCUMENT_ROOT'];
 include_once $root.'/myUniversity/report.php';

   include $root.'/common/functions.pages.php';
   include $root.'/common/functions.inc.php';
   include $root.'/config/config.inc.php';

#-------------------------------------------------------
# Gt data from form
#-------------------------------------------------------
 $ID = $_GET["selectedID"];
 $login = $_GET["login"];

#-------------------------------------------------
# Find Field name and Department from lessonID
#-------------------------------------------------
$sql = "SELECT department, field, examiner1, examiner2, examiner3  FROM lessons WHERE id='$ID' " ;

$retval = mysqli_query($conn, $sql);
if(! $retval ) {  die('Could not get data: ' . mysqli_error($conn)); }
while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
{
    $myDepartment=$row['department'];
    $myField=$row['field'];
    $examiner1=$row['examiner1'];
    $examiner2=$row['examiner2'];
    $examiner3=$row['examiner3'];
}

#-------------------------------------------------------------------------------------
# LDAP search
#-------------------------------------------------------------------------------------
/*
 $info=ldapBind($examiner1);
 $examiner1Name=$info[0]["displayname;lang-el"][0];
 $info=ldapBind($examiner2);
 $examiner2Name=$info[0]["displayname;lang-el"][0];
 $info=ldapBind($examiner3);
 $examiner3Name=$info[0]["displayname;lang-el"][0];
 */

#-------------------------------------------------------------------------------------
# DATABASE search
#-------------------------------------------------------------------------------------
 $sql = "SELECT user, fullname FROM users WHERE user='$examiner1' " ;
 $retval = mysqli_query($conn, $sql);
 if(! $retval ) { die('Could not get data: ' . mysqli_error($conn)); }
 while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
  {
    $examiner1Name=$row['fullname'];
  }


 $sql = "SELECT user, fullname FROM users WHERE user='$examiner2' " ;
 $retval = mysqli_query($conn, $sql);
 if(! $retval ) { die('Could not get data: ' . mysqli_error($conn)); }
 while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
  {
    $examiner2Name=$row['fullname'];
  }

 $sql = "SELECT user, fullname FROM users WHERE user='$examiner3' " ;
 $retval = mysqli_query($conn, $sql);
 if(! $retval ) { die('Could not get data: ' . mysqli_error($conn)); }
 while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
  {
    $examiner3Name=$row['fullname'];
  }


#----------------------------------------------------------------
# Retrieve applicant data (id, name, surname) from applications
#----------------------------------------------------------------
$count=0;
$app_sql = "SELECT * FROM applications WHERE field1 = '$ID' AND active='1';" ;
$app_val = mysqli_query($conn, $app_sql);
if(! $app_val ) {   die('Could not get data: ' . mysqli_error($conn)); }
while($row = mysqli_fetch_array($app_val, MYSQLI_ASSOC))
{
    $myID[$count]=$row['id'];
    $myName[$count]=$row['name'];
    $mySurname[$count]=$row['surname'];

    $required1_1_1[$count]=$row['required1_1_1'];
    $required1_1_2[$count]=$row['required1_1_2'];
    $required1_1_3[$count]=$row['required1_1_3'];
    $required1_1_4[$count]=$row['required1_1_4'];
    $required1_1_5[$count]=$row['required1_1_5'];
    $mark1_1_6[$count]=$row['mark1_1_6'];
    $mark1_1_7[$count]=$row['mark1_1_7'];
    $mark1_1_8[$count]=$row['mark1_1_8'];
    $mark1_1_9[$count]=$row['mark1_1_9'];
    $mark1_1_10[$count]=$row['mark1_1_10'];
    $mark1_1_11[$count]=$row['mark1_1_11'];
    $mark1_1_12[$count]=$row['mark1_1_12'];
    $mark1_1_comments[$count]=$row['mark1_1_comments'];
    $mark1_1_date[$count]=$row['mark1_1_date'];

    $sum1_1[$count]=$mark1_1_6[$count]*$factor1+$mark1_1_7[$count]*$factor2+$mark1_1_8[$count]*$factor3+$mark1_1_9[$count]*$factor4+$mark1_1_10[$count]*$factor5+$mark1_1_11[$count]*$factor6+$mark1_1_12[$count]*$factor7;

    $required1_2_1[$count]=$row['required1_2_1'];
    $required1_2_2[$count]=$row['required1_2_2'];
    $required1_2_3[$count]=$row['required1_2_3'];
    $required1_2_4[$count]=$row['required1_2_4'];
    $required1_2_5[$count]=$row['required1_2_5'];
    $mark1_2_6[$count]=$row['mark1_2_6'];
    $mark1_2_7[$count]=$row['mark1_2_7'];
    $mark1_2_8[$count]=$row['mark1_2_8'];
    $mark1_2_9[$count]=$row['mark1_2_9'];
    $mark1_2_10[$count]=$row['mark1_2_10'];
    $mark1_2_11[$count]=$row['mark1_2_11'];
    $mark1_2_12[$count]=$row['mark1_2_12'];
    $mark1_2_comments[$count]=$row['mark1_2_comments'];
    $mark1_2_date[$count]=$row['mark1_2_date'];

    $sum1_2[$count]=$mark1_2_6[$count]*$factor1+$mark1_2_7[$count]*$factor2+$mark1_2_8[$count]*$factor3+$mark1_2_9[$count]*$factor4+$mark1_2_10[$count]*$factor5+$mark1_2_11[$count]*$factor6+$mark1_2_12[$count]*$factor7;

    $required1_3_1[$count]=$row['required1_3_1'];
    $required1_3_2[$count]=$row['required1_3_2'];
    $required1_3_3[$count]=$row['required1_3_3'];
    $required1_3_4[$count]=$row['required1_3_4'];
    $required1_3_5[$count]=$row['required1_3_5'];
    $mark1_3_6[$count]=$row['mark1_3_6'];
    $mark1_3_7[$count]=$row['mark1_3_7'];
    $mark1_3_8[$count]=$row['mark1_3_8'];
    $mark1_3_9[$count]=$row['mark1_3_9'];
    $mark1_3_10[$count]=$row['mark1_3_10'];
    $mark1_3_11[$count]=$row['mark1_3_11'];
    $mark1_3_12[$count]=$row['mark1_3_12'];
    $mark1_3_comments[$count]=$row['mark1_3_comments'];
    $mark1_3_date[$count]=$row['mark1_3_date'];

    $sum1_3[$count]=$mark1_3_6[$count]*$factor1+$mark1_3_7[$count]*$factor2+$mark1_3_8[$count]*$factor3+$mark1_3_9[$count]*$factor4+$mark1_3_10[$count]*$factor5+$mark1_3_11[$count]*$factor6+$mark1_3_12[$count]*$factor7;

    $grade[$count]=number_format((float)   ($sum1_1[$count]+$sum1_2[$count]+$sum1_3[$count])/3.0, 2, '.', '');
  $count++;
}
    $date=date("Y-m-d H:i");
    $myDate=date("d-m-Y");

   include_once 'form1.php';
   for ($i = 0; $i <= ($count-1); $i++) {
    $fullName= ($i+1).". ".$mySurname[$i] ." ".$myName[$i];
# ON Off criteria
      if ( $required1_1_1[$i] ==1 ) {
      	$pass11= 'NAI';
      } else {
      	$pass11= 'OXI';
      }
      if ( $required1_1_2[$i] ==1 ) {
      	$pass12= 'NAI';
      } else {
      	$pass12= 'OXI';
      }
      if ( $required1_1_3[$i] ==1 ) {
      	$pass13= 'NAI';
      } else {
      	$pass13= 'OXI';
      }
      if ( $required1_1_4[$i] ==1 ) {
      	$pass14= 'NAI';
      } else {
      	$pass14= 'OXI';
      }
      if ( $required1_1_5[$i] ==1 ) {
      	$pass15= 'NAI';
      } else {
      	$pass15= 'OXI';
      }

      if ( $required1_2_1[$i] ==1 ) {
      	$pass21= 'NAI';
      } else {
      	$pass21= 'OXI';
      }
      if ( $required1_1_2[$i] ==1 ) {
      	$pass22= 'NAI';
      } else {
      	$pass22= 'OXI';
      }
      if ( $required1_2_3[$i] ==1 ) {
      	$pass23= 'NAI';
      } else {
      	$pass23= 'OXI';
      }
      if ( $required1_2_4[$i] ==1 ) {
      	$pass24= 'NAI';
      } else {
      	$pass24= 'OXI';
      }
      if ( $required1_2_5[$i] ==1 ) {
      	$pass25= 'NAI';
      } else {
      	$pass25= 'OXI';
      }


      if ( $required1_3_1[$i] ==1 ) {
      	$pass31= 'NAI';
      } else {
      	$pass31= 'OXI';
      }
      if ( $required1_3_2[$i] ==1 ) {
      	$pass32= 'NAI';
      } else {
      	$pass32= 'OXI';
      }
      if ( $required1_3_3[$i] ==1 ) {
      	$pass33= 'NAI';
      } else {
      	$pass33= 'OXI';
      }
      if ( $required1_3_4[$i] ==1 ) {
      	$pass34= 'NAI';
      } else {
      	$pass34= 'OXI';
      }
      if ( $required1_3_5[$i] ==1 ) {
      	$pass35= 'NAI';
      } else {
      	$pass35= 'OXI';
      }


      $grade16=$mark1_1_6[$i];
      $grade17=$mark1_1_7[$i];
      $grade18=$mark1_1_8[$i];
      $grade19=$mark1_1_9[$i];
      $grade110=$mark1_1_10[$i];
      $grade111=$mark1_1_11[$i];
      $grade112=$mark1_1_12[$i];

      $grade26=$mark1_2_6[$i];
      $grade27=$mark1_2_7[$i];
      $grade28=$mark1_2_8[$i];
      $grade29=$mark1_2_9[$i];
      $grade210=$mark1_2_10[$i];
      $grade211=$mark1_2_11[$i];
      $grade212=$mark1_2_12[$i];

      $grade36=$mark1_3_6[$i];
      $grade37=$mark1_3_7[$i];
      $grade38=$mark1_3_8[$i];
      $grade39=$mark1_3_9[$i];
      $grade310=$mark1_3_10[$i];
      $grade311=$mark1_3_11[$i];
      $grade312=$mark1_3_12[$i];

      $comments1=$mark1_1_comments[$i];
      $comments2=$mark1_2_comments[$i];
      $comments3=$mark1_3_comments[$i];

      $totalGrade=$grade[$i];

      include 'form2.php';

# Add empty lines after each applicant exept the last
      if ($i < ($count-1)) {
	echo "<div class='gap-100'></div>";
      }
   }
   include_once 'form3.php';
?>


