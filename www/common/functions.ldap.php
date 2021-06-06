<?php
#-------------------------------------------------------------------------------------------
# ldap bind using $myName. Returns $info array
#-------------------------------------------------------------------------------------------
function ldapBind($myName) {
 $conn = ldap_connect("ldap://ldap.duth.gr");
 ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
 ldap_set_option($conn, LDAP_OPT_REFERRALS, 0);

 ldap_bind($conn) or die("Σφάλμα σύνδεσης στην υπηρεσία καταλόγου. Παρακαλώ δοκιμάστε αργότερα.");

 $query = "uid=".$myName;
 $attributes = array("displayname;lang-el", "mail", "ou", "title;lang-el", "telephonenumber", "x-duthaffiliation");
 $ldap_result = ldap_search($conn,"dc=duth,dc=gr", $query, $attributes);
                if(!$ldap_result)
                {
                    error_log("ldap search error using query: $query");
                    die("Παρουσιάστηκε σφάλμα στην αναζήτηση.");
                }

 $info = ldap_get_entries($conn, $ldap_result);

 return $info;
}


?>
