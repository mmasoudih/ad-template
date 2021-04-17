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

  <title>index</title>
</head>

<body lang="fa" dir="rtl">
  <div id="app">
    <!-- Modal -->
    <div class="modal fade" style="background: rgba(0,0,0,.6);" ref="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">{{ modalTitle }}</h5>
            <button type="button" class="close btn rounded-circle btn-danger" @click="closeModal">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <template v-if="modalContentType === 1">

              <div class="form-group my-2">
                <input v-model="loginForm.phone" type="text" class="form-control" placeholder="شماره موبایل">
              </div>
              <div class="form-group mb-2">
                <input v-model="loginForm.password" type="password" class="form-control" placeholder="رمز عبور">
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success btn-block" @click="login">ورود به حساب</button>
              </div>

            </template>

            <template v-if="modalContentType === 2">

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
                <button type="submit" class="btn btn-warning" @click="register">نام نویسی</button>
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
          <template v-if="!isAdmin">
            <li class="nav-item">
              <a class="nav-link" href="#">لیست ‌آگهی‌ها</a>
            </li>
          </template>

          <template v-if="isAdmin">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?page=users">مدیریت کاربران</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">مدیریت دسته‌بندی‌ها</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">مدیریت آگهی‌ها</a>
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
            <a class="btn btn-dark text-white" @click="logout">خروج از پنل</a>
          </div>
        </template>
      </div>
    </nav>