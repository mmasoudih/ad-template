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
                <th>وضعیت</th>
                <th style="text-align: left;">عملیات</th>
              </tr>
            </thead>
            <tbody>
            <template v-for="(ads, index) in userAdsList">
              <tr> 
                <td>{{ index + 1 }}</td>
                <td>{{ ads.title }}</td>
                <td>{{ ads.description }}</td>
                <td>{{ ads.phone }}</td>
                <td>{{ ads.category }}</td>
                
                
                
                <td>
                  <template v-if="ads.status == 'enable'">
                    <span class="badge bg-success">فعال</span>
                  </template>
                  <template v-if="ads.status != 'enable'">
                    <span class="badge bg-warning text-dark">غیرفعال</span>
                  </template>

                </td>

                
                <td style="text-align: left;">
                  <button class="btn btn-sm btn-danger" @click.prevent="deleteAd(ads.id)" :disabled="loading">حذف</button>

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