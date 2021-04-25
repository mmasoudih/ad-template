<div class="container-fluid">
  <div class="row mt-5">
    <div class="col-3">
      <div class="card">
        <div class="card-header">دسته‌بندی ها</div>
        <div class="card-body">
          <nav class="nav flex-column">
            <template v-for="category in categoryList">
              <a class="nav-link" href="#"> {{ category.title }} </a>
            </template>
          </nav>
        </div>
      </div>
    </div>
    <div class="col-9 d-flex flex-wrap justify-content-center">
      <template v-for="(ads,i) in visibleAds">
        <div class="card mx-2 mb-2" :key="i" style="width: 18rem">
          <img :src="`/uploaded_pictures/${ads.images[0]}`" style="width: 14rem; margin: auto;" class="card-img-top" alt="..." />
          <div class="card-body">
            <h5 class="card-title">{{ ads.title }}</h5>
            <p class="card-text">
            {{ ads.description }}
            </p>
            <a :href="`index.php?page=details&id=${ads.id}`" class="btn btn-primary">مشاهده جزئیات</a>
          </div>
        </div>
      </template>
    </div>
  </div>
</div>