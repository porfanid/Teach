<?php
#==============================================================================
# Greek
#==============================================================================
$messages['nophpldap'] = "You should install PHP LDAP to use this tool";
$messages['nophpmhash'] = "You should install PHP mhash to use Samba mode";
$messages['ldaperror'] = "Cannot access LDAP directory";
//$messages['loginrequired'] = "Εισάγετε το όνομα χρήστη σας";
//$messages['oldpasswordrequired'] = "Εισάγετε τον παλιό σας κωδικό";
//$messages['newpasswordrequired'] = "Εισάγετε το νέο σας κωδικό";
//$messages['confirmpasswordrequired'] = "Επιβεβαιώστε το νέο σας κωδικό";
$messages['loginrequired'] = "Δώστε τα στοιχεία σας.";
$messages['passwordrequired'] = "Δεν έχετε εισάγει τον κωδικό σας";
$messages['oldpasswordrequired'] = "Δεν έχετε εισάγει τον κωδικό σας";
$messages['newpasswordrequired'] = "Δεν έχετε εισάγει το νέο σας κωδικό";
$messages['confirmpasswordrequired'] = "Δεν επιβεβαιώσατε το νέο σας κωδικό";
$messages['passwordchanged'] = "Συνδεθήκατε";
$messages['loggedin'] = "Συνδεθήκατε";
$messages['nomatch'] = "Οι κωδικοί διαφέρουν";
$messages['badcredentials'] = "Λάθος κωδικός ή όνομα χρήστη";
$messages['passworderror'] = "Password was refused by the LDAP directory";
$messages['title'] = "Πρόγραμμα Απόκτησης Ακαδημαϊκής Εμπειρίας";
$messages['login'] = "Όνομα χρήστη";
$messages['oldpassword'] = "Παλιός κωδικός";
$messages['newpassword'] = "Νέος κωδικός";
$messages['confirmpassword'] = "Επιβεβαίωση νέου κωδικού";
$messages['submit'] = "Υποβολή";
$messages['getuser'] = "Get user";
$messages['tooshort'] = "Ο κωδικός σας είναι πολύ μικρός";
$messages['toobig'] = "Ο κωδικός σας είναι πολύ μεγάλος";
$messages['minlower'] = "Ο κωδικός σας δεν περιέχει αρκετούς μικρούς χαρακτήρες";
$messages['minupper'] = "Ο κωδικός σας δεν περιέχει αρκετούς κεφαλαίους χαρακτήρες";
$messages['mindigit'] = "Ο κωδικός σας δεν περιέχει αρκετούς αριθμητικούς χαρακτήρες";
$messages['minspecial'] = "Ο κωδικός σας δεν περιέχει αρκετά σύμβολα";
$messages['sameasold'] = "Ο νέος σας κωδικός είναι ίδιος με τον παλιό";
$messages['policy'] = "Ο νέος κωδικός πρέπει να πληρoί τις παρακάτω προϋποθέσεις:";
$messages['policyminlength'] = "- Ελάχιστο μήκος:";
$messages['policymaxlength'] = "- Μέγιστο μήκος:";
$messages['policyminlower'] = "- Ελάχιστος αριθμός μικρών χαρακτήρων:";
$messages['policyminupper'] = "- Ελάχιστος αριθμός κεφαλαίων χαρακτήρων:";
$messages['policymindigit'] = "- Ελάχιστος αριθμός αριθμητικών χαρακτήρων:";
$messages['policyminspecial'] = "- Ελάχιστος αριθμός συμβόλων:";
$messages['forbiddenchars'] = "Ο κωδικός σας περιέχει μη επιτρεπτούς χαρακτήρες";
$messages['policyforbiddenchars'] = "- Επιτρέπονται λατινικοί και ελληνικοί χαρακτήρες, αριθμοί<br />&nbsp;&nbsp;και τα σύμβολα";
$messages['policynoreuse'] = "- Πρέπει να διαφέρει από τον παλιό σας κωδικό";
$messages['questions']['birthday'] = "When is your birthday?";
$messages['questions']['color'] = "What is your favorite color?";
$messages['password'] = "Κωδικός";
$messages['question'] = "Question";
$messages['answer'] = "Answer";
$messages['setquestionshelp'] = "Initialize or change your password reset question/answer. You will then be able to reset your password <a href=\"?action=resetbyquestions\">here</a>.";
$messages['answerrequired'] = "No answer given";
$messages['questionrequired'] = "No question selected";
$messages['passwordrequired'] = "Ο κωδικός είναι απαραίτητος";
$messages['answermoderror'] = "Your answer has not been registered";
$messages['answerchanged'] = "Your answer has been registered";
$messages['answernomatch'] = "Your answer is incorrect";
$messages['resetbyquestionshelp'] = "Choose a question and answer it to reset your password. This requires that you have already <a href=\"?action=setquestions\">register an answer</a>.";
$messages['changehelp'] = "Εισάγετε τον παλιό σας κωδικό και επιλέξτε ένα νέο.";
$messages['changehelpreset'] = "Forgot your password?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Reset your password by answering questions</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Email a password reset link</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reset your password with a SMS</a>";
$messages['resetmessage'] = "Hello {login},\n\nClick here to reset your password:\n{url}\n\nIf you didn't request a password reset, please ignore this email.";
$messages['resetsubject'] = "Reset your password";
$messages['sendtokenhelp'] = "Enter your user name and your email address to reset your password. When you receive the email, click the link inside to comlpete the password reset.";
$messages['mail'] = "Mail";
$messages['mailrequired'] = "Your email address is required";
$messages['mailnomatch'] = "The email address does not match the submitted user name";
$messages['tokensent'] = "A confirmation email has been sent";
$messages['tokennotsent'] = "Error when sending confirmation email";
$messages['tokenrequired'] = "Token is required";
$messages['tokennotvalid'] = "Token is not valid";
$messages['resetbytokenhelp'] = "The link sent by email allows you to reset your password. To request a new link via email, <a href=\"?action=sendtoken\">click here</a>.";
$messages['resetbysmshelp'] = "The token sent by sms allows you to reset your password. To get a new token, <a href=\"?action=sendsms\">click here</a>.";
$messages['changemessage'] = "Hello {login},\n\nYour password has been changed.\n\nIf you didn't request a password reset, please contact your administrator immediately.";
$messages['changesubject'] = "Your password has been changed";
$messages['badcaptcha'] = "Το CAPTCHA δεν εισήχθει σωστά. Δοκιμάστε ξανά.";
$messages['notcomplex'] = "Ο κωδικός σας δεν έχει αρκετούς διαφορετικούς τύπους χαρακτήρων";
$messages['policycomplex'] = "Ελάχιστος αριθμός διαφορετικών τύπων χαρακτήρων:";
$messages['nophpmcrypt'] = "You should install PHP mcrypt to use cryptographic functions";
$messages['sms'] = "SMS number";
$messages['smsresetmessage'] = "Your password reset token is:";
$messages['sendsmshelp'] = "Enter your login to get password reset token. Then type token in sent SMS.";
$messages['smssent'] = "A confirmation code has been send by SMS";
$messages['smsnotsent'] = "Error when sending SMS";
$messages['smsnonumber'] = "Can't find mobile number";
$messages['userfullname'] = "User full name";
$messages['username'] = "Username";
$messages['smscrypttokensrequired'] = "You can't use reset by SMS without crypt_tokens setting";
$messages['smsuserfound'] = "Check that user information are correct and press Send to get SMS token";
$messages['smstoken'] = "SMS token";


#--------------------------------------------------
# Header-Footer
#--------------------------------------------------
$messages['start'] = "Αρχική";
$messages['information'] = "Πληροφορίες";
$messages['conditions'] = "Προϋποθέσεις";
$messages['fields'] = "Επιστημονικά Πεδία";
$messages['dep'] = "ΔΕΠ";
$messages['grading'] = "Βαθμολόγηση";
$messages['admin'] = "Γραμματεία";
$messages['administration'] = "Διαχείριση";
$messages['analytics'] = "Αναλυτικά";
$messages['applications'] = "Αιτήσεις";
$messages['lessons'] = "Μαθήματα";
$messages['graded'] = "Βαθμολογήθηκαν";
$messages['results'] = "Αποτελέσματα";
$messages['editlessons'] = "Επεξεργασία Μαθήματος";
$messages['submit'] = "Υποβολή";
$messages['history'] = "Ιστορικό";

$messages['footermessage'] = "Πανεπιστήμιο xxx - Διεύθυνση Μηχανοργάνωσης.";
$messages['secrmail'] = "Παρακαλώ επικοινωνήστε με τη γραμματεία στη διεύθυνση ηλεκτρονικού ταχυδρομείου teach@xxx.gr";
?>
