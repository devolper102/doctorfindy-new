<template>
  <div>
     <div class="box_radius box_shadow mt-3 mb-3 d-inline-block w-100">
                <div class="invoices" >
                  <p class="pb-2 p-2 pl-lg-3 font-weight-bold border-bottom-dark">Invoices</p>
                  <table class="table " v-if="doctor.doctor_invoices.length">
                    <thead>
                        <tr>
                            <th>Inovoice id</th>
                            <th>Paying date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(invoice, index) in doctor.doctor_invoices">
                            <td>{{index+1}}</td>
                            <td>{{invoice.created_at | formatDate}}</td>
                            <td>Rs: {{invoice.charges}}</td>
                            <td>{{invoice.status}}</td>
                            <td>
                              <a :href="'/show-invoice/'+invoice.id" class="theme-color-text font-weight-bold">View</a>
                            </td>
                        </tr>
                                  
                    </tbody>
                  </table>
                  <div v-else> <h6 style="color:black;font-weight:bold;margin-top:5px;"align="center">No Invoices</h6></div>
                </div>
                
              </div>
  </div>
</template>

<script>
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MMM DD,YYYY')
  }
});
export default {
  name: "InvoicesSectionComponent",
  props: ['doctor'],
  data() {
    return {
      
    }
  },

  created () {
                console.log('invoices',this.doctor.doctor_invoices)
  }
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