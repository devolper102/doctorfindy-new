<template>
  <div>
    <b-container>
      <b-row class="mt-4">
        <b-col cols="12">
          <template>
            <div class="product-table w-100 d-inline-block">
              <!-- <b-table striped hover :items="items"></b-table> -->
              <b-table
                  :items="orders"
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
                  <template v-slot:cell(type)="data">
                    <p v-if="data.item.type==1">Cash On Delivery</p>
                    <p v-if="data.item.type==2">Pay via Alfa</p>
                  </template>
                  <template v-slot:cell(is_received)="data">
                    <p v-if="data.item.is_received==1">Yes</p>
                    <p v-if="data.item.is_received==0">No</p>
                  </template>
                  <template v-slot:cell(status)="data">
                    <p v-if='data.item.status == 0' class="pending-status">Pending</p>
                    <p v-if='data.item.status == 1' class="approve-status">Confirmed</p>
                    <p v-if='data.item.status == 2' class="unfeatured-status">Delivered</p>
                    <p v-if='data.item.status == 3' class="unflaged-status">Completed</p>
                    <p v-if='data.item.status == 4' class="featured-status">Cancelled</p>
                  </template>
            <template v-slot:cell(created_at)="data">
                <p>{{moment(data.item.created_at).format('DD-MM-YYYY hh:mm a')}}</p>        
            </template>
             <template v-slot:cell(action)="data">
              <b-icon icon="three-dots-vertical" font-scale="1" @click="showdropdown(data.item.id)">
              </b-icon>
              <div :id="'drop'+data.item.id" class="show-dropdown">
                  <a class="approve font-weight-bold d-block" href="javascript:void(0)" @click="markPendingOrder(data.item.id)">
                    Pending
                  </a>
                  <a class="approve font-weight-bold d-block" href="javascript:void(0)" @click="markConfirmOrder(data.item.id)">
                    Confirm
                  </a> 
                  <a class="decline font-weight-bold d-block" href="javascript:void(0)" @click="markDeliverOrder(data.item.id)">
                    Delivered
                  </a>
                  <a class="decline font-weight-bold text-center px-2 d-block" href="javascript:void(0)" @click="markCancelOrder(data.item.id)">
                    Cancel
                  </a>
                  <a class="approve font-weight-bold d-block" href="javascript:void(0)" @click="markCompleteOrder(data.item.id)">
                    Complete
                  </a>
                  <a class="approve font-weight-bold d-block" href="javascript:void(0)" 
                   @click="viewOrderDetail(data.item.id)">
                    View Detail
                  </a>  
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
    <!-- Start View Detail Modal -->
