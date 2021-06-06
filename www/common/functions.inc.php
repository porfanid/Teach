<?php
# Strip slashes added by PHP
# Only if magic_quote_gpc is not set to off in php.ini
function stripslashes_if_gpc_magic_quotes( $string ) {
    if(get_magic_quotes_gpc()) {
        return stripslashes($string);
    } else {
        return $string;
    }
}

# Get message criticity
function get_criticity( $msg ) {

    if ( preg_match( "/nophpldap|nophpmhash|ldaperror|nomatch|badcredentials|passworderror|tooshort|toobig|minlower|minupper|mindigit|minspecial|forbiddenchars|sameasold|answermoderror|answernomatch|mailnomatch|tokennotsent|tokennotvalid|notcomplex|nophpmcrypt|smsnonumber|smscrypttokensrequired/" , $msg ) ) {
    return "danger";
    }
	
    if ( preg_match( "/(login|oldpassword|newpassword|confirmpassword|answer|question|password|mail|token)required|badcaptcha/" , $msg ) ) {
        return "warning";
    }

    return "success";
}


#function send_mail($mail, $mail_from, $subject, $body, $data) {
function send_mail($subject, $body, $mail_from) {
  $root=$_SERVER['DOCUMENT_ROOT'];
  $admin_file=$root.'/config/admins.php';

  $mail="";
  $handle = fopen($admin_file, "r");
  if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $mail=$line.", ".$mail;
    }
    fclose($handle);
  }



    $result = false;

    if (!$mail) {
        error_log("send_mail: no mail given, exiting...");
        return $result;
    }

    /* Encode the subject */
    mb_internal_encoding("UTF-8");
    $subject = mb_encode_mimeheader($subject);

    /* Set encoding for the body */
    $header = "MIME-Version: 1.0\r\nContent-type: text/plain; charset=UTF-8\r\n";

    /* Send the mail */
    if ($mail_from) {
        $result = mail($mail, $subject, $body, $header."From: $mail_from\r\n","-f$mail_from");
    } else {
        $result = mail($mail, $subject, $body, $header);
    }

    return $result;

}


function log_changes($mytable,$mycolumn,$myrow,$username,$oldvalue,$newvalue,$conn) {

    $date=date("Y-m-d H:i:s");
    $sql = "INSERT INTO logs (mytable, mycolumn, myrow, changed_by, old_value, new_value, changed_date) VALUES ('$mytable', '$mycolumn', '$myrow', '$username', '$oldvalue', '$newvalue', '$date')" ;
    $val = mysqli_query($conn, $sql);
    if(! $val ) { die('Could not get data: ' . mysqli_error($conn)); }
}

?>
