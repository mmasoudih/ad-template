<?php include_once 'header.php' ?>
<?php
if (isset($_GET['page'])) {
  switch ($_GET['page']) {
    case 'index':
      include_once 'modules/index.php';
      break;

    case 'users':
      include_once 'modules/users.php';
      break;

    case 'categories':
      include_once 'modules/categories.php';
      break;

    default: 
      include_once 'modules/index.php';
  }
}else{
  include_once 'modules/index.php';
}
?>
<?php include_once 'footer.php' ?>