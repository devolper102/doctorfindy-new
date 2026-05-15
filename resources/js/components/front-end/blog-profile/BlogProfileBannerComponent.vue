<template>
    <div>
        <div class="container">
            <div class="row mt-4">
                <div class="col-xl-2 col-4">
                    <div class="w-100 d-inline-block blog-profile-image">
                        <img src="/images/blog-profile-image.svg">
                    </div>
                </div>
                <div class="col-xl-10 col-8">
                    <div class="w-100 d-inline-block blog-profile-image-content">
                        <h1 class="text_black text_18 font-weight-bold">Sadaf Noreen</h1>
                        <p class="text_black text_13">
                            Sadaf Noreen is one of the top notch Urdu writers from Lahore, working in Health industry for over a year. Her work has been featured in national publications such as Doctorfindy.com. Before becoming a full time writer, Sadaf has worked as a professional teacher and has an extensive
                        </p>
                    </div>
                    <div class="w-100 d-xl-inline-block d-none">
                        <div class="w-100 d-inline-block mt-3">
                            <p class="text_black text_15">
                                Share
                            </p>
                        </div>
                    <ul class="w-100 d-inline-block blog-profile-icon mb-0 mt-2"> 
                        <li class="float-left mr-2">
                            <a class="d-inline-block text-center" href="javascript:void(0)">
                                <img src="/images/linkdin-image.svg" 
                                style="height:20px;">
                            </a>
                        </li>
                        <li class="float-left mr-2">
                            <a class="d-inline-block text-center" href="javascript:void(0)">
                                <img src="/images/gmail-image.svg" 
                                style="height:25px;">
                            </a>
                        </li>
                        <li class="float-left mr-2">
                            <a class="d-inline-block text-center" href="javascript:void(0)">
                                <img src="/images/facebook-image.svg" 
                                style="height:25px;">
                            </a>
                        </li>
                        <li class="float-left mr-2">
                            <a class="d-inline-block text-center" href="javascript:void(0)">
                                <img src="/images/whatsapp-icon-image.svg" 
                                style="height:25px;">
                            </a>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
            <div class="row d-xl-none d-block">
                <div class="col-12">
                    <div class="w-100 d-inline-block mt-3">
                            <p class="text_black text_15">
                                Share
                            </p>
                    </div>
                    <ul class="w-100 d-inline-block blog-profile-icon mb-0 mt-2"> 
                        <li class="float-left mr-2">
                            <a class="d-inline-block text-center" href="javascript:void(0)">
                                <img src="/images/linkdin-image.svg" 
                                style="height:20px;">
                            </a>
                        </li>
                        <li class="float-left mr-2">
                            <a class="d-inline-block text-center" href="javascript:void(0)">
                                <img src="/images/gmail-image.svg" 
                                style="height:25px;">
                            </a>
                        </li>
                        <li class="float-left mr-2">
                            <a class="d-inline-block text-center" href="javascript:void(0)">
                                <img src="/images/facebook-image.svg" 
                                style="height:25px;">
                            </a>
                        </li>
                        <li class="float-left mr-2">
                            <a class="d-inline-block text-center" href="javascript:void(0)">
                                <img src="/images/whatsapp-icon-image.svg" 
                                style="height:25px;">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
  name: "BlogProfileBannerComponent",
  
data(){
    return{
      
    }
  },
  methods: {


  },

};

</script>

<style>
.blog-profile-icon li a{
    width: 40px;
    height: 40px;
    background: #E5EAEE;
    padding-top: 9px;
    border-radius: 50%;
}
.blog-profile-image img{
    border-bottom-right-radius: 35px;
}


</style>