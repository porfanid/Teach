$(document).ready(function() {
/************************************************************* DOCUMENT READY START */

if (document.getElementById('date_of_birth')) {initPicker();}

$("#mobile-menu-icon").click(function(){
	$("#mobile-menu-items").slideToggle(200);
});

if($(".fadeout").length){
	$(".fadeout").delay(12000).slideUp(300);
}

$(window).scroll(function () {
	if ($(this).scrollTop() > 200) {
		$('#scroll-top').fadeIn();
	} else {
		$('#scroll-top').fadeOut();
	}
});
$("a.scroller").smoothScroll({
//afterScroll: function() {location.hash = this.hash;}
});



$("#citizenship").change(function(){
	var cid = $("#citizenship").val().charAt(0);
	$(".csh").hide();
	$(".c"+cid).show();
});

check_radios();
$('input[type=radio][name=field_id]').change(check_radios);


function initPicker(){
$('#calendar_date_of_birth').datePicker({startDate:'01-01-1950'})
.dpSetSelected('01-01-1984')
.bind('click',
function()
{$(this).dpDisplay(); this.blur(); return false;}
);
$('#calendar_date_of_birth').bind('dateSelected',
function(e, selectedDate)
{document.forms[0].date_of_birth.value=selectedDate.asString(); document.forms[0].date_of_birth.focus();});
}

/************************************************************* SHOW HIDE */
var show_hide_speed = 400;
$(".show-hide-content").hide();
$(".show-hide-content.current").show();
$(".show-hide-head").click(function(){
	var id=$(this).attr('id').replace("show-hide-head-", "");
	var content = $("#show-hide-content-"+id);
	var head = $("#show-hide-head-"+id);
	if(content.hasClass("current")){
		content.removeClass("current");
		head.removeClass("current");
		content.slideUp(show_hide_speed);
	}else{
		if($(".show-hide-content").hasClass("current")){
			$(".show-hide-content").removeClass("current");
			$(".show-hide-head").removeClass("current");
			$(".show-hide-content").slideUp(show_hide_speed);
		}
		content.addClass("current");
		head.addClass("current");
		content.slideDown(show_hide_speed);
	}
});
$(".show-hide-all").click(function(){
	if($(".show-hide-all").hasClass("open")){
		$(".show-hide-all").removeClass("open");
		$(".show-hide-content").removeClass("current");
		$(".show-hide-head").removeClass("current");
		$(".show-hide-content").slideUp(show_hide_speed);
	}else{
		$(".show-hide-all").addClass("open");
		$(".show-hide-content").addClass("current");
		$(".show-hide-head").addClass("current");
		$(".show-hide-content").slideDown(show_hide_speed);
	}
});

/************************************************************* DOCUMENT READY END */
});



function check_radios(){
	$('.field-row').removeClass('selected');
	$('.field-row').each(function(i){
		if($('input[type=radio][name=field_id]',this).is(':checked')){
			$(this).addClass('selected');
		}
	});
}



