<template>
  <div>
    <section class="top-specialist-in-doctor-hospital" v-if="laboratories.length > 0">
      <div class="container">
        <div class="row">
          <div class="col-12 mt-2 mb-2">
            <div class="accordion md-accordion" id="Lahore" role="tablist" aria-multiselectable="true">
              <!-- Accordion card -->
              <div class="card_main border-0 rounded-0">
                <!-- Card header -->
                <div class="p-0 heading-doctor-city-pakistan" role="tab" id="lahore_doctors">
                  <a class="pr-2 pl-0 pt-2 pb-2 d-inline-block w-100 collapsed text_-blue text_20 text-xs-15 font-weight-bold" data-toggle="collapse" data-parent="#Lahore" href="#doctors_in_lahore" aria-expanded="false" aria-controls="doctors_in_lahore">Top Test Labs in {{user.location.title}}</a>
                </div>
                <!-- Card body -->
                <div id="doctors_in_lahore" class="collapse show" role="tabpanel" aria-labelledby="lahore_doctors" data-parent="#Lahore" style="">
                  <div class="card-body p-0">
                    <ul class="doctor-hospital-city item_list w-100 d-inline-block d-lg-table d-md-table text_black">
                      <li  v-if="index < labsToShows"  v-for="(lab,index) in laboratories" class="d-inline-block w-sm-100 w-md-100 mr-2 mb-2 align-middle item text-center">
                        <a class="text_14 text_black w-100 d-inline-block" :href="'/laboratories/'+lab.location.slug+'/'+lab.slug">
                          {{ lab.first_name }} {{ lab.last_name }}
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>

              </div>
              <!-- Accordion card -->
            </div>
          </div>
            <div class="col-12">
              <div class="mt-2 more_btn text-center d-inline-block w-100">
                <a  href="javascript:void(0)" v-if="laboratories.length > 8 && laboratories.length > labsToShows-1" @click="labsToShows += 8" class="d-inline-block text-center bg-blue book-rounded book-padding text-white text_14 text_md_12"> View More Labs
                </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'TopLabSectionComponent',
  props: ['laboratories','user'],
  data() {
    return {
      tests: [],
      labsToShows: 8,
    }
  },
  created () {
   

  },
}
</script>

<style scoped>

</style>