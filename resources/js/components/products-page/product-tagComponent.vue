<template>
  <div>
    <b-container>
      <b-row class="mt-4">
        <b-col cols="12">
          <div class="product-btn float-right">
            <a href="javascript:void(0)" class="text-white font-weight-bold knockdoc_btn_bg box_radius d-inline-block" 
            v-b-modal.product-backend-tag>
            Create Tag
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
                  :items="allTags"
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
                  <template v-slot:cell(action)="data">
                    <a v-b-modal.editTag class="font-weight-bold theme-color-text" href="javascript:void(0)" @click="getId(data.item.id);">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      </a>
                      <a class="font-weight-bold theme-color-text" href="javascript:void(0)" @click="$bvModal.show('bv-modal-delete');getId(data.item.id);">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>
                    </template>
                </b-table>
            </div>
          </template>
        </b-col>
        <b-col cols="12 mb-5">
         <div class="product-list-pagination mb-4 position-relative float-right">
            <b-pagination
              v-model="currentPage"
              :total-rows="rows"
              :per-page="perPage"
              first-number
              last-number>
            </b-pagination>
          </div>
        </b-col>
      </b-row>
    </b-container>
    <!-- Start product categories modal -->
<div>
  <b-modal id="product-backend-tag" ref="product-categories-modal" title="BootstrapVue" :no-close-on-backdrop = "true" :no-close-on-esc = "true" hide-footer 
  :hide-header="true">
    <div class="w-100 d-inline-block p-2">
      <div class="cross-btn float-right">
         <a class="text_black text_16" href="javascript:void(0)" @click="productcategorieshideModal()">
           <i class="fa fa-times" aria-hidden="true"></i>
         </a>
      </div>
      <b-row class="mt-5">
            <b-col cols="12">
               <div class="product-tabs w-100 d-inline-block">
                  <b-row>
                     <b-col cols="12" col lg ="3">
                        <div class="nav flex-column nav-pills tab-left-side w-100 d-inline-block float-left p-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                           <a class="nav-link active text-white" 
                              id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true">
                           General
                           </a>
                        </div>
                     </b-col>
                     <b-col cols="12" col lg ="9">
                        <div class="tab-content tabs-description w-100 d-inline-block float-left" id="v-pills-tabContent">
                           <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                              <b-form>
                                 <b-form-group class="w-100 d-inline-block mt-4">
                                    <label class="w-15 float-left 
                                       text_black pt-2 w-xs-100">Name
                                    </label>
                                    <b-form-input 
                                       id="input-name" 
                                       type="text"
                                       v-model="tag.name" 
                                       class="w-85 d-inline-block 
                                       float-left w-xs-100 theme-color-border h_37"
                                       autofocus>
                                    </b-form-input>
                                 </b-form-group>
                              </b-form>
                              <div class="product-save-btn w-85 w-xs-100 float-right mt-3 pb-4">
                                 <a @click="saveTag()" href="javascript:void(0)" class="text-white knockdoc_btn_bg box_radius d-inline-block">
                                 Save
                                 </a>
                              </div>
                           </div>
                        </div>
                     </b-col>
                  </b-row>
               </div>
            </b-col>
         </b-row>
    </div>
  </b-modal>
</div>
<!-- End product categories modal -->
<!-- Edit Tag -->
<div>
  <b-modal id="editTag" ref="editTag" 
  :no-close-on-backdrop = "true" 
  :no-close-on-esc = "true" title="BootstrapVue" hide-footer 
  :hide-header="true">
    <div class="w-100 d-inline-block p-2">
      <div class="cross-btn float-right">
        <a href="javascript:void(0)" class="text_black text_16" 
        @click="hideedittagModal()">
          <i aria-hidden="true" class="fa fa-times"></i>
        </a>
      </div>
      <div class="product-tabs w-100 d-inline-block mt-4">
        <div>
  <b-card no-body>
    <b-tabs pills card vertical>
      <b-tab title="General" active>
        <b-card-text>
            <b-form>
              <b-form-group class="w-100 d-inline-block mt-4">
                <label class="w-20 float-left text-black pt-2 w-xs-100 text_black">Name
                </label>
                <b-form-input 
                 id="input-name"
                 v-model="editTag.name" 
                 type="text" 
                 class="w-80 d-inline-block 
                 float-left border-gold w-xs-100 theme-color-border h_37"
                 autofocus>
                </b-form-input>
              </b-form-group>
            </b-form>
            <div class="product-save-btn w-80 w-xs-100 float-right pb-4">
              <a href="javascript:void(0)" class="text-white knockdoc_btn_bg box_radius 
                d-inline-block" @click="updateTag(status_id)">
                Update
              </a>
            </div>
        </b-card-text>
      </b-tab>
    </b-tabs>
  </b-card>