function validate_step(step) {
	var RegExEmail = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/);
	var ll_problems = "Παρουσιάστηκαν τα εξής προβλήματα:\n\n";
	var ll_sep = ": ";
	var ll_empty = "Κενό πεδίο\n";
	var ll_format = "Λανθασμένη μορφή\n";
	var ll_unselected = "Μη-επιλεγμένο\n";
	var ll_filesize = "Πολύ μεγάλο Αρχείο\n";
	var msg="";
	if(step==2){
		var checked_field=0;
		if ($('input[name=field_id]:checked').length > 0){ checked_field = 1; }
		if(checked_field==0){
			msg += "Επιλέξτε τουλάχιστον ένα γνωστικό πεδίο";
		}
	}else if(step==3){
		if($('input[name=surname]').val()==''){ msg += "Ονοματεπώνυμο"+ll_sep+ll_empty; }
		if($('input[name=name]').val()==''){ msg += "Όνομα"+ll_sep+ll_empty; }
		if($('input[name=father_name]').val()==''){ msg += "Ονοματεπώνυμο πατέρα"+ll_sep+ll_empty; }
		if($('input[name=mother_name]').val()==''){ msg += "Ονοματεπώνυμο μητέρας"+ll_sep+ll_empty; }
		if($('input[name=date_of_birth]').val()==''){ msg += "Ημερομηνία γέννησης"+ll_sep+ll_empty; }
		if($('input[name=place_of_birth]').val()==''){ msg += "Τόπος γέννησης"+ll_sep+ll_empty; }
		if($("#county").val()==0){ msg += "Νομός κατοικίας"+ll_sep+ll_empty; }
		if($('input[name=postal_code]').val()==''){ msg += "T.K."+ll_sep+ll_empty; }
		if($('input[name=address]').val()==''){ msg += "Διεύθυνση κατοικίας"+ll_sep+ll_empty; }
		if($('input[name=phone]').val()==''){ msg += "Τηλέφωνο"+ll_sep+ll_empty; }
		if($('input[name=email]').val()==''){ 
			msg += "Email"+ll_sep+ll_empty; 
		}else{
			if(!RegExEmail.test($('input[name=email]').val())){ msg += "Email" + ll_sep + ll_format; }
		}
		
		var cid = $("#citizenship").val().charAt(0);
		if(cid==1){
			if($('input[name=tax_num]').val()==''){ msg += "Α.Φ.Μ."+ll_sep+ll_empty; }
			if($('input[name=tax_office').val()==''){ msg += "Αρμόδια Δ.Ο.Υ."+ll_sep+ll_empty; }
			if($('input[name=ss_number]').val()==''){ msg += "Α.Μ.Κ.Α."+ll_sep+ll_empty; }
			if($('input[name=id_card_number]').val()==''){ msg += "Αρ. Ταυτότητας"+ll_sep+ll_empty; }
		}else if(cid==2){
			if($('input[name=passport_number]').val()==''){ msg += "Αρ. Διαβατηρίου"+ll_sep+ll_empty; }
		}else{
			msg += "Υπηκοότητα"+ll_sep+ll_unselected;
		}
	}else if(step==4){
		if($('input[name=att_course_plan_1]').length){
			if($('input[name=att_course_plan_1]').val()==''){ msg += "Πρόταση Διδασκαλίας (1ο)"+ll_sep+ll_empty; }
			else if($('input[name=att_course_plan_1]')[0].files[0].size > 8000000){ msg += "Πρόταση Διδασκαλίας (1ο)"+ll_sep+ll_filesize; }
		}
		
		if($('input[name=att_course_plan_2]').length){
			if($('input[name=att_course_plan_2]').val()==''){ msg += "Πρόταση Διδασκαλίας (2ο)"+ll_sep+ll_empty; }
			else if($('input[name=att_course_plan_2]')[0].files[0].size > 8000000){ msg += "Πρόταση Διδασκαλίας (2ο)"+ll_sep+ll_filesize; }
		}	
		
		if($('input[name=att_course_plan_3]').length){
			if($('input[name=att_course_plan_3]').val()==''){ msg += "Πρόταση Διδασκαλίας (3ο)"+ll_sep+ll_empty; }
			else if($('input[name=att_course_plan_3]')[0].files[0].size > 8000000){ msg += "Πρόταση Διδασκαλίας (3ο)"+ll_sep+ll_filesize; }
		}	
		
		if($('input[name=att_cv]').length){
			if($('input[name=att_cv]').val()==''){ msg += "Βιογραφικό Σημείωμα"+ll_sep+ll_empty; }
			else if($('input[name=att_cv]')[0].files[0].size > 8000000){ msg += "Βιογραφικό Σημείωμα"+ll_sep+ll_filesize; }
		}
		if($('input[name=att_phd_validation]').length){
			if($('input[name=att_phd_validation]').val()==''){  }
			else if($('input[name=att_phd_validation]')[0].files[0].size > 8000000){ msg += "Αναγνώριση του τίτλου από τον Δ.Ο.Α.Τ.Α.Π"+ll_sep+ll_filesize; }
		}	
		if($('input[name=att_phd_copy]').length){
			if($('input[name=att_phd_copy]').val()==''){ msg += "Φωτοαντίγραφο Διδακτορικού Τίτλου Σπουδών"+ll_sep+ll_empty; }
			else if($('input[name=att_phd_copy]')[0].files[0].size > 8000000){ msg += "Φωτοαντίγραφο Διδακτορικού Τίτλου Σπουδών"+ll_sep+ll_filesize; }
		}	
		
		var cid = $("#citizenship").val().charAt(0);
		if(cid==2){
			if($('input[name=att_gr_lang_validation]').length){
				if($('input[name=att_gr_lang_validation]').val()==''){ msg += "Πιστοποιητικό ελληνομάθειας Δ΄ επιπέδου"+ll_sep+ll_empty; }
				else if($('input[name=att_gr_lang_validation]')[0].files[0].size > 8000000){ msg += "Πιστοποιητικό ελληνομάθειας Δ΄ επιπέδου"+ll_sep+ll_filesize; }
			}	
		}
		if($('input[name=att_solemn_declaration]').length){
			if($('input[name=att_solemn_declaration]').val()==''){ msg += "Υπεύθυνη Δήλωση του Ν.1599/1986"+ll_sep+ll_empty; }
			else if($('input[name=att_solemn_declaration]')[0].files[0].size > 8000000){ msg += "Υπεύθυνη Δήλωση του Ν.1599/1986"+ll_sep+ll_filesize; }
		}	
		
	}else if(step==5){
		if(!$('#terms').is(':checked')){ msg +="Επιβεβαιώστε ότι όλα τα στοιχεία και δικαιολογητικά που καταθέσατε με την αίτησή σας είναι αληθή"; }
	}
	if (msg!="") {alert(ll_problems+msg); return false;}
}

