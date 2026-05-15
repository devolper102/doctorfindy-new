<template>
  <div>
    <div class="procedure-bg-image w-100 d-inline-block">
      <div class="procedure-bg-image-2">
         <div class="container">
      <div class="row">
        <div class="col-12">
           <div class="procedure-faq-description w-100 d-inline-block">
               <!-- <h2 class="text_black text_20 font-weight-bold">Symptoms</h2> -->
               <div class="text_black text_14" v-html="procedure.description">
               </div>
           </div>
        </div>
      </div>
    </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="procedure-faq w-100 d-inline-block">
           <!--  <p class="text_black text_14" v-html="procedure.faq_procedure">
               </p> -->
               <!-- <div class="accordion" id="FaqS">
                  <div class="card border-0 bg-white box_radius box-shadow mt-2">
                      <div class="card-header pl-3 pt-2 bg-white border-0 faq_accordian">
                        <h6 class="mb-0">
                          <a href="javascript:void(0)" class="text_black p-0 text-left w-100 collapsed" data-toggle="collapse"data-target="#collapsebypass" aria-expanded="true" aria-controls="first_faq">
                            <span class="w-100 d-inline-block service-text text_13 font-weight-bold"> What happent to the veins from the leg user for bypass surgery
                            </span>
                          </a>
                        </h6>
                      </div>
                      <div class="collapse" id="collapsebypass">
                        <div class="card-body p-0 mt-xl-2 mt-1 mb-xl-0 mb-1 faq_details p-3">
                          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                        </div>
                      </div>
                    </div>
                  </div> -->
                   <div class="p-0 heading-doctor-city-pakistan">
                <div href="javascript:void(0)" class="pt-2 pb-0 d-inline-block w-100 main-faq text_15">
                  <h2 class="w-90 d-inline-block text_18 text-xs-16 text-blue font-weight-bold">Frequently Asked Questions
                  </h2>
                </div>
                <!-- <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div> -->
              </div>
               <div class="w-100 d-inline-block accordion">
          <div class="accordion" id="FaqS">
              <div v-for="(faqItem, index) in $faq" :key="index">
                <div class="card border-0 bg-white box_radius box-shadow mt-2">
                  <div class="card-header border-0 faq_accordian bg-white" :id="'faq_' + index">
                    <h6 class="mb-0">
                      <a href="#" class="text_black p-0 text-left w-100 collapsed pt-2 pb-2" data-toggle="collapse" :data-target="'#faq_collapse_' + index" aria-expanded="true" aria-controls="faq_collapse">
                        <span class="w-100 d-inline-block service-text font-weight-bold text_15">{{ faqItem.question }}
                        </span>
                      </a>
                    </h6>
                  </div>
                  <div :id="'faq_collapse_' + index" class="collapse">
                    <div class="card-body p-0 faq_details p-3">
                      <span class="text_14">
                        {{ faqItem.answer }}
                      </span>
                  </div>
                  </div>
                </div>
              </div>
            </div>

            <!--   <div class="accordion" id="FaqS">
                  <div class="card border-0 bg-white box_radius box-shadow mt-2">
                      <div class="card-header pl-3 pt-2 bg-white border-0 faq_accordian">
                        <h6 class="mb-0">
                          <a href="javascript:void(0)" class="text_black p-0 text-left w-100 collapsed" data-toggle="collapse"data-target="#collapsebypass" aria-expanded="true" aria-controls="first_faq">
                            <span class="w-100 d-inline-block service-text text_13 font-weight-bold"> What happent to the veins from the leg user for bypass surgery
                            </span>
                          </a>
                        </h6>
                      </div>
                      <div class="collapse" id="collapsebypass">
                        <div class="card-body faq_details p-3">
                          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                        </div>
                      </div>
                    </div>
                    <div class="card border-0 bg-white box_radius box-shadow mt-2">
                      <div class="card-header pl-3 pt-2 bg-white border-0 faq_accordian">
                        <h6 class="mb-0">
                          <a href="javascript:void(0)" class="text_black p-0 text-left w-100 collapsed" data-toggle="collapse"data-target="#collapsebypass-2" aria-expanded="true" aria-controls="first_faq">
                            <span class="w-100 d-inline-block service-text text_13 font-weight-bold"> What bypass surgery survival rate of age?
                            </span>
                          </a>
                        </h6>
                      </div>
                      <div class="collapse" id="collapsebypass-2">
                        <div class="card-body p-0 faq_details p-3">
                          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                        </div>
                      </div>
                    </div>
                    <div class="card border-0 bg-white box_radius box-shadow mt-2">
                      <div class="card-header pl-3 pt-2 bg-white border-0 faq_accordian">
                        <h6 class="mb-0">
                          <a href="javascript:void(0)" class="text_black p-0 text-left w-100 collapsed" data-toggle="collapse"data-target="#collapsebypass-3" aria-expanded="true" aria-controls="first_faq">
                            <span class="w-100 d-inline-block service-text text_13 font-weight-bold"> What's the average cost of bypass surgery
                            </span>
                          </a>
                        </h6>
                      </div>
                      <div class="collapse" id="collapsebypass-3">
                        <div class="card-body p-0 faq_details p-3">
                          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                        </div>
                      </div>
                    </div>
                    <div class="card border-0 bg-white box_radius box-shadow mt-2">
                      <div class="card-header pl-3 pt-2 bg-white border-0 faq_accordian">
                        <h6 class="mb-0">
                          <a href="javascript:void(0)" class="text_black p-0 text-left w-100 collapsed" data-toggle="collapse"data-target="#collapsebypass-4" aria-expanded="true" aria-controls="first_faq">
                            <span class="w-100 d-inline-block service-text text_13 font-weight-bold"> Is there an age limit of bypass surgery
                            </span>
                          </a>
                        </h6>
                      </div>
                      <div class="collapse" id="collapsebypass-4">
                        <div class="card-body p-0 faq_details p-3">
                          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                        </div>
                      </div>
                    </div>
                    <div class="card border-0 bg-white box_radius box-shadow mt-2">
                      <div class="card-header pl-3 pt-2 bg-white border-0 faq_accordian">
                        <h6 class="mb-0">
                          <a href="javascript:void(0)" class="text_black p-0 text-left w-100 collapsed" data-toggle="collapse"data-target="#collapsebypass-5" aria-expanded="true" aria-controls="first_faq">
                            <span class="w-100 d-inline-block service-text text_13 font-weight-bold"> Which is batter a stent of bypass surgery
                            </span>
                          </a>
                        </h6>
                      </div>
                      <div class="collapse" id="collapsebypass-5">
                        <div class="card-body p-0 faq_details p-3">
                          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                        </div>
                      </div>
                    </div>
                  </div> -->
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>

<script>

export default {
  name: "ProceduresDetailFaqComponent",
  // props: ['procedure'],
  props: {
  procedure: Object, 
  faqPairs: Array, 
},
data() {
    return {
      $faq: [], 
    };
  },
  mounted(){
     // console.log('checcc',this.procedure);
    // console.log("Procedure prop:", this.procedure);
    // console.log("FAQ Pairs prop:", this.faqPairs);
  },
  created() {
  // Fetch and assign FAQ data to $faq
  this.$faq =this.faqPairs; 
},
  
}
</script>

<style>

</style>