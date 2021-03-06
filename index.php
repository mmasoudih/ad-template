<?php
ob_start();

if (isset($_POST['api'])) {
  if(isset($_POST['ads-id'])){
    $ads_id = $_POST['ads-id'];
  }
  if(isset($_POST['category_name'])){
    $category_name = $_POST['category_name'];
  }
  if(isset($_POST['cat_id'])){
    $cat_id = $_POST['cat_id'];
  }
  if(isset($_POST['cat_title'])){
    $cat_title = $_POST['cat_title'];
  }
  if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
  }
  if(isset($_FILES['ads-pictrue'])){
    $file = $_FILES['ads-pictrue'];
  }
  if(isset($_POST['images'])){
    $images = $_POST['images'];
  }
  if(isset($_POST['phone'])){
    $phone = $_POST['phone'];
  }
  if(isset($_POST['ads_title'])){
    $ads_title = $_POST['ads_title'];
  }
  if(isset($_POST['ads_description'])){
    $ads_description = $_POST['ads_description'];
  }
  if(isset($_POST['category_id'])){
    $category_id = $_POST['category_id'];
  }
  if(isset($_POST['ads_price'])){
    $ads_price = $_POST['ads_price'];
  }
  if(isset($_POST['keyword'])){
    $keyword = $_POST['keyword'];
  }
  if(isset($_POST['catId'])){
    $catId = $_POST['catId'];
  }


  
  switch ($_POST['api']) {
    case 'get-ads':
      include_once 'actions/ads.php';
      getAds();
      break;
    case 'get-ad':
      include_once 'actions/ads.php';
      getAd($ads_id);
      break;
    case 'delete-ad':
      include_once 'actions/ads.php';
      deleteAd($ads_id);
      break;
    case 'get-user-ads':
      include_once 'actions/ads.php';
      getUserAds();
      break;
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
    case 'get-users':
      include_once 'actions/users.php';
      getUsers();
      break;
    case 'toggle-user-status':
      include_once 'actions/users.php';
      toggleEnableUser($user_id);
      break;
    case 'toggle-ads-status':
      include_once 'actions/ads.php';
      toggleAdsStatus($ads_id);
      break;
    case 'upload':
      include_once 'actions/upload.php';
      upload($file);
      break;
    case 'save-ads': 
      include_once 'actions/ads.php';
      addAds($ads_title,$ads_description,$category_id,$ads_price,$images,$phone);
      break;
    case 'search':
      include_once 'actions/ads.php';
      searchAds($keyword);
      break;
    case 'filter-cat':
      include_once 'actions/ads.php';
      filterByCategory($catId);
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

    case 'ads':
      include_once 'modules/ads.php';
      break;

    case 'details':
      include_once 'modules/details.php';
      break;

    case 'my-ads':
      include_once 'modules/user_ads.php';
      break;

    default:
      include_once 'modules/index.php';
  }
} else {
  include_once 'modules/index.php';
}
?>
<?php include_once 'footer.php' ?>