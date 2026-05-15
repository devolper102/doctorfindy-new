<template>
  <div>
    <div class="mt-3 d-inline-block w-100 pt-2 pb-2 pl-3 pr-3 bg-white box-shadow box_radius">
      <div class="heading-box w-100 d-inline-block">
        <strong class="m-0 text_black">Languages spoken
        </strong>
        <ul class="Specialties-list mb-0 mt-2">
          <li>
            <span class="text_14 text_black w-90 float-left">English</span>
          </li>
          <li>
            <span class="text_14 text_black w-90 float-left">Urdu
            </span>
          </li>
          <!-- <li v-for="language in languages" v-if="languages.length > 0">
            <span class="text_14 text_black ml-1" >{{language.capitalize()}}</span>
          </li> -->
         <!--  <li>
            <a class="text_15 text_black ml-2" href="#">Spanish</a>
          </li> -->

        </ul>
      </div>
    </div>
  </div>
</template>

<script>
String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}
export default {
name: "LanguagesSectionComponent",
 props: ['user'],
  data() {
    return {
      languages: [],
    }
  },
  created () {
    // this.languages = this.user.profile.language
    // this.languages = JSON.parse(languages)
  },
}
</script>

<style scoped>

</style>