<div>
  <b-modal id="view-detail" ref="view-detail" title="BootstrapVue" :no-close-on-backdrop = "true" :no-close-on-esc = "true" 
  hide-footer :hide-header="true">
    <div class="w-100 d-inline-block p-2">
      <div class="cross-button float-right">
        <b-icon icon="x" aria-hidden="true" 
        @click="hideviewdetailModal()"></b-icon>
      </div>
      <div class="heading-account-information w-100 d-inline-block b-bottom pb-2">
        <h2 class="text-black text_lg_20">Order & Account Information</h2>
      </div>
      <b-row>
        <b-col cols="12" col lg ="6">
          <div class="order-information w-100 d-inline-block">
            <span class="font-weight-bold text-black">Order Information</span>
          </div>
          <ul class="account-information w-100 d-inline-block pl-0 mt-3">
            <li class="w-100 d-inline-block pb-2">
              <span class="w-45 float-left text-black">Order Date:</span>
              <span class="w-45 float-left text-black" v-if="orderDetail">{{moment(orderDetail.created_at).format('LL')}}
              </span>
            </li>
            <li class="w-100 d-inline-block pb-2">
              <span class="w-45 float-left text-black">Order Status</span>
              <span class="w-45 float-left text-black" v-if="orderDetail && orderDetail.status == 0">Pending</span>
              <span class="w-45 float-left text-black" v-if="orderDetail && orderDetail.status == 1">Confirmed</span>
              <span class="w-45 float-left text-black" v-if="orderDetail && orderDetail.status == 2">Delivered</span>
              <span class="w-45 float-left text-black" v-if="orderDetail && orderDetail.status == 3">Completed</span>
              <span class="w-45 float-left text-black" v-if="orderDetail && orderDetail.status == 4">Cancelled</span>
            </li>
            <li class="w-100 d-inline-block pb-2">
              <span class="w-45 float-left text-black">Shipping Method</span>
              <span class="w-45 float-left text-black">Free Shipping
              </span>
            </li>
            <li class="w-100 d-inline-block pb-2">
              <span class="w-45 float-left text-black">Payment Method</span>
              <span class="w-45 float-left text-black" v-if="orderDetail && orderDetail.type == 1">Cash On Delivery
              </span>
              <span class="w-45 float-left text-black" v-if="orderDetail && orderDetail.type == 2">Pay Via Alfa
              </span>
            </li>
            <li class="w-100 d-inline-block pb-2">
              <span class="w-45 float-left text-black">Currency</span>
              <span class="w-45 float-left text-black">PKR
              </span>
            </li>
            <!-- <li class="w-100 d-inline-block pb-2">
              <span class="w-45 float-left text-black">Currency Rate</span>
              <span class="w-45 float-left text-black">1.0000
              </span>
            </li> -->
          </ul>
        </b-col>
        <b-col cols="12" col lg ="6">
          <div class="order-information w-100 d-inline-block">
            <span class="font-weight-bold text-black">Account Information</span>
          </div>
          <ul class="account-information w-100 d-inline-block pl-0 mt-3">
            <li class="w-100 d-inline-block pb-2">
              <span class="w-45 float-left text-black" >Customer Name</span>
              <span class="w-45 float-left text-black" v-if="orderDetail">{{orderDetail.client.name}}
              </span>
            </li>
            <li class="w-100 d-inline-block pb-2">
              <span class="w-45 float-left text-black">Customer Email</span>
              <span class="w-45 float-left text-black" v-if="orderDetail">{{orderDetail.client.email}}
              </span>
            </li>
            <li class="w-100 d-inline-block pb-2">
              <span class="w-45 float-left text-black">Customer Phone</span>
              <span class="w-45 float-left text-black" v-if="orderDetail">{{orderDetail.client.phone}}
              </span>
            </li>
            <li class="w-100 d-inline-block pb-2">
              <span class="w-45 float-left text-black">Customer Group</span>
              <span class="w-45 float-left text-black">Registered
              </span>
            </li>
          </ul>
        </b-col>
      </b-row>
      <div class="heading-account-information w-100 d-inline-block b-bottom pb-2">
        <h2 class="text-black text_lg_20">Address Information</h2>
      </div>
      <b-row>
        <b-col cols="12" col lg ="6">
          <div class="order-information w-100 d-inline-block">
            <span class="font-weight-bold text-black">Shipping Address
            </span>
          </div>
          <ul class="account-information w-100 d-inline-block pl-0 mt-3">
            <li class="w-100 d-inline-block pb-2">
              <span class="w-45 w-xs-100 float-left text-black" v-if="orderDetail && orderDetail.client.complete_address">{{orderDetail.client.complete_address}}</span>
              <span class="w-45 w-xs-100 float-left text-black" v-if="orderDetail && orderDetail.client.address">{{orderDetail.client.address}}</span>
            </li>
          </ul>
        </b-col>
      </b-row>
      <b-row>
        <b-col cols="12">
           <div class="order-information w-100 d-inline-block">
            <span class="font-weight-bold text-black">Items Ordered
            </span>
          </div>
          <div class="order-account-table w-100 d-inline-block">
            <table class="table">
              <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Discount Total</th>
                </tr>
              </thead>
              <tbody v-if="orderDetail">
                <tr v-for="(item,index) in orderDetail.cart" :key="index">
                  <td>
                      {{item.id}}
                  </td>
                  <td class="product-name">
                    {{item.name}}
                  </td>
                  <td>
                      Rs. {{item.price}}
                  </td>
                  <td>{{item.product_quantity}}</td>
                  <td>
                      Rs. {{item.discount_price}}
                  </td>
                </tr>                   
                </tbody>
            </table>
          </div>
        </b-col>
      </b-row>
      <b-row>
        <b-col cols="12">
          <ul class="order-totals-wrapper pl-0 w-40 w-xs-100 float-right mt-lg-0 mt-4">
            <!-- <li class="w-100 d-inline-block pb-2">
              <span class="w-45 float-left text-black">Subtotal</span>
              <span class="w-45 float-left text-black">PKR 600.00</span>
            </li> -->
            <li class="w-100 d-inline-block pb-2">
              <span class="w-45 float-left text-black">Free Shipping</span>
              <span class="w-45 float-left text-black">PKR 0.00</span>
            </li>
            <li class="w-100 d-inline-block pb-2">
              <h3 class="w-45 float-left text-black">Total</h3>
              <h3 class="w-45 float-left text-black" v-if="orderDetail">PKR {{orderDetail.total}}</h3>
            </li>
          </ul>
        </b-col>
      </b-row>
    </div>
  </b-modal>
