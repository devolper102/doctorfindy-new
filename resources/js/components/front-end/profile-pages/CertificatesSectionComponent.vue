<template>
  <div>
    <div class="mt-3 d-inline-block w-100 pt-2 pb-2 pl-3 pr-3 bg-white box-shadow box_radius">
      <div class="heading-box w-100 d-inline-block">
        <h2 class="font-weight-bold m-0 text_black text_16">
          Certificate</h2>
        <p v-if="certificates.length > 0" v-for="cer in certificates" class="mt-3 w-40 float-left mr-3">
          <img v-lazy="cer" alt="certificate">
        </p>
        <p class="mt-3 w-50 float-left text_14">Certificate Name</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CertificatesSectionComponent",
  props: ['user'],
  data() {
    return {
      certificates: [],
    }
  },
  mounted() {
  },
  created () {
    let self = this
    let cer = JSON.parse(self.user.profile.downloads)
    if (cer.length > 0) {
      cer.forEach(function (c) {
        self.certificates.push('/uploads/users/'+self.user.id+'/'+c)
      })
    }
  },
  methods: {}
}
</script>

<style scoped>

</style>