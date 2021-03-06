<?php 
  require_once 'includes/functions.php';
  checkAdminLogin();
?>
<div class="container-fluid">
  <div class="row mt-5">
    <div class="col-12">
      <div class="card">
        <div class="card-header">مدیریت دسته‌بندی‌ها</div>
        <div class="card-body">
          <button class="btn btn-success rounded" @click="openAddCategoryModal">اضافه کردن دسته‌بندی</button> 
        
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>نام</th>
                <th style="text-align: left;">عملیات</th>
              </tr>
            </thead>
            <tbody>
            <template v-for="(category, index) in categoryList">
              <tr>
                <td>{{ index+1 }}</td>
                <td>{{ category.title }}</td>
                <td style="text-align: left;">
                  <button class="btn btn-sm btn-warning" @click="openUpdateCategoryModal(category.id,category.title)" :disabled="loading">ویرایش</button>
                  <button class="btn btn-sm btn-danger" @click="deleteCategory(category.id)" :disabled="loading">حذف</button>
                </td>
              </tr>
            </template>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>