</div>
<!-- End View Detail Modal -->
  </div>
</template>
<script>

export default {
  name: "product-orderComponent",
data() {
      return {
        orderDetail:null,
          dateRange: { // for v-model
            type: [Object],
            default: null,
            required: true
          },
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
           orders:[],
           options: [
             { value: null, text: 'Any status' },
             { value: 'a', text: 'Any status' },
             { value: 'b', text: 'Any status'},
           ],
           fields: [
         { key: 'id', label: 'ID'},
         { key: 'unique_order_id', label: 'Order ID'},
         { key: 'client_id', label: 'Client ID'},
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
      this.getAllOrders();
    },
methods: {
  deleteOrder(){
            axios.get('/admin/delete_order/'+this.status_id).then(response=>{
              this.$toasted.show(response.data.message,{
                type:'success',
                duration: 2000
              });
              this.showdropdown(this.status_id);
              this.getAllOrders();
            });
          },
          markPendingOrder(id){
            axios.get('/admin/mark_pending_order/'+id).then(response=>{
              this.$toasted.show(response.data.message,{
                type:'success',
                duration: 2000
              });
              this.showdropdown(id);
              this.getAllOrders();
            });
          },
          markConfirmOrder(id){
            axios.get('/admin/mark_confirm_order/'+id).then(response=>{
              this.$toasted.show(response.data.message,{
                type:'success',
                duration: 2000
              });
              this.showdropdown(id);
              this.getAllOrders();
            });
          },
          markDeliverOrder(id){
            axios.get('/admin/mark_deliver_order/'+id).then(response=>{
              this.$toasted.show(response.data.message,{
                type:'success',
                duration: 2000
              });
              this.showdropdown(id);
              this.getAllOrders();
            });
          },
          markCompleteOrder(id){
            axios.get('/admin/mark_complete_order/'+id).then(response=>{
              this.$toasted.show(response.data.message,{
                type:'success',
                duration: 2000
              });
              this.showdropdown(id);
              this.getAllOrders();
            });
          },
          markCancelOrder(id){
            axios.get('/admin/mark_cancel_order/'+id).then(response=>{
              this.$toasted.show(response.data.message,{
                type:'success',
                duration: 2000
              });
              this.showdropdown(id);
              this.getAllOrders();
            });
          },
          viewOrderDetail(id){
            axios.get('/admin/view_order/'+id).then(response=>{
              this.orderDetail=response.data.order;
              this.$bvModal.show('view-detail');
              this.showdropdown(id);
            });
          },
  getAllOrders(){
           axios.get('/get_admin_product_orders')
             .then(response => {
             this.orders = response.data;
             this.totalRows =this.orders.length;
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