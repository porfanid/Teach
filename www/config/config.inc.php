<?php
#==============================================================================
# Configuration FILE
#==============================================================================
#
$captcha_site="bbbbbbbbbbbbC-4Znt8swvbWvldZzXjZbbbbbbb";
$secret = "aaaaas8aAAAAAJuVaaaaaaaaaUSnb23bKaaaaaaa";
#
#==============================================================================
# Mail from address
#==============================================================================
 $mail_from='admin@site.com';


#==============================================================================
# DATABASE configuration
#==============================================================================
$dbhost = "localhost";
$dbuser = "dbuser";
$dbpass = "password";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

mysqli_set_charset($conn, 'utf8');

if (mysqli_connect_errno($conn)) {
	   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
mysqli_select_db($conn, 'teach');

#==============================================================================
# LDAP configuration
#==============================================================================
$ldap_url = "ldaps://ldap.xxx.gr";
$ldap_binddn = "cn=manager,dc=example,dc=com";
$ldap_bindpw = "secret";
$ldap_base = "ou=people,dc=duth,dc=gr";
$ldap_login_attribute = "uid";
$ldap_fullname_attribute = "cn";
$ldap_filter = "(&(objectClass=inetorgperson)($ldap_login_attribute={login}))";

$hash = "clear";

# Answer attribute should be hidden to users!
$answer_objectClass = "extensibleObject";
$answer_attribute = "info";

$use_tokens = false;
$crypt_tokens = true;
$token_lifetime = "3600";

# Debug mode
$debug = true;

# Encryption, decryption keyphrase
$keyphrase = "secret";

?>
