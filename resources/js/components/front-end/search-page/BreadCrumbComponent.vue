<template>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb doctor_profile text_14 font-weight-bold text_xs_10">
      <li class="breadcrumb-item text_12">
        <a href="/" class="text_black">Home</a>
      </li>
      <li v-bind:class="{ ' breadcrumb-item text_12 active text_black ' : parseInt(segLength) === parseInt(index) }" class="breadcrumb-item text_12 d-lg-block" v-for="(segment, index) in this.$parent.resultSegments">
        <a href="#" class="text_black">{{ segment.removed() }}</a>
      </li>
      <!--<li class="breadcrumb-item text_12 d-none d-lg-block">
        <a href="#" class="text_black">PAKISTAN</a>
      </li>
      <li class="breadcrumb-item text_12">
        <a href="#" class="text_black">LAHORE</a>
      </li>
      <li class="breadcrumb-item text_12 active text_black" aria-current="page">DERMATOLOGISTS IN LAHORE</li>-->
    </ol>
  </nav>
</template>

<script>
String.prototype.removed = function() {
    return this.replace(/-/g,' ');;
}
export default {
  name: "BreadCrumbComponent",
  data() {
    return {
      segLength: 0,
    }
  },
  created () {
    this.segLength = this.$parent.resultSegments.length - 1
    // console.log('breadcrumb',this.$parent.resultSegments,this.segLength)
  }
}
</script>

<style scoped>

</style>