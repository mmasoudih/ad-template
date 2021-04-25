<?php 
if (!isset($_GET['id'])){
  header('location: /');
}
?>
<div class="container-fluid">
  <div class="row mt-5">
    <div class="col-6">
      <carousel :per-page="1" style="direction:ltr;" :loop="true" :autoplay="true">
        <template v-for="item in singleAds.images">
          <slide>
            <span class="label">
              <img :src="`/uploaded_pictures/${item}`" style="max-width: 100%;" alt="">
            </span>
          </slide>
        </template>
      </carousel>
      <!-- <img src="" class="card-img-top" alt="..."> -->
    </div>
    <div class="col-6">
      <div class="card mx-2 mb-2">

        <div class="card-body">
          <h5 class="card-title">
            {{singleAds.title}}
            <!-- {{ i }} -->

          </h5>
          <p>
            <strong>شماره موبایل: </strong>
            <i> {{singleAds.phone}} </i>
          </p>
          <p class="card-text">
            
            {{singleAds.description}}
          </p>
          
        </div>
      </div>
    </div>
  </div>

</div>