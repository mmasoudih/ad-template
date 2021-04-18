<?php
if (isset($_POST['api'])) {
  
  if(isset($_POST['category_name'])){
    $category_name = $_POST['category_name'];
  }
  if(isset($_POST['cat_id'])){
    $cat_id = $_POST['cat_id'];
  }
  if(isset($_POST['cat_title'])){
    $cat_title = $_POST['cat_title'];
  }



  
  
  switch ($_POST['api']) {
    case 'get-categories':
      include_once 'actions/categories.php';
      getCategories();
      break;
    case 'add-category':
      include_once 'actions/categories.php';
      addCategory($category_name);
      break;
    case 'delete-category':
      include_once 'actions/categories.php';
      deleteCategory($cat_id);
      break;
    case 'update-category':
      include_once 'actions/categories.php';
      updateCategory($cat_id,$cat_title);
      break;
      
    default:
      echo response(['status' => 404]);
  }
  die;
}
?>
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
} else {
  include_once 'modules/index.php';
}
?>
<?php include_once 'footer.php' ?>