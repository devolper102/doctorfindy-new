<template>
	<div>
		<b-container>
			<b-row class="mt-4">
				<b-col cols="12">
					<div class="product-btn float-right">
						<a href="/product/creat/catalogue" class="text-white font-weight-bold knockdoc_btn_bg box_radius d-inline-block">
            Create Product
            </a>
          </div>
				</b-col>
			</b-row>
			<b-row class="mt-4">
				<b-col cols="12">
					<template>
					  <div class="product-table w-100 d-inline-block">
					    <!-- <b-table striped hover :items="items"></b-table> -->
					    <b-table
                  :items="products"
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
                  <template v-slot:cell(brand)="data">   
              <p class="w-100px">{{data.item.brand.name}}</p>
            </template>
            <template v-slot:cell(return_policy)="data">   
              <p class="date-time">{{data.item.return_policy}}</p>
            </template>
            <template v-slot:cell(quantity)="data">   
              <p class="land-line">{{data.item.quantity}}</p>
            </template>
            <template v-slot:cell(sku)="data">   
              <p class="w-100px">{{data.item.sku}}</p>
            </template>
            <template v-slot:cell(price)="data">
              <p class="w-100px">
                {{data.item.price}}
              </p>
            </template>
            <template v-slot:cell(price_start)="data">
              <p class="land-line">
                {{data.item.price_start}}
              </p>
            </template>
            <template v-slot:cell(price_end)="data">
              <p class="land-line">
                {{data.item.price_end}}
              </p>
            </template>
            <template v-slot:cell(discount_price)="data">
              <p class="date-time">
                {{data.item.discount_price}}
              </p>
            </template>
            <!-- <template v-slot:cell(description)="data">   
              <p class="saloon-name">{{data.item.description}}</p>
            </template> -->
            <template v-slot:cell(name)="data">   
              <span class="w-100px d-inline-block">{{data.item.name}}</span>
            </template>
            <template v-slot:cell(description)="data">   
              <span>{{data.item.description.substring(0,100)+".."}}</span>
            </template>
            <template v-slot:cell(category)="data">   
              <p class="w-100px" v-for="(category,index) in data.item.categories" :key="index">{{category.name}}</p>
            </template>
            <template v-slot:cell(tag)="data">   
              <p class="w-100px" v-for="(tag,index) in data.item.tags" :key="index">{{tag.name}}</p>
            </template>
            <template v-slot:cell(attribute)="data">   
              <p class="w-100px" v-for="(attribute,index) in data.item.attributes" :key="index">{{attribute.name}}</p>
            </template>
            <template v-slot:cell(attribute_values)="data">   
              <!-- <p v-for="(value,item) in data.item.attributes[data.index].values" :key="item"> -->
                <p class="saloon-name">
                {{data.item.values.join(', ')}}
              </p>
              <!-- </p> -->
            </template>
            <template v-slot:cell(status)="data">   
              <p class="approve-status mt-2 w-100px" 
              v-if="data.item.status == 1">
              Active</p>
              <p class="flaged-status mt-2 w-100px" v-if="data.item.status == 0">
              Not Active</p>
            </template>
            <template v-slot:cell(price_type_id)="data">   
              <p class="approve-status mt-2 w-100px" v-if="data.item.price_type_id == 1">Fixed</p>
              <p class="flaged-status mt-2 w-100px" v-if="data.item.price_type_id == 2">Percentage</p>
            </template>
            <template v-slot:cell(stock_available)="data">   
              <p class="date-time" v-if="data.item.stock_available == 1">In Stock</p>
              <p class="date-time" v-if="data.item.stock_available == 0">Out of Stock</p>
            </template>
            <template v-slot:cell(thumbnail)="data">
                <a href="javascript:void(0)" class="w-100px d-inline-block">
                  <img v-if="data.item.thumbnail" class="img-fluid" :src="'/uploads/products/'+data.item.thumbnail"/> 
                  <div v-if="!data.item.thumbnail" class="addedClient_character">
                  <span>{{data.item.name.split(' ').slice(0, 2).map(name => name[0]).join('').toUpperCase()}}</span>
                </div>   
               </a>        
            </template>
            <template v-slot:cell(additional_images)="data">
                <a class="date-time d-inline-block" href="javascript:void(0)">
                  <img v-if="data.item.additional_images && data.item.additional_images[0]" class="img-fluid" :src="'/uploads/products/'+data.item.additional_images[0]"/> 
                  <div v-if="!data.item.additional_images" class="addedClient_character">
                  <span>{{data.item.name.split(' ').slice(0, 2).map(name => name[0]).join('').toUpperCase()}}</span>
                </div>   
               </a>        
            </template>
            <template v-slot:cell(feature)="data">
              <p class="flaged-status mt-2 w-100px" 
              v-if="data.item.feature ==1">Featured</p>
              <p class="w-100px approve-status mt-2" v-if="data.item.feature ==0">Un Featured</p>
            </template>
            <template v-slot:cell(top)="data">
              <p class="approve-status mt-2 w-100px" 
              v-if="data.item.top ==1">Top</p>
              <p class="w-100px flaged-status mt-2" v-if="data.item.top ==0">Not Top</p>
            </template>
             <template v-slot:cell(action)="data">
              <a class="text_black dots-icon" 
              href="javascript:void(0)" @click="showdropdown(data.item.id)">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
              </a>
              <div :id="'drop'+data.item.id" class="show-dropdown">
                <a @click="reloadToEdit(data.item.id)" class="approve font-weight-bold d-block">
                  Edit
                </a> 
                        <a class="decline font-weight-bold d-block" href="javascript:void(0)" @click="$bvModal.show('bv-modal-inActive'); getId(data.item.id);">
                          Delete
                        </a>
                        <a v-if="data.item.top == 0" class="decline font-weight-bold d-block" href="javascript:void(0)" @click="markTop(data.item.id);">
                          Mark as Top
                        </a>
                        <a v-if="data.item.top == 1" class="decline font-weight-bold d-block" href="javascript:void(0)" @click="unmarkTop(data.item.id);">
                          UnMark as Top
                        </a>
                        <a v-if="data.item.feature == 0" class="decline font-weight-bold d-block" href="javascript:void(0)" @click="markFeature(data.item.id);">
                          Mark as Feature
                        </a>
                        <a v-if="data.item.feature == 1" class="decline font-weight-bold d-block" href="javascript:void(0)" @click="unmarkFeature(data.item.id);">
                          Unmark as Feature
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
      <!-- Start Decline modal -->
  <div>
    <div id="decline-modal">
  <b-modal id="bv-modal-inActive" hide-footer>
    <div class="d-block text-center mb-5">
      <h6>Are you sure to Delete</h6>
    </div>
    <div class="approve-btn w-100 d-inline-block text-center">
    <b-button class="mt-3 cancle-btn mr-3" @click="hideModalInActive()">Cancel</b-button>
    <b-button class="mt-3 bg-gold done-btn border-gold" @click="hideModalInActive(); deleteProduct(status_id);">Done</b-button>
  </div>
  </b-modal>
