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
  <link href="css/noty.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/custom.css">

  <title> آگهیش کن !</title>
</head>

<body lang="fa" dir="rtl">
  <div id="app">

    <template v-if="isAdmin || userLoggedIn">
      <button @click="showAdsModal" class="text-white rounded-circle btn btn-success" style="position: fixed;right: 15px; bottom: 15px; width: 60px; height: 60px; font-size: 42px; line-height: 50px; z-index: 20;"> + </button>
    </template>
    <!-- Modal -->
    <div class="modal fade" style="background: rgba(0,0,0,.2);" ref="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="transform: translate(0,0);" :class="{'modal-xl': adsModal}" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">{{ modalTitle }}</h5>
            <button type="button" class="close btn rounded-circle btn-danger" style="width: 40px; height: 40px;font-size: 20px;" @click="closeModal">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <template v-if="modalContentType === 'login'">

              <div class="my-2 form-group">
                <input v-model="loginForm.phone" type="text" class="form-control" placeholder="شماره موبایل">
              </div>
              <div class="mb-2 form-group">
                <input v-model="loginForm.password" type="password" class="form-control" placeholder="رمز عبور">
              </div>
              <div class="gap-2 d-grid">
                <button type="submit" class="btn btn-success btn-block" @click="login" :disabled="loading">ورود به حساب</button>
              </div>

            </template>

            <template v-if="modalContentType === 'register'">

              <div class="my-2 form-group">
                <input v-model="registerForm.fullName" type="text" class="form-control" placeholder="نام و نام خانوادگی">
              </div>
              <div class="my-2 form-group">
                <input v-model="registerForm.phone" type="text" class="form-control" placeholder="شماره موبایل">
              </div>
              <div class="mb-2 form-group">
                <input v-model="registerForm.password" type="password" class="form-control" placeholder="رمز عبور">
              </div>
              <div class="mb-2 form-group">
                <input v-model="registerForm.passwordConfirm" type="password" class="form-control" placeholder="تکرار رمز عبور">
              </div>
              <div class="gap-2 d-grid">
                <button type="submit" class="btn btn-warning" @click="register" :disabled="loading">نام نویسی</button>
              </div>


            </template>


            <template v-if="modalContentType === 'add-category'">
              <div class="my-2 form-group">
                <input v-model="categoryForm.categoryName" type="text" class="form-control" @keyup.enter="addCategory" placeholder="نام دسته‌بندی جدید را وارد کنید">
              </div>
              <div class="gap-2 d-grid">
                <button type="submit" class="text-white btn btn-primary" @click="addCategory" :disabled="loading">ایجاد دسته‌بندی ‌جدید</button>
              </div>
            </template>

            <template v-if="modalContentType === 'update-category'">
              <div class="my-2 form-group">
                <input v-model="categoryForm.categoryName" type="text" class="form-control" @keyup.enter="updateCategory" placeholder="نام دسته‌بندی جدید را وارد کنید">
              </div>
              <div class="gap-2 d-grid">
                <button type="submit" class="text-white btn btn-info" @click="updateCategory" :disabled="loading">ویرایش ‌دسته‌بندی</button>
              </div>
            </template>


            <template v-if="modalContentType === 'new-ads'">
              <div class="row">
                <div class="my-2 col-12 col-md-6">
                  <div class="my-1 form-group">
                    <input v-model="newAdsForm.adsTitle" type="text" class="py-1 form-control" placeholder="عنوان آگهی را وارد کنید">
                  </div>
                  <div class="my-1 form-group">
                    <input v-model="newAdsForm.phone" type="text" class="py-1 form-control" placeholder="شماره تماس خود را وارد کنید">
                  </div>
                  <div class="my-1 form-group">
                    <input v-model="newAdsForm.adsPrice" type="text" class="py-1 form-control" placeholder="قیمت را وارد کنید">
                  </div>
                  <div class="my-1 form-group">
                    <select v-model="newAdsForm.categoryId" class="py-1 form-control">
                      <option value='' disabled>لطفا یک دسته‌بندی را انتخاب کنید</option>
                      <template v-for="category in categoryList">
                        <option :value="category.id">{{ category.title }}</option>
                      </template>
                    </select>
                  </div>

                  <div class="my-2 form-group">
                    <textarea v-model="newAdsForm.adsDescription" cols="30" rows="10" class="form-control" placeholder="توضیحات آگهی را وارد کنید"></textarea>
                  </div>

                </div>
                <div class="col-12 col-md-6">
                  <template v-for="file in adsFileArray">
                    <input class="form-control" type="file" @change="uploadFile" accept="images/*">
                  </template>

                  <div class="gap-2 pt-2 d-grid">
                    <button class="text-white btn btn-info" @click="addNewAdsPicture">عکس جدید</button>
                  </div>

                </div>
              </div>
              <div class="gap-2 d-grid">
                <button type="submit" class="btn btn-primary " @click="saveAds" :disabled="loading">ارسال آگهی</button>
              </div>
            </template>




          </div>
        </div>
      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid d-block d-md-flex">
        <ul class="p-0 mb-2 text-center navbar-nav mb-lg-0 flex-md-row p-md-2">
          <li class="nav-item px-md-3">
            <a class="text-white nav-link active" aria-current="page" href="/">صفحه‌اصلی</a>
          </li>
          <template v-if="!isAdmin && userLoggedIn">
            <li class="nav-item">
              <a class="text-white nav-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?page=my-ads">لیست ‌آگهی‌های من</a>
            </li>
          </template>

          <template v-if="isAdmin">
            <li class="nav-item px-md-3">
              <a class="text-white nav-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?page=users">مدیریت کاربران</a>
            </li>
            <li class="nav-item px-md-3">
              <a class="text-white nav-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?page=categories">مدیریت دسته‌بندی‌ها</a>
            </li>
            <li class="nav-item px-md-3">
              <a class="text-white nav-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?page=ads">مدیریت آگهی‌ها</a>
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
            <button class="text-white btn btn-dark" @click="logout" :disabled="loading" style="width:100%">خروج از پنل</button>
          </div>
        </template>
      </div>
    </nav>