function validate(v_lang, v_formname) {
	// regural expressions
	var RegExEmail = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/);
	var RegExId=new RegExp(/^[A-ZA-zΑ-Ωα-ω0-9]+$/);
	df = document.forms[v_formname];
	var ll_sep = ": ";
	if (v_lang == 'gr') {
		var ll_fulname = "Ονοματεπώνυμο";
		var ll_captcha = "Κωδικός";
		var ll_problems = "Παρουσιάστηκαν τα εξής προβλήματα:\n\n";
		var ll_empty = "Κενό πεδίο\n";
		var ll_format = "Λανθασμένη μορφή\n";
		var ll_unselected = "Μη-επιλεγμένο\n";
	} else {
		var ll_fulname = "Full name";
		var ll_captcha = "Code";
		var ll_problems = "The following errors occurred:\n\n";
		var ll_empty = "Empty field\n";
		var ll_format = "Wrong format\n";
		var ll_unselected = "Not-selected\n";
	}
	msg="";
	if (document.getElementById('fullname')){
		if (df.fullname.value == 0){msg += ll_fulname + ll_sep + ll_empty;}
	}
	if (document.getElementById('id_number')){
		if (df.id_number.value == 0){
			msg += "Αρ. Ταυτότητας ή Διαβατηρίου" + ll_sep + ll_empty;
		}	else if(!RegExId.test(df.id_number.value)){
				msg += "Αρ. Ταυτότητας ή Διαβατηρίου" + ll_sep + ll_format; 
		}
	} 
	if (document.getElementById('email')){
		if (df.email.value == 0){
			msg += "Email" + ll_sep + ll_empty;
		}else{
			if(!RegExEmail.test(df.email.value)){ msg += "Email" + ll_sep + ll_format; }
		}
	}
	if (document.getElementById('captcha')){
		if (df.captcha.value == 0){msg += ll_captcha + ll_sep + ll_empty;}
	}

	if (msg!="") {alert(ll_problems+msg); return false;}
}


function KeepCount(a){
     var limit=1;
     if (a.checked){
          this.NewCount++;
     }

     if (!a.checked){
          this.NewCount=document.querySelectorAll('input[type="checkbox"]:checked').length;
     }

     if(NewCount>limit){
       alert('Παρακαλώ επιλέξτε μόνο ένα επιστημονικό πεδίο!!!');
       return false;
     }
}

