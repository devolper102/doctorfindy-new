<template>
  <div>
    <b-container>
      <b-row class="mt-4">
        <b-col cols="12">
          <template>
            <div class="product-table w-100 d-inline-block">
              <!-- <b-table striped hover :items="items"></b-table> -->
              <b-table
                  :items="transactions"
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
                  <template v-slot:cell(unique_order_id)="data">
                    {{data.item.order.unique_order_id}}
                  </template>
                  <template v-slot:cell(client_number)="data">
                    <p v-if="data.item.order.client_number">{{data.item.order.client_number}}</p>
                    <p v-else>Not Found</p>
                  </template>
                  <template v-slot:cell(client_name)="data">
                    {{data.item.order.client_name}}
                  </template>
                  <template v-slot:cell(type)="data">
                    <p v-if="data.item.order.type==1">Cash On Delivery</p>
                    <p v-if="data.item.order.type==2">Pay via Alfa</p>
                  </template>
                  <template v-slot:cell(is_received)="data">
                    <p v-if="data.item.order.is_received==1">Yes</p>
                    <p v-if="data.item.order.is_received==0">No</p>
                  </template>
                  <template v-slot:cell(status)="data">
                    <p v-if='data.item.status == 0' class="pending-status">Pending</p>
                    <p v-if='data.item.status == 1' class="approve-status">Confirmed</p>
                    <p v-if='data.item.status == 2' class="unfeatured-status">Delivered</p>
                    <p v-if='data.item.status == 3' class="unflaged-status">Completed</p>
                    <p v-if='data.item.status == 4' class="featured-status">Cancelled</p>
                  </template>
                    <template v-slot:cell(created_at)="data">
                        <p>{{moment(data.item.order.created_at).format('DD-MM-YYYY hh:mm a')}}</p>        
                    </template>
                    <template v-slot:cell(action)="data">
                      <b-icon icon="three-dots-vertical" font-scale="1" @click="showdropdown(data.item.id)">
                      </b-icon>
                      <div :id="'drop'+data.item.id" class="show-dropdown">
                          <a  class="decline font-weight-bold d-block" href="javascript:void(0)" @click="$bvModal.show('bv-modal-delete'); getId(data.item.id);">   Delete
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
    <!-- Start Delete modal -->
  <div>
    <div id="delete-modal">
  <b-modal id="bv-modal-delete" hide-footer>
    <div class="d-block text-center mb-5">
      <h6>Are you sure to Delete</h6>
    </div>
    <div class="approve-btn w-100 d-inline-block text-center">
    <b-button class="mt-3 cancle-btn mr-3" @click="hideModalDelete()">Delete</b-button>
    <b-button class="mt-3 bg-gold done-btn border-gold" @click="hideModalDelete(); deleteTransaction(status_id);">Done</b-button>
  </div>
  </b-modal>
</div>
</div>
<!-- End Delete modal -->
  </div>
</template>
<script>

export default {
  name: "product-transcationsComponent",
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
           transactions:[],
           options: [
             { value: null, text: 'Any status' },
             { value: 'a', text: 'Any status' },
             { value: 'b', text: 'Any status'},
           ],
           fields: [
         { key: 'id', label: 'ID'},
         { key: 'unique_order_id', label: 'Order ID'},
         { key: 'client_number', label: 'Client Number'},
         { key: 'client_name', label: 'Client Name'},
         { key: 'total', label: 'Total'},
         { key: 'type', label: 'Type'},
         { key: 'quantity', label: 'Quantity'},
         { key: 'is_received', label: 'Received'},
         { key: 'created_at', label: 'Date'},
         { key: 'status', label: 'Status' , sortable: true  },
         { key: 'action', label: 'Action'  },
         
        ],
      }
    },
    mounted(){
         this.getAllTransactions();
       },
methods: {
  getAllTransactions(){
           axios.get('/get_admin_transactions')
             .then(response => {
             this.transactions = response.data;
             this.totalRows =this.transactions.length;
             })
             .catch((error) => {
             this.success = false;
           });
         },
         getId(id){
          // alert(id);
        this.status_id = id;
        this.showdropdown(id);
      },
  deleteTransaction(){
            axios.get('/admin/delete_transaction/'+this.status_id).then(response=>{
              this.$toasted.show(response.data.message,{
                type:'success',
                duration: 2000
              });
              this.showdropdown(this.status_id);
              this.getAllTransactions();
            });
          },
  hideModalDelete() {
        this.$root.$emit('bv::hide::modal', 'bv-modal-delete')
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