<?php
session_start();
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']) {
  setcookie('user_logged_in', true, time() + (86400 * 30), "*"); // 86400 = 1 day
} else {
  if (isset($_COOKIE['user_logged_in'])) {
    unset($_COOKIE['user_logged_in']);
    setcookie("user_logged_in", "", time() - 3600);
  }
}
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
  setcookie('admin_logged_in', true, time() + (86400 * 30), "*"); // 86400 = 1 day
} else {
  if (isset($_COOKIE['admin_logged_in'])) {
    unset($_COOKIE['admin_logged_in']);
    setcookie("admin_logged_in", "", time() - 3600);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link href="css/vueperslides.css" rel="stylesheet" />

  <title>index</title>
</head>

<body lang="fa" dir="rtl">
  <div id="app">
  
    <template v-if="isAdmin || userLoggedIn">
      <button @click="showAdsModal" class="rounded-circle btn btn-success text-white" style="position: fixed;right: 15px; bottom: 15px; width: 60px; height: 60px; font-size: 42px; line-height: 50px;"> + </button>
    </template>
    <!-- Modal -->
    <div class="modal fade" style="background: rgba(0,0,0,.6);" ref="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="transform: translate(0,0);" :class="{'modal-xl': adsModal}" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">{{ modalTitle }}</h5>
            <button type="button" class="close btn rounded-circle btn-danger" style="width: 40px; height: 40px;font-size: 20px;" @click="closeModal">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <template v-if="modalContentType === 'login'">

              <div class="form-group my-2">
                <input v-model="loginForm.phone" type="text" class="form-control" placeholder="شماره موبایل">
              </div>
              <div class="form-group mb-2">
                <input v-model="loginForm.password" type="password" class="form-control" placeholder="رمز عبور">
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success btn-block" @click="login" :disabled="loading">ورود به حساب</button>
              </div>

            </template>

            <template v-if="modalContentType === 'register'">

              <div class="form-group my-2">
                <input v-model="registerForm.fullName" type="text" class="form-control" placeholder="نام و نام خانوادگی">
              </div>
              <div class="form-group my-2">
                <input v-model="registerForm.phone" type="text" class="form-control" placeholder="شماره موبایل">
              </div>
              <div class="form-group mb-2">
                <input v-model="registerForm.password" type="password" class="form-control" placeholder="رمز عبور">
              </div>
              <div class="form-group mb-2">
                <input v-model="registerForm.passwordConfirm" type="password" class="form-control" placeholder="تکرار رمز عبور">
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-warning" @click="register" :disabled="loading">نام نویسی</button>
              </div>


            </template>


            <template v-if="modalContentType === 'add-category'">
              <div class="form-group my-2">
                <input v-model="categoryForm.categoryName" type="text" class="form-control" @keyup.enter="addCategory" placeholder="نام دسته‌بندی جدید را وارد کنید">
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary text-white" @click="addCategory" :disabled="loading">ایجاد دسته‌بندی ‌جدید</button>
              </div>
            </template>

            <template v-if="modalContentType === 'update-category'">
              <div class="form-group my-2">
                <input v-model="categoryForm.categoryName" type="text" class="form-control" @keyup.enter="updateCategory" placeholder="نام دسته‌بندی جدید را وارد کنید">
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-info text-white" @click="updateCategory" :disabled="loading">ویرایش ‌دسته‌بندی</button>
              </div>
            </template>


            <template v-if="modalContentType === 'new-ads'">
            <div class="row">
              <div class="col-6 my-2">
                <div class="form-group my-1">
                  <input v-model="newAdsForm.adsTitle" type="text" class="form-control py-1" placeholder="عنوان آگهی را وارد کنید">
                </div>
                <div class="form-group my-1">
                  <input v-model="newAdsForm.phone" type="text" class="form-control py-1" placeholder="شماره تماس خود را وارد کنید">
                </div>
                <div class="form-group my-1">
                  <input v-model="newAdsForm.adsPrice" type="text" class="form-control py-1" placeholder="قیمت را وارد کنید">
                </div>
                <div class="form-group my-1">
                <select v-model="newAdsForm.categoryId" class="form-control py-1">
                  <option value='' disabled>لطفا یک دسته‌بندی را انتخاب کنید</option> 
                  <template v-for="category in categoryList">
                    <option :value="category.id">{{ category.title }}</option>
                  </template>
                </select>
                </div>
                
                <div class="form-group my-2">
                  <textarea v-model="newAdsForm.adsDescription" cols="30" rows="10" class="form-control" placeholder="توضیحات آگهی را وارد کنید"></textarea>
                </div>

              </div>
              <div class="col-6">
                <template v-for="file in adsFileArray">
                  <input class="form-control" type="file" @change="uploadFile" accept="images/*">
                </template>
                
                <div class="d-grid pt-2 gap-2">
                  <button class="btn btn-info text-white" @click="addNewAdsPicture">عکس جدید</button>
                </div>
                
              </div>
            </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary " @click="saveAds" :disabled="loading">ارسال آگهی</button>
              </div>
            </template>




          </div>
        </div>
      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">صفحه‌اصلی</a>
          </li>
          <template v-if="!isAdmin && userLoggedIn">
            <li class="nav-item">
              <a class="nav-link" href="#">لیست ‌آگهی‌های من</a>
            </li>
          </template>

          <template v-if="isAdmin">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?page=users">مدیریت کاربران</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?page=categories">مدیریت دسته‌بندی‌ها</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?page=ads">مدیریت آگهی‌ها</a>
            </li>
          </template>

        </ul>
        <template v-if="!userLoggedIn && isAdmin === false">
          <div>
            <a class="btn btn-secondary" @click="showLoginModal">ورود</a>
            <a class="btn btn-primary" @click="showRegisterModal">نام نویسی</a>
          </div>
        </template>
        <template v-if="userLoggedIn || isAdmin">
          <div>
            <button class="btn btn-dark text-white" @click="logout" :disabled="loading">خروج از پنل</button>
          </div>
        </template>
      </div>
    </nav>