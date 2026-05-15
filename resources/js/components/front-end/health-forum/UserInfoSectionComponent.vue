<template>
  <div>
    <ul class="active-user w-100 d-inline-block bg-white box_shadow p-1">
      <li class="float-left mr-2 ml-2 w-sm-30 w-md-30">
        <p class="text_black text_12">
          {{ $parent.contributors.length }}
          <span class="font-weight-bold ml-2">Active users</span>
        </p>
      </li>
      <li class="float-left mrlg-0 mr-2 mr-sm 4 w-sm-30 
      w-md-30">
        <p class="text_black text_12">
          {{ $parent.quesLength }}
          <span class="font-weight-bold ml-2">Questions</span>
        </p>
      </li>
      <li class="float-left w-sm-30 w-md-30">
        <p class="text_black text_12">
          {{ $parent.answersLength }}
          <span class="font-weight-bold ml-2">Answers</span>
        </p>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
name: "UserInfoSectionComponent"
}
</script>

<style scoped>

</style>