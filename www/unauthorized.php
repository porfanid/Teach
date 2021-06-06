<?php
 $root=$_SERVER['DOCUMENT_ROOT'];
 include_once $root.'/common/header.php';
 include $root.'/common/functions.pages.php';

  pageid('Πρόσβαση');
?>

 <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-lg-12">
                                        <div class="card-content">
<div class="alert alert-danger">
<h2>Δεν έχετε πρόσβαση στη σελίδα αυτή.</h2> 
</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<?php  include_once $root.'/common/footer.php'; ?>
