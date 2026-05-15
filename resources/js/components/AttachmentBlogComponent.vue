<template>
    <div class="la-upload-holder">
        <vue-dropzone 
        :options="this.dropzoneOptions" 
        :id="this.id" 
        :useCustomSlot=true 
        :ref="this.img_ref" 
        v-on:vdropzone-error="failed" 
        v-on:vdropzone-thumbnail="validateDimentation"
        v-on:vdropzone-file-added="addedFile">
            <div class="form-group form-group-label">
                <div class="dc-labelgroup">
                    <label for="file">
                        <span class="dc-btn">{{ trans('lang.select_files') }}</span>
                    </label>
                    <span>{{ trans('lang.drop_files') }}</span>
                </div>
            </div>
        </vue-dropzone>
        <div class="dc-downloads-files" v-if="this.type == 'multiple_types'">
            <ul :class="this.id">
            </ul>
        </div>
        <div :class="this.id" class="la-upload-preview form-group form-group-label" v-else></div>
         <!-- <img id="watermark-profile" src="images/logo.png" alt="doctorfindy-watermark" style="display:none"> -->
    </div>

</template>

<script>
import Event from '../event.js'
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
export default {
    props: ['id', 'img_ref', 'url', 'name', 'maxFiles', 'type', 'image_width', 'image_height'],
    components: {
        vueDropzone: vue2Dropzone
    },
    data: function () {
        return {
        is_show:true,
        options: {
            error: {
                position: 'center',
                timeout: 4000,
            },
        },
        file_type: this.type,
        dropzoneOptions: {
                url: this.getUrl(),
                maxFilesize: 2, // MB
                maxFiles: this.getMaxFiles(),
                previewTemplate: this.getImageUploadTemplate(),
                previewsContainer: '.'+this.getPreviewerClass(),
                paramName:this.getName(),
                acceptedFiles: "image/*",
                headers: {
                    'x-csrf-token': document.querySelectorAll('meta[name=csrf-token]')[0].getAttributeNode('content').value,
                },
                init: function() {
                    var myDropzone = this;
                    this.on("removedfile", function(file) {
                        var input_hidden_id = jQuery('#'+myDropzone.element.id).parents('.dc-settingscontent').find('input[type=hidden]').attr('id');
                        document.getElementById(input_hidden_id).value = '';
                    });
                },
                accept: function(file, done) {
                    var myDropzone = this;
                    file.acceptDimensions = done;
                    var width = 'height';
                    var height = 'width';
                    Event.$on('invalid-dimentation', (data) => {
                            if (data.width) {
                                width = data.width;
                            }
                            if (data.height) {
                                height = data.height
                            }
                            
                        })
                    file.rejectDimensions = function() { 
                        done("image size must be " + width + '*' + height); 
                    };
                },
                transformFile: function (file, done) {
                       var myDropZone = this;
                          var editor = document.createElement('div');
                          editor.style.position = 'fixed';
                          editor.style.left = 0;
                          editor.style.right = 0;
                          editor.style.top = 0;
                          editor.style.bottom = 0;
                          editor.style.zIndex = 9999;
                          editor.style.backgroundColor = '#000000'; // Fix background color issue
                          document.body.appendChild(editor);

                          // var input = document.createElement('input');
                          // input.type = 'text';
                          // input.value = 'Place Your Text';
                          // input.style.position = 'absolute';
                          // input.style.left = '50%';
                          // input.style.top = '50%';
                          // input.style.transform = 'translate(-50%, -50%)';
                          // input.style.backgroundColor = '#ffffff';
                          // input.style.border = 'none';
                          // input.style.color = '#000000';
                          // input.style.fontSize = '12px';
                          // input.style.fontWeight = 'bold';
                          // input.style.textAlign = 'center';
                          // input.draggable = true; // Make the text draggable
                          // input.style.zIndex = 10000;
                          // var offsetX, offsetY; // Variables to track dragging offset

                          // editor.appendChild(input);

                          myDropZone.autoProcessQueue = false;

                          var buttonConfirm = document.createElement('button');
                          buttonConfirm.style.position = 'absolute';
                          buttonConfirm.style.left = '10px';
                          buttonConfirm.style.top = '10px';
                          buttonConfirm.style.zIndex = 9999;
                          buttonConfirm.textContent = 'Confirm';
                          editor.appendChild(buttonConfirm);

                          var canvas = document.createElement('canvas');
                          canvas.width = file.width;
                          canvas.height = file.height;
                          canvas.style.position = 'absolute';
                          canvas.style.left = '0';
                          canvas.style.top = '0';
                          editor.appendChild(canvas);

                          var ctx = canvas.getContext('2d');

                          var image = new Image();

                          image.onload = function () {
                            ctx.drawImage(image, 0, 0, image.width, image.height);
                          };

                          image.src = URL.createObjectURL(file);

                          // function updateInputPosition(e) {
                          //   input.style.left = e.clientX - offsetX + 'px';
                          //   input.style.top = e.clientY - offsetY + 'px';
                          // }

                          // function adjustInputSize() {
                          //   ctx.font = input.style.fontSize + ' ' + input.style.fontWeight + ' Arial';
                          //   var textWidth = ctx.measureText(input.value).width;
                          //   input.style.width = textWidth + 'px';
                          // }

                          // input.addEventListener('input', function () {
                          //   adjustInputSize();
                          // });

                          buttonConfirm.addEventListener('click', function () {
                            // // Set the background rectangle properties
                            // var paddingX = 10; // Horizontal padding around the text
                            // var paddingY = 10; // Vertical padding around the text
                            // var textWidth = ctx.measureText(input.value).width; // Width of the text
                            // var rectWidth = textWidth + 2 * paddingX; // Width of the rectangle (text width + padding)
                            // var rectHeight = 30; // Height of the rectangle
                            // var rectX = paddingX; // X position of the rectangle (10px left margin)
                            // var rectY = canvas.height - rectHeight - paddingY; // Y position of the rectangle (10px bottom margin)

                            // // Draw the background rectangle
                            // ctx.fillStyle = '#474747'; // Set the background color of the rectangle
                            // ctx.fillRect(rectX, rectY, rectWidth, rectHeight);

                            // Set the watermark text properties
                            ctx.fillStyle = '#ffffff'; // Set the text color to white
                            ctx.textAlign = 'left'; // Adjusted to left-align the text
                            ctx.textBaseline = 'middle';

                            // Adjust font size to fit the text within the rectangle
                        //     var fontSize = 24; 
                        // var maxTextWidth = rectWidth - 2 * paddingX;
                        // while (ctx.measureText(input.value).width > maxTextWidth) {
                        //   fontSize -= 1;
                        //   ctx.font = 'bold ' + fontSize + 'px Arial';
                        // }

                        // // Calculate the center of the rectangle for vertical alignment of the text
                        // var textY = rectY + rectHeight / 2;

                        // // Draw the watermark text on the canvas
                        // ctx.fillText(input.value, rectX + paddingX, textY);

                        // Convert the canvas to an image
                        var watermarkedImage = new Image();
                        watermarkedImage.src = canvas.toDataURL('image/png');

                        // Remove the editor from the view
                        document.body.removeChild(editor);

                        // Convert the watermarked image to a Blob (file object without a name)
                        fetch(watermarkedImage.src)
                          .then((res) => res.blob())
                          .then((blob) => {
                            // Create a new Dropzone file thumbnail
                            myDropZone.createThumbnail(
                              blob,
                              myDropZone.options.thumbnailWidth,
                              myDropZone.options.thumbnailHeight,
                              myDropZone.options.thumbnailMethod,
                              false,
                              function (dataURL) {
                                // Update the Dropzone file thumbnail
                                myDropZone.emit('thumbnail', file, dataURL);
                                // Return the file to Dropzone
                                done(blob);
                              }
                            );
                          });
                      });

                      editor.appendChild(buttonConfirm);
                    },
                // transformFile: function (file, done) {
                //   var myDropZone = this;
                //   var editor = document.createElement('div');
                //   editor.style.position = 'fixed';
                //   editor.style.left = 0;
                //   editor.style.right = 0;
                //   editor.style.top = 0;
                //   editor.style.bottom = 0;
                //   editor.style.zIndex = 9999;
                //   editor.style.backgroundColor = '#000000'; // Fix background color issue
                //   document.body.appendChild(editor);

                //   var input = document.createElement('input');
                //   input.type = 'text';
                //   input.value = 'Place Your Text';
                //   input.style.position = 'absolute';
                //   input.style.left = '50%';
                //   input.style.top = '50%';
                //   input.style.transform = 'translate(-50%, -50%)';
                //   input.style.backgroundColor = '#ffffff';
                //   input.style.border = 'none';
                //   input.style.color = '#000000';
                //   input.style.fontSize = '16px';
                //   input.style.fontWeight = 'bold';
                //   input.style.textAlign = 'center';
                //   input.draggable = true; // Make the text draggable
                //   input.style.zIndex = 10000;
                //   var offsetX, offsetY; // Variables to track dragging offset

                //   editor.appendChild(input);

                //   myDropZone.autoProcessQueue = false;

                //   var buttonConfirm = document.createElement('button');
                //   buttonConfirm.style.position = 'absolute';
                //   buttonConfirm.style.left = '10px';
                //   buttonConfirm.style.top = '10px';
                //   buttonConfirm.style.zIndex = 9999;
                //   buttonConfirm.textContent = 'Confirm';
                //   editor.appendChild(buttonConfirm);

                //   var canvas = document.createElement('canvas');
                //   canvas.width = file.width;
                //   canvas.height = file.height;
                //   canvas.style.position = 'absolute';
                //   canvas.style.left = '0';
                //   canvas.style.top = '0';
                //   editor.appendChild(canvas);

                //   var ctx = canvas.getContext('2d');

                //   var image = new Image();

                //   image.onload = function () {
                //     ctx.drawImage(image, 0, 0, image.width, image.height);
                //   };

                //   image.src = URL.createObjectURL(file);

                //   function updateInputPosition(e) {
                //         input.style.left = e.clientX - offsetX + 'px';
                //         input.style.top = e.clientY - offsetY + 'px';
                //       }

                //       var offsetX, offsetY; // Variables to track dragging offset

                //       input.addEventListener('mousedown', function (e) {
                //         e.stopPropagation();
                //         offsetX = e.clientX - input.offsetLeft;
                //         offsetY = e.clientY - input.offsetTop;
                //         document.addEventListener('mousemove', updateInputPosition);
                //       });

                //       document.addEventListener('mouseup', function (e) {
                //         document.removeEventListener('mousemove', updateInputPosition);
                //       });

                //   buttonConfirm.addEventListener('click', function () {
                //   // Calculate the updated position of the text based on the input field's position after dragging
                //   var textX = parseInt(input.style.left, 10) + input.offsetWidth / 2;
                //   var textY = parseInt(input.style.top, 10) + input.offsetHeight / 2;

                //    // Set the background rectangle properties
                //       var paddingX = 20; // Horizontal padding around the text
                //       var paddingY = 10; // Vertical padding around the text
                //       var textWidth = ctx.measureText(input.value).width; // Width of the text
                //       var rectWidth = textWidth + 2 * paddingX; // Width of the rectangle (text width + padding)
                //       var rectHeight = 30; // Height of the rectangle
                //       var rectX = textX - rectWidth / 2; // X position of the rectangle (centered horizontally)
                //       var rectY = textY - rectHeight / 2; // Y position of the rectangle (centered vertically)

                //       // Adjust rectangle width if it is smaller than the text
                //       if (rectWidth < textWidth) {
                //         rectWidth = textWidth + 2 * paddingX;
                //         rectX = textX - rectWidth / 2;
                //       }

                //       // Draw the background rectangle
                //       ctx.fillStyle = '#474747'; // Set the background color of the rectangle
                //       ctx.fillRect(rectX, rectY, rectWidth, rectHeight);

                //       // Set the watermark text properties
                //       ctx.font = 'bold 24px Arial';
                //       ctx.fillStyle = '#ffffff'; // Set the text color to white
                //       ctx.textAlign = 'center';
                //       ctx.textBaseline = 'middle';

                //       // Draw the watermark text on the canvas
                //       ctx.fillText(input.value, textX, textY);

                //   // Convert the canvas to an image
                //   var watermarkedImage = new Image();
                //   watermarkedImage.src = canvas.toDataURL('image/png');

                //   // Remove the editor from the view
                //   document.body.removeChild(editor);

                //   // Convert the watermarked image to a Blob (file object without a name)
                //   fetch(watermarkedImage.src)
                //     .then(res => res.blob())
                //     .then(blob => {
                //       // Create a new Dropzone file thumbnail
                //       myDropZone.createThumbnail(
                //         blob,
                //         myDropZone.options.thumbnailWidth,
                //         myDropZone.options.thumbnailHeight,
                //         myDropZone.options.thumbnailMethod,
                //         false,
                //         function (dataURL) {
                //           // Update the Dropzone file thumbnail
                //           myDropZone.emit('thumbnail', file, dataURL);
                //           // Return the file to Dropzone
                //           done(blob);
                //         }
                //       );
                //     });
                // });

                //   editor.appendChild(buttonConfirm);
                // },

            },
        }
    },
    methods:{
        getImageUploadTemplate() { 
            var template ='';
            if(this.type && this.type =='multiple_types') {
                template = `
                    <li>
                        <div class="dc-files-content">
                            <img src="${APP_URL}/images/file-icon.png" alt="${window.lang.trans.img_desc}">
                            <div class="dc-filecontent dz-filename">
                                <span data-dz-name></span><em><div class="dz-size" data-dz-size></div></em>
                                <a class="lnr lnr-cross" href="javascript:;" data-dz-remove=""></a>
                            </div>
                        </div>
                    </li>
                `
            } else {
                // template = `
                //     <ul class="dc-uploadingbox dc-attachfile dc-attachfilevtwo">
                //         <li class="dz-preview dz-file-preview dc-uploadingholder dc-companyimg-uploading">
                //             <div class="dc-uploadingbox">
                //                 <figure><img data-dz-thumbnail /></figure>
                //             </div>
                //             <div class="dc-uploadingbar">
                //             <div class="dz-filename"><span data-dz-name></span></div>
                //             <em><div class="dz-size" data-dz-size></div><a class="lnr lnr-cross" href="javascript:;" data-dz-remove=""></a>
                //             <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                //             <div class="dz-success-mark"><i class="fa fa-check"></i></div>
                //             </em>
                //             </div>
                //         </li>
                //     </ul>
                // `
                template = `
                    <div class="dc-uploadingbox ">
                        <figure><img data-dz-thumbnail/></figure> 
                        <div class="dc-uploadingbar"><div class="dz-filename" data-dz-name></div> 
                        <span data-dz-size></span> 
                        <a class="lnr lnr-cross" href="javascript:;" data-dz-remove=""></a></div> 
                    </div>
                `
            }
        return template;
        },
        showError(message){
            return this.$toast.error(' ', message, this.options.error);
        },
        getUrl() {
            return this.url;
        },
        getName() {
            return this.name;
        },
        getPreviewerClass() {
            return this.id;
        },
        getAcceptedFiles(){
            // console.log(this.type);
            // if(this.type && this.type =='image') {
            //     return 'image/*';
            // } else {
            //     return '';
            // }
        },
        getMaxFiles() {
            if(this.maxFiles) {
                return this.maxFiles;
            } else {
                return 1;
            }
        },
        failed:function(file,message,xhr){
            if (file.type != this.$refs[this.img_ref].options.acceptedFiles) {
                if (message == 'You can not upload any more files.') {
                    message = 'you need to remove file before uploading new one.'
                }
                this.showError(message);
                this.$refs[this.img_ref].removeFile(file);
                var input_hidden_id = jQuery('#'+this.$refs[this.img_ref].id).parents('.dc-settingscontent').find('.dc-userform input[type=hidden]').attr('id');
                if (input_hidden_id) {
                    document.getElementById(input_hidden_id).value = '';
                }
            }
        },
        addedFile:function(file){
            if(this.type && this.type =='multiple_types' && this.maxFiles > 1) {
                var count = 0;
                var li_count = jQuery('#'+this.$refs[this.img_ref].id).parents('.dc-settingscontent').find('.downloads li').length;
                count = li_count -1;
                var hidden_count = jQuery('#'+this.$refs[this.img_ref].id).parents('.dc-settingscontent').find('.downloads li input:hidden').length;
                // jQuery('#'+this.$refs[this.img_ref].id).parents('.dc-settingscontent').find('.downloads li:last-child').append('<input type="hidden" value="'+file.name+'" id="hidden-'+count+'" class="hidden-file" name="attachments['+[count]+']">');
                count++
            } else {
                var input_hidden_id = jQuery('#'+this.$refs[this.img_ref].id).parents('.dc-settingscontent').find('input[type=hidden]').attr('id');
                document.getElementById(input_hidden_id).value = file.name;
            }
            
        },
        validateDimentation:function(file) {
            if ((file.width > this.image_width || file.height > this.image_height)) {
                Event.$emit('invalid-dimentation', { width:this.image_width, height:this.image_height });
                file.rejectDimensions()
            }
            else {
                file.acceptDimensions();
            }
        },   
    },
    mounted: function () {

    },
}
</script>
