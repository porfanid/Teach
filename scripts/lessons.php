<?php
 include '/var/www/teach.orfanidis.xyz/docs/config/config.inc.php';

 $date0=date("Y-m-d");
 $date1=date('Y-m-d', strtotime('-1 day' ));
 $date2=date('Y-m-d', strtotime('-2 day' ));
 $date3=date('Y-m-d', strtotime('-3 day' ));
 $date4=date('Y-m-d', strtotime('-4 day' ));
 $date5=date('Y-m-d', strtotime('-5 day' ));
 $date6=date('Y-m-d', strtotime('-6 day' ));

 $sql = "SELECT * FROM lessons WHERE active='1';" ;
 $sql = "SELECT * FROM lessons" ;
   $retval = mysqli_query($conn, $sql);
   $lessons = mysqli_num_rows($retval);

 $sql = "SELECT * FROM applications WHERE submit_date < '$date0';" ;
   $retval = mysqli_query($conn, $sql);
   $applications1 = mysqli_num_rows($retval);

 $sql = "SELECT * FROM applications WHERE submit_date < '$date1';" ;
   $retval = mysqli_query($conn, $sql);
   $applications2 = mysqli_num_rows($retval);

 $sql = "SELECT * FROM applications WHERE submit_date < '$date2';" ;
   $retval = mysqli_query($conn, $sql);
   $applications3 = mysqli_num_rows($retval);

 $sql = "SELECT * FROM applications WHERE submit_date < '$date3';" ;
   $retval = mysqli_query($conn, $sql);
   $applications4 = mysqli_num_rows($retval);

 $sql = "SELECT * FROM applications WHERE submit_date < '$date4';" ;
   $retval = mysqli_query($conn, $sql);
   $applications5 = mysqli_num_rows($retval);

 $sql = "SELECT * FROM applications WHERE submit_date < '$date5';" ;
   $retval = mysqli_query($conn, $sql);
   $applications6 = mysqli_num_rows($retval);

 $sql = "SELECT * FROM applications WHERE submit_date < '$date6';" ;
   $retval = mysqli_query($conn, $sql);
   $applications7 = mysqli_num_rows($retval);

 $sql = "SELECT * FROM applications WHERE mark1_1_date IS NOT NULL AND mark1_2_date IS NOT NULL AND mark1_3_date IS NOT NULL AND mark1_1_date < '$date0' AND mark1_2_date < '$date0' AND mark1_3_date < '$date0' ;" ;
   $retval = mysqli_query($conn, $sql);
   $rated1 = mysqli_num_rows($retval);

 $sql = "SELECT * FROM applications WHERE mark1_1_date IS NOT NULL AND mark1_2_date IS NOT NULL AND mark1_3_date IS NOT NULL AND mark1_1_date < '$date1' AND mark1_2_date < '$date1' AND mark1_3_date < '$date1' ;" ;
   $retval = mysqli_query($conn, $sql);
   $rated2 = mysqli_num_rows($retval);

 $sql = "SELECT * FROM applications WHERE mark1_1_date IS NOT NULL AND mark1_2_date IS NOT NULL AND mark1_3_date IS NOT NULL AND mark1_1_date < '$date2' AND mark1_2_date < '$date2' AND mark1_3_date < '$date2' ;" ;
   $retval = mysqli_query($conn, $sql);
   $rated3 = mysqli_num_rows($retval);

 $sql = "SELECT * FROM applications WHERE mark1_1_date IS NOT NULL AND mark1_2_date IS NOT NULL AND mark1_3_date IS NOT NULL AND mark1_1_date < '$date3' AND mark1_2_date < '$date3' AND mark1_3_date < '$date3' ;" ;
   $retval = mysqli_query($conn, $sql);
   $rated4 = mysqli_num_rows($retval);

 $sql = "SELECT * FROM applications WHERE mark1_1_date IS NOT NULL AND mark1_2_date IS NOT NULL AND mark1_3_date IS NOT NULL AND mark1_1_date < '$date4' AND mark1_2_date < '$date4' AND mark1_3_date < '$date4' ;" ;
   $retval = mysqli_query($conn, $sql);
   $rated5 = mysqli_num_rows($retval);

 $sql = "SELECT * FROM applications WHERE mark1_1_date IS NOT NULL AND mark1_2_date IS NOT NULL AND mark1_3_date IS NOT NULL AND mark1_1_date < '$date5' AND mark1_2_date < '$date5' AND mark1_3_date < '$date5' ;" ;
   $retval = mysqli_query($conn, $sql);
   $rated6 = mysqli_num_rows($retval);

 $sql = "SELECT * FROM applications WHERE mark1_1_date IS NOT NULL AND mark1_2_date IS NOT NULL AND mark1_3_date IS NOT NULL AND mark1_1_date < '$date6' AND mark1_2_date < '$date6' AND mark1_3_date < '$date6' ;" ;
   $retval = mysqli_query($conn, $sql);
   $rated7 = mysqli_num_rows($retval);

echo $lessons." ".$applications1." ".$rated1." ".$date0."\n";
echo $lessons." ".$applications2." ".$rated2." ".$date1."\n";
echo $lessons." ".$applications3." ".$rated3." ".$date2."\n";
echo $lessons." ".$applications4." ".$rated4." ".$date3."\n";
echo $lessons." ".$applications5." ".$rated5." ".$date4."\n";
echo $lessons." ".$applications6." ".$rated6." ".$date5."\n";
echo $lessons." ".$applications7." ".$rated7." ".$date6."\n";
?>
