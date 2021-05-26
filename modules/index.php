<div class="container-fluid">
  <div class="row mt-5">
    <div class="col-md-3 col-12 ">
      <div class="card">
        <div class="card-header">دسته‌بندی ها</div>
        <div class="card-body">
          <nav class="nav flex-column">
            <template v-for="category in categoryList">
              <a class="nav-link" href="#" @click.prevent="filterResultByCategory(category.id)"> {{ category.title }} </a>
            </template>
          </nav>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-9 py-4" :class="{'d-flex' : !noAdsFound, 'flex-wrap': !noAdsFound, 'justify-content-center': !noAdsFound}">
      <div class="col-12">
          <div class="mb-3 row px-2">
            <input type="text" class="form-control" id="search" placeholder="چیزی که دنبالشی بنویس اینجا و اینتر رو بزن " @keypress.enter="filterResultBySearch">
          </div>
      </div>
      <div class="row col-12" v-if="noAdsFound">
        <div class="alert alert-primary" role="alert">
          متاسفانه هیچ آگهی وجود ندارد ، لطفا دسته‌بندی دیگری را انتخاب کنید یا کلمه دیگه‌ای رو جستجو کنید
        </div>
        <button type="button" class="btn btn-outline-danger" @click="showAllAds">نمایش همه آگهی ها</button>
      </div>
      <template v-for="(ads,i) in visibleAds" v-if="!noAdsFound">
        <div class="card mx-2 mb-2" :key="i" style="width: 18rem">
          <img :src="`/uploaded_pictures/${ads.images[0]}`" style="width: 14rem; margin: auto;" class="card-img-top" alt="..." />
          <div class="card-body relative-position">
            <h5 class="card-title">{{ ads.title }}</h5>
            <p class="card-text">
            {{ ads.description }}
            </p>
            <a :href="`index.php?page=details&id=${ads.id}`" class="btn btn-primary absolute-button-bottom">مشاهده جزئیات</a>
          </div>
        </div>
      </template>
    </div>
  </div>
</div>