function NoSelection(){
     if(NewCount<1){
       alert('Παρακαλώ επιλέξτε επιστημονικό πεδίο!!!');
       return false;
     }
}



/*--------------------------------------------------------------------------------
 Grades2
-------------------------------------------------------------------------------- */
function validateGrades() {
    var field1 = document.forms["myForm"]["grade1"].value;
    var field2 = document.forms["myForm"]["grade2"].value;
    var field3 = document.forms["myForm"]["grade3"].value;
    var field4 = document.forms["myForm"]["grade4"].value;
    var field5 = document.forms["myForm"]["grade5"].value;
    var field6 = document.forms["myForm"]["grade6"].value;
    var field7 = document.forms["myForm"]["grade7"].value;


    if (field1 == "" || field2 == "" || field3 == "" || field4 == "" || field5 == "" || field6 == "" || field7 == "") {
        alert("Πρέπει να συμπληρώσετε όλα τα πεδία.");
        return false;
    }

    if ( field1 < 0  || field1 > 10 || !(isInt(field1)) ) {
        alert(" Η κλίμακα βαθμολογίας είναι ακέραιος μεταξύ 0 και 10.");
        return false;
    }
    if ( field2 < 0  || field2 > 10 || !(isInt(field2)) ) {
        alert(" Η κλίμακα βαθμολογίας είναι ακέραιος μεταξύ 0 και 10.");
        return false;
    }
    if ( field3 < 0  || field3 > 10 || !(isInt(field3)) ) {
        alert(" Η κλίμακα βαθμολογίας είναι ακέραιος μεταξύ 0 και 10.");
        return false;
    }
    if ( field4 < 0  || field4 > 10 || !(isInt(field4)) ) {
        alert(" Η κλίμακα βαθμολογίας είναι ακέραιος μεταξύ 0 και 10.");
        return false;
    }
    if ( field5 < 0  || field5 > 10 || !(isInt(field5)) ) {
        alert(" Η κλίμακα βαθμολογίας είναι ακέραιος μεταξύ 0 και 10.");
        return false;
    }
    if ( field6 < 0  || field6 > 10 || !(isInt(field6)) ) {
        alert(" Η κλίμακα βαθμολογίας είναι ακέραιος μεταξύ 0 και 10.");
        return false;
    }
    if ( field7 < 0  || field7 > 10 || !(isInt(field7)) ) {
        alert(" Η κλίμακα βαθμολογίας είναι ακέραιος μεταξύ 0 και 10.");
        return false;
    }
}


function isInt(value) {
  return !isNaN(value) &&
         parseInt(Number(value)) == value &&
         !isNaN(parseInt(value, 10));
}


/*--------------------------------------------------------------------------------
 Submit
-------------------------------------------------------------------------------- */

   function capcha_filled () {
      allowSubmit = true;
   }

   function capcha_expired () {
      allowSubmit = false;
   }

   function check_if_capcha_is_filled () {
      if (allowSubmit)
      {
         return true;
      }
         else
      {
         alert('Παρακαλώ συμπληρώστε το Captcha');
         return false;
      }
   }

function checkPhone() {
    var myPhone = document.forms["personal_data"]["phone"].value;
    var phoneNum =  parseInt( myPhone.replace(/[^\d]/g, ''), 10) ;
    const phoneLen = Math.ceil(Math.log10(phoneNum + 1));

   if (Number.isInteger(phoneNum)) {
        if ( phoneLen > 9 && phoneLen < 13) {
            return true;
        }else{
            alert("Ο αριθμός τηλεφώνου πρέπει να έχει μεταξύ 10 και 12 αριθμών.");
            return false;
        }
    }else{
        alert("Δεν έχετε συμπληρώσει τον αριθμό τηλεφώνου.");
        return false;
    }
}



   function validateSubmit () {
      capCheck = check_if_capcha_is_filled ()
      phoneCheck= checkPhone ();

   if ( capCheck && phoneCheck ) {
            return true;
        }else{
            return false;
    }
}
