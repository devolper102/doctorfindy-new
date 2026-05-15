  <template>
  <div>
    <div class="box_radius box_shadow mt-4 mb-4 d-inline-block w-100">
      <div class="today_appointment table-responsive">
        <p class="p-2 pb-0 font-weight-bold border-bottom">Total Appointments:<span style="color:green"> {{appointments.length}}</span></p>
        <table class="table">
          <thead class="d-none">
          <tr>
            <th></th>
            <th></th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <tr :id="appointment.id" v-for="(appointment, index) in appointments" :class=" selectedAppointment.id === appointment.id ? ' light_green_bg ' : ''">
            <td>

              <a @click="showDetails(appointment)">
                <span>
                  <img v-if="appointment.patient.profile.avatar"  v-lazy="'/uploads/users/'+appointment.patient.id+'/'+appointment.patient.profile.avatar"  :alt="appointment.patient.first_name+' '+appointment.patient.last_name" :name="appointment.patient.first_name+' '+appointment.patient.last_name" class="rounded-circle w-30px h_30 mr-2 float-left">
                  <img v-else  v-lazy="'/uploads/users/default/patient.svg'"  :alt="appointment.patient.first_name+' '+appointment.patient.last_name" :name="appointment.patient.first_name+' '+appointment.patient.last_name" class="rounded-circle w-30px h_30 mr-2 float-left">
                  <span class="pt-1 d-inline-block">{{ appointment.patient.first_name }} {{ appointment.patient.last_name }}</span>
                </span>
              </a>
            </td>
            <td class="green_text pt-2"> {{ appointment.hospital_id === 0 ? ' Online Consultation ' : 'Medical check up' }} </td>
            <td class="pt-2">{{ appointment.status }}</td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
    <patient-detail :patient="patient"></patient-detail>

  </div>
</template>

<script>
export default {
  name: 'AppointmentListingSectionComponent',
  props: ['appointments'],
  data() {
    return {
      patient: this.appointments[0].patient,
      selectedAppointment: this.appointments[0],
    }
  },
  created () {
    let self = this
     console.log(self.appointments);
  },
  methods: {
    showDetails(appointment) {
      let self = this
      self.selectedAppointment = appointment
      self.patient = appointment.patient
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
</style>