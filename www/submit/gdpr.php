<?php
 $root=$_SERVER['DOCUMENT_ROOT'];
 include_once $root.'/common/header.php';
?>

<div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Προσωπικά Δεδομένα</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Υποβολή</a></li>
			<li class="breadcrumb-item active">Προσωπικά Δεδομένα</li>
                    </ol>
                </div>
            </div>
 <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-lg-12">
                                        <div class="card-content">
					   <?php include_once $root.'/myUniversity/gdpr.txt'; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
  </div>
<?php include '../config/footer.php'; ?>