</div>
</div>
<!-- End Decline modal -->
		</b-container>
	</div>
</template>

<script>
export default {
  name: "catalogueComponent",
data() {
      return {
      	status_id:'',
          dateRange: { // for v-model
            type: [Object],
            default: null,
            required: true
          },
           /*data table*/
           totalRows: 1,
           currentPage: 1,
           perPage: 10,
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
           products:[],
           options: [
             { value: null, text: 'Any status' },
             { value: 'a', text: 'Any status' },
             { value: 'b', text: 'Any status'},
           ],
            fields: [
              { key: 'id', label: 'ID'},
              { key: 'name', label: 'Name'},
              { key: 'thumbnail', label: 'Base Image'},
              { key: 'additional_images', label: 'Additional Image'},
              { key: 'description', label: 'Description'},
              { key: 'manufacturer_name', label: 'Manufacturer Name'},
              { key: 'brand', label: 'Brand'},
              { key: 'category', label: 'Category'},
              { key: 'tag', label: 'Tag'},
              { key: 'attribute', label: 'Attribute'},
              { key: 'attribute_values', label: 'Attribute Value'},
              { key: 'status', label: 'Status'},
              { key: 'price', label: 'Price'},
              { key: 'discount_price', label: 'Discount Price'},
              { key: 'price_type_id', label: 'Price Type'},
              { key: 'price_start', label: 'Price Starts'},
              { key: 'price_end', label: 'Price Ends'},
              { key: 'sku', label: 'SKU'},
              { key: 'quantity', label: 'Remaining Quantity'},
              { key: 'return_policy', label: 'Return Policy'},
              { key: 'stock_available', label: 'Stock Available'},
              { key: 'feature', label: 'Featured'},
              { key: 'top', label: 'Top'},
              { key: 'action', label: 'Action'  },
          ],
      }
    },
    mounted(){
         this.getAllProduct();
       },
methods: {
  deleteProduct(){
      axios.get('/admin/product/delete/'+this.status_id)
      .then(response => {
        this.$toasted.show(response.data.message,{
          type:'success',
          duration: 2000
        });
      this.getAllProduct();
      this.showdropdown(this.status_id);
    });
  },
  markFeature(id){
            axios.get('/admin/product/markfeature/'+id)
            .then(response => {
              this.$toasted.show(response.data.message,{
                type:'success',
                duration: 2000
              });
              this.getAllProduct();
              this.showdropdown(id);
            });
          },
          unmarkFeature(id){
            axios.get('/admin/product/unmarkfeature/'+id)
            .then(response => {
              this.$toasted.show(response.data.message,{
                type:'success',
                duration: 2000
              });
              this.getAllProduct();
              this.showdropdown(id);
            });
          },
          markTop(id){
            axios.get('/admin/product/marktop/'+id)
            .then(response => {
              this.$toasted.show(response.data.message,{
                type:'success',
                duration: 2000
              });
              this.getAllProduct();
              this.showdropdown(id);
            });
          },
          unmarkTop(id){
            axios.get('/admin/product/unmarktop/'+id)
            .then(response => {
              this.$toasted.show(response.data.message,{
                type:'success',
                duration: 2000
              });
              this.getAllProduct();
              this.showdropdown(id);
            });
          },
  hideModalInActive() {
        this.$root.$emit('bv::hide::modal', 'bv-modal-inActive')
      },
  reloadToEdit(id){
    window.location = "/product/catalogue/edit/"+id;
  },
  getAllProduct(){
           axios.get('/get_admin_products')
             .then(response => {
             this.products = response.data;
             this.totalRows =this.products.length;
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