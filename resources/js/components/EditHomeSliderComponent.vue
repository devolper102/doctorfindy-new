<template>
    <div class="slide-inner-list-item dc-settingscontent">
        <div :id="this.main_accordion_id" class="slide-inner-list-item dc-accordioninnertitle" data-toggle="collapse" :data-target="'#'+this.inner_accordion_id">
            <span>{{ this.stored_slide_title_one }}</span>
            <div class="dc-rightarea">
            <div class="dc-btnaction">
                <a href="javascript:void(0);" @click="editElement()" class="dc-editbtn" :id="this.main_accordion_id" data-toggle="collapse" aria-expanded="true">
                    <i class="lnr lnr-pencil"></i>
                </a>
                <a href="javascript:void(0);" @click="removeElement()"  class="dc-delbtn"><i class="lnr lnr-trash"></i></a></div>
            </div>
        </div>
        <div class="dc-collapseexp collapse hide" :id="this.inner_accordion_id" :aria-labelledby="this.inner_accordion_id" data-parent="#accordion">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group form-group-half">
                        <input type="text" :value="this.stored_slide_title_one" v-bind:name="this.slide_title_one" class="form-control" :placeholder="ph_edit_slide_title_one">
                    </div>
                    <div class="form-group form-group-half">
                        <input type="text" :value="this.stored_slide_title_two" v-bind:name="this.slide_title_two" class="form-control" :placeholder="ph_edit_slide_title_two">
                    </div>
                    <div class="form-group form-group-half">
                        <input type="text" :value="this.stored_slide_title_url" v-bind:name="this.slide_title_url" class="form-control" :placeholder="ph_edit_slide_title_two">
                    </div>
                  
                </fieldset>
            </div>
        </div>
    </div>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone'
export default {
    props: [
        'slide_title_one', 'slide_title_two','slide_title_url', 'main_accordion_id', 'inner_accordion_id', 'stored_slide_title_one', 
        'stored_slide_title_two', 'ph_edit_slide_title_one',
        'ph_edit_slide_title_two','stored_slide_title_url'
        ],
    components: {
        vueDropzone: vue2Dropzone
    },
    data: function () {
        return {
            options: {
            error: {
                position: 'center',
                    timeout: 3000,
                },
            },
            stored_slides:[],
        }
    },
    methods: {
        showError(message){
            return this.$toast.error(' ', message, this.options.error);
        },
        removeElement() {
            this.$emit('removeElement');
        },
        editElement() {
            this.$emit('editElement');
        },
    },
    mounted: function () {
       
    },
    created: function() {}
}
</script>
