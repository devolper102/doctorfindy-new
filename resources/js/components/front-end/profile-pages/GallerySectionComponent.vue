<template>
  <div>

    <div v-if="images.length > 0 && galleries.length > 0" class="bg-white mt-3 box_radius box-shadow d-inline-block p-2 w-100" id="gallery_main">
      <div class="heading-box">
        <h6 class="font-weight-bold m-0 text-blue">Gallery</h6>
      </div>
        <div class="gallery-image pt-3 text-center d-lg-inline-block d-flex flex-wrap mobile_view pb-3">
            <img class="image mr-2" v-for="(image, i) in images" v-lazy="image" :key="i" @click="index = i"><vue-gallery-slideshow :images="images" :index="index" @close="index = null"></vue-gallery-slideshow>
        </div>
      <div class="heading-box">
        <h6 class="font-weight-bold m-0 text_black">Video Gallery</h6>
      </div>
      <div class="gallery-image pt-3 text-center d-lg-inline-block d-flex flex-wrap mobile_view pb-3" v-for="(video, i) in videos">
        <!-- <iframe width="auto" class="mr-2" height="auto" allow="fullscreen"
            :src="video.url"></iframe> -->
            <iframe width="auto" height="auto" :src="video.url" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    
    </div>




  </div>
</template>

<script>
import Lightbox from '@morioh/v-lightbox'
import VueGallerySlideshow from 'vue-gallery-slideshow';


// global register
Vue.use(Lightbox);

export default {
  name: "GallerySectionComponent",
  components: { VueGallerySlideshow },
  props: ['user', 'patient', 'galleries','galleryvideos', 'fileSystemDriver'],
  data() {
    return {
      images: [],
      thumbnails: [],
      index: null,
      videos: [],
      basePath:'',
    }
  },
  mounted(){
      if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  created () {
    let self = this
    if(self.galleries != null){
      let photos = JSON.parse(self.galleries)
      let keys = Object.keys(photos)
      keys = keys.splice(1,10);
      if (keys.length > 0) {
        keys.forEach(function (key) {
          self.images.push(this.basePath+'/uploads/users/'+self.user.id+'/gallery/images/' + photos[key])
        })
      }
    }
    if(self.galleryvideos != null){
      let links = JSON.parse(self.galleryvideos)
      self.videos = Object.values(links)
    }
  },
}
</script>

<style>
img[lazy=loading] {
    background-image: url("/images/loader/loaderss.gif");
    background-position: center;
    background-size: contain;
    display: flex;
    width: auto;
    height: auto;
    background-repeat: no-repeat;
  }
img[lazy=error] {
    background-image: url("/images/loader/healthcare-image.png");
    background-position: center;
    background-size: contain;
    display: flex;
    width: auto;
    height: auto;
    background-repeat: no-repeat;
  }
  .lb {
    display: inline-block;
    width: 100%;
  }
  .lb-item {
    background-size: contain;
    width: 20%;
    height: 70px;
    float: left;
  }
  .lb-modal {
    width: 100%;
    position: relative;
    display: inline-block;
  }
  .lb-modal-close{
    position: absolute;
    top: 10px;
    right: 72px;
    border: 0;
    font-size: 25px;
    color: #000;
  }
  .lb-modal-prev,.lb-modal-next{
    position: absolute;
    left: 0;
    top: 40%;
    border: none;
    color: #000;
  }
  .lb-modal-next{
    right: 0;
    left: inherit;
  }
  .lb-modal-img img {
    width: 80%;
    margin-top: 10px;
  }
  .btn-outline-primary:hover,  .btn-outline-primary:not(:disabled):not(.disabled):active{
    color: #fff;
    background-color: #ff465c;
    border-color: #ff465c;
  }
  .btn-outline-primary:not(:disabled):not(.disabled):active:focus{
    box-shadow: none;
  }
  .lb-more{
    color: #fff;
    font-size: 40px;
    background: rgba(0,0,0,0.4);
    width: 100%;
    display: inline-block;
    height: 100%;
  }
  .spinner{
    display: none;
  }
  @media(max-width:991){
    .mobile_view{
      display: flex !important;
      overflow-x: scroll;
      overflow-y: hidden;
    }
  }
</style>