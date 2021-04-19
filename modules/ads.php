<div class="container-fluid">
  <div class="row mt-5">
    <div class="col-12">
      <div class="card">
        <div class="card-header">مدیریت اگهی‌ها</div>
        <div class="card-body">
          <table class="table table-striped">
            <thead> 
              <tr>
                <th>#</th>
                <th>عنوان</th>
                <th>توضیحات</th>
                <th>شماره موبایل</th>
                <th>دسته‌بندی</th>
                <th>کاربر</th>
                <th>وضعیت</th>
                <th style="text-align: left;">عملیات</th>
              </tr>
            </thead>
            <tbody>
            <template v-for="(ads, index) in adsList">
              <tr> 
                <td>{{ index + 1 }}</td>
                <td>{{ ads.title }}</td>
                <td>{{ ads.description }}</td>
                <td>{{ ads.phone }}</td>
                <td>{{ ads.category }}</td>
                <td>{{ ads.user }}</td>
                <td>{{ ads.status == 'enable' ? 'فعال' : 'غیرفعال' }}</td>

                <!-- <td style="text-align: left;" v-if="user.status === 'enable'">
                  <button class="btn btn-sm btn-danger" @click.prevent="toggleUserStatus(user.id)" :disabled="loading">غیرفعال کردن</button>
                </td>
                <td style="text-align: left;" v-if="user.status === 'disable'">
                  <button class="btn btn-sm btn-success" @click.prevent="toggleUserStatus(user.id)" :disabled="loading">فعال کردن</button>
                </td> -->
              </tr>
            </template>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>