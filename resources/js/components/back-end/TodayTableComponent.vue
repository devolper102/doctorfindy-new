<template>
   <div>
       <table id="today_table" class="table table-bordered dt-responsive nowrap tabs_table" style="width:100%">
    <thead>
        <tr>
            <th>Time</th>
            <th>Date</th>
            <th>Doctor</th>
            <th>Phone</th>
            <th>Disease</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr v-if="appointments" v-for="appointment in appointments">
            <td>
              <p>{{appointment.appointment_time}}</p>
            </td>
            <td>
              <p>{{appointment.appointment_date}}</p>
            </td>
            <td>
              <span>
                <span class="badge p-2 rounded-pill badge_color">New</span>
                {{appointment.patients.first_name+' '+appointment.patients.last_name}}
              </span>
            </td>
            <td>{{appointment.patients.phone_number}}</td>
            <td><span class="text-center w-100 d-block">Cough</span></td>
            <td>
              <span class="theme-color-text">
                Emergency
              </span>
            </td>
            <td>
                <a href="#" class="box_radius p-1 text-center text-white green_btn_bg  text_14 w-50">Approve</a>
                <a href="#" class="box_radius p-1 text-center text-white green_btn_bg d-inline-block text_14 w-50">Cancel</a>
            </td>
        </tr>
    </tbody>
</table>
   </div>
</template>
   
<script>
   
    export default {
        props: ['appointment'],
        name: "TodayDataTableComponent",
        data(){
            return {
                selectedDay: null,
                appointments: this.appointment,
            }
        },
        methods:{
            getAppointmentData(date){
                //$('#today_table').DataTable().clear().destroy();
                var self = this;
                console.log(date);
                axios.post(APP_URL + '/doctor/appointments',{
                    date : date
                })
                .then(function (response) { 
                    console.log(response);

                    self.appointments = response.data.appointments;
                   $('#today_table').DataTable().draw();
                    //table.ajax.reload();
                    // // if ( $.fn.DataTable.isDataTable('#today_table') ) {
                    // $('#tomorrow_table').DataTable();
                })
                .catch(function (error) {});
        }
    },
    mounted: function () { 
        this.$root.$on('dayEvent', (day) => { // here you need to use the arrow function
        this.selectedDay = day.year+'-0'+day.month+'-'+day.day;
        console.log(this.selectedDay);
        this.getAppointmentData(this.selectedDay);
    })
    }
}
</script>