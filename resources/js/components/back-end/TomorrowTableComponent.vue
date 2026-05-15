<template>
    <div>
        <table id="tomorrow_table" class="table table-striped table-bordered dt-responsive nowrap tabs_table" style="width:100%">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Date</th>
                    <th>Doctor</th>
                    <th>Phone</th>
                    <th>Disease</th>
                    <th>Status</th>
                    <th class="none">Actions</th>
                </tr>
            </thead>
            <tbody>
            <tr v-if="tappointments" v-for="appointment in tappointments">
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
                <a href="#" class="box_radius p-1 text-center text-white green_btn_bg d-inline-block text_14 w-50">Approve</a>
                <a href="#" class="box_radius p-1 text-center text-white green_btn_bg d-inline-block text_14 w-50">Cancel</a>
            </td>
        </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
   
    export default {
        props: ['tappointments'],
        name: "TomorrowTableComponent",
        data(){
            return {
            }
        },
        methods:{}
    }
</script>