</div>
      </div>
    </div>
  </b-modal>
</div>
<!-- End Edit Tag -->
<div>
  <b-modal id="bv-modal-delete" hide-footer :hide-header="true" 
  :no-close-on-backdrop = "true" 
  :no-close-on-esc = "true" title="BootstrapVue">
    <div class="w-100 d-inline-block p-2">
      <h6>Are you sure to Delete</h6>
    <div class="approve-btn w-100 d-inline-block text-center">
    <b-button class="mt-3 cancle-btn mr-3" @click="hideModalDelete()">Cancel</b-button>
    <b-button class="mt-3 bg-gold done-btn border-gold" @click="hideModalDelete(); deleteTag(status_id);">Delete</b-button>
  </div>
  </div>
  </b-modal>
</div>
  </div>
</template>
<script>

export default {
  name: "product-tagComponent",
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
           tag:{
             name:'',
           },
           editTag:{
            name:'',
           },
           allTags:[],
           options: [
             { value: null, text: 'Any status' },
             { value: 'a', text: 'Any status' },
             { value: 'b', text: 'Any status'},
           ],
           fields: [
         { key: 'id', label: 'ID'},
         { key: 'name', label: 'Tag Name'},
         { key: 'action', label: 'Action'  },
         
        ],
      }
    },
    computed: {
         sortOptions() {
           // Create an options list from our fields
           return this.fields
             .filter(f => f.sortable)
             .map(f => {
               return { text: f.label, value: f.key }
             })
         }
       },
       mounted(){
         this.getAllTags();
       },
methods: {
  deleteTag(id){
        this.$bvModal.show('bv-modal-loading');
        axios.delete('/admin/delete-tag/'+id)
          .then(response => {
            this.$toasted.show("Tag Deleted",{
                type:'success',
                duration: 2000
              });
            this.$bvModal.hide('bv-modal-loading');
            this.getAllTags();
          })
      },
  hideModalDelete() {
       this.$root.$emit('bv::hide::modal', 'bv-modal-delete')
      },
  getId(id){
          // alert(id);
          var data = {specs:this.allTags};
        var valObj = data.specs.filter((elem)=>{
            if(elem.id == id){
                this.editTag=elem;
            }
          });
        this.status_id = id;
        // this.showdropdown(id);
      },
  hideedittagModal() {
        this.$refs['editTag'].hide()
      },
   productcategorieshideModal() {
        this.$refs['product-categories-modal'].hide()
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
          getAllTags()
          {
             axios.get('/admin_get_all_tag')
             .then((response)=>{
              this.allTags=response.data;
              this.rows = this.allTags.length;
             })
          },
          saveTag()
          { 
            if(this.tag.name)
            {
                let formData = new FormData();
                formData.append('name',this.tag.name)
                axios.post('/save-product-tag',formData)
                .then((response)=>{
                  this.$toasted.show("Tag Saved",{
                    type:'success',
                    duration: 2000
                  });
                   this.tag={
                       name:'',
                   };
                  this.getAllTags();
                  this.$refs['product-categories-modal'].hide();

                });
            }
            else
            {
                  this.getAllTags();
                  this.$refs['tag-product'].hide();
                  this.$toasted.show("Please Enter Tag Name",{
                    type:'error',
                    duration: 2000
                  });
            }

          },
          updateTag(id)
          {
 
            if(this.editTag.name)
            {
                let formData = new FormData();
                formData.append('name',this.editTag.name)
                axios.post('/update-product-tag/'+id,formData)
                .then((response)=>{
                  this.$toasted.show("Tag Updated",{
                    type:'success',
                    duration: 2000
                  });
                   this.editTag={
                       name:'',
                   };
                  this.getAllTags();
                 this.$refs.editTag.hide();
                });
            }
            else
            {
                  this.getAllTags();
                 this.$refs.editTag.hide();
                  this.$toasted.show("Please Enter Tag Name",{
                    type:'error',
                    duration: 2000
                  });
            }
          },

}


};

</script>

<style>

</style>