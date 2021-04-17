<div class="container-fluid">
  <div class="row mt-5">
    <div class="col-3">
      <div class="card">
        <div class="card-header">دسته‌بندی ها</div>
        <div class="card-body">
          <nav class="nav flex-column">
            <template v-for="i in 10">
              <a class="nav-link" href="#"> دسته بندی {{ i }} </a>
            </template>
          </nav>
        </div>
      </div>
    </div>
    <div class="col-9 d-flex flex-wrap justify-content-center">
      <template v-for="i in 30">
        <div class="card mx-2 mb-2" :key="i" style="width: 18rem">
          <img src="https://picsum.photos/400/300" class="card-img-top" alt="..." />
          <div class="card-body">
            <h5 class="card-title">آگهی {{ i }}</h5>
            <p class="card-text">
              Some quick example text to build on the card title and make
              up the bulk of the card's content.
            </p>
            <a href="#" class="btn btn-primary">مشاهده جزئیات</a>
          </div>
        </div>
      </template>
    </div>
  </div>
</div>