  <template>
  <div>
    <!--   <div class="container">
        <div class="row">
              <div class="col-12 mt-4">
                <bread-crumb-spec></bread-crumb-spec>
              </div>
        </div>
    </div>  -->
    <section :style="{ 'background-image': 'url(/uploads/settings/home/' + banner_section_img + ')' }" class="section-doctoe-practice position-relative">
      <div class="bg-doctor-practice w-100 d-inline-block">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="heading-doctor-practice">
                <h2 class="text-white mt-5 font-weight-bold mb-0">{{title}}</h2>
                <p class="text-white mt-3 text_18">{{heading}}</p>
                <p class="text-white mt-3 text_14 w-60 w-xs-100 w-sm-100">{{description}}</p>
                <div class="join-doctor-btn mt-4 mb-4">
                  <a href="#request-demo" class="rounded-pill knockdoc_btn_bg text-white p-2 btn_padding d-inline-block text-center">Request a Demo
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "BannerSectionCompoent",
   props:['segments','managements'],
 data() {
    return {
      resultSegments: this.segments,
      title: '',
      heading: '',
      description : '',
      banner_section_img : '',
    }
  },
  created() {
      this.banner_section = this.managements.find(pf =>pf.meta_key ==='banner_video_section')
      this.title = JSON.parse(this.banner_section.meta_value).title;
      this.description = JSON.parse(this.banner_section.meta_value).description;
      this.heading = JSON.parse(this.banner_section.meta_value).heading;
      this.banner_section_img = JSON.parse(this.banner_section.meta_value).hidden_banner_section_img;

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
</style>