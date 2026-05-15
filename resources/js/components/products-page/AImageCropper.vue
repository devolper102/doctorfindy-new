<template>
  <div>
    <div class="dummy">
    <slot name="upload" :beforeUpload="beforeUpload" />
    <a-modal
      :visible="modalVisible"
      :title="modalTitle"
      :width="modalWidth"
      @cancel="closeModal"
      :maskClosable="false"
    >
      <div
        class="cropperContainer"
        :style="{
          width: `${containerWidth}px`,
          height: `${containerHeight}px`,
        }"
      >
        <vue-cropper
          ref="cropper"
          :img="imageUrl"
          v-bind="$props"
          v-on="$listeners"
        />
      </div>
      <a-button-group class="cropperControls">
        <a-button @click="$refs.cropper.rotateLeft()">
          <a-icon type="undo" />
        </a-button>
        <a-button @click="$refs.cropper.rotateRight()">
          <a-icon type="redo" />
        </a-button>
      </a-button-group>
      <template slot="footer">
        <a-button
          type="primary"
          :loading="false"
          @click="
            () => {
              cropImage();
              closeModal();
            }
          "
        >
          {{ modalControl }}
        </a-button>
      </template>
    </a-modal>
  </div>
  </div>
</template>

<script>
// https://github.com/xyxiao001/vue-cropper/blob/master/english.md
import { VueCropper } from "vue-cropper";

function getBase64(img, callback) {
  const reader = new FileReader();
  reader.addEventListener("load", () => callback(reader.result));
  reader.readAsDataURL(img);
}

export default {
  name: "AImageCropper",
  components: {
    VueCropper,
  },
  extends: VueCropper,
  props: {
    modalTitle: {
      type: String,
      default: "Image editing",
    },
    modalControl: {
      type: String,
      default: "CROP",
    },
    modalWidth: {
      type: Number,
      default: 610,
    },
    containerWidth: {
      type: Number,
      default: 520,
    },
    containerHeight: {
      type: Number,
      default: 370,
    },
  },
  data() {
    return {
      croppedImageSrc: "",
      modalVisible: false,
      imageUrl: null,
      scale: null,
    };
  },
  methods: {
    beforeUpload(image) {
      getBase64(image, (imageUrl) => {
        this.imageUrl = imageUrl;
        this.modalVisible = true;
      });
      return false;
    },
    cropImage() {
      // this.croppedImageSrc = this.$refs.cropper.getCroppedCanvas().toDataURL();
      this.$refs.cropper.getCropBlob((image) => {
        this.$emit("crop", image);
        // console.log("crop",image);
      });
    },
    closeModal() {
      this.modalVisible = false;
    },
  },
};
</script>

<style>
.cropperContainer {
  margin: auto;
  background-color: #d9d9d9;
}

.cropperControls {
  margin-top: 24px;
  display: flex;
  justify-content: center;
}
.ant-modal-close-icon{
  margin-top: 20px !important;
}
.ant-modal{
 margin: -70px auto !important; 
}
.ant-modal-content .ant-modal-close-x .ant-modal-close-icon{
  border: 1px solid #212529;
  padding: 3px;
  border-radius: 50px;
  color: #212529;
}
.ant-modal-content .ant-modal-close-x .ant-modal-close-icon:hover{
  border: 1px solid #b59e5c;
  color: #b59e5c;
}
</style>
