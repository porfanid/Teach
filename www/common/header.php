<?php
#==============================================================================
# Includes
#==============================================================================
 $root=$_SERVER['DOCUMENT_ROOT'];
 require_once($root.'/myUniversity/el.inc.php');
 $active='';
?>

<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="/common/images/favicon.png">
    <title>@teach</title>
    <link href="/common/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="/common/css/helper.css" rel="stylesheet">
    <link href="/common/css/style.css" rel="stylesheet">

    <link href="/common/css/lib/calendar2/semantic.ui.min.css" rel="stylesheet">
    <link href="/common/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="/common/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="/common/css/lib/owl.theme.default.min.css" rel="stylesheet" />

    <link href="/common/css/description.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="/common/teach.css" />
    <script type="text/javascript" src="/common/js_frontend_inclusive_v2.js"></script>

    <script type="text/javascript" src="/common/teach.js"></script>

    <script type="text/javascript">document.documentElement.className += ' js'</script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar">

<div id="main-wrapper">
   <div class="header">
       <nav class="navbar top-navbar navbar-expand-md navbar-light">
       	  <div class="navbar-header">
             <a class="navbar-brand" href="/index.php">
                <b><img src="/myUniversity/logo.png" alt="homepage" class="dark-logo" /></b>
             </a>
          </div>  

	  <div class="navbar-collapse">
   	  <!-- toggle and nav items -->
   	     <ul class="navbar-nav mr-auto mt-md-0">
       		<li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
        	<li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu">Menu</i></a> </li>
   	     </ul>
       
          </div>
      	  <h2 class="text-primary text-left"><?php echo $messages['title']; ?></h2>        
        </nav>
        
   </div>
 </div>

    <div class="left-sidebar">
        <div class="scroll-sidebar">
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="nav-devider"></li>
   <li class="nav-label"><?php echo $messages['start']; ?></li>  
                    <li> <a href="/" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu"><?php echo $messages['start']; ?></span></a></li>
                    <li> <a href="/info.php" aria-expanded="false"><i class="fa fa-exclamation-circle"></i><span class="hide-menu"><?php echo $messages['information']; ?></span></a></li>
                    <li> <a href="/conditions.php" aria-expanded="false"><i class="fa fa-envelope"></i><span class="hide-menu"><?php echo $messages['conditions']; ?></span></a></li>
                    <li> <a href="/lessons.php" aria-expanded="false"><i class="fa fa-book"></i><span class="hide-menu"><?php echo $messages['fields']; ?></span></a></li>

		            <li> <a class="nav-label <?php echo $active; ?>" href="/submit/" aria-expanded="false"><i class="fa fa-folder-open"></i><span class="hide-menu"><?php echo $messages['submit']; ?></span></a></li>

                    <li> <a href="/contact.php" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Επικοινωνία</span></a></li>

                    <li class="nav-label"><?php echo $messages['dep']; ?></li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-wpforms"></i><span class="hide-menu"><?php echo $messages['grading']; ?></span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="/grades/"><?php echo $messages['grading']; ?></a></li>
                            <li><a href="/results/"><?php echo $messages['results']; ?></a></li>
                        </ul>
                    </li>

                    <li class="nav-label"><?php echo $messages['admin']; ?></li>
                    <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-wpforms"></i><span class="hide-menu"><?php echo $messages['administration']; ?></span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="/admin/"><?php echo $messages['analytics']; ?></a></li>
                            <li><a href="/admin/applications/"><?php echo $messages['applications']; ?></a></li>
                            <li><a href="/admin/fields/"><?php echo $messages['lessons']; ?></a></li>
                            <li><a href="/admin/rated/"><?php echo $messages['graded']; ?></a></li>
                            <li><a href="/admin/lessons/"><?php echo $messages['editlessons']; ?></a></li>
                            <li><a href="/admin/logs/"><?php echo $messages['history']; ?></a></li>
                        </ul>
                     </li>
                 </ul>
               </nav>
            </div>
        </div>
