<template>
  <div>
     <!-- Topbar -->
    <header-section
      :managements="managements"
    ></header-section>
    <!-- End of Topbar -->
    <!-- Sidebar -->
    <sidebar-patient-section></sidebar-patient-section>
    <!-- End of Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div class="invoice-content">
        <div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="invoice-logo">
                 <img :src="'/uploads/settings/general/'+ main_logo" alt="Site Logo" name="Site Logo" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="invoice-detail">
                    <strong><strong>Date:</strong></strong>
                     {{invoice.created_at | formatDate}}
                     <br>
                    <strong><strong>Status:</strong></strong>
                    {{invoice.status}}
                    <br>
                    <strong><strong>Type:</strong></strong>
                    {{invoice.appointment.type}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="invoice-info">
                <strong>Doctor Name</strong>
                <p>
                   {{invoice.doctor_profile.first_name}} {{invoice.doctor_profile.last_name}}
                </p>
            </div>
        </div>

         <div class="col-md-6">
            <div class="invoice-info invoice-info-2">
                <strong>Patient Name</strong>
                <p>
                {{invoice.first_name}} {{invoice.last_name}}
               </p>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
             <div class="invoice-info">
                <strong>Payment Method</strong>
                <p>
                   {{invoice.payment_gateway}}
                 </p>
            </div>
        </div>
    </div>
    <div class="invoice-item invoice-table-wrap">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="invoice-table table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Charges</th>
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center">Rs: {{invoice.charges}}</td>
                                                          
                                                        </tr>
                                                       
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                      
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="other-info">
                                            <h4>Comments</h4>
                                            <p>{{invoice.commants}}</p>
                                        </div>
                                    </div>
                                </div>
</div>
</div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white box_shadow p-2 d-inline-block mt-4 p-2 border-top">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
  </div>
</template>

<script>
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MMM DD,YYYY')
  }
});
export default
{
  name: "ShowInvoiceSectionComponent",
  props: ['invoice', 'doctors', 'hospitals','managements'],
  data() {
    return {
      site_logo: '',
    }
  },
  created () {
    console.log('new invoice',this.invoice)
       this.site_logo = this.managements.find(pf =>pf.meta_key ==='general_settings')
    if(this.site_logo !== undefined) {
      if (this.site_logo.meta_value === '') {
      }
      else{
        if (JSON.parse(this.site_logo.meta_value).site_logo !== 0) {
          this.main_logo = JSON.parse(this.site_logo.meta_value).site_logo;
        }
      }}
   
  },
  methods: {
  

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
.invoice-content{width: 100%;
display: inline-block;
background-color: #fff;
border: 1px solid #f0f0f0;
    border-radius: 4px;
padding:28px 17px;}
.invoice-detail p{
    text-align: right;
    color: #757575;
     font-size: 0.9375rem; 
    font-family: "Poppins",sans-serif;
    font-weight: 500;
}
.invoice-detail strong{
    color: #272b41;
}
.invoice-logo, .invoice-info{margin-bottom: 30px;}

.invoice-info strong{
    font-size: 18px;
    color: #272b41;
    margin-bottom: 8px;
    display: inline-block;
    font-family: "Poppins",sans-serif;
}
.invoice-info p{
    color: #757575;
    font-size: 0.9375rem;
    font-family: "Poppins",sans-serif;
    font-weight: 500;
}
.invoice-info-2{text-align: right;}
.invoice-table thead tr th{
    text-align: left;
    padding: 10px 20px;
    line-height: inherit;
}
.invoice-table tbody tr td{
    color: #757575;
    font-weight: 500;
    text-align: left;
    padding: 10px 20px;
    line-height: inherit;
}
.invoice-table-two tbody tr th{
    border: 0; 
    line-height: inherit;
text-align: left;}
.invoice-table-two tbody tr td{border: 0;
line-height: inherit;}
.invoice-table-two tbody tr td span{
    color: #757575;
    font-weight: 500;
}
.invoice-table-two tbody tr{border-bottom: 1px solid #eee;}
.invoice-table-two tbody tr:nth-child(3){border-bottom: 0;}
.other-info p{font-family: "Poppins",sans-serif;
    font-size: 0.9375rem;
    color: #757575;
width: 86%;
    margin: 0;
    display: inline-block;}

.other-info h4{font-size: 1.125rem;}

</style>
