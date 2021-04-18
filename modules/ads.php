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
                <th>نام کامل</th>
                <th>شماره موبایل</th>
                <th>وضعیت</th>
                <th style="text-align: left;">عملیات</th>
              </tr>
            </thead>
            <tbody>
            <template v-for="(user, index) in usersList">
              <tr> 
                <td>{{ index + 1 }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.phone }}</td>
                <td>{{ user.status == 'enable' ? 'فعال' : 'غیرفعال' }}</td>
                <td style="text-align: left;" v-if="user.status === 'enable'">
                  <button class="btn btn-sm btn-danger" @click.prevent="toggleUserStatus(user.id)" :disabled="loading">غیرفعال کردن</button>
                </td>
                <td style="text-align: left;" v-if="user.status === 'disable'">
                  <button class="btn btn-sm btn-success" @click.prevent="toggleUserStatus(user.id)" :disabled="loading">فعال کردن</button>
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