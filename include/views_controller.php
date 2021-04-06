<?php
 include('views/view_head.php');
 include('views/view_dbs.php');
 include('views/view_body.php');
 include('views/view_footer.php');
 include('session.php');


  $view_dbs = new ViewDbs;
  $view_head = new ViewHead;
  $view_body = new ViewBody;
  $view_footer = new ViewFooter;

?>