<template>
  <div>
    <b-container>
      <b-row class="mt-4">
        <b-col cols="12">
          <template>
            <div class="product-table w-100 d-inline-block">
              <!-- <b-table striped hover :items="items"></b-table> -->
              <b-table
                  :items="reviews"
                  :fields="fields"
                  :current-page="currentPage"
                  :per-page="perPage"
                  :filter="filter"
                  :filter-included-fields="filterOn"
                  :sort-by.sync="sortBy"
                  :sort-desc.sync="sortDesc"
                  :sort-direction="sortDirection"
                  show-empty
                  small
                  @filtered="onFiltered"
                  >
                  <template v-slot:cell(date)="data">
                     <p class="date-time">{{ moment(data.item.date).format("LL") }}</p>
                  </template>
                  <template v-slot:cell(reviewer_number)="data">
                     <p class="client-name">{{data.item.client.phone}}</p>
                  </template>
                  <template v-slot:cell(reviewer_address)="data">
                     <p class="client-name">{{data.item.client.address}}</p>
                  </template>
                  <template v-slot:cell(product_name)="data">
                     <p class="client-name">{{data.item.products.name}}</p>
                  </template>
                  <template v-slot:cell(status)="data">
                    <p v-if='data.item.status == 0' class="pending-status">Pending</p>
                    <p v-if='data.item.status == 1' class="approve-status">Approved</p>
                  </template>
             <template v-slot:cell(action)="data">
                <b-icon icon="three-dots-vertical" font-scale="1" @click="showdropdown(data.item.id)">
                </b-icon>
                <div :id="'drop'+data.item.id" class="show-dropdown">
                  <a v-if="data.item.status == 0"  class="approve font-weight-bold d-block" href="javascript:void(0)" @click="approveReview(data.item.id)">
                              Approve
                          </a> 
                          <a  v-if="data.item.status == 1" class="decline font-weight-bold d-block" href="javascript:void(0)" @click="declineReview(data.item.id)">
                            Decline
                          </a>                
                </div>      
            </template>
                </b-table>
            </div>
          </template>
        </b-col>
        <b-col cols="12 mb-5">
         <div class="product-list-pagination mb-4 position-relative float-right">
            <b-pagination
              v-model="currentPage"
               :total-rows="totalRows"
               :per-page="perPage"
              first-number
              last-number>
            </b-pagination>
          </div>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>
<script>

export default {
  name: "product-reviewsComponent",
data() {
      return {
        /*data table*/
           totalRows: 1,
           currentPage: 1,
           perPage: 15,
           pageOptions: [15, 30, 45, { value: 100, text: "Show a lot" }],
           sortBy: '',
           sortDesc: false,
           sortDirection: 'asc',
           filter: null,
           filterOn: [],
           selectCity:'',
           selectService:'',
           citiesOpt:[],
           servicesOpt:[],
           infoModal: {
             id: 'info-modal',
             title: '',
             content: ''
           },
           /*data table*/
           moment: moment,
           rows: 100,
           selected: null,
           reviews:[],
           options: [
             { value: null, text: 'Any status' },
             { value: 'a', text: 'Any status' },
             { value: 'b', text: 'Any status'},
           ],
           fields: [
         { key: 'id', label: 'ID'},
         { key: 'reviewer_name', label: 'Review Name'},
         { key: 'reviewer_number', label: 'Reviewer Number'},
         { key: 'reviewer_address', label: 'Reviewer Address'},
         { key: 'message', label: 'Message'},
         { key: 'rating', label: 'Rating'},
         { key: 'product_id', label: 'Product ID'},
         { key: 'product_name', label: 'Product Name'},
         { key: 'status', label: 'Status' , sortable: true  },
         { key: 'action', label: 'Action'  },
         
        ],
      }
    },
    mounted(){
         this.getAllReview();
       },
methods: {
  approveReview(id){
        // this.$bvModal.show('bv-modal-loading');
        axios.get('/product/review/approve/'+id)
          .then(response => {
            // this.$bvModal.hide('bv-modal-loading');
            this.getAllReview();
          })
      },
      declineReview(id){
         // this.$bvModal.show('bv-modal-loading');
          axios.get('/product/review/decline/'+id)
            .then(response => {
              // this.$bvModal.hide('bv-modal-loading');
              this.getAllReview();
            })
      },
  getAllReview(){
           axios.get('/get_admin_product_reviews')
             .then(response => {
             this.reviews = response.data;
             this.totalRows =this.reviews.length;
             })
             .catch((error) => {
             this.success = false;
           });
         },
showdropdown(id){
            var newid = 'drop'+id;
            var check = document.getElementById("drop"+id).style.display;
            if (check == "block") {
              document.getElementById("drop"+id).style.display = 'none';
            }else{
              document.getElementById("drop"+id).style.display = 'block';
            }
          },

}


};

</script>

<style>

</style>