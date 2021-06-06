<?php
function pageid($pageId) {
?>
<div class="page-wrapper">
  <div class="row page-titles">
    <div class="col-md-5 align-self-center">
       <h3 class="text-primary"><?php echo $pageId; ?></h3>
    </div>
    <div class="col-md-7 align-self-center">
       <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Αρχική</a></li>
       </ol>
     </div>
  </div>
<?php
}


?>
