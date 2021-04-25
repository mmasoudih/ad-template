<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ورود به پنل مدیریت</title>

  <!-- Bootstrap CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet" />

</head>
<body dir="rtl">
  <div tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <form action="<?php echo $_SERVER['REQUEST_URI'] == '/admin/' ? $_SERVER['REQUEST_URI'] : $_SERVER['REQUEST_URI'].'/' ?>login.php" method="post">
            <div class="form-group my-2">
              <input name="phone" type="text" class="form-control" placeholder="شماره موبایل">
            </div>
            <div class="form-group mb-2">
              <input name="password" type="password" class="form-control" placeholder="رمز عبور">
            </div>
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-success btn-block" @click="login">ورود مدیر</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>