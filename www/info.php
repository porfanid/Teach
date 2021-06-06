<?php 
 $root=$_SERVER['DOCUMENT_ROOT'];
 include_once $root.'/common/header.php';
 include $root.'/common/functions.pages.php';

  pageid('Πληροφορίες');
?>
 <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-lg-12">
                                        <h4 class="card-title">Πληροφορίες</h4>
 					<?php include $root.'/myUniversity/myInfo.txt'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<?php include $root.'/common/footer.php';?>
