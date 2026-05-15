<script>
import VueCalendar from 'v-calendar/lib/components/calendar.umd';
Vue.component('v-calendar', VueCalendar)
export default {
	name: 'vcalendar',
    components: { 
    'v-calendar' : VueCalendar 
    },
    data() {
    return {
      selectedDay: null, // Add state to store selected day
      attrs: [
        {
          key: 'today',
         highlight: true,
          dates: new Date(),
        },
      ],
    };
  },
   methods: {
    dayClicked(day) {
      this.selectedDay = day;
      this.$root.$emit('dayEvent', day);
      // $('#today_table').DataTable().clear().destroy();
      // $('#today_table tbody tr').empty();
      //this.attrs.dates: day.year+'-0'+day.month+'-'+day.day;
      // console.log(this.attrs.dates);
    },
   },
}
</script>
<template>
	<v-calendar :attributes='attrs' @dayclick='dayClicked'></v-calendar>
</template>