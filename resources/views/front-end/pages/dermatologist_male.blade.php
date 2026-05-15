@extends('front-end.master') @section('description', '') @section('keywords', '') @section('content')


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />



<style>
    body{padding: 0px !important;}
                    .autocomplete-items{position:absolute;border:1px solid #d4d4d4;z-index:99;top:100%;left:0;right:0;margin-top:7px;max-height:361px;overflow:auto;background:#fff}.autocomplete-items-holder{border:0;z-index:9;-webkit-overflow-scrolling:touch;margin-top:-10px}.autocomplete-items .city-locality,.autocomplete-items .default-filter,.autocomplete-items .item-holder,.autocomplete-items-holder .default-filter{padding:10px;cursor:pointer;background-color:#fff;border-bottom:1px solid #d4d4d4;color:#000;position:relative;display:flex;align-items:center;white-space:normal;word-break:break-word;min-height:51px}.autocomplete-items .item-holder{padding-right:75px}.autocomplete-items .item-holder.title-holder{padding-right:10px}.autocomplete-items-holder>div span,.autocomplete-items>div span{color:rgba(0,0,0,.5)}.autocomplete-items .city-locality,.autocomplete-items .default-filter{padding:10px 10px 10px 47px}.autocomplete-items-holder .city-locality,.autocomplete-items-holder .default-filter{padding:13px 13px 13px 47px}.autocomplete-items-holder>div .image-holder,.autocomplete-items>div .image-holder{height:30px;width:30px;min-width:30px;display:flex;border-radius:100%;overflow:hidden;vertical-align:middle;margin-right:8px;align-items:center;justify-content:center;background-color:#f3f2f7}.autocomplete-items-holder>div .image-holder img,.autocomplete-items>div .image-holder img{display:block;width:100%}.autocomplete-items .city-locality:after,.autocomplete-items .default-filter:after,.autocomplete-items-holder .city-locality:after,.autocomplete-items-holder .default-filter:after{height:30px;width:30px;content:"";position:absolute;background:url(/dist/images/search-icon.svg) no-repeat;background-size:15px;background-position:center;border-radius:100%;left:9px;top:0;bottom:0;margin:auto 0;background-color:#f3f2f7}.autocomplete-items-holder>div:hover,.autocomplete-items>div:hover{background-color:#e9e9e9}.autocomplete-items .autocomplete-active{background-color:#006!important;color:#fff}.autocomplete-items .autocomplete-active span{color:#fff}.doctor-designation{right:10px;top:50%;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);-o-transform:translateY(-50%);transform:translateY(-50%)}.no-result-item{padding:20px 10px;background:#fff;height:361px;display:flex;align-items:center;text-align:center;justify-content:center}.lds-ring.lds-border-primary div{border:3px solid #006;border-color:#006 transparent transparent transparent}#navigation_loader{position:absolute;right:5px;top:0;z-index:9}#navigation_loader div{border:3px solid #fff;border-color:#fff transparent transparent transparent}@media screen and (max-width:767px){.modal .modal-dialog{margin:0;max-width:100%}.search-modal .modal-content{min-height:100vh;border:0;border-radius:0;background-color:#f8f9fa}.search-modal .modal-body{padding:0}.autocomplete-items{position:static;max-height:100%;border:0;height:100%}.autocomplete-items-holder{height:78.4vh}.no-result-item{height:100%}}#gps_icon{cursor:pointer!important}#modal-locality-filter{cursor:pointer!important;z-index:9;}
                </style>

                <script type="application/ld+json">{
        "@context": "http://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement":[
        {
            "@type": "ListItem",
            "position": 1,
            "item":
            {
             "@id": "https://oladoc.com/",
             "name": "Home"
            }
       },{
        "@type": "ListItem",
        "position": "2",
            "item":
            {
                "@id": "#pakistan",
                "name": "Pakistan"
            }
        },{
            "@type": "ListItem",
            "position": "3",
                "item":
                {
                    "@id": "#pakistan/lahore",
                    "name": "Lahore"
                }
            },{
                    "@type": "ListItem",
                    "position": "4",
                        "item":
                        {
                            "@id": "#pakistan/lahore/bahria-town/dermatologist",
                            "name": "Dermatologists in Bahria Town, Lahore"
                        }
                    }]}</script> <style>:root{--blue:#006;--indigo:#6610f2;--purple:#6f42c1;--pink:#e83e8c;--red:#dc3545;--orange:#fd7e14;--yellow:#ff9e15;--green:#81bf5d;--teal:#20c997;--cyan:#15359a;--white:#fff;--gray:#6c757d;--gray-dark:#222;--primary:#006;--secondary:#6c757d;--success:#81bf5d;--info:#15359a;--warning:#ff9e15;--danger:#dc3545;--light:#f8f9fa;--dark:#222;--lightgray:#f5f5f5;--mediumgray:#f3f2f7;--midgray:#a5a5a5;--breakpoint-xs:0;--breakpoint-sm:576px;--breakpoint-md:768px;--breakpoint-lg:992px;--breakpoint-xl:1200px;--font-family-sans-serif:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--font-family-monospace:SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace}h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6{margin-bottom:.5rem;font-family:inherit;font-weight:500;line-height:1.2;color:inherit}h1,.h1{font-size:2.5rem}h2,.h2{font-size:2rem}h3,.h3{font-size:1.75rem}h4,.h4{font-size:1.5rem}h5,.h5{font-size:1.15rem}h6,.h6{font-size:1rem}.lead{font-size:1.25rem;font-weight:300}.display-1{font-size:6rem;font-weight:300;line-height:1.2}.display-2{font-size:5.5rem;font-weight:300;line-height:1.2}.display-3{font-size:4.5rem;font-weight:300;line-height:1.2}.display-4{font-size:3.5rem;font-weight:300;line-height:1.2}hr{margin-top:1rem;margin-bottom:1rem;border:0;border-top:1px solid rgba(0,0,0,.1)}small,.small{font-size:80%;font-weight:400}mark,.mark{padding:.2em;background-color:#fcf8e3}.list-unstyled{padding-left:0;list-style:none}.list-inline{padding-left:0;list-style:none}.list-inline-item{display:inline-block}.list-inline-item:not(:last-child){margin-right:.5rem}.initialism{font-size:90%;text-transform:uppercase}.blockquote{margin-bottom:1rem;font-size:1.25rem}.blockquote-footer{display:block;font-size:80%;color:#6c757d}.blockquote-footer::before{content:"\2014 \00A0"}.img-fluid{max-width:100%;height:auto}.img-thumbnail{padding:.25rem;background-color:#fff;border:1px solid #dee2e6;border-radius:3px;max-width:100%;height:auto}.figure{display:inline-block}.figure-img{margin-bottom:.5rem;line-height:1}.figure-caption{font-size:90%;color:#6c757d}code{font-size:87.5%;color:#e83e8c;word-break:break-word}a>code{color:inherit}kbd{padding:.2rem .4rem;font-size:87.5%;color:#fff;background-color:#212529;border-radius:2px}kbd kbd{padding:0;font-size:100%;font-weight:700}pre{display:block;font-size:87.5%;color:#212529}pre code{font-size:inherit;color:inherit;word-break:normal}.pre-scrollable{max-height:340px;overflow-y:scroll}.dropup,.dropright,.dropdown,.dropleft{position:relative}.dropdown-toggle::after{display:inline-block;width:0;height:0;margin-left:.255em;vertical-align:.255em;content:"";border-top:.3em solid;border-right:.3em solid transparent;border-bottom:0;border-left:.3em solid transparent}.dropdown-toggle:empty::after{margin-left:0}.dropdown-menu{position:absolute;top:100%;left:0;z-index:1000;display:none;float:left;min-width:10rem;padding:.5rem 0;margin:.125rem 0 0;font-size:1rem;color:#212529;text-align:left;list-style:none;background-color:#fff;background-clip:padding-box;border:1px solid rgba(0,0,0,.15);border-radius:3px}.dropdown-menu-right{right:0;left:auto}.dropup .dropdown-menu{top:auto;bottom:100%;margin-top:0;margin-bottom:.125rem}.dropup .dropdown-toggle::after{display:inline-block;width:0;height:0;margin-left:.255em;vertical-align:.255em;content:"";border-top:0;border-right:.3em solid transparent;border-bottom:.3em solid;border-left:.3em solid transparent}.dropup .dropdown-toggle:empty::after{margin-left:0}.dropright .dropdown-menu{top:0;right:auto;left:100%;margin-top:0;margin-left:.125rem}.dropright .dropdown-toggle::after{display:inline-block;width:0;height:0;margin-left:.255em;vertical-align:.255em;content:"";border-top:.3em solid transparent;border-right:0;border-bottom:.3em solid transparent;border-left:.3em solid}.dropright .dropdown-toggle:empty::after{margin-left:0}.dropright .dropdown-toggle::after{vertical-align:0}.dropleft .dropdown-menu{top:0;right:100%;left:auto;margin-top:0;margin-right:.125rem}.dropleft .dropdown-toggle::after{display:inline-block;width:0;height:0;margin-left:.255em;vertical-align:.255em;content:""}.dropleft .dropdown-toggle::after{display:none}.dropleft .dropdown-toggle::before{display:inline-block;width:0;height:0;margin-right:.255em;vertical-align:.255em;content:"";border-top:.3em solid transparent;border-right:.3em solid;border-bottom:.3em solid transparent}.dropleft .dropdown-toggle:empty::after{margin-left:0}.dropleft .dropdown-toggle::before{vertical-align:0}.dropdown-menu[x-placement^="top"],.dropdown-menu[x-placement^="right"],.dropdown-menu[x-placement^="bottom"],.dropdown-menu[x-placement^="left"]{right:auto;bottom:auto}.dropdown-divider{height:0;margin:.5rem 0;overflow:hidden;border-top:1px solid #e9ecef}.dropdown-item{display:block;width:100%;padding:.25rem 1.5rem;clear:both;font-weight:400;color:#212529;text-align:inherit;white-space:nowrap;background-color:transparent;border:0}.dropdown-item:hover,.dropdown-item:focus{color:#16181b;text-decoration:none;background-color:#f8f9fa}.dropdown-item.active,.dropdown-item:active{color:#fff;text-decoration:none;background-color:#006}.dropdown-item.disabled,.dropdown-item:disabled{color:#6c757d;background-color:transparent}.dropdown-menu.show{display:block}.dropdown-header{display:block;padding:.5rem 1.5rem;margin-bottom:0;font-size:.875rem;color:#6c757d;white-space:nowrap}.dropdown-item-text{display:block;padding:.25rem 1.5rem;color:#212529}.btn-group,.btn-group-vertical{position:relative;display:inline-flex;vertical-align:middle}.btn-group>.btn,.btn-group-vertical>.btn{position:relative;flex:0 1 auto}.btn-group>.btn:hover,.btn-group-vertical>.btn:hover{z-index:1}.btn-group>.btn:focus,.btn-group>.btn:active,.btn-group>.btn.active,.btn-group-vertical>.btn:focus,.btn-group-vertical>.btn:active,.btn-group-vertical>.btn.active{z-index:1}.btn-group .btn+.btn,.btn-group .btn+.btn-group,.btn-group .btn-group+.btn,.btn-group .btn-group+.btn-group,.btn-group-vertical .btn+.btn,.btn-group-vertical .btn+.btn-group,.btn-group-vertical .btn-group+.btn,.btn-group-vertical .btn-group+.btn-group{margin-left:-1px}.btn-toolbar{display:flex;flex-wrap:wrap;justify-content:flex-start}.btn-toolbar .input-group{width:auto}.btn-group>.btn:first-child{margin-left:0}.btn-group>.btn:not(:last-child):not(.dropdown-toggle),.btn-group>.btn-group:not(:last-child)>.btn{border-top-right-radius:0;border-bottom-right-radius:0}.btn-group>.btn:not(:first-child),.btn-group>.btn-group:not(:first-child)>.btn{border-top-left-radius:0;border-bottom-left-radius:0}.dropdown-toggle-split{padding-right:.5625rem;padding-left:.5625rem}.dropdown-toggle-split::after,.dropup .dropdown-toggle-split::after,.dropright .dropdown-toggle-split::after{margin-left:0}.dropleft .dropdown-toggle-split::before{margin-right:0}.btn-sm+.dropdown-toggle-split,.btn-group-sm>.btn+.dropdown-toggle-split{padding-right:.375rem;padding-left:.375rem}.btn-lg+.dropdown-toggle-split,.btn-group-lg>.btn+.dropdown-toggle-split{padding-right:.75rem;padding-left:.75rem}.btn-group-vertical{flex-direction:column;align-items:flex-start;justify-content:center}.btn-group-vertical .btn,.btn-group-vertical .btn-group{width:100%}.btn-group-vertical>.btn+.btn,.btn-group-vertical>.btn+.btn-group,.btn-group-vertical>.btn-group+.btn,.btn-group-vertical>.btn-group+.btn-group{margin-top:-1px;margin-left:0}.btn-group-vertical>.btn:not(:last-child):not(.dropdown-toggle),.btn-group-vertical>.btn-group:not(:last-child)>.btn{border-bottom-right-radius:0;border-bottom-left-radius:0}.btn-group-vertical>.btn:not(:first-child),.btn-group-vertical>.btn-group:not(:first-child)>.btn{border-top-left-radius:0;border-top-right-radius:0}.btn-group-toggle>.btn,.btn-group-toggle>.btn-group>.btn{margin-bottom:0}.btn-group-toggle>.btn input[type="radio"],.btn-group-toggle>.btn input[type="checkbox"],.btn-group-toggle>.btn-group>.btn input[type="radio"],.btn-group-toggle>.btn-group>.btn input[type="checkbox"]{position:absolute;clip:rect(0,0,0,0);pointer-events:none}.input-group{position:relative;display:flex;flex-wrap:wrap;align-items:stretch;width:100%}.input-group>.form-control,.input-group>.custom-select,.input-group>.custom-file{position:relative;flex:1 1 auto;width:1%;margin-bottom:0}.input-group>.form-control+.form-control,.input-group>.form-control+.custom-select,.input-group>.form-control+.custom-file,.input-group>.custom-select+.form-control,.input-group>.custom-select+.custom-select,.input-group>.custom-select+.custom-file,.input-group>.custom-file+.form-control,.input-group>.custom-file+.custom-select,.input-group>.custom-file+.custom-file{margin-left:-1px}.input-group>.form-control:focus,.input-group>.custom-select:focus,.input-group>.custom-file .custom-file-input:focus~.custom-file-label{z-index:3}.input-group>.custom-file .custom-file-input:focus{z-index:4}.input-group>.form-control:not(:last-child),.input-group>.custom-select:not(:last-child){border-top-right-radius:0;border-bottom-right-radius:0}.input-group>.form-control:not(:first-child),.input-group>.custom-select:not(:first-child){border-top-left-radius:0;border-bottom-left-radius:0}.input-group>.custom-file{display:flex;align-items:center}.input-group>.custom-file:not(:last-child) .custom-file-label,.input-group>.custom-file:not(:last-child) .custom-file-label::after{border-top-right-radius:0;border-bottom-right-radius:0}.input-group>.custom-file:not(:first-child) .custom-file-label{border-top-left-radius:0;border-bottom-left-radius:0}.input-group-prepend,.input-group-append{display:flex}.input-group-prepend .btn,.input-group-append .btn{position:relative;z-index:2}.input-group-prepend .btn+.btn,.input-group-prepend .btn+.input-group-text,.input-group-prepend .input-group-text+.input-group-text,.input-group-prepend .input-group-text+.btn,.input-group-append .btn+.btn,.input-group-append .btn+.input-group-text,.input-group-append .input-group-text+.input-group-text,.input-group-append .input-group-text+.btn{margin-left:-1px}.input-group-prepend{margin-right:-1px}.input-group-append{margin-left:-1px}.input-group-text{display:flex;align-items:center;padding:.375rem .75rem;margin-bottom:0;font-size:1rem;font-weight:400;line-height:1.5;color:#495057;text-align:center;white-space:nowrap;background-color:#e9ecef;border:1px solid #ced4da;border-radius:3px}.input-group-text input[type="radio"],.input-group-text input[type="checkbox"]{margin-top:0}.input-group-lg>.form-control,.input-group-lg>.input-group-prepend>.input-group-text,.input-group-lg>.input-group-append>.input-group-text,.input-group-lg>.input-group-prepend>.btn,.input-group-lg>.input-group-append>.btn{height:calc(2.875rem + 2px);padding:.5rem 1rem;font-size:1.25rem;line-height:1.5;border-radius:2px}.input-group-sm>.form-control,.input-group-sm>.input-group-prepend>.input-group-text,.input-group-sm>.input-group-append>.input-group-text,.input-group-sm>.input-group-prepend>.btn,.input-group-sm>.input-group-append>.btn{height:calc(1.8125rem + 2px);padding:.25rem .5rem;font-size:.875rem;line-height:1.5;border-radius:2px}.input-group>.input-group-prepend>.btn,.input-group>.input-group-prepend>.input-group-text,.input-group>.input-group-append:not(:last-child)>.btn,.input-group>.input-group-append:not(:last-child)>.input-group-text,.input-group>.input-group-append:last-child>.btn:not(:last-child):not(.dropdown-toggle),.input-group>.input-group-append:last-child>.input-group-text:not(:last-child){border-top-right-radius:0;border-bottom-right-radius:0}.input-group>.input-group-append>.btn,.input-group>.input-group-append>.input-group-text,.input-group>.input-group-prepend:not(:first-child)>.btn,.input-group>.input-group-prepend:not(:first-child)>.input-group-text,.input-group>.input-group-prepend:first-child>.btn:not(:first-child),.input-group>.input-group-prepend:first-child>.input-group-text:not(:first-child){border-top-left-radius:0;border-bottom-left-radius:0}.nav{display:flex;flex-wrap:wrap;padding-left:0;margin-bottom:0;list-style:none}.nav-link{display:block;padding:.5rem 1rem}.nav-link:hover,.nav-link:focus{text-decoration:none}.nav-link.disabled{color:#6c757d}.nav-tabs{border-bottom:1px solid #dee2e6}.nav-tabs .nav-item{margin-bottom:-1px}.nav-tabs .nav-link{border:1px solid transparent;border-top-left-radius:3px;border-top-right-radius:3px}.nav-tabs .nav-link:hover,.nav-tabs .nav-link:focus{border-color:#e9ecef #e9ecef #dee2e6}.nav-tabs .nav-link.disabled{color:#6c757d;background-color:transparent;border-color:transparent}.nav-tabs .nav-link.active,.nav-tabs .nav-item.show .nav-link{color:#495057;background-color:#fff;border-color:#dee2e6 #dee2e6 #fff}.nav-tabs .dropdown-menu{margin-top:-1px;border-top-left-radius:0;border-top-right-radius:0}.nav-pills .nav-link{border-radius:3px}.nav-pills .nav-link.active,.nav-pills .show>.nav-link{color:#fff;background-color:#006}.nav-fill .nav-item{flex:1 1 auto;text-align:center}.nav-justified .nav-item{flex-basis:0;flex-grow:1;text-align:center}.tab-content>.tab-pane{display:none}.tab-content>.active{display:block}.card{position:relative;display:flex;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:3px}.card>hr{margin-right:0;margin-left:0}.card>.list-group:first-child .list-group-item:first-child{border-top-left-radius:3px;border-top-right-radius:3px}.card>.list-group:last-child .list-group-item:last-child{border-bottom-right-radius:3px;border-bottom-left-radius:3px}.card-body{flex:1 1 auto;padding:1.25rem}.card-title{margin-bottom:.75rem}.card-subtitle{margin-top:-.375rem;margin-bottom:0}.card-text:last-child{margin-bottom:0}.card-link:hover{text-decoration:none}.card-link+.card-link{margin-left:1.25rem}.card-header{padding:.75rem 1.25rem;margin-bottom:0;background-color:rgba(0,0,0,.03);border-bottom:1px solid rgba(0,0,0,.125)}.card-header:first-child{border-radius:calc(3px - 1px) calc(3px - 1px) 0 0}.card-header+.list-group .list-group-item:first-child{border-top:0}.card-footer{padding:.75rem 1.25rem;background-color:rgba(0,0,0,.03);border-top:1px solid rgba(0,0,0,.125)}.card-footer:last-child{border-radius:0 0 calc(3px - 1px) calc(3px - 1px)}.card-header-tabs{margin-right:-.625rem;margin-bottom:-.75rem;margin-left:-.625rem;border-bottom:0}.card-header-pills{margin-right:-.625rem;margin-left:-.625rem}.card-img-overlay{position:absolute;top:0;right:0;bottom:0;left:0;width:100%}.card-img{width:100%;border-radius:calc(3px - 1px)}.card-img-top{width:100%;border-top-left-radius:calc(3px - 1px);border-top-right-radius:calc(3px - 1px)}.card-img-bottom{width:100%;border-bottom-right-radius:calc(3px - 1px);border-bottom-left-radius:calc(3px - 1px)}.card-deck{display:flex;flex-direction:column}.card-deck .card{margin-bottom:7.5px}@media (min-width:576px){.card-deck{flex-flow:row wrap;margin-right:-7.5px;margin-left:-7.5px}.card-deck .card{display:flex;flex:1 0 0%;flex-direction:column;margin-right:7.5px;margin-bottom:0;margin-left:7.5px}}.card-group{display:flex;flex-direction:column}.card-group>.card{margin-bottom:7.5px}@media (min-width:576px){.card-group{flex-flow:row wrap}.card-group>.card{flex:1 0 0%;margin-bottom:0}.card-group>.card+.card{margin-left:0;border-left:0}.card-group>.card:first-child{border-top-right-radius:0;border-bottom-right-radius:0}.card-group>.card:first-child .card-img-top,.card-group>.card:first-child .card-header{border-top-right-radius:0}.card-group>.card:first-child .card-img-bottom,.card-group>.card:first-child .card-footer{border-bottom-right-radius:0}.card-group>.card:last-child{border-top-left-radius:0;border-bottom-left-radius:0}.card-group>.card:last-child .card-img-top,.card-group>.card:last-child .card-header{border-top-left-radius:0}.card-group>.card:last-child .card-img-bottom,.card-group>.card:last-child .card-footer{border-bottom-left-radius:0}.card-group>.card:only-child{border-radius:3px}.card-group>.card:only-child .card-img-top,.card-group>.card:only-child .card-header{border-top-left-radius:3px;border-top-right-radius:3px}.card-group>.card:only-child .card-img-bottom,.card-group>.card:only-child .card-footer{border-bottom-right-radius:3px;border-bottom-left-radius:3px}.card-group>.card:not(:first-child):not(:last-child):not(:only-child){border-radius:0}.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-top,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-header,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-footer{border-radius:0}}.card-columns .card{margin-bottom:.75rem}@media (min-width:576px){.card-columns{column-count:3;column-gap:1.25rem;orphans:1;widows:1}.card-columns .card{display:inline-block;width:100%}}.accordion .card:not(:first-of-type):not(:last-of-type){border-bottom:0;border-radius:0}.accordion .card:not(:first-of-type) .card-header:first-child{border-radius:0}.accordion .card:first-of-type{border-bottom:0;border-bottom-right-radius:0;border-bottom-left-radius:0}.accordion .card:last-of-type{border-top-left-radius:0;border-top-right-radius:0}.breadcrumb{display:flex;flex-wrap:wrap;padding:.75rem 1rem;margin-bottom:1rem;list-style:none;background-color:#e9ecef;border-radius:3px}.breadcrumb-item+.breadcrumb-item{padding-left:.5rem}.breadcrumb-item+.breadcrumb-item::before{display:inline-block;padding-right:.5rem;color:#6c757d;content:"/"}.breadcrumb-item+.breadcrumb-item:hover::before{text-decoration:underline}.breadcrumb-item+.breadcrumb-item:hover::before{text-decoration:none}.breadcrumb-item.active{color:#6c757d}.pagination{display:flex;padding-left:0;list-style:none;border-radius:3px}.page-link{position:relative;display:block;padding:.5rem .75rem;margin-left:-1px;line-height:1.25;color:#006;background-color:#fff;border:1px solid #dee2e6}.page-link:hover{z-index:2;color:#00001a;text-decoration:none;background-color:#e9ecef;border-color:#dee2e6}.page-link:focus{z-index:2;outline:0;box-shadow:0 0 0 .2rem rgba(0,0,102,.25)}.page-link:not(:disabled):not(.disabled){cursor:pointer}.page-item:first-child .page-link{margin-left:0;border-top-left-radius:3px;border-bottom-left-radius:3px}.page-item:last-child .page-link{border-top-right-radius:3px;border-bottom-right-radius:3px}.page-item.active .page-link{z-index:1;color:#fff;background-color:#006;border-color:#006}.page-item.disabled .page-link{color:#6c757d;pointer-events:none;cursor:auto;background-color:#fff;border-color:#dee2e6}.pagination-lg .page-link{padding:.75rem 1.5rem;font-size:1.25rem;line-height:1.5}.pagination-lg .page-item:first-child .page-link{border-top-left-radius:2px;border-bottom-left-radius:2px}.pagination-lg .page-item:last-child .page-link{border-top-right-radius:2px;border-bottom-right-radius:2px}.pagination-sm .page-link{padding:.25rem .5rem;font-size:.875rem;line-height:1.5}.pagination-sm .page-item:first-child .page-link{border-top-left-radius:2px;border-bottom-left-radius:2px}.pagination-sm .page-item:last-child .page-link{border-top-right-radius:2px;border-bottom-right-radius:2px}.badge{display:inline-block;padding:.25em .4em;font-size:75%;font-weight:700;line-height:1;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius:3px}.badge:empty{display:none}.btn .badge{position:relative;top:-1px}.badge-pill{padding-right:.6em;padding-left:.6em;border-radius:10rem}.badge-primary{color:#fff;background-color:#006}.badge-primary[href]:hover,.badge-primary[href]:focus{color:#fff;text-decoration:none;background-color:#003}.badge-secondary{color:#fff;background-color:#6c757d}.badge-secondary[href]:hover,.badge-secondary[href]:focus{color:#fff;text-decoration:none;background-color:#545b62}.badge-success{color:#212529;background-color:#81bf5d}.badge-success[href]:hover,.badge-success[href]:focus{color:#212529;text-decoration:none;background-color:#67a742}.badge-info{color:#fff;background-color:#15359a}.badge-info[href]:hover,.badge-info[href]:focus{color:#fff;text-decoration:none;background-color:#0f266d}.badge-warning{color:#212529;background-color:#ff9e15}.badge-warning[href]:hover,.badge-warning[href]:focus{color:#212529;text-decoration:none;background-color:#e18400}.badge-danger{color:#fff;background-color:#dc3545}.badge-danger[href]:hover,.badge-danger[href]:focus{color:#fff;text-decoration:none;background-color:#bd2130}.badge-light{color:#212529;background-color:#f8f9fa}.badge-light[href]:hover,.badge-light[href]:focus{color:#212529;text-decoration:none;background-color:#dae0e5}.badge-dark{color:#fff;background-color:#222}.badge-dark[href]:hover,.badge-dark[href]:focus{color:#fff;text-decoration:none;background-color:#090909}.badge-lightgray{color:#212529;background-color:#f5f5f5}.badge-lightgray[href]:hover,.badge-lightgray[href]:focus{color:#212529;text-decoration:none;background-color:gainsboro}.badge-mediumgray{color:#212529;background-color:#f3f2f7}.badge-mediumgray[href]:hover,.badge-mediumgray[href]:focus{color:#212529;text-decoration:none;background-color:#d6d2e4}.badge-midgray{color:#212529;background-color:#a5a5a5}.badge-midgray[href]:hover,.badge-midgray[href]:focus{color:#212529;text-decoration:none;background-color:#8c8c8c}.list-group{display:flex;flex-direction:column;padding-left:0;margin-bottom:0}.list-group-item-action{width:100%;color:#495057;text-align:inherit}.list-group-item-action:hover,.list-group-item-action:focus{color:#495057;text-decoration:none;background-color:#f8f9fa}.list-group-item-action:active{color:#212529;background-color:#e9ecef}.list-group-item{position:relative;display:block;padding:.75rem 1.25rem;margin-bottom:-1px;background-color:#fff;border:1px solid rgba(0,0,0,.125)}.list-group-item:first-child{border-top-left-radius:3px;border-top-right-radius:3px}.list-group-item:last-child{margin-bottom:0;border-bottom-right-radius:3px;border-bottom-left-radius:3px}.list-group-item:hover,.list-group-item:focus{z-index:1;text-decoration:none}.list-group-item.disabled,.list-group-item:disabled{color:#6c757d;background-color:#fff}.list-group-item.active{z-index:2;color:#fff;background-color:#006;border-color:#006}.list-group-flush .list-group-item{border-right:0;border-left:0;border-radius:0}.list-group-flush:first-child .list-group-item:first-child{border-top:0}.list-group-flush:last-child .list-group-item:last-child{border-bottom:0}.list-group-item-primary{color:#000035;background-color:#b8b8d4}.list-group-item-primary.list-group-item-action:hover,.list-group-item-primary.list-group-item-action:focus{color:#000035;background-color:#a8a8ca}.list-group-item-primary.list-group-item-action.active{color:#fff;background-color:#000035;border-color:#000035}.list-group-item-secondary{color:#383d41;background-color:#d6d8db}.list-group-item-secondary.list-group-item-action:hover,.list-group-item-secondary.list-group-item-action:focus{color:#383d41;background-color:#c8cbcf}.list-group-item-secondary.list-group-item-action.active{color:#fff;background-color:#383d41;border-color:#383d41}.list-group-item-success{color:#436330;background-color:#dcedd2}.list-group-item-success.list-group-item-action:hover,.list-group-item-success.list-group-item-action:focus{color:#436330;background-color:#cee6c0}.list-group-item-success.list-group-item-action.active{color:#fff;background-color:#436330;border-color:#436330}.list-group-item-info{color:#0b1c50;background-color:#bdc6e3}.list-group-item-info.list-group-item-action:hover,.list-group-item-info.list-group-item-action:focus{color:#0b1c50;background-color:#abb7db}.list-group-item-info.list-group-item-action.active{color:#fff;background-color:#0b1c50;border-color:#0b1c50}.list-group-item-warning{color:#85520b;background-color:#ffe4bd}.list-group-item-warning.list-group-item-action:hover,.list-group-item-warning.list-group-item-action:focus{color:#85520b;background-color:#ffdaa4}.list-group-item-warning.list-group-item-action.active{color:#fff;background-color:#85520b;border-color:#85520b}.list-group-item-danger{color:#721c24;background-color:#f5c6cb}.list-group-item-danger.list-group-item-action:hover,.list-group-item-danger.list-group-item-action:focus{color:#721c24;background-color:#f1b0b7}.list-group-item-danger.list-group-item-action.active{color:#fff;background-color:#721c24;border-color:#721c24}.list-group-item-light{color:#818182;background-color:#fdfdfe}.list-group-item-light.list-group-item-action:hover,.list-group-item-light.list-group-item-action:focus{color:#818182;background-color:#ececf6}.list-group-item-light.list-group-item-action.active{color:#fff;background-color:#818182;border-color:#818182}.list-group-item-dark{color:#121212;background-color:#c1c1c1}.list-group-item-dark.list-group-item-action:hover,.list-group-item-dark.list-group-item-action:focus{color:#121212;background-color:#b4b4b4}.list-group-item-dark.list-group-item-action.active{color:#fff;background-color:#121212;border-color:#121212}.list-group-item-lightgray{color:#7f7f7f;background-color:#fcfcfc}.list-group-item-lightgray.list-group-item-action:hover,.list-group-item-lightgray.list-group-item-action:focus{color:#7f7f7f;background-color:#efefef}.list-group-item-lightgray.list-group-item-action.active{color:#fff;background-color:#7f7f7f;border-color:#7f7f7f}.list-group-item-mediumgray{color:#7e7e80;background-color:#fcfbfd}.list-group-item-mediumgray.list-group-item-action:hover,.list-group-item-mediumgray.list-group-item-action:focus{color:#7e7e80;background-color:#efeaf5}.list-group-item-mediumgray.list-group-item-action.active{color:#fff;background-color:#7e7e80;border-color:#7e7e80}.list-group-item-midgray{color:#565656;background-color:#e6e6e6}.list-group-item-midgray.list-group-item-action:hover,.list-group-item-midgray.list-group-item-action:focus{color:#565656;background-color:#d9d9d9}.list-group-item-midgray.list-group-item-action.active{color:#fff;background-color:#565656;border-color:#565656}.close{float:right;font-size:1.5rem;font-weight:700;line-height:1;color:#000;text-shadow:0 1px 0 #fff;opacity:.5}.close:not(:disabled):not(.disabled){cursor:pointer}.close:not(:disabled):not(.disabled):hover,.close:not(:disabled):not(.disabled):focus{color:#000;text-decoration:none;opacity:.75}button.close{padding:0;background-color:transparent;border:0;-webkit-appearance:none}.modal-open{overflow:hidden}.modal-open .modal{overflow-x:hidden;overflow-y:auto}.modal{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1050;display:none;overflow:hidden;outline:0}.modal-dialog{position:relative;width:auto;margin:.5rem;pointer-events:none}.modal.fade .modal-dialog{transition:transform 0.3s ease-out;transform:translate(0,-25%)}@media screen and (prefers-reduced-motion:reduce){.modal.fade .modal-dialog{transition:none}}.modal.show .modal-dialog{transform:translate(0,0)}.modal-dialog-centered{display:flex;align-items:center;min-height:calc(100% - (.5rem * 2))}.modal-dialog-centered::before{display:block;height:calc(100vh - (.5rem * 2));content:""}.modal-content{position:relative;display:flex;flex-direction:column;width:100%;pointer-events:auto;background-color:#fff;background-clip:padding-box;border:1px solid rgba(0,0,0,.2);border-radius:2px;outline:0}.modal-backdrop{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1020;background-color:#000}.modal-backdrop.fade{opacity:0}.modal-backdrop.show{opacity:.5}.modal-header{display:flex;align-items:flex-start;justify-content:space-between;padding:1rem;border-bottom:1px solid #e9ecef;border-top-left-radius:2px;border-top-right-radius:2px}.modal-header .close{padding:1rem;margin:-1rem -1rem -1rem auto}.modal-title{margin-bottom:0;line-height:1.5}.modal-body{position:relative;flex:1 1 auto;padding:1rem}.modal-footer{display:flex;align-items:center;justify-content:flex-end;padding:1rem;border-top:1px solid #e9ecef}.modal-footer>:not(:first-child){margin-left:.25rem}.modal-footer>:not(:last-child){margin-right:.25rem}.modal-scrollbar-measure{position:absolute;top:-9999px;width:50px;height:50px;overflow:scroll}@media (min-width:576px){.modal-dialog{max-width:500px;margin:1.75rem auto}.modal-dialog-centered{min-height:calc(100% - (1.75rem * 2))}.modal-dialog-centered::before{height:calc(100vh - (1.75rem * 2))}.modal-sm{max-width:300px}}@media (min-width:992px){.modal-lg{max-width:800px}}.tooltip{position:absolute;z-index:1070;display:block;margin:0;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";font-style:normal;font-weight:400;line-height:1.5;text-align:left;text-align:start;text-decoration:none;text-shadow:none;text-transform:none;letter-spacing:normal;word-break:normal;word-spacing:normal;white-space:normal;line-break:auto;font-size:.875rem;word-wrap:break-word;opacity:0}.tooltip.show{opacity:.9}.tooltip .arrow{position:absolute;display:block;width:.8rem;height:.4rem}.tooltip .arrow::before{position:absolute;content:"";border-color:transparent;border-style:solid}.bs-tooltip-top,.bs-tooltip-auto[x-placement^="top"]{padding:.4rem 0}.bs-tooltip-top .arrow,.bs-tooltip-auto[x-placement^="top"] .arrow{bottom:0}.bs-tooltip-top .arrow::before,.bs-tooltip-auto[x-placement^="top"] .arrow::before{top:0;border-width:.4rem .4rem 0;border-top-color:#000}.bs-tooltip-right,.bs-tooltip-auto[x-placement^="right"]{padding:0 .4rem}.bs-tooltip-right .arrow,.bs-tooltip-auto[x-placement^="right"] .arrow{left:0;width:.4rem;height:.8rem}.bs-tooltip-right .arrow::before,.bs-tooltip-auto[x-placement^="right"] .arrow::before{right:0;border-width:.4rem .4rem .4rem 0;border-right-color:#000}.bs-tooltip-bottom,.bs-tooltip-auto[x-placement^="bottom"]{padding:.4rem 0}.bs-tooltip-bottom .arrow,.bs-tooltip-auto[x-placement^="bottom"] .arrow{top:0}.bs-tooltip-bottom .arrow::before,.bs-tooltip-auto[x-placement^="bottom"] .arrow::before{bottom:0;border-width:0 .4rem .4rem;border-bottom-color:#000}.bs-tooltip-left,.bs-tooltip-auto[x-placement^="left"]{padding:0 .4rem}.bs-tooltip-left .arrow,.bs-tooltip-auto[x-placement^="left"] .arrow{right:0;width:.4rem;height:.8rem}.bs-tooltip-left .arrow::before,.bs-tooltip-auto[x-placement^="left"] .arrow::before{left:0;border-width:.4rem 0 .4rem .4rem;border-left-color:#000}.tooltip-inner{max-width:200px;padding:.25rem .5rem;color:#fff;text-align:center;background-color:#000;border-radius:3px}.popover{position:absolute;top:0;left:0;z-index:1060;display:block;max-width:276px;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";font-style:normal;font-weight:400;line-height:1.5;text-align:left;text-align:start;text-decoration:none;text-shadow:none;text-transform:none;letter-spacing:normal;word-break:normal;word-spacing:normal;white-space:normal;line-break:auto;font-size:.875rem;word-wrap:break-word;background-color:#fff;background-clip:padding-box;border:1px solid rgba(0,0,0,.2);border-radius:2px}.popover .arrow{position:absolute;display:block;width:1rem;height:.5rem;margin:0 2px}.popover .arrow::before,.popover .arrow::after{position:absolute;display:block;content:"";border-color:transparent;border-style:solid}.bs-popover-top,.bs-popover-auto[x-placement^="top"]{margin-bottom:.5rem}.bs-popover-top .arrow,.bs-popover-auto[x-placement^="top"] .arrow{bottom:calc((.5rem + 1px) * -1)}.bs-popover-top .arrow::before,.bs-popover-auto[x-placement^="top"] .arrow::before,.bs-popover-top .arrow::after,.bs-popover-auto[x-placement^="top"] .arrow::after{border-width:.5rem .5rem 0}.bs-popover-top .arrow::before,.bs-popover-auto[x-placement^="top"] .arrow::before{bottom:0;border-top-color:rgba(0,0,0,.25)}.bs-popover-top .arrow::after,.bs-popover-auto[x-placement^="top"] .arrow::after{bottom:1px;border-top-color:#fff}.bs-popover-right,.bs-popover-auto[x-placement^="right"]{margin-left:.5rem}.bs-popover-right .arrow,.bs-popover-auto[x-placement^="right"] .arrow{left:calc((.5rem + 1px) * -1);width:.5rem;height:1rem;margin:2px 0}.bs-popover-right .arrow::before,.bs-popover-auto[x-placement^="right"] .arrow::before,.bs-popover-right .arrow::after,.bs-popover-auto[x-placement^="right"] .arrow::after{border-width:.5rem .5rem .5rem 0}.bs-popover-right .arrow::before,.bs-popover-auto[x-placement^="right"] .arrow::before{left:0;border-right-color:rgba(0,0,0,.25)}.bs-popover-right .arrow::after,.bs-popover-auto[x-placement^="right"] .arrow::after{left:1px;border-right-color:#fff}.bs-popover-bottom,.bs-popover-auto[x-placement^="bottom"]{margin-top:.5rem}.bs-popover-bottom .arrow,.bs-popover-auto[x-placement^="bottom"] .arrow{top:calc((.5rem + 1px) * -1)}.bs-popover-bottom .arrow::before,.bs-popover-auto[x-placement^="bottom"] .arrow::before,.bs-popover-bottom .arrow::after,.bs-popover-auto[x-placement^="bottom"] .arrow::after{border-width:0 .5rem .5rem .5rem}.bs-popover-bottom .arrow::before,.bs-popover-auto[x-placement^="bottom"] .arrow::before{top:0;border-bottom-color:rgba(0,0,0,.25)}.bs-popover-bottom .arrow::after,.bs-popover-auto[x-placement^="bottom"] .arrow::after{top:1px;border-bottom-color:#fff}.bs-popover-bottom .popover-header::before,.bs-popover-auto[x-placement^="bottom"] .popover-header::before{position:absolute;top:0;left:50%;display:block;width:1rem;margin-left:-.5rem;content:"";border-bottom:1px solid #f7f7f7}.bs-popover-left,.bs-popover-auto[x-placement^="left"]{margin-right:.5rem}.bs-popover-left .arrow,.bs-popover-auto[x-placement^="left"] .arrow{right:calc((.5rem + 1px) * -1);width:.5rem;height:1rem;margin:2px 0}.bs-popover-left .arrow::before,.bs-popover-auto[x-placement^="left"] .arrow::before,.bs-popover-left .arrow::after,.bs-popover-auto[x-placement^="left"] .arrow::after{border-width:.5rem 0 .5rem .5rem}.bs-popover-left .arrow::before,.bs-popover-auto[x-placement^="left"] .arrow::before{right:0;border-left-color:rgba(0,0,0,.25)}.bs-popover-left .arrow::after,.bs-popover-auto[x-placement^="left"] .arrow::after{right:1px;border-left-color:#fff}.popover-header{padding:.5rem .75rem;margin-bottom:0;font-size:1rem;color:inherit;background-color:#f7f7f7;border-bottom:1px solid #ebebeb;border-top-left-radius:calc(2px - 1px);border-top-right-radius:calc(2px - 1px)}.popover-header:empty{display:none}.popover-body{padding:.5rem .75rem;color:#212529}</style><style>:root{--primary-dark-color:#000052;--primary-color:#006;--primary-color-hover:#000040;--primary-color-thrd:#333385;--light-blue-color:#434392;--lavender-color:#E5E5F0;--light-purple-color:#6666A3;--warning-color:#ff9e15;--warning-color-hover:#ee8b00;--light-green-color:#8FBC69;--indianred-color:#CB4039;--indianred-light-color:#F5D9D7;--indianred-color-2:#8F1B1E;--light-gray:#EFF0F2;--light-gray-primary:#CFD3D7;--light-gray-secondary:#DFE1E4;--mediumgray-default-color:#f3f2f7;--whitesmoke-color:#F0F0F6;--ghostwhite-color:#F8F9FA;--darkgray-color:#9AAAC0;--dark-color:#232426;--dark-color-50:rgba(35,36,38,.5);--muted-color-2:#696D71;--dark-muted-color:#46484B;--light-muted-color:#8C9196;--border-color:#EFF0F2;--body-text-size:13.6px;--body-text-size-2:12.8px;--small-text-size:11.2px;--font-family-opensans:'Open Sans',Arial,sans-serif}*,::before,::after{box-sizing:border-box}html{font-family:var(--font-family-opensans);line-height:1.15;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;-ms-overflow-style:scrollbar;-webkit-tap-highlight-color:rgba(0,0,0,0)}body{margin:0;font-family:var(--font-family-opensans);font-size:1rem;font-weight:400;line-height:1.5;color:var(--dark-color);text-align:left;background-color:#fff;padding-top:56px}.custom-radio label{border-color:#ced4da;background-color:#fff}.custom-radio label:not(:last-child){border-right:0}.custom-radio input[type="radio"]:checked+label{background-color:#006;color:#fff}.radio-btn-group .btn:first-of-type{border-top-left-radius:3px!important;border-bottom-left-radius:3px!important}select.form-control{appearance:none;-webkit-appearance:none;border-radius:3px!important;-webkit-border-radius:3px!important}.dropdown-toggle.no-caret::after{display:none}.text-sm{font-size:85%!important}@media (max-width:768px){.h1{font-size:2rem}.h2{font-size:1.75rem}.h3{font-size:1.5rem}.h4{font-size:1.3rem}.h5{font-size:1.05rem}small{font-size:75%}}.text-md{font-size:92%!important}.text-sm{font-size:85%!important}.text-m-14{font-size:88%!important}.text-s{font-size:78.5%!important}.text-xs{font-size:70%!important}.sub-nav li:not(:last-child){border-right:1px solid #ddd}@media (max-width:768px){.sub-nav li:nth-child(1),.sub-nav li:nth-child(2),.sub-nav li:nth-child(3){border-bottom:1px solid #ddd}.sub-nav li:nth-child(3){border-right:0}.avatar .badge{font-size:65%}.css-articles-container{overflow-y:hidden;overflow-x:auto;margin:0!important}}select.form-control{background:#fff url(/dist/images/chevron-down-svg.svg) center right 0.75rem/7px no-repeat}.icon-available{display:inline-block;width:.5em;height:.5em;border-radius:1000px;background-color:#79B654}@media (min-width:992px){.css-row-stats{margin-top:-5rem}.css-col-stats{border-left:1px solid #dee2e6}}.css-avatar-img{height:0;padding:0;padding-bottom:100%;background:#ddd center/cover no-repeat;box-shadow:0 1px 3px rgba(0,0,0,.2)}.navbar-toggler{outline:none!important}@media (max-width:768px){.card{border:0;border-top:1px solid #ddd!important;border-bottom:1px solid #ddd!important}}.sprite{display:inline-block;background-image:url(/dist/images/sprite.png?1.0)}@media (min--moz-device-pixel-ratio:1.5),(-o-min-device-pixel-ratio:3 2),(-webkit-min-device-pixel-ratio:1.5),(min-device-pixel-ratio:1.5),(min-resolution:1.5dppx){.sprite{background-image:url(/dist/images/sprite-retina.png?1.0);background-size:181px 299px}}.sprite--icon-bolt{width:15px;height:15px;background-position:0 -28px}.sprite--icon-envelope{width:16px;height:16px;background-position:0 -43px}.sprite--icon-insta{width:16px;height:16px;background-position:0 -59px}.sprite--icon-facebook{width:16px;height:16px;background-position:0 -75px}.sprite--icon-twitter{width:16px;height:16px;background-position:0 -123px}.sprite--oladoc-footer{width:147px;height:33px;background-position:0 -139px}#footer .social-media{line-height:1}.container{width:100%;padding-right:7.5px;padding-left:7.5px;margin-right:auto;margin-left:auto}@media (min-width:576px){.container{max-width:540px}}@media (min-width:768px){.container{max-width:720px}}@media (min-width:992px){.container{max-width:960px}}@media (min-width:1200px){.container{max-width:1140px}}.container-fluid{width:100%;padding-right:7.5px;padding-left:7.5px;margin-right:auto;margin-left:auto}.row{display:flex;flex-wrap:wrap;margin-right:-7.5px;margin-left:-7.5px}.no-gutters{margin-right:0;margin-left:0}.no-gutters>.col,.no-gutters>[class*="col-"]{padding-right:0;padding-left:0}.col-1,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-10,.col-11,.col-12,.col,.col-auto,.col-sm-1,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm,.col-sm-auto,.col-md-1,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-10,.col-md-11,.col-md-12,.col-md,.col-md-auto,.col-lg-1,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg,.col-lg-auto,.col-xl-1,.col-xl-2,.col-xl-3,.col-xl-4,.col-xl-5,.col-xl-6,.col-xl-7,.col-xl-8,.col-xl-9,.col-xl-10,.col-xl-11,.col-xl-12,.col-xl,.col-xl-auto{position:relative;width:100%;min-height:1px;padding-right:7.5px;padding-left:7.5px}.col{flex-basis:0;flex-grow:1;max-width:100%}.col-auto{flex:0 0 auto;width:auto;max-width:none}.col-1{flex:0 0 8.33333%;max-width:8.33333%}.col-2{flex:0 0 16.66667%;max-width:16.66667%}.col-3{flex:0 0 25%;max-width:25%}.col-4{flex:0 0 33.33333%;max-width:33.33333%}.col-5{flex:0 0 41.66667%;max-width:41.66667%}.col-6{flex:0 0 50%;max-width:50%}.col-7{flex:0 0 58.33333%;max-width:58.33333%}.col-8{flex:0 0 66.66667%;max-width:66.66667%}.col-9{flex:0 0 75%;max-width:75%}.col-10{flex:0 0 83.33333%;max-width:83.33333%}.col-11{flex:0 0 91.66667%;max-width:91.66667%}.col-12{flex:0 0 100%;max-width:100%}.order-first{order:-1}.order-last{order:13}.order-0{order:0}.order-1{order:1}.order-2{order:2}.order-3{order:3}.order-4{order:4}.order-5{order:5}.order-6{order:6}.order-7{order:7}.order-8{order:8}.order-9{order:9}.order-10{order:10}.order-11{order:11}.order-12{order:12}.offset-1{margin-left:8.33333%}.offset-2{margin-left:16.66667%}.offset-3{margin-left:25%}.offset-4{margin-left:33.33333%}.offset-5{margin-left:41.66667%}.offset-6{margin-left:50%}.offset-7{margin-left:58.33333%}.offset-8{margin-left:66.66667%}.offset-9{margin-left:75%}.offset-10{margin-left:83.33333%}.offset-11{margin-left:91.66667%}@media (min-width:576px){.col-sm{flex-basis:0;flex-grow:1;max-width:100%}.col-sm-auto{flex:0 0 auto;width:auto;max-width:none}.col-sm-1{flex:0 0 8.33333%;max-width:8.33333%}.col-sm-2{flex:0 0 16.66667%;max-width:16.66667%}.col-sm-3{flex:0 0 25%;max-width:25%}.col-sm-4{flex:0 0 33.33333%;max-width:33.33333%}.col-sm-5{flex:0 0 41.66667%;max-width:41.66667%}.col-sm-6{flex:0 0 50%;max-width:50%}.col-sm-7{flex:0 0 58.33333%;max-width:58.33333%}.col-sm-8{flex:0 0 66.66667%;max-width:66.66667%}.col-sm-9{flex:0 0 75%;max-width:75%}.col-sm-10{flex:0 0 83.33333%;max-width:83.33333%}.col-sm-11{flex:0 0 91.66667%;max-width:91.66667%}.col-sm-12{flex:0 0 100%;max-width:100%}.order-sm-first{order:-1}.order-sm-last{order:13}.order-sm-0{order:0}.order-sm-1{order:1}.order-sm-2{order:2}.order-sm-3{order:3}.order-sm-4{order:4}.order-sm-5{order:5}.order-sm-6{order:6}.order-sm-7{order:7}.order-sm-8{order:8}.order-sm-9{order:9}.order-sm-10{order:10}.order-sm-11{order:11}.order-sm-12{order:12}.offset-sm-0{margin-left:0}.offset-sm-1{margin-left:8.33333%}.offset-sm-2{margin-left:16.66667%}.offset-sm-3{margin-left:25%}.offset-sm-4{margin-left:33.33333%}.offset-sm-5{margin-left:41.66667%}.offset-sm-6{margin-left:50%}.offset-sm-7{margin-left:58.33333%}.offset-sm-8{margin-left:66.66667%}.offset-sm-9{margin-left:75%}.offset-sm-10{margin-left:83.33333%}.offset-sm-11{margin-left:91.66667%}}@media (min-width:768px){.col-md{flex-basis:0;flex-grow:1;max-width:100%}.col-md-auto{flex:0 0 auto;width:auto;max-width:none}.col-md-1{flex:0 0 8.33333%;max-width:8.33333%}.col-md-2{flex:0 0 16.66667%;max-width:16.66667%}.col-md-3{flex:0 0 25%;max-width:25%}.col-md-4{flex:0 0 33.33333%;max-width:33.33333%}.col-md-5{flex:0 0 41.66667%;max-width:41.66667%}.col-md-6{flex:0 0 50%;max-width:50%}.col-md-7{flex:0 0 58.33333%;max-width:58.33333%}.col-md-8{flex:0 0 66.66667%;max-width:66.66667%}.col-md-9{flex:0 0 75%;max-width:75%}.col-md-10{flex:0 0 83.33333%;max-width:83.33333%}.col-md-11{flex:0 0 91.66667%;max-width:91.66667%}.col-md-12{flex:0 0 100%;max-width:100%}.order-md-first{order:-1}.order-md-last{order:13}.order-md-0{order:0}.order-md-1{order:1}.order-md-2{order:2}.order-md-3{order:3}.order-md-4{order:4}.order-md-5{order:5}.order-md-6{order:6}.order-md-7{order:7}.order-md-8{order:8}.order-md-9{order:9}.order-md-10{order:10}.order-md-11{order:11}.order-md-12{order:12}.offset-md-0{margin-left:0}.offset-md-1{margin-left:8.33333%}.offset-md-2{margin-left:16.66667%}.offset-md-3{margin-left:25%}.offset-md-4{margin-left:33.33333%}.offset-md-5{margin-left:41.66667%}.offset-md-6{margin-left:50%}.offset-md-7{margin-left:58.33333%}.offset-md-8{margin-left:66.66667%}.offset-md-9{margin-left:75%}.offset-md-10{margin-left:83.33333%}.offset-md-11{margin-left:91.66667%}}@media (min-width:992px){.col-lg{flex-basis:0;flex-grow:1;max-width:100%}.col-lg-auto{flex:0 0 auto;width:auto;max-width:none}.col-lg-1{flex:0 0 8.33333%;max-width:8.33333%}.col-lg-2{flex:0 0 16.66667%;max-width:16.66667%}.col-lg-3{flex:0 0 25%;max-width:25%}.col-lg-4{flex:0 0 33.33333%;max-width:33.33333%}.col-lg-5{flex:0 0 41.66667%;max-width:41.66667%}.col-lg-6{flex:0 0 50%;max-width:50%}.col-lg-7{flex:0 0 58.33333%;max-width:58.33333%}.col-lg-8{flex:0 0 66.66667%;max-width:66.66667%}.col-lg-9{flex:0 0 75%;max-width:75%}.col-lg-10{flex:0 0 83.33333%;max-width:83.33333%}.col-lg-11{flex:0 0 91.66667%;max-width:91.66667%}.col-lg-12{flex:0 0 100%;max-width:100%}.order-lg-first{order:-1}.order-lg-last{order:13}.order-lg-0{order:0}.order-lg-1{order:1}.order-lg-2{order:2}.order-lg-3{order:3}.order-lg-4{order:4}.order-lg-5{order:5}.order-lg-6{order:6}.order-lg-7{order:7}.order-lg-8{order:8}.order-lg-9{order:9}.order-lg-10{order:10}.order-lg-11{order:11}.order-lg-12{order:12}.offset-lg-0{margin-left:0}.offset-lg-1{margin-left:8.33333%}.offset-lg-2{margin-left:16.66667%}.offset-lg-3{margin-left:25%}.offset-lg-4{margin-left:33.33333%}.offset-lg-5{margin-left:41.66667%}.offset-lg-6{margin-left:50%}.offset-lg-7{margin-left:58.33333%}.offset-lg-8{margin-left:66.66667%}.offset-lg-9{margin-left:75%}.offset-lg-10{margin-left:83.33333%}.offset-lg-11{margin-left:91.66667%}}@media (min-width:1200px){.col-xl{flex-basis:0;flex-grow:1;max-width:100%}.col-xl-auto{flex:0 0 auto;width:auto;max-width:none}.col-xl-1{flex:0 0 8.33333%;max-width:8.33333%}.col-xl-2{flex:0 0 16.66667%;max-width:16.66667%}.col-xl-3{flex:0 0 25%;max-width:25%}.col-xl-4{flex:0 0 33.33333%;max-width:33.33333%}.col-xl-5{flex:0 0 41.66667%;max-width:41.66667%}.col-xl-6{flex:0 0 50%;max-width:50%}.col-xl-7{flex:0 0 58.33333%;max-width:58.33333%}.col-xl-8{flex:0 0 66.66667%;max-width:66.66667%}.col-xl-9{flex:0 0 75%;max-width:75%}.col-xl-10{flex:0 0 83.33333%;max-width:83.33333%}.col-xl-11{flex:0 0 91.66667%;max-width:91.66667%}.col-xl-12{flex:0 0 100%;max-width:100%}.order-xl-first{order:-1}.order-xl-last{order:13}.order-xl-0{order:0}.order-xl-1{order:1}.order-xl-2{order:2}.order-xl-3{order:3}.order-xl-4{order:4}.order-xl-5{order:5}.order-xl-6{order:6}.order-xl-7{order:7}.order-xl-8{order:8}.order-xl-9{order:9}.order-xl-10{order:10}.order-xl-11{order:11}.order-xl-12{order:12}.offset-xl-0{margin-left:0}.offset-xl-1{margin-left:8.33333%}.offset-xl-2{margin-left:16.66667%}.offset-xl-3{margin-left:25%}.offset-xl-4{margin-left:33.33333%}.offset-xl-5{margin-left:41.66667%}.offset-xl-6{margin-left:50%}.offset-xl-7{margin-left:58.33333%}.offset-xl-8{margin-left:66.66667%}.offset-xl-9{margin-left:75%}.offset-xl-10{margin-left:83.33333%}.offset-xl-11{margin-left:91.66667%}}article,aside,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}[tabindex="-1"]:focus{outline:0!important}hr{box-sizing:content-box;height:0;overflow:visible}h1,h2,h3,h4,h5,h6{margin-top:0;margin-bottom:.5rem}p{margin-top:0;margin-bottom:1rem}abbr[title],abbr[data-original-title]{text-decoration:underline;text-decoration:underline dotted;cursor:help;border-bottom:0}address{margin-bottom:1rem;font-style:normal;line-height:inherit}ol,ul,dl{margin-top:0;margin-bottom:1rem}ol ol,ul ul,ol ul,ul ol{margin-bottom:0}dt{font-weight:700}dd{margin-bottom:.5rem;margin-left:0}blockquote{margin:0 0 1rem}dfn{font-style:italic}b,strong{font-weight:bolder}small{font-size:80%}sub,sup{position:relative;font-size:75%;line-height:0;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}a{color:#006;text-decoration:none;background-color:transparent;-webkit-text-decoration-skip:objects}a:hover{color:#00001a;text-decoration:none}a:not([href]):not([tabindex]){color:inherit;text-decoration:none}a:not([href]):not([tabindex]):hover,a:not([href]):not([tabindex]):focus{color:inherit;text-decoration:none}a:not([href]):not([tabindex]):focus{outline:0}pre,code,kbd,samp{font-family:SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;font-size:1em}pre{margin-top:0;margin-bottom:1rem;overflow:auto;-ms-overflow-style:scrollbar}figure{margin:0 0 1rem}img{vertical-align:middle;border-style:none;max-width:100%;height:auto}svg{overflow:hidden;vertical-align:middle}table{border-collapse:collapse}.table{width:100%;margin-bottom:1rem;color:#212529}.table th,.table td{padding:.75rem;vertical-align:top;border-top:1px solid #dee2e6}.table thead th{vertical-align:bottom;border-bottom:2px solid #dee2e6}.table tbody+tbody{border-top:2px solid #dee2e6}.table-sm th,.table-sm td{padding:.3rem}.table-bordered{border:1px solid #dee2e6}.table-bordered th,.table-bordered td{border:1px solid #dee2e6}.table-bordered thead th,.table-bordered thead td{border-bottom-width:2px}.table-borderless th,.table-borderless td,.table-borderless thead th,.table-borderless tbody+tbody{border:0}.table-striped tbody tr:nth-of-type(odd){background-color:rgba(0,0,0,.05)}.table-hover tbody tr:hover{color:#212529;background-color:rgba(0,0,0,.075)}.table-primary,.table-primary>th,.table-primary>td{background-color:#b8daff}.table-primary th,.table-primary td,.table-primary thead th,.table-primary tbody+tbody{border-color:#7abaff}.table-hover .table-primary:hover{background-color:#9fcdff}.table-hover .table-primary:hover>td,.table-hover .table-primary:hover>th{background-color:#9fcdff}.table-secondary,.table-secondary>th,.table-secondary>td{background-color:#d6d8db}.table-secondary th,.table-secondary td,.table-secondary thead th,.table-secondary tbody+tbody{border-color:#b3b7bb}.table-hover .table-secondary:hover{background-color:#c8cbcf}.table-hover .table-secondary:hover>td,.table-hover .table-secondary:hover>th{background-color:#c8cbcf}.table-success,.table-success>th,.table-success>td{background-color:#c3e6cb}.table-success th,.table-success td,.table-success thead th,.table-success tbody+tbody{border-color:#8fd19e}.table-hover .table-success:hover{background-color:#b1dfbb}.table-hover .table-success:hover>td,.table-hover .table-success:hover>th{background-color:#b1dfbb}.table-info,.table-info>th,.table-info>td{background-color:#bee5eb}.table-info th,.table-info td,.table-info thead th,.table-info tbody+tbody{border-color:#86cfda}.table-hover .table-info:hover{background-color:#abdde5}.table-hover .table-info:hover>td,.table-hover .table-info:hover>th{background-color:#abdde5}.table-warning,.table-warning>th,.table-warning>td{background-color:#ffeeba}.table-warning th,.table-warning td,.table-warning thead th,.table-warning tbody+tbody{border-color:#ffdf7e}.table-hover .table-warning:hover{background-color:#ffe8a1}.table-hover .table-warning:hover>td,.table-hover .table-warning:hover>th{background-color:#ffe8a1}.table-danger,.table-danger>th,.table-danger>td{background-color:#f5c6cb}.table-danger th,.table-danger td,.table-danger thead th,.table-danger tbody+tbody{border-color:#ed969e}.table-hover .table-danger:hover{background-color:#f1b0b7}.table-hover .table-danger:hover>td,.table-hover .table-danger:hover>th{background-color:#f1b0b7}.table-light,.table-light>th,.table-light>td{background-color:#fdfdfe}.table-light th,.table-light td,.table-light thead th,.table-light tbody+tbody{border-color:#fbfcfc}.table-hover .table-light:hover{background-color:#ececf6}.table-hover .table-light:hover>td,.table-hover .table-light:hover>th{background-color:#ececf6}.table-dark,.table-dark>th,.table-dark>td{background-color:#c6c8ca}.table-dark th,.table-dark td,.table-dark thead th,.table-dark tbody+tbody{border-color:#95999c}.table-hover .table-dark:hover{background-color:#b9bbbe}.table-hover .table-dark:hover>td,.table-hover .table-dark:hover>th{background-color:#b9bbbe}.table-active,.table-active>th,.table-active>td{background-color:rgba(0,0,0,.075)}.table-hover .table-active:hover{background-color:rgba(0,0,0,.075)}.table-hover .table-active:hover>td,.table-hover .table-active:hover>th{background-color:rgba(0,0,0,.075)}.table .thead-dark th{color:#fff;background-color:#343a40;border-color:#454d55}.table .thead-light th{color:#495057;background-color:#e9ecef;border-color:#dee2e6}.table-dark{color:#fff;background-color:#343a40}.table-dark th,.table-dark td,.table-dark thead th{border-color:#454d55}.table-dark.table-bordered{border:0}.table-dark.table-striped tbody tr:nth-of-type(odd){background-color:rgba(255,255,255,.05)}.table-dark.table-hover tbody tr:hover{color:#fff;background-color:rgba(255,255,255,.075)}@media (max-width:575.98px){.table-responsive-sm{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch}.table-responsive-sm>.table-bordered{border:0}}@media (max-width:767.98px){.table-responsive-md{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch}.table-responsive-md>.table-bordered{border:0}}@media (max-width:991.98px){.table-responsive-lg{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch}.table-responsive-lg>.table-bordered{border:0}}@media (max-width:1199.98px){.table-responsive-xl{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch}.table-responsive-xl>.table-bordered{border:0}}.table-responsive{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch}.table-responsive>.table-bordered{border:0}caption{padding-top:.75rem;padding-bottom:.75rem;color:#9ca0a9;text-align:left;caption-side:bottom}th{text-align:inherit}label{display:inline-block;margin-bottom:.5rem}button{border-radius:0}button:focus{outline:1px dotted;outline:5px auto -webkit-focus-ring-color}input,button,select,optgroup,textarea{margin:0;font-family:inherit;font-size:inherit;line-height:inherit}button,input{overflow:visible}button,select{text-transform:none}button,html [type="button"],[type="reset"],[type="submit"]{-webkit-appearance:button}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner{padding:0;border-style:none}input[type="radio"],input[type="checkbox"]{box-sizing:border-box;padding:0}input[type="date"],input[type="time"],input[type="datetime-local"],input[type="month"]{-webkit-appearance:listbox}textarea{overflow:auto;resize:vertical}fieldset{min-width:0;padding:0;margin:0;border:0}legend{display:block;width:100%;max-width:100%;padding:0;margin-bottom:.5rem;font-size:1.5rem;line-height:inherit;color:inherit;white-space:normal}progress{vertical-align:baseline}[type="number"]::-webkit-inner-spin-button,[type="number"]::-webkit-outer-spin-button{height:auto}[type="search"]{outline-offset:-2px;-webkit-appearance:none}[type="search"]::-webkit-search-cancel-button,[type="search"]::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{font:inherit;-webkit-appearance:button}output{display:inline-block}summary{display:list-item;cursor:pointer}template{display:none}[hidden]{display:none!important}.navbar{position:relative;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;padding:.5rem 1rem}.navbar>.container,.navbar>.container-fluid{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between}.navbar-brand{display:inline-block;padding-top:.3125rem;padding-bottom:.3125rem;margin-right:1rem;font-size:1.25rem;line-height:inherit;white-space:nowrap}.navbar-brand:hover,.navbar-brand:focus{text-decoration:none}.navbar-nav{display:flex;flex-direction:column;padding-left:0;margin-bottom:0;list-style:none}.navbar-nav .nav-link{padding-right:0;padding-left:0}.navbar-nav .dropdown-menu{position:static;float:none}.navbar-text{display:inline-block;padding-top:.5rem;padding-bottom:.5rem}.navbar-collapse{flex-basis:100%;flex-grow:1;align-items:center}.navbar-toggler{padding:.25rem .75rem;font-size:1.25rem;line-height:1;background-color:transparent;border:1px solid transparent;border-radius:3px}.navbar-toggler:hover,.navbar-toggler:focus{text-decoration:none}.navbar-toggler:not(:disabled):not(.disabled){cursor:pointer}.navbar-toggler-icon{display:inline-block;width:1.5em;height:1.5em;vertical-align:middle;content:"";background:no-repeat center center;background-size:100% 100%}@media (max-width:575.98px){.navbar-expand-sm>.container,.navbar-expand-sm>.container-fluid{padding-right:0;padding-left:0}}@media (min-width:576px){.navbar-expand-sm{flex-flow:row nowrap;justify-content:flex-start}.navbar-expand-sm .navbar-nav{flex-direction:row}.navbar-expand-sm .navbar-nav .dropdown-menu{position:absolute}.navbar-expand-sm .navbar-nav .nav-link{padding-right:.5rem;padding-left:.5rem}.navbar-expand-sm>.container,.navbar-expand-sm>.container-fluid{flex-wrap:nowrap}.navbar-expand-sm .navbar-collapse{display:flex!important;flex-basis:auto}.navbar-expand-sm .navbar-toggler{display:none}}@media (max-width:767.98px){.navbar-expand-md>.container,.navbar-expand-md>.container-fluid{padding-right:0;padding-left:0}}@media (min-width:768px){.navbar-expand-md{flex-flow:row nowrap;justify-content:flex-start}.navbar-expand-md .navbar-nav{flex-direction:row}.navbar-expand-md .navbar-nav .dropdown-menu{position:absolute}.navbar-expand-md .navbar-nav .nav-link{padding-right:.5rem;padding-left:.5rem}.navbar-expand-md>.container,.navbar-expand-md>.container-fluid{flex-wrap:nowrap}.navbar-expand-md .navbar-collapse{display:flex!important;flex-basis:auto}.navbar-expand-md .navbar-toggler{display:none}}@media (max-width:991.98px){.navbar-expand-lg>.container,.navbar-expand-lg>.container-fluid{padding-right:0;padding-left:0}}@media (min-width:992px){body{padding-top:94px}.navbar-expand-lg{flex-flow:row nowrap;justify-content:flex-start}.navbar-expand-lg .navbar-nav{flex-direction:row}.navbar-expand-lg .navbar-nav .dropdown-menu{position:absolute}.navbar-expand-lg .navbar-nav .nav-link{padding-right:.5rem;padding-left:.5rem}.navbar-expand-lg>.container,.navbar-expand-lg>.container-fluid{flex-wrap:nowrap}.navbar-expand-lg .navbar-collapse{display:flex!important;flex-basis:auto}.navbar-expand-lg .navbar-toggler{display:none}}@media (max-width:1199.98px){.navbar-expand-xl>.container,.navbar-expand-xl>.container-fluid{padding-right:0;padding-left:0}}@media (min-width:1200px){.navbar-expand-xl{flex-flow:row nowrap;justify-content:flex-start}.navbar-expand-xl .navbar-nav{flex-direction:row}.navbar-expand-xl .navbar-nav .dropdown-menu{position:absolute}.navbar-expand-xl .navbar-nav .nav-link{padding-right:.5rem;padding-left:.5rem}.navbar-expand-xl>.container,.navbar-expand-xl>.container-fluid{flex-wrap:nowrap}.navbar-expand-xl .navbar-collapse{display:flex!important;flex-basis:auto}.navbar-expand-xl .navbar-toggler{display:none}}.navbar-expand{flex-flow:row nowrap;justify-content:flex-start}.navbar-expand>.container,.navbar-expand>.container-fluid{padding-right:0;padding-left:0}.navbar-expand .navbar-nav{flex-direction:row}.navbar-expand .navbar-nav .dropdown-menu{position:absolute}.navbar-expand .navbar-nav .nav-link{padding-right:.5rem;padding-left:.5rem}.navbar-expand>.container,.navbar-expand>.container-fluid{flex-wrap:nowrap}.navbar-expand .navbar-collapse{display:flex!important;flex-basis:auto}.navbar-expand .navbar-toggler{display:none}.navbar-light .navbar-brand{color:rgba(0,0,0,.9)}.navbar-light .navbar-brand:hover,.navbar-light .navbar-brand:focus{color:rgba(0,0,0,.9)}.navbar-light .navbar-nav .nav-link{color:#303030}.navbar-light .navbar-nav .nav-link:hover,.navbar-light .navbar-nav .nav-link:focus{color:rgba(0,0,0,.7)}.navbar-light .navbar-nav .nav-link.disabled{color:rgba(0,0,0,.3)}.navbar-light .navbar-nav .show>.nav-link,.navbar-light .navbar-nav .active>.nav-link,.navbar-light .navbar-nav .nav-link.show,.navbar-light .navbar-nav .nav-link.active{color:rgba(0,0,0,.9)}.navbar-light .navbar-toggler{color:rgba(0,0,0,.5);border-color:rgba(0,0,0,.1)}.navbar-light .navbar-toggler-icon{background-image:url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(0,0,0,0.5)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E")}.navbar-light .navbar-text{color:rgba(0,0,0,.5)}.navbar-light .navbar-text a{color:rgba(0,0,0,.9)}.navbar-light .navbar-text a:hover,.navbar-light .navbar-text a:focus{color:rgba(0,0,0,.9)}.navbar-dark .navbar-brand{color:#fff}.navbar-dark .navbar-brand:hover,.navbar-dark .navbar-brand:focus{color:#fff}.navbar-dark .navbar-nav .nav-link{color:rgba(255,255,255,.5)}.navbar-dark .navbar-nav .nav-link:hover,.navbar-dark .navbar-nav .nav-link:focus{color:rgba(255,255,255,.75)}.navbar-dark .navbar-nav .nav-link.disabled{color:rgba(255,255,255,.25)}.navbar-dark .navbar-nav .show>.nav-link,.navbar-dark .navbar-nav .active>.nav-link,.navbar-dark .navbar-nav .nav-link.show,.navbar-dark .navbar-nav .nav-link.active{color:#fff}.navbar-dark .navbar-toggler{color:rgba(255,255,255,.5);border-color:rgba(255,255,255,.1)}.navbar-dark .navbar-toggler-icon{background-image:url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255,255,255,0.5)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E")}.navbar-dark .navbar-text{color:rgba(255,255,255,.5)}.navbar-dark .navbar-text a{color:#fff}.navbar-dark .navbar-text a:hover,.navbar-dark .navbar-text a:focus{color:#fff}.align-baseline{vertical-align:baseline!important}.align-top{vertical-align:top!important}.align-middle{vertical-align:middle!important}.align-bottom{vertical-align:bottom!important}.align-text-bottom{vertical-align:text-bottom!important}.align-text-top{vertical-align:text-top!important}.bg-primary{background-color:#006!important}a.bg-primary:hover,a.bg-primary:focus,button.bg-primary:hover,button.bg-primary:focus{background-color:#003!important}.bg-secondary{background-color:#6c757d!important}a.bg-secondary:hover,a.bg-secondary:focus,button.bg-secondary:hover,button.bg-secondary:focus{background-color:#545b62!important}.bg-success{background-color:#81bf5d!important}a.bg-success:hover,a.bg-success:focus,button.bg-success:hover,button.bg-success:focus{background-color:#67a742!important}.bg-info{background-color:#15359a!important}a.bg-info:hover,a.bg-info:focus,button.bg-info:hover,button.bg-info:focus{background-color:#0f266d!important}.bg-warning{background-color:#ff9e15!important}a.bg-warning:hover,a.bg-warning:focus,button.bg-warning:hover,button.bg-warning:focus{background-color:#e18400!important}.bg-danger{background-color:#dc3545!important}a.bg-danger:hover,a.bg-danger:focus,button.bg-danger:hover,button.bg-danger:focus{background-color:#bd2130!important}.bg-light{background-color:#f8f9fa!important}a.bg-light:hover,a.bg-light:focus,button.bg-light:hover,button.bg-light:focus{background-color:#dae0e5!important}.bg-dark{background-color:#222!important}a.bg-dark:hover,a.bg-dark:focus,button.bg-dark:hover,button.bg-dark:focus{background-color:#090909!important}.bg-lightgray{background-color:#f5f5f5!important}a.bg-lightgray:hover,a.bg-lightgray:focus,button.bg-lightgray:hover,button.bg-lightgray:focus{background-color:#dcdcdc!important}.bg-mediumgray{background-color:#f3f2f7!important}a.bg-mediumgray:hover,a.bg-mediumgray:focus,button.bg-mediumgray:hover,button.bg-mediumgray:focus{background-color:#d6d2e4!important}.bg-midgray{background-color:#a5a5a5!important}a.bg-midgray:hover,a.bg-midgray:focus,button.bg-midgray:hover,button.bg-midgray:focus{background-color:#8c8c8c!important}.bg-darkgray-color{background-color:var(--darkgray-color)!important}a.bg-darkgray-color:hover,a.bg-darkgray-color:focus,button.bg-darkgray-color:hover,button.bg-darkgray-color:focus{background-color:var(--darkgray-color)!important}.bg-lightpurple{background-color:var(--light-blue-color)!important}a.bg-lightpurple:hover,a.bg-lightpurple:focus,button.bg-lightpurple:hover,button.bg-lightpurple:focus{background-color:var(--lavender-color)!important}.bg-lightpurple-2{background-color:var(--light-purple-color)!important}a.bg-lightpurple-2:hover,a.bg-lightpurple-2:focus,button.bg-lightpurple-2:hover,button.bg-lightpurple-2:focus{background-color:var(--lavender-color)!important}.bg-indianred{background-color:var(--indianred-color)!important}a.bg-indianred:hover,a.bg-indianred:focus,button.bg-indianred:hover,button.bg-indianred:focus{background-color:var(--light-purple-color)!important}.bg-white{background-color:#fff!important}.bg-transparent{background-color:transparent!important}.border{border:1px solid #dee2e6!important}.border-top{border-top:1px solid #dee2e6!important}.border-right{border-right:1px solid #dee2e6!important}.border-bottom{border-bottom:1px solid var(--mediumgray-default-color)!important}.border-left{border-left:1px solid #dee2e6!important}.border-0{border:0!important}.border-top-0{border-top:0!important}.border-right-0{border-right:0!important}.border-bottom-0{border-bottom:0!important}.border-left-0{border-left:0!important}.border-primary{border-color:#006!important}.border-secondary{border-color:#6c757d!important}.border-success{border-color:#81bf5d!important}.border-info{border-color:#15359a!important}.border-warning{border-color:#ff9e15!important}.border-danger{border-color:#dc3545!important}.border-light{border-color:#f8f9fa!important}.border-dark{border-color:#222!important}.border-lightgray{border-color:var(--border-color)!important}.border-mediumgray{border-color:#f3f2f7!important}.border-midgray{border-color:#a5a5a5!important}.border-white{border-color:#fff!important}.border-mediumgraylight{border-color:#ced4da!important}.border-light-green{border-color:var(--light-green-color)!important}.border-darkgray{border-color:var(--darkgray-color)!important}.rounded{border-radius:3px!important}.rounded-top{border-top-left-radius:3px!important;border-top-right-radius:3px!important}.rounded-right{border-top-right-radius:3px!important;border-bottom-right-radius:3px!important}.rounded-bottom{border-bottom-right-radius:3px!important;border-bottom-left-radius:3px!important}.rounded-left{border-top-left-radius:3px!important;border-bottom-left-radius:3px!important}.rounded-pill{border-radius:50rem!important}.rounded-circle{border-radius:50%!important}.rounded-0{border-radius:0!important}.clearfix::after{display:block;clear:both;content:""}.d-none{display:none!important}.d-inline{display:inline!important}.d-inline-block{display:inline-block!important}.d-block{display:block!important}.d-table{display:table!important}.d-table-row{display:table-row!important}.d-table-cell{display:table-cell!important}.d-flex{display:flex!important}.d-inline-flex{display:inline-flex!important}@media (min-width:576px){.d-sm-none{display:none!important}.d-sm-inline{display:inline!important}.d-sm-inline-block{display:inline-block!important}.d-sm-block{display:block!important}.d-sm-table{display:table!important}.d-sm-table-row{display:table-row!important}.d-sm-table-cell{display:table-cell!important}.d-sm-flex{display:flex!important}.d-sm-inline-flex{display:inline-flex!important}}@media (min-width:768px){.d-md-none{display:none!important}.d-md-inline{display:inline!important}.d-md-inline-block{display:inline-block!important}.d-md-block{display:block!important}.d-md-table{display:table!important}.d-md-table-row{display:table-row!important}.d-md-table-cell{display:table-cell!important}.d-md-flex{display:flex!important}.d-md-inline-flex{display:inline-flex!important}}@media (min-width:992px){.d-lg-none{display:none!important}.d-lg-inline{display:inline!important}.d-lg-inline-block{display:inline-block!important}.d-lg-block{display:block!important}.d-lg-table{display:table!important}.d-lg-table-row{display:table-row!important}.d-lg-table-cell{display:table-cell!important}.d-lg-flex{display:flex!important}.d-lg-inline-flex{display:inline-flex!important}}@media (min-width:1200px){.d-xl-none{display:none!important}.d-xl-inline{display:inline!important}.d-xl-inline-block{display:inline-block!important}.d-xl-block{display:block!important}.d-xl-table{display:table!important}.d-xl-table-row{display:table-row!important}.d-xl-table-cell{display:table-cell!important}.d-xl-flex{display:flex!important}.d-xl-inline-flex{display:inline-flex!important}}@media print{.d-print-none{display:none!important}.d-print-inline{display:inline!important}.d-print-inline-block{display:inline-block!important}.d-print-block{display:block!important}.d-print-table{display:table!important}.d-print-table-row{display:table-row!important}.d-print-table-cell{display:table-cell!important}.d-print-flex{display:flex!important}.d-print-inline-flex{display:inline-flex!important}}.embed-responsive{position:relative;display:block;width:100%;padding:0;overflow:hidden}.embed-responsive::before{display:block;content:""}.embed-responsive .embed-responsive-item,.embed-responsive iframe,.embed-responsive embed,.embed-responsive object,.embed-responsive video{position:absolute;top:0;bottom:0;left:0;width:100%;height:100%;border:0}.embed-responsive-21by9::before{padding-top:42.85714%}.embed-responsive-16by9::before{padding-top:56.25%}.embed-responsive-4by3::before{padding-top:75%}.embed-responsive-1by1::before{padding-top:100%}.flex-row{flex-direction:row!important}.flex-column{flex-direction:column!important}.flex-row-reverse{flex-direction:row-reverse!important}.flex-column-reverse{flex-direction:column-reverse!important}.flex-wrap{flex-wrap:wrap!important}.flex-nowrap{flex-wrap:nowrap!important}.flex-wrap-reverse{flex-wrap:wrap-reverse!important}.flex-fill{flex:1 1 auto!important}.flex-grow-0{flex-grow:0!important}.flex-grow-1{flex-grow:1!important}.flex-shrink-0{flex-shrink:0!important}.flex-shrink-1{flex-shrink:1!important}.justify-content-start{justify-content:flex-start!important}.justify-content-end{justify-content:flex-end!important}.justify-content-center{justify-content:center!important}.justify-content-between{justify-content:space-between!important}.justify-content-around{justify-content:space-around!important}.align-items-start{align-items:flex-start!important}.align-items-end{align-items:flex-end!important}.align-items-center{align-items:center!important}.align-items-baseline{align-items:baseline!important}.align-items-stretch{align-items:stretch!important}.align-content-start{align-content:flex-start!important}.align-content-end{align-content:flex-end!important}.align-content-center{align-content:center!important}.align-content-between{align-content:space-between!important}.align-content-around{align-content:space-around!important}.align-content-stretch{align-content:stretch!important}.align-self-auto{align-self:auto!important}.align-self-start{align-self:flex-start!important}.align-self-end{align-self:flex-end!important}.align-self-center{align-self:center!important}.align-self-baseline{align-self:baseline!important}.align-self-stretch{align-self:stretch!important}@media (min-width:576px){.flex-sm-row{flex-direction:row!important}.flex-sm-column{flex-direction:column!important}.flex-sm-row-reverse{flex-direction:row-reverse!important}.flex-sm-column-reverse{flex-direction:column-reverse!important}.flex-sm-wrap{flex-wrap:wrap!important}.flex-sm-nowrap{flex-wrap:nowrap!important}.flex-sm-wrap-reverse{flex-wrap:wrap-reverse!important}.flex-sm-fill{flex:1 1 auto!important}.flex-sm-grow-0{flex-grow:0!important}.flex-sm-grow-1{flex-grow:1!important}.flex-sm-shrink-0{flex-shrink:0!important}.flex-sm-shrink-1{flex-shrink:1!important}.justify-content-sm-start{justify-content:flex-start!important}.justify-content-sm-end{justify-content:flex-end!important}.justify-content-sm-center{justify-content:center!important}.justify-content-sm-between{justify-content:space-between!important}.justify-content-sm-around{justify-content:space-around!important}.align-items-sm-start{align-items:flex-start!important}.align-items-sm-end{align-items:flex-end!important}.align-items-sm-center{align-items:center!important}.align-items-sm-baseline{align-items:baseline!important}.align-items-sm-stretch{align-items:stretch!important}.align-content-sm-start{align-content:flex-start!important}.align-content-sm-end{align-content:flex-end!important}.align-content-sm-center{align-content:center!important}.align-content-sm-between{align-content:space-between!important}.align-content-sm-around{align-content:space-around!important}.align-content-sm-stretch{align-content:stretch!important}.align-self-sm-auto{align-self:auto!important}.align-self-sm-start{align-self:flex-start!important}.align-self-sm-end{align-self:flex-end!important}.align-self-sm-center{align-self:center!important}.align-self-sm-baseline{align-self:baseline!important}.align-self-sm-stretch{align-self:stretch!important}}@media (min-width:768px){.flex-md-row{flex-direction:row!important}.flex-md-column{flex-direction:column!important}.flex-md-row-reverse{flex-direction:row-reverse!important}.flex-md-column-reverse{flex-direction:column-reverse!important}.flex-md-wrap{flex-wrap:wrap!important}.flex-md-nowrap{flex-wrap:nowrap!important}.flex-md-wrap-reverse{flex-wrap:wrap-reverse!important}.flex-md-fill{flex:1 1 auto!important}.flex-md-grow-0{flex-grow:0!important}.flex-md-grow-1{flex-grow:1!important}.flex-md-shrink-0{flex-shrink:0!important}.flex-md-shrink-1{flex-shrink:1!important}.justify-content-md-start{justify-content:flex-start!important}.justify-content-md-end{justify-content:flex-end!important}.justify-content-md-center{justify-content:center!important}.justify-content-md-between{justify-content:space-between!important}.justify-content-md-around{justify-content:space-around!important}.align-items-md-start{align-items:flex-start!important}.align-items-md-end{align-items:flex-end!important}.align-items-md-center{align-items:center!important}.align-items-md-baseline{align-items:baseline!important}.align-items-md-stretch{align-items:stretch!important}.align-content-md-start{align-content:flex-start!important}.align-content-md-end{align-content:flex-end!important}.align-content-md-center{align-content:center!important}.align-content-md-between{align-content:space-between!important}.align-content-md-around{align-content:space-around!important}.align-content-md-stretch{align-content:stretch!important}.align-self-md-auto{align-self:auto!important}.align-self-md-start{align-self:flex-start!important}.align-self-md-end{align-self:flex-end!important}.align-self-md-center{align-self:center!important}.align-self-md-baseline{align-self:baseline!important}.align-self-md-stretch{align-self:stretch!important}}@media (min-width:992px){.flex-lg-row{flex-direction:row!important}.flex-lg-column{flex-direction:column!important}.flex-lg-row-reverse{flex-direction:row-reverse!important}.flex-lg-column-reverse{flex-direction:column-reverse!important}.flex-lg-wrap{flex-wrap:wrap!important}.flex-lg-nowrap{flex-wrap:nowrap!important}.flex-lg-wrap-reverse{flex-wrap:wrap-reverse!important}.flex-lg-fill{flex:1 1 auto!important}.flex-lg-grow-0{flex-grow:0!important}.flex-lg-grow-1{flex-grow:1!important}.flex-lg-shrink-0{flex-shrink:0!important}.flex-lg-shrink-1{flex-shrink:1!important}.justify-content-lg-start{justify-content:flex-start!important}.justify-content-lg-end{justify-content:flex-end!important}.justify-content-lg-center{justify-content:center!important}.justify-content-lg-between{justify-content:space-between!important}.justify-content-lg-around{justify-content:space-around!important}.align-items-lg-start{align-items:flex-start!important}.align-items-lg-end{align-items:flex-end!important}.align-items-lg-center{align-items:center!important}.align-items-lg-baseline{align-items:baseline!important}.align-items-lg-stretch{align-items:stretch!important}.align-content-lg-start{align-content:flex-start!important}.align-content-lg-end{align-content:flex-end!important}.align-content-lg-center{align-content:center!important}.align-content-lg-between{align-content:space-between!important}.align-content-lg-around{align-content:space-around!important}.align-content-lg-stretch{align-content:stretch!important}.align-self-lg-auto{align-self:auto!important}.align-self-lg-start{align-self:flex-start!important}.align-self-lg-end{align-self:flex-end!important}.align-self-lg-center{align-self:center!important}.align-self-lg-baseline{align-self:baseline!important}.align-self-lg-stretch{align-self:stretch!important}}@media (min-width:1200px){.flex-xl-row{flex-direction:row!important}.flex-xl-column{flex-direction:column!important}.flex-xl-row-reverse{flex-direction:row-reverse!important}.flex-xl-column-reverse{flex-direction:column-reverse!important}.flex-xl-wrap{flex-wrap:wrap!important}.flex-xl-nowrap{flex-wrap:nowrap!important}.flex-xl-wrap-reverse{flex-wrap:wrap-reverse!important}.flex-xl-fill{flex:1 1 auto!important}.flex-xl-grow-0{flex-grow:0!important}.flex-xl-grow-1{flex-grow:1!important}.flex-xl-shrink-0{flex-shrink:0!important}.flex-xl-shrink-1{flex-shrink:1!important}.justify-content-xl-start{justify-content:flex-start!important}.justify-content-xl-end{justify-content:flex-end!important}.justify-content-xl-center{justify-content:center!important}.justify-content-xl-between{justify-content:space-between!important}.justify-content-xl-around{justify-content:space-around!important}.align-items-xl-start{align-items:flex-start!important}.align-items-xl-end{align-items:flex-end!important}.align-items-xl-center{align-items:center!important}.align-items-xl-baseline{align-items:baseline!important}.align-items-xl-stretch{align-items:stretch!important}.align-content-xl-start{align-content:flex-start!important}.align-content-xl-end{align-content:flex-end!important}.align-content-xl-center{align-content:center!important}.align-content-xl-between{align-content:space-between!important}.align-content-xl-around{align-content:space-around!important}.align-content-xl-stretch{align-content:stretch!important}.align-self-xl-auto{align-self:auto!important}.align-self-xl-start{align-self:flex-start!important}.align-self-xl-end{align-self:flex-end!important}.align-self-xl-center{align-self:center!important}.align-self-xl-baseline{align-self:baseline!important}.align-self-xl-stretch{align-self:stretch!important}}.float-left{float:left!important}.float-right{float:right!important}.float-none{float:none!important}@media (min-width:576px){.float-sm-left{float:left!important}.float-sm-right{float:right!important}.float-sm-none{float:none!important}}@media (min-width:768px){.float-md-left{float:left!important}.float-md-right{float:right!important}.float-md-none{float:none!important}}@media (min-width:992px){.float-lg-left{float:left!important}.float-lg-right{float:right!important}.float-lg-none{float:none!important}}@media (min-width:1200px){.float-xl-left{float:left!important}.float-xl-right{float:right!important}.float-xl-none{float:none!important}}.position-static{position:static!important}.position-relative{position:relative!important}.position-absolute{position:absolute!important}.position-fixed{position:fixed!important}.position-sticky{position:sticky!important}.fixed-top{position:fixed;top:0;right:0;left:0;z-index:1020}.fixed-bottom{position:fixed;right:0;bottom:0;left:0;z-index:1030}@supports ((position:-webkit-sticky) or (position:sticky)){.sticky-top{position:-webkit-sticky;position:sticky;top:0;z-index:1020}}.sr-only{position:absolute;width:1px;height:1px;padding:0;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}.sr-only-focusable:active,.sr-only-focusable:focus{position:static;width:auto;height:auto;overflow:visible;clip:auto;white-space:normal}.shadow-sm{box-shadow:0 .125rem .25rem rgba(0,0,0,.075)!important}.shadow{box-shadow:0 .5rem 1rem rgba(0,0,0,.15)!important}.shadow-lg{box-shadow:0 1rem 3rem rgba(0,0,0,.175)!important}.shadow-none{box-shadow:none!important}.w-25{width:25%!important}.w-50{width:50%!important}.w-75{width:75%!important}.w-100{width:100%!important}.w-auto{width:auto!important}.h-25{height:25%!important}.h-50{height:50%!important}.h-75{height:75%!important}.h-100{height:100%!important}.h-auto{height:auto!important}.mw-100{max-width:100%!important}.mh-100{max-height:100%!important}.m-0{margin:0!important}.mt-0,.my-0{margin-top:0!important}.mr-0,.mx-0{margin-right:0!important}.mb-0,.my-0{margin-bottom:0!important}.ml-0,.mx-0{margin-left:0!important}.m-1{margin:.25rem!important}.mt-1,.my-1{margin-top:.25rem!important}.mr-1,.mx-1{margin-right:.25rem!important}.mb-1,.my-1{margin-bottom:.25rem!important}.ml-1,.mx-1{margin-left:.25rem!important}.m-2{margin:.5rem!important}.mt-2,.my-2{margin-top:.5rem!important}.mr-2,.mx-2{margin-right:.5rem!important}.mb-2,.my-2{margin-bottom:.5rem!important}.ml-2,.mx-2{margin-left:.5rem!important}.m-3{margin:1rem!important}.mt-3,.my-3{margin-top:1rem!important}.mr-3,.mx-3{margin-right:1rem!important}.mb-3,.my-3{margin-bottom:1rem!important}.ml-3,.mx-3{margin-left:1rem!important}.m-4{margin:1.5rem!important}.mt-4,.my-4{margin-top:1.5rem!important}.mr-4,.mx-4{margin-right:1.5rem!important}.mb-4,.my-4{margin-bottom:1.5rem!important}.ml-4,.mx-4{margin-left:1.5rem!important}.m-5{margin:3rem!important}.mt-5,.my-5{margin-top:3rem!important}.mr-5,.mx-5{margin-right:3rem!important}.mb-5,.my-5{margin-bottom:3rem!important}.ml-5,.mx-5{margin-left:3rem!important}.p-0{padding:0!important}.pt-0,.py-0{padding-top:0!important}.pr-0,.px-0{padding-right:0!important}.pb-0,.py-0{padding-bottom:0!important}.pl-0,.px-0{padding-left:0!important}.p-1{padding:.25rem!important}.pt-1,.py-1{padding-top:.25rem!important}.pr-1,.px-1{padding-right:.25rem!important}.pb-1,.py-1{padding-bottom:.25rem!important}.pl-1,.px-1{padding-left:.25rem!important}.p-2{padding:.5rem!important}.pt-2,.py-2{padding-top:.5rem!important}.pr-2,.px-2{padding-right:.5rem!important}.pb-2,.py-2{padding-bottom:.5rem!important}.pl-2,.px-2{padding-left:.5rem!important}.p-3{padding:1rem!important}.pt-3,.py-3{padding-top:1rem!important}.pr-3,.px-3{padding-right:1rem!important}.pb-3,.py-3{padding-bottom:1rem!important}.pl-3,.px-3{padding-left:1rem!important}.p-4{padding:1.5rem!important}.pt-4,.py-4{padding-top:1.5rem!important}.pr-4,.px-4{padding-right:1.5rem!important}.pb-4,.py-4{padding-bottom:1.5rem!important}.pl-4,.px-4{padding-left:1.5rem!important}.p-5{padding:3rem!important}.pt-5,.py-5{padding-top:3rem!important}.pr-5,.px-5{padding-right:3rem!important}.pb-5,.py-5{padding-bottom:3rem!important}.pl-5,.px-5{padding-left:3rem!important}.p-6{padding:2rem!important}.pt-6,.py-6{padding-top:2rem!important}.pr-6,.px-6{padding-right:2rem!important}.pb-6,.py-6{padding-bottom:2rem!important}.pl-6,.px-6{padding-left:2rem!important}.m-auto{margin:auto!important}.mt-auto,.my-auto{margin-top:auto!important}.mr-auto,.mx-auto{margin-right:auto!important}.mb-auto,.my-auto{margin-bottom:auto!important}.ml-auto,.mx-auto{margin-left:auto!important}@media (min-width:576px){.m-sm-0{margin:0!important}.mt-sm-0,.my-sm-0{margin-top:0!important}.mr-sm-0,.mx-sm-0{margin-right:0!important}.mb-sm-0,.my-sm-0{margin-bottom:0!important}.ml-sm-0,.mx-sm-0{margin-left:0!important}.m-sm-1{margin:.25rem!important}.mt-sm-1,.my-sm-1{margin-top:.25rem!important}.mr-sm-1,.mx-sm-1{margin-right:.25rem!important}.mb-sm-1,.my-sm-1{margin-bottom:.25rem!important}.ml-sm-1,.mx-sm-1{margin-left:.25rem!important}.m-sm-2{margin:.5rem!important}.mt-sm-2,.my-sm-2{margin-top:.5rem!important}.mr-sm-2,.mx-sm-2{margin-right:.5rem!important}.mb-sm-2,.my-sm-2{margin-bottom:.5rem!important}.ml-sm-2,.mx-sm-2{margin-left:.5rem!important}.m-sm-3{margin:1rem!important}.mt-sm-3,.my-sm-3{margin-top:1rem!important}.mr-sm-3,.mx-sm-3{margin-right:1rem!important}.mb-sm-3,.my-sm-3{margin-bottom:1rem!important}.ml-sm-3,.mx-sm-3{margin-left:1rem!important}.m-sm-4{margin:1.5rem!important}.mt-sm-4,.my-sm-4{margin-top:1.5rem!important}.mr-sm-4,.mx-sm-4{margin-right:1.5rem!important}.mb-sm-4,.my-sm-4{margin-bottom:1.5rem!important}.ml-sm-4,.mx-sm-4{margin-left:1.5rem!important}.m-sm-5{margin:3rem!important}.mt-sm-5,.my-sm-5{margin-top:3rem!important}.mr-sm-5,.mx-sm-5{margin-right:3rem!important}.mb-sm-5,.my-sm-5{margin-bottom:3rem!important}.ml-sm-5,.mx-sm-5{margin-left:3rem!important}.p-sm-0{padding:0!important}.pt-sm-0,.py-sm-0{padding-top:0!important}.pr-sm-0,.px-sm-0{padding-right:0!important}.pb-sm-0,.py-sm-0{padding-bottom:0!important}.pl-sm-0,.px-sm-0{padding-left:0!important}.p-sm-1{padding:.25rem!important}.pt-sm-1,.py-sm-1{padding-top:.25rem!important}.pr-sm-1,.px-sm-1{padding-right:.25rem!important}.pb-sm-1,.py-sm-1{padding-bottom:.25rem!important}.pl-sm-1,.px-sm-1{padding-left:.25rem!important}.p-sm-2{padding:.5rem!important}.pt-sm-2,.py-sm-2{padding-top:.5rem!important}.pr-sm-2,.px-sm-2{padding-right:.5rem!important}.pb-sm-2,.py-sm-2{padding-bottom:.5rem!important}.pl-sm-2,.px-sm-2{padding-left:.5rem!important}.p-sm-3{padding:1rem!important}.pt-sm-3,.py-sm-3{padding-top:1rem!important}.pr-sm-3,.px-sm-3{padding-right:1rem!important}.pb-sm-3,.py-sm-3{padding-bottom:1rem!important}.pl-sm-3,.px-sm-3{padding-left:1rem!important}.p-sm-4{padding:1.5rem!important}.pt-sm-4,.py-sm-4{padding-top:1.5rem!important}.pr-sm-4,.px-sm-4{padding-right:1.5rem!important}.pb-sm-4,.py-sm-4{padding-bottom:1.5rem!important}.pl-sm-4,.px-sm-4{padding-left:1.5rem!important}.p-sm-5{padding:3rem!important}.pt-sm-5,.py-sm-5{padding-top:3rem!important}.pr-sm-5,.px-sm-5{padding-right:3rem!important}.pb-sm-5,.py-sm-5{padding-bottom:3rem!important}.pl-sm-5,.px-sm-5{padding-left:3rem!important}.m-sm-auto{margin:auto!important}.mt-sm-auto,.my-sm-auto{margin-top:auto!important}.mr-sm-auto,.mx-sm-auto{margin-right:auto!important}.mb-sm-auto,.my-sm-auto{margin-bottom:auto!important}.ml-sm-auto,.mx-sm-auto{margin-left:auto!important}}@media (min-width:768px){.m-md-0{margin:0!important}.mt-md-0,.my-md-0{margin-top:0!important}.mr-md-0,.mx-md-0{margin-right:0!important}.mb-md-0,.my-md-0{margin-bottom:0!important}.ml-md-0,.mx-md-0{margin-left:0!important}.m-md-1{margin:.25rem!important}.mt-md-1,.my-md-1{margin-top:.25rem!important}.mr-md-1,.mx-md-1{margin-right:.25rem!important}.mb-md-1,.my-md-1{margin-bottom:.25rem!important}.ml-md-1,.mx-md-1{margin-left:.25rem!important}.m-md-2{margin:.5rem!important}.mt-md-2,.my-md-2{margin-top:.5rem!important}.mr-md-2,.mx-md-2{margin-right:.5rem!important}.mb-md-2,.my-md-2{margin-bottom:.5rem!important}.ml-md-2,.mx-md-2{margin-left:.5rem!important}.m-md-3{margin:1rem!important}.mt-md-3,.my-md-3{margin-top:1rem!important}.mr-md-3,.mx-md-3{margin-right:1rem!important}.mb-md-3,.my-md-3{margin-bottom:1rem!important}.ml-md-3,.mx-md-3{margin-left:1rem!important}.m-md-4{margin:1.5rem!important}.mt-md-4,.my-md-4{margin-top:1.5rem!important}.mr-md-4,.mx-md-4{margin-right:1.5rem!important}.mb-md-4,.my-md-4{margin-bottom:1.5rem!important}.ml-md-4,.mx-md-4{margin-left:1.5rem!important}.m-md-5{margin:3rem!important}.mt-md-5,.my-md-5{margin-top:3rem!important}.mr-md-5,.mx-md-5{margin-right:3rem!important}.mb-md-5,.my-md-5{margin-bottom:3rem!important}.ml-md-5,.mx-md-5{margin-left:3rem!important}.p-md-0{padding:0!important}.pt-md-0,.py-md-0{padding-top:0!important}.pr-md-0,.px-md-0{padding-right:0!important}.pb-md-0,.py-md-0{padding-bottom:0!important}.pl-md-0,.px-md-0{padding-left:0!important}.p-md-1{padding:.25rem!important}.pt-md-1,.py-md-1{padding-top:.25rem!important}.pr-md-1,.px-md-1{padding-right:.25rem!important}.pb-md-1,.py-md-1{padding-bottom:.25rem!important}.pl-md-1,.px-md-1{padding-left:.25rem!important}.p-md-2{padding:.5rem!important}.pt-md-2,.py-md-2{padding-top:.5rem!important}.pr-md-2,.px-md-2{padding-right:.5rem!important}.pb-md-2,.py-md-2{padding-bottom:.5rem!important}.pl-md-2,.px-md-2{padding-left:.5rem!important}.p-md-3{padding:1rem!important}.pt-md-3,.py-md-3{padding-top:1rem!important}.pr-md-3,.px-md-3{padding-right:1rem!important}.pb-md-3,.py-md-3{padding-bottom:1rem!important}.pl-md-3,.px-md-3{padding-left:1rem!important}.p-md-4{padding:1.5rem!important}.pt-md-4,.py-md-4{padding-top:1.5rem!important}.pr-md-4,.px-md-4{padding-right:1.5rem!important}.pb-md-4,.py-md-4{padding-bottom:1.5rem!important}.pl-md-4,.px-md-4{padding-left:1.5rem!important}.p-md-5{padding:3rem!important}.pt-md-5,.py-md-5{padding-top:3rem!important}.pr-md-5,.px-md-5{padding-right:3rem!important}.pb-md-5,.py-md-5{padding-bottom:3rem!important}.pl-md-5,.px-md-5{padding-left:3rem!important}.m-md-auto{margin:auto!important}.mt-md-auto,.my-md-auto{margin-top:auto!important}.mr-md-auto,.mx-md-auto{margin-right:auto!important}.mb-md-auto,.my-md-auto{margin-bottom:auto!important}.ml-md-auto,.mx-md-auto{margin-left:auto!important}.mx-md-row{margin-right:-7.5px!important;margin-left:-7.5px!important}.px-md-col{padding-right:7.5px!important;padding-left:7.5px!important}}@media (min-width:992px){.m-lg-0{margin:0!important}.mt-lg-0,.my-lg-0{margin-top:0!important}.mr-lg-0,.mx-lg-0{margin-right:0!important}.mb-lg-0,.my-lg-0{margin-bottom:0!important}.ml-lg-0,.mx-lg-0{margin-left:0!important}.m-lg-1{margin:.25rem!important}.mt-lg-1,.my-lg-1{margin-top:.25rem!important}.mr-lg-1,.mx-lg-1{margin-right:.25rem!important}.mb-lg-1,.my-lg-1{margin-bottom:.25rem!important}.ml-lg-1,.mx-lg-1{margin-left:.25rem!important}.m-lg-2{margin:.5rem!important}.mt-lg-2,.my-lg-2{margin-top:.5rem!important}.mr-lg-2,.mx-lg-2{margin-right:.5rem!important}.mb-lg-2,.my-lg-2{margin-bottom:.5rem!important}.ml-lg-2,.mx-lg-2{margin-left:.5rem!important}.m-lg-3{margin:1rem!important}.mt-lg-3,.my-lg-3{margin-top:1rem!important}.mr-lg-3,.mx-lg-3{margin-right:1rem!important}.mb-lg-3,.my-lg-3{margin-bottom:1rem!important}.ml-lg-3,.mx-lg-3{margin-left:1rem!important}.m-lg-4{margin:1.5rem!important}.mt-lg-4,.my-lg-4{margin-top:1.5rem!important}.mr-lg-4,.mx-lg-4{margin-right:1.5rem!important}.mb-lg-4,.my-lg-4{margin-bottom:1.5rem!important}.ml-lg-4,.mx-lg-4{margin-left:1.5rem!important}.m-lg-5{margin:3rem!important}.mt-lg-5,.my-lg-5{margin-top:3rem!important}.mr-lg-5,.mx-lg-5{margin-right:3rem!important}.mb-lg-5,.my-lg-5{margin-bottom:3rem!important}.ml-lg-5,.mx-lg-5{margin-left:3rem!important}.p-lg-0{padding:0!important}.pt-lg-0,.py-lg-0{padding-top:0!important}.pr-lg-0,.px-lg-0{padding-right:0!important}.pb-lg-0,.py-lg-0{padding-bottom:0!important}.pl-lg-0,.px-lg-0{padding-left:0!important}.p-lg-1{padding:.25rem!important}.pt-lg-1,.py-lg-1{padding-top:.25rem!important}.pr-lg-1,.px-lg-1{padding-right:.25rem!important}.pb-lg-1,.py-lg-1{padding-bottom:.25rem!important}.pl-lg-1,.px-lg-1{padding-left:.25rem!important}.p-lg-2{padding:.5rem!important}.pt-lg-2,.py-lg-2{padding-top:.5rem!important}.pr-lg-2,.px-lg-2{padding-right:.5rem!important}.pb-lg-2,.py-lg-2{padding-bottom:.5rem!important}.pl-lg-2,.px-lg-2{padding-left:.5rem!important}.p-lg-3{padding:1rem!important}.pt-lg-3,.py-lg-3{padding-top:1rem!important}.pr-lg-3,.px-lg-3{padding-right:1rem!important}.pb-lg-3,.py-lg-3{padding-bottom:1rem!important}.pl-lg-3,.px-lg-3{padding-left:1rem!important}.p-lg-4{padding:1.5rem!important}.pt-lg-4,.py-lg-4{padding-top:1.5rem!important}.pr-lg-4,.px-lg-4{padding-right:1.5rem!important}.pb-lg-4,.py-lg-4{padding-bottom:1.5rem!important}.pl-lg-4,.px-lg-4{padding-left:1.5rem!important}.p-lg-5{padding:3rem!important}.pt-lg-5,.py-lg-5{padding-top:3rem!important}.pr-lg-5,.px-lg-5{padding-right:3rem!important}.pb-lg-5,.py-lg-5{padding-bottom:3rem!important}.pl-lg-5,.px-lg-5{padding-left:3rem!important}.m-lg-auto{margin:auto!important}.mt-lg-auto,.my-lg-auto{margin-top:auto!important}.mr-lg-auto,.mx-lg-auto{margin-right:auto!important}.mb-lg-auto,.my-lg-auto{margin-bottom:auto!important}.ml-lg-auto,.mx-lg-auto{margin-left:auto!important}}@media (min-width:1200px){.m-xl-0{margin:0!important}.mt-xl-0,.my-xl-0{margin-top:0!important}.mr-xl-0,.mx-xl-0{margin-right:0!important}.mb-xl-0,.my-xl-0{margin-bottom:0!important}.ml-xl-0,.mx-xl-0{margin-left:0!important}.m-xl-1{margin:.25rem!important}.mt-xl-1,.my-xl-1{margin-top:.25rem!important}.mr-xl-1,.mx-xl-1{margin-right:.25rem!important}.mb-xl-1,.my-xl-1{margin-bottom:.25rem!important}.ml-xl-1,.mx-xl-1{margin-left:.25rem!important}.m-xl-2{margin:.5rem!important}.mt-xl-2,.my-xl-2{margin-top:.5rem!important}.mr-xl-2,.mx-xl-2{margin-right:.5rem!important}.mb-xl-2,.my-xl-2{margin-bottom:.5rem!important}.ml-xl-2,.mx-xl-2{margin-left:.5rem!important}.m-xl-3{margin:1rem!important}.mt-xl-3,.my-xl-3{margin-top:1rem!important}.mr-xl-3,.mx-xl-3{margin-right:1rem!important}.mb-xl-3,.my-xl-3{margin-bottom:1rem!important}.ml-xl-3,.mx-xl-3{margin-left:1rem!important}.m-xl-4{margin:1.5rem!important}.mt-xl-4,.my-xl-4{margin-top:1.5rem!important}.mr-xl-4,.mx-xl-4{margin-right:1.5rem!important}.mb-xl-4,.my-xl-4{margin-bottom:1.5rem!important}.ml-xl-4,.mx-xl-4{margin-left:1.5rem!important}.m-xl-5{margin:3rem!important}.mt-xl-5,.my-xl-5{margin-top:3rem!important}.mr-xl-5,.mx-xl-5{margin-right:3rem!important}.mb-xl-5,.my-xl-5{margin-bottom:3rem!important}.ml-xl-5,.mx-xl-5{margin-left:3rem!important}.p-xl-0{padding:0!important}.pt-xl-0,.py-xl-0{padding-top:0!important}.pr-xl-0,.px-xl-0{padding-right:0!important}.pb-xl-0,.py-xl-0{padding-bottom:0!important}.pl-xl-0,.px-xl-0{padding-left:0!important}.p-xl-1{padding:.25rem!important}.pt-xl-1,.py-xl-1{padding-top:.25rem!important}.pr-xl-1,.px-xl-1{padding-right:.25rem!important}.pb-xl-1,.py-xl-1{padding-bottom:.25rem!important}.pl-xl-1,.px-xl-1{padding-left:.25rem!important}.p-xl-2{padding:.5rem!important}.pt-xl-2,.py-xl-2{padding-top:.5rem!important}.pr-xl-2,.px-xl-2{padding-right:.5rem!important}.pb-xl-2,.py-xl-2{padding-bottom:.5rem!important}.pl-xl-2,.px-xl-2{padding-left:.5rem!important}.p-xl-3{padding:1rem!important}.pt-xl-3,.py-xl-3{padding-top:1rem!important}.pr-xl-3,.px-xl-3{padding-right:1rem!important}.pb-xl-3,.py-xl-3{padding-bottom:1rem!important}.pl-xl-3,.px-xl-3{padding-left:1rem!important}.p-xl-4{padding:1.5rem!important}.pt-xl-4,.py-xl-4{padding-top:1.5rem!important}.pr-xl-4,.px-xl-4{padding-right:1.5rem!important}.pb-xl-4,.py-xl-4{padding-bottom:1.5rem!important}.pl-xl-4,.px-xl-4{padding-left:1.5rem!important}.p-xl-5{padding:3rem!important}.pt-xl-5,.py-xl-5{padding-top:3rem!important}.pr-xl-5,.px-xl-5{padding-right:3rem!important}.pb-xl-5,.py-xl-5{padding-bottom:3rem!important}.pl-xl-5,.px-xl-5{padding-left:3rem!important}.m-xl-auto{margin:auto!important}.mt-xl-auto,.my-xl-auto{margin-top:auto!important}.mr-xl-auto,.mx-xl-auto{margin-right:auto!important}.mb-xl-auto,.my-xl-auto{margin-bottom:auto!important}.ml-xl-auto,.mx-xl-auto{margin-left:auto!important}}.text-monospace{font-family:SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace}.text-justify{text-align:justify!important}.text-nowrap{white-space:nowrap!important}.text-truncate{overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.text-left{text-align:left!important}.text-right{text-align:right!important}.text-center{text-align:center!important}@media (min-width:576px){.text-sm-left{text-align:left!important}.text-sm-right{text-align:right!important}.text-sm-center{text-align:center!important}}@media (min-width:768px){.text-md-left{text-align:left!important}.text-md-right{text-align:right!important}.text-md-center{text-align:center!important}.bg-md-white{background:#fff!important}}@media (min-width:992px){.text-lg-left{text-align:left!important}.text-lg-right{text-align:right!important}.text-lg-center{text-align:center!important}}@media (min-width:1200px){.text-xl-left{text-align:left!important}.text-xl-right{text-align:right!important}.text-xl-center{text-align:center!important}}.text-lowercase{text-transform:lowercase!important}.text-uppercase{text-transform:uppercase!important}.text-capitalize{text-transform:capitalize!important}.font-weight-light{font-weight:300!important}.font-weight-normal{font-weight:400!important}.font-weight-medium{font-weight:600!important}.font-weight-bold{font-weight:700!important}.font-italic{font-style:italic!important}.text-white{color:#fff!important}.text-primary{color:var(--primary-color)!important}a.text-primary:hover,a.text-primary:focus{color:#003!important}.text-primary-dark{color:var(--primary-dark-color)!important}a.text-primary-dark:hover,a.text-primary-dark:focus{color:var(--primary-color)!important}.text-secondary{color:#6c757d!important}a.text-secondary:hover,a.text-secondary:focus{color:#545b62!important}.text-success{color:#2a872e!important}a.text-success:hover,a.text-success:focus{color:#67a742!important}.text-info{color:#15359a!important}a.text-info:hover,a.text-info:focus{color:#0f266d!important}.text-warning{color:var(--warning-color)!important}a.text-warning:hover,a.text-warning:focus{color:#e18400!important}.text-danger{color:#dc3545!important}a.text-danger:hover,a.text-danger:focus{color:#bd2130!important}.text-light{color:#f8f9fa!important}a.text-light:hover,a.text-light:focus{color:#dae0e5!important}.text-dark{color:var(--dark-color)!important}a.text-dark:hover,a.text-dark:focus{color:#090909!important}.text-lightgray{color:#f5f5f5!important}a.text-lightgray:hover,a.text-lightgray:focus{color:#dcdcdc!important}.text-mediumgray{color:#f3f2f7!important}a.text-mediumgray:hover,a.text-mediumgray:focus{color:#d6d2e4!important}.text-midgray{color:#a5a5a5!important}a.text-midgray:hover,a.text-midgray:focus{color:#8c8c8c!important}.text-darkgray{color:var(--darkgray-color)!important}a.text-darkgray:hover,a.text-darkgray:focus{color:var(--darkgray-color)!important}.text-light-green{color:var(--light-green-color)!important}a.text-light-green:hover,a.text-light-green:focus{color:var(--light-green-color)!important}.text-body{color:var(--dark-color)!important}.text-muted{color:var(--muted-color-2)!important}a.text-muted:hover,a.text-muted:focus{color:var(--primary-color)!important}.text-dark-muted{color:var(--dark-muted-color)!important}a.text-dark-muted:hover,a.text-dark-muted:focus{color:var(--primary-color)!important}.text-indianred{color:var(--indianred-color)!important}a.text-indianred:hover,a.text-indianred:focus{color:var(--primary-color)!important}.text-light-muted{color:var(--light-muted-color)!important}a.text-light-muted:hover,a.text-light-muted:focus{color:var(--primary-color)!important}.text-black-50{color:rgba(0,0,0,.5)!important}.text-white-50{color:rgba(255,255,255,.5)!important}.text-white-70{color:rgba(255,255,255,.7)!important}.text-available{color:#2a872e!important}.text-hide{font:0/0 a;color:transparent;text-shadow:none;background-color:transparent;border:0}.visible{visibility:visible!important}.invisible{visibility:hidden!important}.form-control{display:block;width:100%;height:calc(2.25rem + 2px);padding:.375rem .75rem;font-size:1rem;line-height:1.5;color:#495057;background-color:#fff;background-clip:padding-box;border:1px solid #ced4da;border-radius:3px;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out}@media screen and (prefers-reduced-motion:reduce){.form-control{transition:none}}.form-control::-ms-expand{background-color:transparent;border:0}.form-control:focus{color:#495057;background-color:#fff;border-color:#006;outline:0;box-shadow:none}.form-control::placeholder{color:#6c757d;opacity:1}.form-control:disabled,.form-control[readonly]{background-color:#e9ecef;opacity:1}select.form-control:focus::-ms-value{color:#495057;background-color:#fff}.form-control-file,.form-control-range{display:block;width:100%}.col-form-label{padding-top:calc(.375rem + 1px);padding-bottom:calc(.375rem + 1px);margin-bottom:0;font-size:inherit;line-height:1.5}.col-form-label-lg{padding-top:calc(.5rem + 1px);padding-bottom:calc(.5rem + 1px);font-size:1.25rem;line-height:1.5}.col-form-label-sm{padding-top:calc(.25rem + 1px);padding-bottom:calc(.25rem + 1px);font-size:.875rem;line-height:1.5}.form-control-plaintext{display:block;width:100%;padding-top:.375rem;padding-bottom:.375rem;margin-bottom:0;line-height:1.5;color:#212529;background-color:transparent;border:solid transparent;border-width:1px 0}.form-control-plaintext.form-control-sm,.form-control-plaintext.form-control-lg{padding-right:0;padding-left:0}.form-control-sm{height:calc(1.8125rem + 2px);padding:.25rem .5rem;font-size:.875rem;line-height:1.5;border-radius:2px}.form-control-lg{height:calc(2.875rem + 2px);padding:.5rem 1rem;font-size:1.25rem;line-height:1.5;border-radius:2px}select.form-control[size],select.form-control[multiple]{height:auto}textarea.form-control{height:auto}.form-group{margin-bottom:1rem}.form-text{display:block;margin-top:.25rem}.form-row{display:flex;flex-wrap:wrap;margin-right:-5px;margin-left:-5px}.form-row>.col,.form-row>[class*="col-"]{padding-right:5px;padding-left:5px}.form-check{position:relative;display:block;padding-left:1.25rem}.form-check-input{position:absolute;margin-top:.3rem;margin-left:-1.25rem}.form-check-input:disabled~.form-check-label{color:#9ca0a9}.form-check-label{margin-bottom:0}.form-check-inline{display:inline-flex;align-items:center;padding-left:0;margin-right:.75rem}.form-check-inline .form-check-input{position:static;margin-top:0;margin-right:.3125rem;margin-left:0}.valid-feedback{display:none;width:100%;margin-top:.25rem;font-size:80%;color:#81bf5d}.valid-tooltip{position:absolute;top:100%;z-index:5;display:none;max-width:100%;padding:.25rem .5rem;margin-top:.1rem;font-size:.875rem;line-height:1.5;color:#212529;background-color:rgba(129,191,93,.9);border-radius:3px}.was-validated .form-control:valid,.form-control.is-valid,.was-validated .custom-select:valid,.custom-select.is-valid{border-color:#81bf5d}.was-validated .form-control:valid:focus,.form-control.is-valid:focus,.was-validated .custom-select:valid:focus,.custom-select.is-valid:focus{border-color:#81bf5d;box-shadow:0 0 0 .2rem rgba(129,191,93,.25)}.was-validated .form-control:valid~.valid-feedback,.was-validated .form-control:valid~.valid-tooltip,.form-control.is-valid~.valid-feedback,.form-control.is-valid~.valid-tooltip,.was-validated .custom-select:valid~.valid-feedback,.was-validated .custom-select:valid~.valid-tooltip,.custom-select.is-valid~.valid-feedback,.custom-select.is-valid~.valid-tooltip{display:block}.was-validated .form-control-file:valid~.valid-feedback,.was-validated .form-control-file:valid~.valid-tooltip,.form-control-file.is-valid~.valid-feedback,.form-control-file.is-valid~.valid-tooltip{display:block}.was-validated .form-check-input:valid~.form-check-label,.form-check-input.is-valid~.form-check-label{color:#81bf5d}.was-validated .form-check-input:valid~.valid-feedback,.was-validated .form-check-input:valid~.valid-tooltip,.form-check-input.is-valid~.valid-feedback,.form-check-input.is-valid~.valid-tooltip{display:block}.was-validated .custom-control-input:valid~.custom-control-label,.custom-control-input.is-valid~.custom-control-label{color:#81bf5d}.was-validated .custom-control-input:valid~.custom-control-label::before,.custom-control-input.is-valid~.custom-control-label::before{background-color:#c8e3b8}.was-validated .custom-control-input:valid~.valid-feedback,.was-validated .custom-control-input:valid~.valid-tooltip,.custom-control-input.is-valid~.valid-feedback,.custom-control-input.is-valid~.valid-tooltip{display:block}.was-validated .custom-control-input:valid:checked~.custom-control-label::before,.custom-control-input.is-valid:checked~.custom-control-label::before{background-color:#9dcd82}.was-validated .custom-control-input:valid:focus~.custom-control-label::before,.custom-control-input.is-valid:focus~.custom-control-label::before{box-shadow:0 0 0 1px #fff,0 0 0 .2rem rgba(129,191,93,.25)}.was-validated .custom-file-input:valid~.custom-file-label,.custom-file-input.is-valid~.custom-file-label{border-color:#81bf5d}.was-validated .custom-file-input:valid~.custom-file-label::after,.custom-file-input.is-valid~.custom-file-label::after{border-color:inherit}.was-validated .custom-file-input:valid~.valid-feedback,.was-validated .custom-file-input:valid~.valid-tooltip,.custom-file-input.is-valid~.valid-feedback,.custom-file-input.is-valid~.valid-tooltip{display:block}.was-validated .custom-file-input:valid:focus~.custom-file-label,.custom-file-input.is-valid:focus~.custom-file-label{box-shadow:0 0 0 .2rem rgba(129,191,93,.25)}.invalid-feedback{display:none;width:100%;margin-top:.25rem;font-size:80%;color:#dc3545}.invalid-tooltip{position:absolute;top:100%;z-index:5;display:none;max-width:100%;padding:.25rem .5rem;margin-top:.1rem;font-size:.875rem;line-height:1.5;color:#fff;background-color:rgba(220,53,69,.9);border-radius:3px}.was-validated .form-control:invalid,.form-control.is-invalid,.was-validated .custom-select:invalid,.custom-select.is-invalid{border-color:#dc3545}.was-validated .form-control:invalid:focus,.form-control.is-invalid:focus,.was-validated .custom-select:invalid:focus,.custom-select.is-invalid:focus{border-color:#dc3545;box-shadow:0 0 0 .2rem rgba(220,53,69,.25)}.was-validated .form-control:invalid~.invalid-feedback,.was-validated .form-control:invalid~.invalid-tooltip,.form-control.is-invalid~.invalid-feedback,.form-control.is-invalid~.invalid-tooltip,.was-validated .custom-select:invalid~.invalid-feedback,.was-validated .custom-select:invalid~.invalid-tooltip,.custom-select.is-invalid~.invalid-feedback,.custom-select.is-invalid~.invalid-tooltip{display:block}.was-validated .form-control-file:invalid~.invalid-feedback,.was-validated .form-control-file:invalid~.invalid-tooltip,.form-control-file.is-invalid~.invalid-feedback,.form-control-file.is-invalid~.invalid-tooltip{display:block}.was-validated .form-check-input:invalid~.form-check-label,.form-check-input.is-invalid~.form-check-label{color:#dc3545}.was-validated .form-check-input:invalid~.invalid-feedback,.was-validated .form-check-input:invalid~.invalid-tooltip,.form-check-input.is-invalid~.invalid-feedback,.form-check-input.is-invalid~.invalid-tooltip{display:block}.was-validated .custom-control-input:invalid~.custom-control-label,.custom-control-input.is-invalid~.custom-control-label{color:#dc3545}.was-validated .custom-control-input:invalid~.custom-control-label::before,.custom-control-input.is-invalid~.custom-control-label::before{background-color:#efa2a9}.was-validated .custom-control-input:invalid~.invalid-feedback,.was-validated .custom-control-input:invalid~.invalid-tooltip,.custom-control-input.is-invalid~.invalid-feedback,.custom-control-input.is-invalid~.invalid-tooltip{display:block}.was-validated .custom-control-input:invalid:checked~.custom-control-label::before,.custom-control-input.is-invalid:checked~.custom-control-label::before{background-color:#e4606d}.was-validated .custom-control-input:invalid:focus~.custom-control-label::before,.custom-control-input.is-invalid:focus~.custom-control-label::before{box-shadow:0 0 0 1px #fff,0 0 0 .2rem rgba(220,53,69,.25)}.was-validated .custom-file-input:invalid~.custom-file-label,.custom-file-input.is-invalid~.custom-file-label{border-color:#dc3545}.was-validated .custom-file-input:invalid~.custom-file-label::after,.custom-file-input.is-invalid~.custom-file-label::after{border-color:inherit}.was-validated .custom-file-input:invalid~.invalid-feedback,.was-validated .custom-file-input:invalid~.invalid-tooltip,.custom-file-input.is-invalid~.invalid-feedback,.custom-file-input.is-invalid~.invalid-tooltip{display:block}.was-validated .custom-file-input:invalid:focus~.custom-file-label,.custom-file-input.is-invalid:focus~.custom-file-label{box-shadow:0 0 0 .2rem rgba(220,53,69,.25)}.form-inline{display:flex;flex-flow:row wrap;align-items:center}.form-inline .form-check{width:100%}@media (min-width:576px){.form-inline label{display:flex;align-items:center;justify-content:center;margin-bottom:0}.form-inline .form-group{display:flex;flex:0 0 auto;flex-flow:row wrap;align-items:center;margin-bottom:0}.form-inline .form-control{display:inline-block;width:auto;vertical-align:middle}.form-inline .form-control-plaintext{display:inline-block}.form-inline .input-group,.form-inline .custom-select{width:auto}.form-inline .form-check{display:flex;align-items:center;justify-content:center;width:auto;padding-left:0}.form-inline .form-check-input{position:relative;margin-top:0;margin-right:.25rem;margin-left:0}.form-inline .custom-control{align-items:center;justify-content:center}.form-inline .custom-control-label{margin-bottom:0}}.btn{display:inline-block;font-weight:400;text-align:center;white-space:nowrap;vertical-align:middle;user-select:none;border:1px solid transparent;padding:.375rem .75rem;font-size:1rem;line-height:1.5;border-radius:3px;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;word-break:break-word}@media screen and (prefers-reduced-motion:reduce){.btn{transition:none}}.btn:hover,.btn:focus{text-decoration:none}.btn:focus,.btn.focus{outline:0;box-shadow:none!important}.btn.disabled,.btn:disabled{opacity:.65}.btn:not(:disabled):not(.disabled){cursor:pointer}a.btn.disabled,fieldset:disabled a.btn{pointer-events:none}.btn-primary{color:#fff;background-color:#006;border-color:#006}.btn-primary:hover{color:#fff;background-color:#000040;border-color:#003}.btn-primary:focus,.btn-primary.focus{box-shadow:0 0 0 .2rem rgba(0,0,102,.5)}.btn-primary.disabled,.btn-primary:disabled{color:#fff;background-color:#006;border-color:#006}.btn-primary:not(:disabled):not(.disabled):active,.btn-primary:not(:disabled):not(.disabled).active,.show>.btn-primary.dropdown-toggle{color:#fff;background-color:#003;border-color:#000026}.btn-primary:not(:disabled):not(.disabled):active:focus,.btn-primary:not(:disabled):not(.disabled).active:focus,.show>.btn-primary.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(0,0,102,.5)}.btn-secondary{color:#fff;background-color:#6c757d;border-color:#6c757d}.btn-secondary:hover{color:#fff;background-color:#5a6268;border-color:#545b62}.btn-secondary:focus,.btn-secondary.focus{box-shadow:0 0 0 .2rem rgba(108,117,125,.5)}.btn-secondary.disabled,.btn-secondary:disabled{color:#fff;background-color:#6c757d;border-color:#6c757d}.btn-secondary:not(:disabled):not(.disabled):active,.btn-secondary:not(:disabled):not(.disabled).active,.show>.btn-secondary.dropdown-toggle{color:#fff;background-color:#545b62;border-color:#4e555b}.btn-secondary:not(:disabled):not(.disabled):active:focus,.btn-secondary:not(:disabled):not(.disabled).active:focus,.show>.btn-secondary.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(108,117,125,.5)}.btn-success{color:#212529;background-color:#81bf5d;border-color:#81bf5d}.btn-success:hover{color:#fff;background-color:#6db046;border-color:#67a742}.btn-success:focus,.btn-success.focus{box-shadow:0 0 0 .2rem rgba(129,191,93,.5)}.btn-success.disabled,.btn-success:disabled{color:#212529;background-color:#81bf5d;border-color:#81bf5d}.btn-success:not(:disabled):not(.disabled):active,.btn-success:not(:disabled):not(.disabled).active,.show>.btn-success.dropdown-toggle{color:#fff;background-color:#67a742;border-color:#619e3e}.btn-success:not(:disabled):not(.disabled):active:focus,.btn-success:not(:disabled):not(.disabled).active:focus,.show>.btn-success.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(129,191,93,.5)}.btn-info{color:#fff;background-color:#15359a;border-color:#15359a}.btn-info:hover{color:#fff;background-color:#102978;border-color:#0f266d}.btn-info:focus,.btn-info.focus{box-shadow:0 0 0 .2rem rgba(21,53,154,.5)}.btn-info.disabled,.btn-info:disabled{color:#fff;background-color:#15359a;border-color:#15359a}.btn-info:not(:disabled):not(.disabled):active,.btn-info:not(:disabled):not(.disabled).active,.show>.btn-info.dropdown-toggle{color:#fff;background-color:#0f266d;border-color:#0d2262}.btn-info:not(:disabled):not(.disabled):active:focus,.btn-info:not(:disabled):not(.disabled).active:focus,.show>.btn-info.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(21,53,154,.5)}.btn-warning{color:#fff;background-color:#ff9e15;border-color:#ff9e15}.btn-warning:hover{color:#fff;background-color:#ee8b00;border-color:#e18400}.btn-warning:focus,.btn-warning.focus{box-shadow:none}.btn-warning.disabled,.btn-warning:disabled{color:#212529;background-color:#ff9e15;border-color:#ff9e15}.btn-warning:not(:disabled):not(.disabled):active,.btn-warning:not(:disabled):not(.disabled).active,.show>.btn-warning.dropdown-toggle{color:#fff;background-color:#e18400;border-color:#d47c00}.btn-warning:not(:disabled):not(.disabled):active:focus,.btn-warning:not(:disabled):not(.disabled).active:focus,.show>.btn-warning.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(255,158,21,.5)}.btn-danger{color:#fff;background-color:#dc3545;border-color:#dc3545}.btn-danger:hover{color:#fff;background-color:#c82333;border-color:#bd2130}.btn-danger:focus,.btn-danger.focus{box-shadow:0 0 0 .2rem rgba(220,53,69,.5)}.btn-danger.disabled,.btn-danger:disabled{color:#fff;background-color:#dc3545;border-color:#dc3545}.btn-danger:not(:disabled):not(.disabled):active,.btn-danger:not(:disabled):not(.disabled).active,.show>.btn-danger.dropdown-toggle{color:#fff;background-color:#bd2130;border-color:#b21f2d}.btn-danger:not(:disabled):not(.disabled):active:focus,.btn-danger:not(:disabled):not(.disabled).active:focus,.show>.btn-danger.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(220,53,69,.5)}.btn-light{color:#212529;background-color:#f8f9fa;border-color:#f8f9fa}.btn-light:hover{color:#212529;background-color:#e2e6ea;border-color:#dae0e5}.btn-light:focus,.btn-light.focus{box-shadow:0 0 0 .2rem rgba(248,249,250,.5)}.btn-light.disabled,.btn-light:disabled{color:#212529;background-color:#f8f9fa;border-color:#f8f9fa}.btn-light:not(:disabled):not(.disabled):active,.btn-light:not(:disabled):not(.disabled).active,.show>.btn-light.dropdown-toggle{color:#212529;background-color:#dae0e5;border-color:#d3d9df}.btn-light:not(:disabled):not(.disabled):active:focus,.btn-light:not(:disabled):not(.disabled).active:focus,.show>.btn-light.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(248,249,250,.5)}.btn-dark{color:#fff;background-color:#222;border-color:#222}.btn-dark:hover{color:#fff;background-color:#0f0f0f;border-color:#090909}.btn-dark:focus,.btn-dark.focus{box-shadow:0 0 0 .2rem rgba(34,34,34,.5)}.btn-dark.disabled,.btn-dark:disabled{color:#fff;background-color:#222;border-color:#222}.btn-dark:not(:disabled):not(.disabled):active,.btn-dark:not(:disabled):not(.disabled).active,.show>.btn-dark.dropdown-toggle{color:#fff;background-color:#090909;border-color:#020202}.btn-dark:not(:disabled):not(.disabled):active:focus,.btn-dark:not(:disabled):not(.disabled).active:focus,.show>.btn-dark.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(34,34,34,.5)}.btn-lightgray{color:var(--dark-color);background-color:var(--light-gray);border-color:var(--light-gray)}.btn-lightgray:hover{color:var(--dark-color);background-color:var(--light-gray-secondary);border-color:var(--light-gray-secondary)}.btn-lightgray:focus,.btn-lightgray.focus{box-shadow:0 0 0 .2rem rgba(245,245,245,.5)}.btn-lightgray.disabled,.btn-lightgray:disabled{color:var(--dark-color);background-color:var(--light-gray-secondary);border-color:var(--light-gray-secondary)}.btn-lightgray:not(:disabled):not(.disabled):active,.btn-lightgray:not(:disabled):not(.disabled).active,.show>.btn-lightgray.dropdown-toggle{color:#212529;background-color:#dcdcdc;border-color:#d5d5d5}.btn-lightgray:not(:disabled):not(.disabled):active:focus,.btn-lightgray:not(:disabled):not(.disabled).active:focus,.show>.btn-lightgray.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(245,245,245,.5)}.btn-mediumgray{color:#212529;background-color:#f3f2f7;border-color:#f3f2f7}.btn-mediumgray:hover{color:#212529;background-color:#dddae8;border-color:#d6d2e4}.btn-mediumgray:focus,.btn-mediumgray.focus{box-shadow:0 0 0 .2rem rgba(243,242,247,.5)}.btn-mediumgray.disabled,.btn-mediumgray:disabled{color:#212529;background-color:#f3f2f7;border-color:#f3f2f7}.btn-mediumgray:not(:disabled):not(.disabled):active,.btn-mediumgray:not(:disabled):not(.disabled).active,.show>.btn-mediumgray.dropdown-toggle{color:#212529;background-color:#d6d2e4;border-color:#cfcbdf}.btn-mediumgray:not(:disabled):not(.disabled):active:focus,.btn-mediumgray:not(:disabled):not(.disabled).active:focus,.show>.btn-mediumgray.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(243,242,247,.5)}.btn-midgray{color:#212529;background-color:#a5a5a5;border-color:#a5a5a5}.btn-midgray:hover{color:#fff;background-color:#929292;border-color:#8c8c8c}.btn-midgray:focus,.btn-midgray.focus{box-shadow:0 0 0 .2rem rgba(165,165,165,.5)}.btn-midgray.disabled,.btn-midgray:disabled{color:#212529;background-color:#a5a5a5;border-color:#a5a5a5}.btn-midgray:not(:disabled):not(.disabled):active,.btn-midgray:not(:disabled):not(.disabled).active,.show>.btn-midgray.dropdown-toggle{color:#fff;background-color:#8c8c8c;border-color:#858585}.btn-midgray:not(:disabled):not(.disabled):active:focus,.btn-midgray:not(:disabled):not(.disabled).active:focus,.show>.btn-midgray.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(165,165,165,.5)}.btn-indianred{color:#fff;background-color:var(--indianred-color);border-color:var(--indianred-color)}.btn-indianred:hover{color:#fff;background-color:var(--primary-dark-color);border-color:var(--primary-dark-color)}.btn-outline-primary{color:#006;background-color:transparent;background-image:none;border-color:#006}.btn-outline-primary:hover{color:#fff;background-color:#006;border-color:#006}.btn-outline-primary:focus,.btn-outline-primary.focus{box-shadow:0 0 0 .2rem rgba(0,0,102,.5)}.btn-outline-primary.disabled,.btn-outline-primary:disabled{color:#006;background-color:transparent}.btn-outline-primary:not(:disabled):not(.disabled):active,.btn-outline-primary:not(:disabled):not(.disabled).active,.show>.btn-outline-primary.dropdown-toggle{color:#fff;background-color:#006;border-color:#006}.btn-outline-primary:not(:disabled):not(.disabled):active:focus,.btn-outline-primary:not(:disabled):not(.disabled).active:focus,.show>.btn-outline-primary.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(0,0,102,.5)}.btn-outline-secondary{color:#6c757d;background-color:transparent;background-image:none;border-color:#6c757d}.btn-outline-secondary:hover{color:#fff;background-color:#6c757d;border-color:#6c757d}.btn-outline-secondary:focus,.btn-outline-secondary.focus{box-shadow:0 0 0 .2rem rgba(108,117,125,.5)}.btn-outline-secondary.disabled,.btn-outline-secondary:disabled{color:#6c757d;background-color:transparent}.btn-outline-secondary:not(:disabled):not(.disabled):active,.btn-outline-secondary:not(:disabled):not(.disabled).active,.show>.btn-outline-secondary.dropdown-toggle{color:#fff;background-color:#6c757d;border-color:#6c757d}.btn-outline-secondary:not(:disabled):not(.disabled):active:focus,.btn-outline-secondary:not(:disabled):not(.disabled).active:focus,.show>.btn-outline-secondary.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(108,117,125,.5)}.btn-outline-success{color:#81bf5d;background-color:transparent;background-image:none;border-color:#81bf5d}.btn-outline-success:hover{color:#212529;background-color:#81bf5d;border-color:#81bf5d}.btn-outline-success:focus,.btn-outline-success.focus{box-shadow:0 0 0 .2rem rgba(129,191,93,.5)}.btn-outline-success.disabled,.btn-outline-success:disabled{color:#81bf5d;background-color:transparent}.btn-outline-success:not(:disabled):not(.disabled):active,.btn-outline-success:not(:disabled):not(.disabled).active,.show>.btn-outline-success.dropdown-toggle{color:#212529;background-color:#81bf5d;border-color:#81bf5d}.btn-outline-success:not(:disabled):not(.disabled):active:focus,.btn-outline-success:not(:disabled):not(.disabled).active:focus,.show>.btn-outline-success.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(129,191,93,.5)}.btn-outline-info{color:#15359a;background-color:transparent;background-image:none;border-color:#15359a}.btn-outline-info:hover{color:#fff;background-color:#15359a;border-color:#15359a}.btn-outline-info:focus,.btn-outline-info.focus{box-shadow:0 0 0 .2rem rgba(21,53,154,.5)}.btn-outline-info.disabled,.btn-outline-info:disabled{color:#15359a;background-color:transparent}.btn-outline-info:not(:disabled):not(.disabled):active,.btn-outline-info:not(:disabled):not(.disabled).active,.show>.btn-outline-info.dropdown-toggle{color:#fff;background-color:#15359a;border-color:#15359a}.btn-outline-info:not(:disabled):not(.disabled):active:focus,.btn-outline-info:not(:disabled):not(.disabled).active:focus,.show>.btn-outline-info.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(21,53,154,.5)}.btn-outline-warning{color:#ff9e15;background-color:transparent;background-image:none;border-color:#ff9e15}.btn-outline-warning:hover{color:#fff;background-color:#ff9e15;border-color:#ff9e15}.btn-outline-warning:focus,.btn-outline-warning.focus{box-shadow:0 0 0 .2rem rgba(255,158,21,.5)}.btn-outline-warning.disabled,.btn-outline-warning:disabled{color:#ff9e15;background-color:transparent}.btn-outline-warning:not(:disabled):not(.disabled):active,.btn-outline-warning:not(:disabled):not(.disabled).active,.show>.btn-outline-warning.dropdown-toggle{color:#fff;background-color:#ff9e15;border-color:#ff9e15}.btn-outline-warning:not(:disabled):not(.disabled):active:focus,.btn-outline-warning:not(:disabled):not(.disabled).active:focus,.show>.btn-outline-warning.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(255,158,21,.5)}.btn-outline-danger{color:#dc3545;background-color:transparent;background-image:none;border-color:#dc3545}.btn-outline-danger:hover{color:#fff;background-color:#dc3545;border-color:#dc3545}.btn-outline-danger:focus,.btn-outline-danger.focus{box-shadow:0 0 0 .2rem rgba(220,53,69,.5)}.btn-outline-danger.disabled,.btn-outline-danger:disabled{color:#dc3545;background-color:transparent}.btn-outline-danger:not(:disabled):not(.disabled):active,.btn-outline-danger:not(:disabled):not(.disabled).active,.show>.btn-outline-danger.dropdown-toggle{color:#fff;background-color:#dc3545;border-color:#dc3545}.btn-outline-danger:not(:disabled):not(.disabled):active:focus,.btn-outline-danger:not(:disabled):not(.disabled).active:focus,.show>.btn-outline-danger.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(220,53,69,.5)}.btn-outline-light{color:#f8f9fa;background-color:transparent;background-image:none;border-color:#f8f9fa}.btn-outline-light:hover{color:#212529;background-color:#f8f9fa;border-color:#f8f9fa}.btn-outline-light:focus,.btn-outline-light.focus{box-shadow:0 0 0 .2rem rgba(248,249,250,.5)}.btn-outline-light.disabled,.btn-outline-light:disabled{color:#f8f9fa;background-color:transparent}.btn-outline-light:not(:disabled):not(.disabled):active,.btn-outline-light:not(:disabled):not(.disabled).active,.show>.btn-outline-light.dropdown-toggle{color:#212529;background-color:#f8f9fa;border-color:#f8f9fa}.btn-outline-light:not(:disabled):not(.disabled):active:focus,.btn-outline-light:not(:disabled):not(.disabled).active:focus,.show>.btn-outline-light.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(248,249,250,.5)}.btn-outline-dark{color:#222;background-color:transparent;background-image:none;border-color:#222}.btn-outline-dark:hover{color:#fff;background-color:#222;border-color:#222}.btn-outline-dark:focus,.btn-outline-dark.focus{box-shadow:0 0 0 .2rem rgba(34,34,34,.5)}.btn-outline-dark.disabled,.btn-outline-dark:disabled{color:#222;background-color:transparent}.btn-outline-dark:not(:disabled):not(.disabled):active,.btn-outline-dark:not(:disabled):not(.disabled).active,.show>.btn-outline-dark.dropdown-toggle{color:#fff;background-color:#222;border-color:#222}.btn-outline-dark:not(:disabled):not(.disabled):active:focus,.btn-outline-dark:not(:disabled):not(.disabled).active:focus,.show>.btn-outline-dark.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(34,34,34,.5)}.btn-outline-lightgray{color:#f5f5f5;background-color:transparent;background-image:none;border-color:#f5f5f5}.btn-outline-lightgray:hover{color:#212529;background-color:#f5f5f5;border-color:#f5f5f5}.btn-outline-lightgray:focus,.btn-outline-lightgray.focus{box-shadow:0 0 0 .2rem rgba(245,245,245,.5)}.btn-outline-lightgray.disabled,.btn-outline-lightgray:disabled{color:#f5f5f5;background-color:transparent}.btn-outline-lightgray:not(:disabled):not(.disabled):active,.btn-outline-lightgray:not(:disabled):not(.disabled).active,.show>.btn-outline-lightgray.dropdown-toggle{color:#212529;background-color:#f5f5f5;border-color:#f5f5f5}.btn-outline-lightgray:not(:disabled):not(.disabled):active:focus,.btn-outline-lightgray:not(:disabled):not(.disabled).active:focus,.show>.btn-outline-lightgray.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(245,245,245,.5)}.btn-outline-mediumgray{color:#f3f2f7;background-color:transparent;background-image:none;border-color:#f3f2f7}.btn-outline-mediumgray:hover{color:#212529;background-color:#f3f2f7;border-color:#f3f2f7}.btn-outline-mediumgray:focus,.btn-outline-mediumgray.focus{box-shadow:0 0 0 .2rem rgba(243,242,247,.5)}.btn-outline-mediumgray.disabled,.btn-outline-mediumgray:disabled{color:#f3f2f7;background-color:transparent}.btn-outline-mediumgray:not(:disabled):not(.disabled):active,.btn-outline-mediumgray:not(:disabled):not(.disabled).active,.show>.btn-outline-mediumgray.dropdown-toggle{color:#212529;background-color:#f3f2f7;border-color:#f3f2f7}.btn-outline-mediumgray:not(:disabled):not(.disabled):active:focus,.btn-outline-mediumgray:not(:disabled):not(.disabled).active:focus,.show>.btn-outline-mediumgray.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(243,242,247,.5)}.btn-outline-midgray{color:#a5a5a5;background-color:transparent;background-image:none;border-color:#a5a5a5}.btn-outline-midgray:hover{color:#212529;background-color:#a5a5a5;border-color:#a5a5a5}.btn-outline-midgray:focus,.btn-outline-midgray.focus{box-shadow:0 0 0 .2rem rgba(165,165,165,.5)}.btn-outline-midgray.disabled,.btn-outline-midgray:disabled{color:#a5a5a5;background-color:transparent}.btn-outline-midgray:not(:disabled):not(.disabled):active,.btn-outline-midgray:not(:disabled):not(.disabled).active,.show>.btn-outline-midgray.dropdown-toggle{color:#212529;background-color:#a5a5a5;border-color:#a5a5a5}.btn-outline-midgray:not(:disabled):not(.disabled):active:focus,.btn-outline-midgray:not(:disabled):not(.disabled).active:focus,.show>.btn-outline-midgray.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(165,165,165,.5)}.btn-outline-none:focus,.btn-outline-none{outline:none;box-shadow:none}.btn-outline-lightpurple{color:var(--light-blue-color);background-color:transparent;background-image:none;border-color:var(--light-blue-color)}.btn-outline-lightpurple:hover{color:#fff;background-color:var(--light-blue-color);border-color:var(--light-blue-color)}.btn-outline-indianred{color:var(--indianred-color);background-color:transparent;background-image:none;border-color:var(--indianred-color)}.btn-outline-indianred:hover{color:#fff;background-color:var(--indianred-color);border-color:var(--indianred-color)}.btn-link{font-weight:400;color:#006;background-color:transparent}.btn-link:hover{color:#00001a;text-decoration:underline;background-color:transparent;border-color:transparent}.btn-link:focus,.btn-link.focus{text-decoration:underline;border-color:transparent;box-shadow:none}.btn-link:disabled,.btn-link.disabled{color:#6c757d;pointer-events:none}.btn-lg{padding:.5rem 1rem;font-size:1.25rem;line-height:1.5;border-radius:2px}.btn-sm{padding:.25rem .5rem;font-size:.875rem;line-height:1.5;border-radius:2px}.btn-block{display:block;width:100%}.btn-block+.btn-block{margin-top:.5rem}.text-decoration-none a,.text-decoration-none:hover,.text-decoration-none{text-decoration:none!important;outline:none}.l-h-2{line-height:2}.overflow-hidden{overflow:hidden}.overflow-auto{overflow:auto}.form-control.mw-px-140{min-width:140px}.text-truncate-dots{text-overflow:ellipsis;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;position:relative;display:-webkit-box;max-height:3.8rem}.text-truncate-dots-1{-webkit-line-clamp:1;max-height:2rem}.text-truncate-dots-2{-webkit-line-clamp:2;max-height:2.7rem}.text-truncate-dots-4{-webkit-line-clamp:4;max-height:5.1rem}.text-truncate-dots-5{-webkit-line-clamp:5;max-height:6.3rem}.list-style-type-blue li:before{content:"•";color:#006;display:inline-block;width:1em;margin-left:-1em}.white-space-normal{white-space:normal;white-space:-moz-pre-wrap}.white-space-nowrap{white-space:nowrap;white-space:-moz-pre-nowrap}.btn-mediumgray-default:not(:disabled):not(.disabled):active,.btn-mediumgray-default:active,.btn-mediumgray-default:focus,.btn-mediumgray-default:hover,.btn-mediumgray-default{color:#212529;background-color:#f3f2f7;border-color:#f3f2f7;cursor:default!important}.outline-none:not(:disabled):not(.disabled):active:focus,.outline-none:not(:disabled):not(.disabled).active:focus,.show>.outline-none.dropdown-toggle:focus,.outline-none:active,.outline-none:focus,.outline-none{outline:none}.shadow-white{-webkit-box-shadow:0 0 13px -2px rgba(255,255,255,.6);box-shadow:0 0 13px -2px rgba(255,255,255,.6)}.bg-focus-none:focus,.bg-focus-none.active,.bg-focus-none:active{background:inherit!important;color:inherit!important}.date-holder .viewall-btn svg{-moz-transition:all .25s linear;-webkit-transition:all .25s linear;-o-transition:all .25s linear;transition:all .25s linear;-ms-transform:rotate(180deg);-webkit-transform:rotate(180deg);transform:rotate(180deg)}.date-holder .viewall-btn.collapsed svg{-ms-transform:rotate(0deg);-webkit-transform:rotate(0deg);transform:rotate(0deg)}.our-team-tabs .filter-button.active button,.our-team-tabs .filter-button button:focus{border:solid 1px #006}.dropdown-tab-list{position:relative;width:100%}.dropdown-tab-list .chosen-value{transition:.3s ease-in-out}.dropdown-tab-list .chosen-value:hover{border-color:#15359a;cursor:pointer}.dropdown-tab-list .chosen-value:focus,.dropdown-tab-list .chosen-value.open{box-shadow:0 5px 8px 0 rgba(0,0,0,.2);outline:0;border-color:#15359a;border-color:#15359a}.dropdown-tab-list .value-list{list-style:none;transition:.3s ease-in-out;position:absolute;top:100%;left:0;width:100%;z-index:999;overflow:hidden;max-height:0}.dropdown-tab-list .form-control{background:#fff url(/dist/images/chevron-down-svg.svg) center right 0.75rem/7px no-repeat}.dropdown-tab-list .value-list li{cursor:pointer;transition:background-color .3s;opacity:1;width:100%;margin:0!important}.dropdown-tab-list .value-list.open{max-height:235px;overflow:auto;border:1px solid #dee2e6}.dropdown-tab-list .value-list li:hover button{background-color:#15359a!important;color:#fff}.dropdown-tab-list .value-list li.closed{max-height:0;overflow:hidden;padding:0;opacity:0}.login-signup-model .modal-content{min-height:540px}.verifi-code-group input{max-width:40px;-webkit-appearance:none;-moz-appearance:none;appearance:none}.verifi-code-group input::-webkit-outer-spin-button,.verifi-code-group input::-webkit-inner-spin-button{-webkit-appearance:none;margin:0}.verifi-code-group input[type=number]{-moz-appearance:textfield}.top-arrow-dropdown .dropdown-menu:before{position:absolute;top:-13px;right:100px;display:inline-block;border-right:13px solid transparent;border-bottom:13px solid #ccc;border-left:13px solid transparent;border-bottom-color:rgba(0,0,0,.2);content:''}.top-arrow-dropdown .dropdown-menu:after{position:absolute;top:-12px;right:101px;display:inline-block;border-right:12px solid transparent;border-bottom:12px solid #fff;border-left:12px solid transparent;content:''}.bottom-arrow-dropdown.top-arrow-dropdown .dropdown-menu:before{top:auto;bottom:-13px;border-top:13px solid #ccc;border-bottom:0}.bottom-arrow-dropdown.top-arrow-dropdown .dropdown-menu:after{top:auto;bottom:-12px;border-top:12px solid #fff;border-bottom:0}.top-arrow-dropdown .dropdown-menu[x-placement^="top"]:before{top:auto;bottom:-13px;border-top:13px solid #ccc;border-bottom:0}.top-arrow-dropdown .dropdown-menu[x-placement^="top"]:after{top:auto;bottom:-12px;border-top:12px solid #fff;border-bottom:0}.breadcrumb{font-size:10px!important;text-transform:uppercase}.breadcrumb-item+.breadcrumb-item::before{content:"";background:url(/dist/images/breadcrum-right-arrow.svg) no-repeat;height:9px;width:10px}.login-signup-model .modal-content{min-height:540px}.verifi-code-group input{max-width:40px}input[type="submit"].btn-block,input[type="reset"].btn-block,input[type="button"].btn-block{width:100%}.doctordetail-listing li:after{position:absolute;content:"";background:url(/dist/images/right-arrow.png) no-repeat;left:10px;width:5px;height:8px;top:5px}.icon-available.muted{background-color:#9ca0a9}.fade{transition:opacity .15s linear}@media screen and (prefers-reduced-motion:reduce){.fade{transition:none}}.fade:not(.show){opacity:0}.collapse:not(.show){display:none}.collapsing{position:relative;height:0;overflow:hidden;transition:height .35s ease}@media screen and (prefers-reduced-motion:reduce){.collapsing{transition:none}}.login-steps{display:none}.login-steps#signup-card-1,.login-steps#log-card-1{display:block}.otherinfo_accordion ul.collapsing{height:auto;transition:none}.otherinfo_accordion ul.collapse{display:block}#footer a{color:rgba(255,255,255,.5)}#footer .f-nav li{margin-bottom:.5rem}.lds-ring{display:none;position:relative;width:22px;height:22px;vertical-align:middle}.lds-ring div{box-sizing:border-box;display:block;position:absolute;width:20px;height:20px;border:3px solid #fff;border-radius:50%;animation:lds-ring 1.2s cubic-bezier(.5,0,.5,1) infinite;border-color:#fff transparent transparent}.lds-ring.lds-lg-ring .lds-text,.lds-ring .lds-text{height:auto;width:100%;animation:none;border-radius:0;border:0;padding-top:70px;position:static;text-align:center}.lds-ring div:nth-child(1){animation-delay:-.45s}.lds-ring div:nth-child(2){animation-delay:-.3s}.lds-ring div:nth-child(3){animation-delay:-.15s}@keyframes lds-ring{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}.lds-lg-ring,.lds-ring.lds-lg-ring{position:absolute;width:auto;height:auto;left:0;bottom:0;right:0;top:50px;z-index:9;display:none;align-items:center;justify-content:center;padding-bottom:50px}.lds-lg-ring .lds-ring-holder,.lds-ring.lds-lg-ring .lds-ring-holder{display:flex;width:100%;height:100%;align-items:center;justify-content:center}.lds-lg-ring div,.lds-ring.lds-lg-ring div{width:30px;height:30px;border:3px solid #006;border-color:#006 transparent transparent}.lds-ring.lds-lg-ring .lds-text,.lds-ring .lds-text{height:auto;width:100%;animation:none;border-radius:0;border:0;padding-top:70px;position:static;text-align:center}.lds-ring.bg-white-70{background:rgba(255,255,255,.7)}.modal.fade.bookappointment-mobile-model .modal-dialog{transform:translate(0,25%)}.modal.show.bookappointment-mobile-model .modal-dialog{transform:translate(0,0)}.modal.show.bookappointment-mobile-model .modal-dialog .modal-body{max-height:90vh;overflow:auto}.search-modal .form-control::-webkit-input-placeholder{color:#9ca0a9;opacity:1}.search-modal .form-control::-moz-placeholder{color:#9ca0a9;opacity:1}.search-modal .form-control:-ms-input-placeholder{color:#9ca0a9;opacity:1}.search-modal .form-control::-ms-input-placeholder{color:#9ca0a9;opacity:1}.search-modal .form-control::placeholder{color:#9ca0a9;opacity:1}.text-truncate-dots-2:after{content:'';background:#FFF;position:absolute;height:50px;width:100%;z-index:1}.text-truncate-dots-3:before{background:#FFF;bottom:1px;position:absolute;right:0;float:right;content:'\2026';margin-left:-2rem;width:2rem}.text-truncate-dots-3:after{content:'';background:#FFF;position:absolute;height:50px;width:100%;z-index:1}.text-truncate-dots-4:before{background:#FFF;bottom:1px;position:absolute;right:0;float:right;content:'\2026';margin-left:-2rem;width:2rem}.text-truncate-dots-4:after{content:'';background:#FFF;position:absolute;height:50px;width:100%;z-index:1}.otp-modal-content .bookinglogin-area .card-body,.login-signup-model .otp-modal-content .modal-body{padding:0}.otp-modal-content .bookinglogin-area .otp-input-hiolder{padding:0 30px}.otp-modal-content .bookinglogin-area{margin:0}.otp-modal-content .bookinglogin-area>.col-12{padding:0!important}.otp-modal-content .modal-header{position:fixed;top:0;right:0;left:0;z-index:1030;background:transparent!important}.otp-modal-content .close{color:#fff!important;opacity:1;text-shadow:none}.otp-modal-content #response_message{padding:0 30px}.btn .icon-hide,.btn.active .icon-show{display:none}.btn.active .icon-hide{display:inline-block}.shiner_laoder_featured .shine,.shiner_laoder .shine{background:#f6f7f8;background-image:linear-gradient(to right,#f6f7f8 0%,#edeef1 20%,#f6f7f8 40%,#f6f7f8 100%);background-repeat:no-repeat;background-size:800px 100%;display:inline-block;position:relative;-webkit-animation-duration:1s;-webkit-animation-fill-mode:forwards;-webkit-animation-iteration-count:infinite;-webkit-animation-name:placeholderShimmer;-webkit-animation-timing-function:linear}.shiner_laoder_featured photo,.shiner_laoder_featured lines,.shiner_laoder_featured box,.shiner_laoder photo,.shiner_laoder lines,.shiner_laoder box{width:100%}@-webkit-keyframes placeholderShimmer{0%{background-position:-468px 0}100%{background-position:468px 0}}ul.yellow_tick_svg{padding-left:29px}ul.yellow_tick_svg li{position:relative}ul.yellow_tick_svg li:after{position:absolute;left:-27px;top:5px;background:url(/dist/images/yellow_tick_svg.svg) no-repeat;background-position:center;background-size:14px;height:14px;width:14px;content:''}ul.custom_check_list{padding-left:29px}ul.custom_check_list li{position:relative;margin:0 0 14px}ul.custom_check_list li:after{position:absolute;left:-27px;top:6px;background-image:url("data:image/svg+xml,%3Csvg width='18' height='14' viewBox='0 0 18 14' fill='%23000069' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.59 10.58L1.42 6.41L0 7.82L5.59 13.41L17.59 1.41L16.18 0L5.59 10.58Z' /%3E%3C/svg%3E%0A");background-repeat:no-repeat;background-position:center;background-size:14px;height:14px;width:18px;content:''}.btn.text-size-14,.text-size-14{font-size:14px;line-height:2}.text-decoration-through{text-decoration:line-through}.text-decoration-underline{text-decoration:underline}.text-purple{color:var(--light-purple-color)!important}a.text-purple:hover,a.text-primary:focus{color:var(--primary-color)!important}@media screen and (min-width:768px){.border-md-0{border:0!important}}@media screen and (max-width:767px){.accordion{margin:0}#otherinfo_accordion>.col-12{border:1px solid rgba(0,0,0,.125);border-bottom:0}#otherinfo_accordion>.col-12:last-child{border-bottom:1px solid rgba(0,0,0,.125)}.accordion button h4:after{background:url(/dist/images/minus.svg) no-repeat;content:'';position:absolute;right:0;top:50%;background-size:9px;-webkit-background-size:9px;-moz-background-size:9px;height:12px;width:12px;background-position:center center;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);-o-transform:translateY(-50%);transform:translateY(-50%);z-index:9}.accordion button.collapsed h4:after{background:url(/dist/images/plus.svg) no-repeat;content:'';position:absolute;right:0;top:50%;height:12px;width:12px;background-position:center center;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);-o-transform:translateY(-50%);transform:translateY(-50%);z-index:9;background-size:8px;-webkit-background-size:8px;-moz-background-size:8px}.otherinfo_accordion ul.collapsing{height:0;transition:height .35s ease}.otherinfo_accordion ul.collapse{display:none}.otherinfo_accordion ul.collapse.show{display:block}.login-signup-model .modal-content{min-height:100vh}}@media screen and (max-width:575px){.doc-listing-card .dropdown-menu{right:15px}}a.hsp-detail-specialit-btn-href{text-decoration:none!important}.slots_alert{background:#ed4444;color:white;width:100%}.body-textsize{font-size:var(--body-text-size)}.body-textsize-sm{font-size:var(--body-text-size-2)}.text-small{font-size:var(--small-text-size)!important}.font-size-10{font-size:10px}.font-size-11{font-size:11px}.font-size-11-2{font-size:var(--small-text-size)}.font-size-12{font-size:12px}.font-size-12-8{font-size:var(--body-text-size-2)}.font-size-13-6{font-size:var(--body-text-size)}.font-size-13{font-size:13px}.font-size-14{font-size:14px}.font-size-15{font-size:15px}.font-size-16{font-size:16px}.font-size-17{font-size:17px}.font-size-18{font-size:18px}.font-size-20{font-size:20px}.font-size-21{font-size:21px}.modal-backdrop{z-index:1020}.doctor-name{font-size:18px;font-weight:600;color:var(--dark-color)}.doctor-name a{color:var(--dark-color)}@media screen and (max-width:767px){.doctor-name{font-size:16px}}.line-height-normal{line-height:normal}.discount-strip{background:var(--light-purple-color);color:#fff;display:flex;align-items:center;justify-content:center;font-size:var(--body-text-size-2);font-weight:600}@media screen and (max-width:767px){.doctor-picture-frame .body-textsize{font-size:var(--small-text-size)!important}}.title_size_mobile{font-size:16px}@media screen and (max-width:575px){.title_size_mobile{font-size:13.6px}.receipt-row{font-weight:600;padding-left:20px}}@media screen and (min-width:767px){.rceipt-bg-light{background-color:#F7F8F8}.receipt-row{font-weight:600;padding-left:50px}}.payment-receipt-section-card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border-bottom:4px solid #21205F;border-radius:8px}.payment-receipt-section-heading{font-size:24px}.receipt-row-headding{color:var(--light-muted-color)}.receipt-row-text{color:var(--dark-color)}.discount-promotion-modal.modal .modal-dialog{height:calc(100% - 3.5rem)}.discount-promotion-modal.modal .modal-dialog .modal-content{top:50%;transform:translate(0,-50%)}.discount-promotion-modal .modal-content{min-height:600px}.discount-promotion-modal img{width:100%;display:block}@media screen and (max-width:767px){.discount-promotion-modal .modal-content{min-height:auto}}.header-discount-strip{position:relative}.header-discount-strip .close{--size:18px;height:var(--size);width:var(--size);border-radius:var(--size);color:#fff;background:#35358c;opacity:1;font-size:var(--body-text-size-2);position:absolute;right:10px;top:50%;transform:translateY(-50%);padding-bottom:1px;display:none}@media screen and (max-width:767px){.header-discount-strip{padding-right:25px}.header-discount-strip .close{display:block}}.vc-doctor-img{padding:4px}.vc-doctor-img:after{content:'';border:1.5px solid var(--indianred-color);position:absolute;left:0;right:0;top:0;bottom:0;border-radius:100%}.vc-doctor-img::before{content:'';position:absolute;right:9%;top:6%;background-image:url("data:image/svg+xml,%3Csvg width='21' height='21' viewBox='0 0 99 99' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='50.5' cy='53.5' r='37.5' fill='white'/%3E%3Cpath fill-rule='evenodd' clip-rule='evenodd' d='M77.22 62.2057C77.22 62.9264 76.828 63.5897 76.1963 63.9382C75.5649 64.2866 74.7945 64.2649 74.1847 63.8788L61.5523 55.9132V63.36C61.5523 64.453 60.6654 65.34 59.5723 65.34H23.76C22.667 65.34 21.78 64.453 21.78 63.36V35.64C21.78 34.547 22.667 33.66 23.76 33.66H59.5723C60.6654 33.66 61.5523 34.547 61.5523 35.64V43.0868L74.1847 35.1212C74.7945 34.7351 75.5649 34.7134 76.1963 35.0618C76.828 35.4103 77.22 36.0736 77.22 36.7943V62.2057ZM84.5024 14.4976C75.1531 5.148 62.7224 0 49.5 0C36.2776 0 23.8471 5.148 14.4976 14.4976C5.14998 23.8471 0 36.2776 0 49.5C0 58.5922 2.47698 67.4487 7.17354 75.1766L0.100982 96.3943C-0.134638 97.1051 0.0494985 97.8892 0.580139 98.4199C0.958319 98.798 1.46322 99 1.98 99C2.18988 99 2.40174 98.9663 2.60568 98.899L23.8234 91.8265C31.5513 96.523 40.4078 99 49.5 99C62.7224 99 75.1531 93.852 84.5024 84.5024C93.852 75.1529 99 62.7224 99 49.5C99 36.2776 93.852 23.8471 84.5024 14.4976Z' fill='%23CB4039'/%3E%3C/svg%3E%0A");background-repeat:no-repeat;background-position:50%;height:21px;width:21px;z-index:4}.vc-doctor-img.border-0{padding:0}.vc-doctor-img.border-0:after{border:0}@media only screen and (max-width:767px){.vc-doctor-img::before{right:0;top:0}}.video-consulation-strip{background:var(--indianred-color);color:#fff;display:flex;align-items:center;justify-content:center;font-size:var(--body-text-size-2);font-weight:600}.video-consulation-slider .frame{background:var(--light-purple-color);border-radius:5px;color:#fff;overflow:hidden;display:block;text-decoration:none;height:100%}.vc-slide,.video-consulation-slider .vc-slide{background-image:url(/dist/images/hand-mobile-vc.svg);background-color:var(--indianred-color);background-repeat:no-repeat;background-position:98% 100%;background-size:auto 108px;padding:11px;min-height:108px;font-size:var(--body-text-size);color:var(--indianred-light-color);padding-right:29%;border-radius:5px;display:flex;align-items:center;line-height:normal}.home-vc-slide.vc-slide{display:block}.vc-slide:hover{color:var(--indianred-light-color)}.vc-slide .badge,.video-consulation-slider .vc-slide .badge{background:#fff;color:#A2332E;font-weight:600;font-size:var(--body-text-size)}.video-consulation-slider>div{flex:0 0 84%;max-width:84%;padding-right:5px;padding-left:5px;margin:0 auto}.dd-hospital-carddetails .frame.available-video-hospitalcard{border:1.5px solid var(--indianred-color);position:relative;overflow:visible}.dd-hospital-carddetails .frame.available-video-hospitalcard .discount-strip{border-radius:0 0 3px 3px}.dd-hospital-carddetails .frame.available-video-hospitalcard::before{content:'';position:absolute;--icon-size:16px;right:-7px;top:-7px;background-image:url("data:image/svg+xml,%3Csvg width='21' height='21' viewBox='0 0 99 99' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='50.5' cy='53.5' r='37.5' fill='white'/%3E%3Cpath fill-rule='evenodd' clip-rule='evenodd' d='M77.22 62.2057C77.22 62.9264 76.828 63.5897 76.1963 63.9382C75.5649 64.2866 74.7945 64.2649 74.1847 63.8788L61.5523 55.9132V63.36C61.5523 64.453 60.6654 65.34 59.5723 65.34H23.76C22.667 65.34 21.78 64.453 21.78 63.36V35.64C21.78 34.547 22.667 33.66 23.76 33.66H59.5723C60.6654 33.66 61.5523 34.547 61.5523 35.64V43.0868L74.1847 35.1212C74.7945 34.7351 75.5649 34.7134 76.1963 35.0618C76.828 35.4103 77.22 36.0736 77.22 36.7943V62.2057ZM84.5024 14.4976C75.1531 5.148 62.7224 0 49.5 0C36.2776 0 23.8471 5.148 14.4976 14.4976C5.14998 23.8471 0 36.2776 0 49.5C0 58.5922 2.47698 67.4487 7.17354 75.1766L0.100982 96.3943C-0.134638 97.1051 0.0494985 97.8892 0.580139 98.4199C0.958319 98.798 1.46322 99 1.98 99C2.18988 99 2.40174 98.9663 2.60568 98.899L23.8234 91.8265C31.5513 96.523 40.4078 99 49.5 99C62.7224 99 75.1531 93.852 84.5024 84.5024C93.852 75.1529 99 62.7224 99 49.5C99 36.2776 93.852 23.8471 84.5024 14.4976Z' fill='%23CB4039'/%3E%3C/svg%3E%0A");background-repeat:no-repeat;background-position:50%;background-size:var(--icon-size);height:var(--icon-size);width:var(--icon-size);z-index:4}@media only screen and (max-width:991px){.vc-slide,.video-consulation-slider .vc-slide{font-size:var(--body-text-size-2);display:block}.vc-slide .badge,.video-consulation-slider .vc-slide .badge{font-size:var(--small-text-size)}.custom-auto-slider{display:flex;flex-wrap:nowrap;overflow:auto;margin:0 -7.5px 0 0}.custom-auto-slider>div{flex:0 0 73%;max-width:73%;padding-right:5px;padding-left:5px;margin:0}.video-consulation-slider{margin:0}.video-consulation-slider>div{flex:0 0 100%;max-width:100%;padding-right:5px;padding-left:5px;margin:0 auto}}.modal.fade.mobile-actionsheet-modal .modal-dialog{margin:0 auto;height:100%;display:flex;align-items:center}@media only screen and (max-width:767px){.modal.fade.mobile-actionsheet-modal .modal-dialog{transform:translate(0,25%);margin:0;max-width:100%;height:100%;display:flex;align-items:flex-end}.modal.show.mobile-actionsheet-modal .modal-dialog{transform:translate(0,0)}.modal.show.mobile-actionsheet-modal .modal-dialog .modal-body{max-height:90vh;overflow:auto}}.jazzcash-strip{background:var(--dark-color);color:#fff;display:flex;align-items:center;justify-content:center;font-size:var(--body-text-size-2);font-weight:600}.jazzcash-banner{background:var(--dark-color);color:#fff;display:flex;align-items:center;border-radius:6px;padding:11px 17px;font-size:11.2px}.jazzcash-banner img{width:65px}.jazzcash-banner .badge{background:var(--indianred-color-2);font-size:11.2px;padding:4.5px 11px;margin-bottom:6px;font-weight:600}.jazzcash-banner p{margin-bottom:4px}.des-view .jazzcash-banner{justify-content:center}.des-view .jazzcash-banner .text{display:flex;align-items:center}.des-view .jazzcash-banner .badge{margin:0 10px 4px 0}@media only screen and (max-width:767px){.jazzcash-banner{flex-direction:row-reverse}.jazzcash-banner img{width:100px}.jazzcash-banner br{display:none}}.medical-record-normal-booking-title{margin-top:10px!important}.login-signup-model .select-number-group{display:flex;border:1px solid var(--muted-color-2);border-radius:4px;padding:4px}.login-signup-model .select-number-group select,.login-signup-model .select-number-group input{border:0}.select-number-group .select2-container--default .select2-selection--single{height:100%;background:var(--light-gray);color:var(--dark-muted-color);border:0;font-size:13.6px;outline:none}.select-number-group .select2-container--default .select2-selection--single .select2-selection__rendered{color:var(--dark-muted-color);padding:5px 30px 5px 10px;min-width:117px}.select-number-group .select2-container--default .select2-selection--single .select2-selection__arrow{top:50%;transform:translateY(-50%) rotate(180deg);right:4px}.select-number-group .select2-container--default .select2-selection--single .select2-selection__arrow b{border:0;background-image:url("data:image/svg+xml,%3Csvg width='8' height='5' viewBox='0 0 8 5' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4 1.66497L1.17731 4.48766C0.907988 4.75699 0.471322 4.75699 0.201995 4.48766C-0.0673322 4.21833 -0.0673322 3.78167 0.201995 3.51234L3.51234 0.201995C3.78167 -0.0673317 4.21833 -0.0673317 4.48766 0.201995L7.798 3.51234C8.06733 3.78167 8.06733 4.21833 7.798 4.48766C7.52868 4.75699 7.09201 4.75699 6.82268 4.48766L4 1.66497Z' fill='%2346484B'/%3E%3C/svg%3E%0A");height:5px;width:8px}#select2-mobile_network-results{font-size:13.6px}#select2-mobile_network-results .img-tele-logo{min-width:20px;margin-right:7px}#select2-mobile_network-results .select2-results__option{padding:10px 9px}.select-country-opner.btn{background:#EFF0F2}.select-country-modal .modal-body{padding:106px 0 0}.select-country-modal .country-frame{font-size:13.6px;height:calc(100vh - 106px);overflow:auto;background:#fff}.select-country-modal .country-frame .item{padding:13px;cursor:pointer;background-color:#fff;border-bottom:1px solid #d4d4d4;color:#000;position:relative;display:flex;align-items:center;white-space:normal;word-break:break-word;min-height:51px}.select-country-modal .country-frame .item figure{width:30px;height:20px;margin:0 10px 0 0;overflow:hidden;box-shadow:0 .125rem .25rem rgba(0,0,0,.075)}.select-country-modal .country-frame .item figure img{width:100%;height:100%}#select2-country_code_select2-results{font-size:13.6px}#select2-country_code_select2-results .country-flags{width:20px;margin-right:7px}#select2-country_code_select2-results .select2-results__option{padding:10px 9px}#select2-country_code_select2-results .select2-results__option>span{display:flex;align-items:center}.select2-container.country-container .select2-dropdown{min-width:195px}.country-container.select2-container--default .select2-search--dropdown .select2-search__field{background-image:url("data:image/svg+xml,%3Csvg width='16' height='16' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M12.1992 11.5287L11.5278 12.2002L15.3252 15.9976L15.9966 15.3261L12.1992 11.5287Z' fill='%23FF9900'/%3E%3Cpath d='M7.11586 14.2366C3.18345 14.2366 -0.00439453 11.0488 -0.00439453 7.11635C-0.00439453 3.18394 3.18345 -0.00390625 7.11586 -0.00390625C11.0483 -0.00390625 14.2361 3.18394 14.2361 7.11635C14.2315 11.0469 11.0464 14.232 7.11586 14.2366ZM7.11586 0.945673C3.70789 0.945673 0.945185 3.70838 0.945185 7.11635C0.945185 10.5243 3.70789 13.287 7.11586 13.287C10.5238 13.287 13.2865 10.5243 13.2865 7.11635C13.2827 3.70998 10.5222 0.949539 7.11586 0.945673Z' fill='%239AAAC1'/%3E%3C/svg%3E%0A");background-position:8px 50%;background-repeat:no-repeat;padding:4px 4px 4px 30px}@media only screen and (max-width:767px){#country_code_select2{display:none}#country_code_select2+.select2-container{display:none}}.selec-country-dropown{border:1px solid var(--light-gray);max-height:310px;overflow:auto}.selec-country-dropown .dropdown-item{padding:10px 11px;display:flex;align-items:center}.selec-country-dropown .dropdown-item.selected{border-bottom:1px solid var(--light-gray)}.selec-country-dropown .dropdown-item figure img{display:block;width:100%;min-height:100%}.selec-country-dropown .dropdown-item figure{margin:0;width:20px;margin-right:7px;overflow:hidden}</style><style>:root{--light-blue-color:#434392;--border-color:#ddd}.dd-modal.modal{display:none;padding-top:60px;overflow:auto;background:rgba(0,0,0,.7)}.dd-modal .modal-content{position:relative;margin:auto;padding:0;width:100%;max-width:800px;top:50%;-webkit-transform:translate(0,-53%);-ms-transform:translate(0,-53%);-o-transform:translate(0,-53%);transform:translate(0,-53%);height:530px}.dd-modal .mySlides{height:100%}.dd-modal .mySlides .image-holder{display:flex;height:100%;align-items:center}.dd-modal img{margin:auto;display:block;max-height:475px}.dd-modal .embed-responsive,.dd-modal iframe{z-index:9}.dd-modal .close{color:#fff;position:absolute;top:10px;right:25px;font-size:35px;font-weight:700;opacity:1;z-index:999}.dd-modal .close:hover,.dd-modal .close:focus{color:#fff;text-decoration:none;cursor:pointer}.dd-modal .caption-container{display:none}.mySlides{display:none}.cursor{cursor:pointer}.prev,.next{cursor:pointer;position:absolute;top:50%;width:auto;padding:16px;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);-o-transform:translateY(-50%);transform:translateY(-50%);color:#fff!important;font-weight:700;font-size:20px;transition:0.6s ease;border-radius:0 3px 3px 0;user-select:none;-webkit-user-select:none;background-color:rgba(0,0,0,.8);z-index:999999}.prev{left:0}.next{right:0;border-radius:3px 0 0 3px}.prev:hover,.next:hover{background-color:rgba(0,0,0,.5)}.slick-slider{position:relative;display:block;box-sizing:border-box;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-touch-callout:none;-khtml-user-select:none;-ms-touch-action:pan-y;touch-action:pan-y;-webkit-tap-highlight-color:transparent;padding:0 20px}.slick-list{position:relative;display:block;overflow:hidden;margin:0;padding:0}.slick-list:focus{outline:none}.slick-list.dragging{cursor:pointer}.slick-slider .slick-track,.slick-slider .slick-list{-webkit-transform:translate3d(0,0,0);-moz-transform:translate3d(0,0,0);-ms-transform:translate3d(0,0,0);-o-transform:translate3d(0,0,0);transform:translate3d(0,0,0)}.slick-track{position:relative;top:0;left:0;display:block;margin-left:0;margin-right:0}.slick-track:before,.slick-track:after{display:table;content:''}.slick-track:after{clear:both}.slick-loading .slick-track{visibility:hidden}.slick-slide{display:none;float:left;height:100%;min-height:1px}[dir='rtl'] .slick-slide{float:right}.slick-slide img{display:block}.slick-slide.slick-loading img{display:none}.slick-slide.dragging img{pointer-events:none}.slick-initialized .slick-slide{display:block;padding:0 5px}.slick-loading .slick-slide{visibility:hidden}.slick-vertical .slick-slide{display:block;height:auto;border:1px solid transparent}.slick-arrow.slick-hidden{display:none}.dd-slider .slide-item{height:70px;overflow:hidden;background:#ddd;display:flex!important;align-items:center}.dd-slider .slide-item img{width:100%;max-height:70px}.slick-prev,.slick-next{font-size:0;line-height:0;position:absolute;top:50%;display:block;width:20px;height:20px;padding:0;-webkit-transform:translate(0,-50%);-ms-transform:translate(0,-50%);transform:translate(0,-50%);cursor:pointer;color:transparent;border:none;outline:none;background:transparent}.slick-prev:hover,.slick-prev:focus,.slick-next:hover,.slick-next:focus{color:transparent;outline:none}.slick-prev{left:0;background:url(/dist/images/chevron-left-solid.svg) no-repeat}[dir='rtl'] .slick-prev{right:0;left:auto}.slick-next{right:0;background:url(/dist/images/chevron-right-solid.svg) no-repeat;background-position:100% 0}[dir='rtl'] .slick-next{right:auto;left:-3px}.buttonsSlideup.bottomfixed_btn-holder{z-index:1049;transition:all 0.3s ease;bottom:-76px;transition-delay:1s}.faq_accordion>.frame,.faq_accordion>.col-12{border:1px solid rgba(0,0,0,.125)}.faq_accordion>.col-12:last-child{border:1px solid rgba(0,0,0,.125)}.faq_accordion button h4:after{background:url(/dist/images/minus.svg) no-repeat;content:'';position:absolute;right:0;top:50%;background-size:9px;-webkit-background-size:9px;-moz-background-size:9px;height:12px;width:12px;background-position:center center;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);-o-transform:translateY(-50%);transform:translateY(-50%);z-index:9}.faq_accordion button.collapsed h4:after{background:url(/dist/images/plus.svg) no-repeat;content:'';position:absolute;right:0;top:50%;height:12px;width:12px;background-position:center center;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);-o-transform:translateY(-50%);transform:translateY(-50%);z-index:9;background-size:8px;-webkit-background-size:8px;-moz-background-size:8px}.faq_accordion>.frame.col-md-6{flex:0 0 49.3%;max-width:49.3%}.custom-control{position:relative;display:block;min-height:1.5rem;padding-left:1.5rem}.custom-control-inline{display:-ms-inline-flexbox;display:inline-flex;margin-right:1rem}.custom-control-input{position:absolute;z-index:-1;opacity:0}.custom-control-input:checked~.custom-control-label::before{color:#fff;border-color:#006;background-color:#006}.custom-control-input:not(:disabled):active~.custom-control-label::before{color:#fff;background-color:#006;border-color:#006}.custom-control-input:disabled~.custom-control-label{color:#006}.custom-control-input:disabled~.custom-control-label::before{background-color:#e9ecef}.custom-radio .custom-control-input:checked~.custom-control-label::before{color:#fff;border:2px solid #006;background-color:#fff}.custom-control-label{position:relative;margin-bottom:0;vertical-align:top}.custom-control-label::before{position:absolute;top:.25rem;left:-1.5rem;display:block;width:1.2rem;height:1.2rem;pointer-events:none;content:"";background-color:#fff;border:#adb5bd solid 1px}.custom-control-label::after{position:absolute;top:.25rem;left:-1.5rem;display:block;width:1.2rem;height:1.2rem;content:"";background:no-repeat 50% / 50% 50%}.custom-checkbox .custom-control-label::before{border-radius:0}.filters_sort_modal .custom-checkbox .custom-control-label::before{border-radius:.25rem}.filters_sort_modal .custom-control-input:checked~.custom-control-label{font-weight:600}.custom-checkbox .custom-control-input:checked~.custom-control-label::after{background-image:url(data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA3MCA3MCIgZmlsbD0iI2ZmZiI+PGc+PGc+PGc+PHBhdGggZD0iTTI2LjQ3NCw3MGMtMi4xNzYsMC00LjIzNC0xLjAxOC01LjU1Ny0yLjc2NEwzLjA0OSw0My42MzlDMC43MjUsNDAuNTcsMS4zMywzNi4yLDQuMzk5LDMzLjg3NWMzLjA3NC0yLjMyNiw3LjQ0MS0xLjcxNyw5Ljc2NiwxLjM1bDExLjc1MiwxNS41MThMNTUuNDc0LDMuMjg1YzIuMDM1LTMuMjY1LDYuMzMyLTQuMjY0LDkuNjA0LTIuMjMyYzMuMjY4LDIuMDM0LDQuMjY2LDYuMzM0LDIuMjMsOS42MDJsLTM0LjkxNiw1Ni4wNmMtMS4yMTMsMS45NDktMy4zMDcsMy4xNzUtNS42LDMuMjc5QzI2LjY4NSw2OS45OTgsMjYuNTgsNzAsMjYuNDc0LDcweiIvPjwvZz48L2c+PC9nPjwvc3ZnPg==)}.custom-checkbox .custom-control-input:indeterminate~.custom-control-label::before{border-color:#007bff;background-color:#007bff}.custom-checkbox .custom-control-input:indeterminate~.custom-control-label::after{background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 4'%3e%3cpath stroke='%23fff' d='M0 2h4'/%3e%3c/svg%3e")}.custom-checkbox .custom-control-input:disabled:checked~.custom-control-label::before{background-color:rgba(0,123,255,.5)}.custom-checkbox .custom-control-input:disabled:indeterminate~.custom-control-label::before{background-color:rgba(0,123,255,.5)}.custom-radio .custom-control-label::before{border-radius:50%}.custom-radio .custom-control-input:checked~.custom-control-label::after{background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23006'/%3e%3c/svg%3e")}.custom-radio .custom-control-input:disabled:checked~.custom-control-label::before{background-color:rgba(0,123,255,.5)}.custom-radio input[type="radio"]:checked+label.custom-control-label,.custom-radio label.custom-control-label{border-color:transparent;background-color:transparent}.custom-radio input[type="radio"]:checked+label.custom-control-label{color:#006}.custom-switch{padding-left:2.25rem}.custom-switch .custom-control-label::before{left:-2.25rem;width:1.75rem;pointer-events:all;border-radius:.5rem}.custom-switch .custom-control-label::after{top:calc(.25rem + 2px);left:calc(-2.25rem + 2px);width:calc(1rem - 4px);height:calc(1rem - 4px);background-color:#adb5bd;border-radius:.5rem;transition:background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out,-webkit-transform 0.15s ease-in-out;transition:transform 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out;transition:transform 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out,-webkit-transform 0.15s ease-in-out}@media (prefers-reduced-motion:reduce){.custom-switch .custom-control-label::after{transition:none}}.custom-switch .custom-control-input:checked~.custom-control-label::after{background-color:#fff;-webkit-transform:translateX(.75rem);transform:translateX(.75rem)}.custom-switch .custom-control-input:disabled:checked~.custom-control-label::before{background-color:rgba(0,123,255,.5)}.custom-select{display:inline-block;width:100%;height:calc(1.5em + .75rem + 2px);padding:.375rem 1.75rem .375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#495057;vertical-align:middle;background:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right .75rem center/8px 10px;background-color:#fff;border:1px solid #ced4da;border-radius:.25rem;-webkit-appearance:none;-moz-appearance:none;appearance:none}.custom-select:focus{border-color:#80bdff;outline:0;box-shadow:0 0 0 .2rem rgba(0,123,255,.25)}.custom-select:focus::-ms-value{color:#495057;background-color:#fff}.custom-select[multiple],.custom-select[size]:not([size="1"]){height:auto;padding-right:.75rem;background-image:none}.custom-select:disabled{color:#6c757d;background-color:#e9ecef}.custom-select::-ms-expand{display:none}.custom-select-sm{height:calc(1.5em + .5rem + 2px);padding-top:.25rem;padding-bottom:.25rem;padding-left:.5rem;font-size:.875rem}.custom-select-lg{height:calc(1.5em + 1rem + 2px);padding-top:.5rem;padding-bottom:.5rem;padding-left:1rem;font-size:1.25rem}.custom-file{position:relative;display:inline-block;width:100%;height:calc(1.5em + .75rem + 2px);margin-bottom:0}.custom-file-input{position:relative;z-index:2;width:100%;height:calc(1.5em + .75rem + 2px);margin:0;opacity:0}.custom-file-input:disabled~.custom-file-label{background-color:#e9ecef}.custom-file-input:lang(en)~.custom-file-label::after{content:"Browse"}.custom-file-input~.custom-file-label[data-browse]::after{content:attr(data-browse)}.custom-file-label{position:absolute;top:0;right:0;left:0;z-index:1;height:calc(1.5em + .75rem + 2px);padding:.375rem .75rem;font-weight:400;line-height:1.5;color:#495057;background-color:#fff;border:1px solid #ced4da;border-radius:.25rem}.custom-file-label::after{position:absolute;top:0;right:0;bottom:0;z-index:3;display:block;height:calc(1.5em + .75rem);padding:.375rem .75rem;line-height:1.5;color:#495057;content:"Browse";background-color:#e9ecef;border-left:inherit;border-radius:0 .25rem .25rem 0}@media (prefers-reduced-motion:reduce){.custom-control-label::before,.custom-file-label,.custom-select{transition:none}}.sect-filters_and_sort .select-sortby{font-size:13.6px}.sect-filters_and_sort .title{min-width:58px}.sect-filters_and_sort .mobile-filters li{position:relative;flex-shrink:0}.mobile-filters li input,.mobile-filters li .discounted-toggle-button-hidden{position:absolute;visibility:hidden;opacity:0}.mobile-filters li input+label,.mobile-filters li .discounted-toggle-button+label,.sect-filters_and_sort .mobile-filters li a{border:1px solid var(--primary-color);color:var(--primary-color);padding:3px 12px;border-radius:50rem;font-weight:600;text-decoration:none;display:block;margin:0;margin-right:7px}.sect-filters_and_sort .mobile-filters li:last-child a{margin-right:0}.mobile-filters input:checked+label,.mobile-filters .discounted-toggle-button:checked+label,.sect-filters_and_sort .mobile-filters li a:focus,.sect-filters_and_sort .mobile-filters li a:hover,.sect-filters_and_sort .mobile-filters li a.discount-filter.active,.sect-filters_and_sort .mobile-filters li a.discount-filter:focus,.sect-filters_and_sort .mobile-filters li a.discount-filter:hover{background:var(--primary-color);color:#fff}.sect-filters_and_sort .custom-control{padding-left:2rem}.sect-filters_and_sort .mobile-filters .custom-control{padding-left:1.4rem}.text-sm .custom-control-label::before{top:0}.custom-control-label::after{top:0;background:no-repeat 50% / 64% 63%}.modal-open .modal.filters_sort_modal{overflow:hidden;height:100%}.filters_sort_modal .modal-header{z-index:9}.filters_sort_modal .modal-header .close{padding:.8rem;opacity:1}.filters_sort_modal .title{font-size:12px;font-weight:700}.filters_sort_modal .custom-control{padding-left:2rem;margin-bottom:10px!important}.filters_sort_modal .custom-control .custom-control-label::after,.filters_sort_modal .custom-control .custom-control-label::before{left:-2rem;top:0;width:1.25rem;height:1.25rem}.filters_sort_modal .modal-body{overflow-x:hidden;overflow-y:auto;-webkit-transition:all 0.6s ease;-moz-transition:all 0.3s ease;-o-transition:all 0.3s ease;-ms-transition:all 0.3s ease;transition:all 0.6s ease;height:100%;left:0;top:0;right:0;bottom:0;position:absolute;padding-top:72px;padding-bottom:76px;z-index:1;vertical-align:baseline}.listing-_hiner_laoder{position:absolute;left:0;top:0;bottom:0;right:0;z-index:5;display:none;overflow:hidden}.sect-filters_and_sort .mobile-filters .custom-control-label::after,.sect-filters_and_sort .mobile-filters .custom-control-label::before{width:1rem;height:1rem;left:-1.3rem}.sect-filters_and_sort .mobile-filters li.allfilters span{color:#c45500}.sect-filters_and_sort .sortby select{min-width:147px;color:#212529}.fixed-header .as-search-section{z-index:1040}.filters_sort_modal .modal-footer{-webkit-transition:all 0.6s ease;-moz-transition:all 0.3s ease;-o-transition:all 0.3s ease;-ms-transition:all 0.3s ease;transition:all 0.6s ease;bottom:0;position:fixed;left:0;right:0;z-index:99}.useapp-modal .app-icon-holder .btn{min-width:96px}.call-number-svg{min-width:16px}.tooltip-bottom{top:100%;min-width:100px;left:50%;background:#28318C;color:#fff;margin-top:10px;transform:translate(-50%);width:246px}.tooltip-bottom:after{width:0;height:0;border-style:solid;border-width:0 12px 10px 12px;border-color:transparent transparent #28318C transparent;content:'';position:absolute;bottom:100%;left:50%;transform:translate(-50%)}.non-intrusive-card{z-index:1035;background:url(/dist/images/doctor-notify-comp.png);background-repeat:no-repeat;background-position:105% 100%;background-size:auto 90%;overflow:hidden;background-color:#006!important}.non-intrusive-card figure{max-width:90px}.dd-open-oladoc-app.fixed-bottom{bottom:60px}.useapp-modal .app-icon-holder .btn{min-width:96px}.tooltip-bottom .tooltip-crose-icon{position:absolute;right:8px;top:8px}.call-number-svg{min-width:16px}.btn.btn-outline-indianred,.btn.btn-primary,.btn.btn-warning,.btn.btn-outline-primary{height:43px;line-height:1.7}.btn.btn-outline-indianred{border-width:1.5px;display:flex;align-items:center;justify-content:center}.bottom-pagination .btn.btn-primary{height:auto;line-height:1.5}.btn.btn-warning{padding:3px .75rem 4px;display:flex;align-items:center;flex-wrap:wrap;justify-content:center;line-height:1.4}a.btn.btn-warning{line-height:normal}.btn.no-booking-btn{font-size:14px}.btn .no-booking{font-size:11px;line-height:13px;font-weight:normal!important;width:100%}.btn.text-size-14,.text-size-14{font-size:14px;line-height:2}.listing_links_holder .btn{width:32%;text-align:left}.patient_review_chart{line-height:1}.single-chart{--size:66px;--stroke-color:#9AAAC1;width:var(--size);height:var(--size);border-radius:var(--size);position:relative;justify-content:center;display:flex;align-items:center;font-weight:700;margin:0 auto 4px}.single-chart:after{content:attr(data-percent)"%";text-align:center;position:absolute;top:-4px;color:#fff;font-size:10px;left:50%;z-index:1;padding:1px 3px;border-radius:.25rem;background:var(--stroke-color);font-weight:500}.single-chart:before{content:"";--size:calc(100% - 4px);width:var(--size);z-index:0;height:var(--size);border-radius:var(--size);position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);border:solid 3px #fff;background-color:#F3F2F7}.single-chart svg{z-index:2}.single-chart.green{--stroke-color:#81bf5d}.single-chart .circular-chart{display:block;position:absolute;z-index:1}.single-chart .circle{fill:none;stroke-width:1;stroke-linecap:round;animation:progress 1s ease-out forwards;stroke:var(--stroke-color)}@keyframes progress{0%{stroke-dasharray:0 100}}.single-helpline-btn{position:relative}.single-helpline-btn:after{width:100%;height:100%;border:inherit;top:0;left:0;z-index:-1;background:var(--primary-color);border-radius:inherit;animation:pulsing 2.5s linear infinite;content:"";position:absolute}.single-helpline-btn:after{animation:pulsing1 2.5s linear infinite}.single-helpline-btn.btn-warning:before,.single-helpline-btn.btn-warning:after{background:var(--warning-color)}@keyframes pulsing1{0%{opacity:1;transform:scaleY(1) scaleX(1)}20%{opacity:.5}70%{opacity:.2;transform:scaleY(1.5) scaleX(1.15)}80%{opacity:0;transform:scaleY(1.5) scaleX(1.15)}90%{opacity:0;transform:scaleY(1) scaleX(1)}}.infinite-call-icon{-webkit-animation:1s ease-in-out 0s normal none infinite running kmacb-circle-img-anim;animation:1s ease-in-out 0s normal none infinite running kmacb-circle-img-anim}@-webkit-keyframes kmacb-circle-img-anim{0%,100%,50%{-webkit-transform:rotate(0) scale(1) skew(1deg);transform:rotate(0) scale(1) skew(1deg)}10%,30%{-webkit-transform:rotate(-25deg) scale(1) skew(1deg);transform:rotate(-25deg) scale(1) skew(1deg)}20%,40%{-webkit-transform:rotate(25deg) scale(1) skew(1deg);transform:rotate(25deg) scale(1) skew(1deg)}}@keyframes kmacb-circle-img-anim{0%,100%,50%{-webkit-transform:rotate(0) scale(1) skew(1deg);transform:rotate(0) scale(1) skew(1deg)}10%,30%{-webkit-transform:rotate(-25deg) scale(1) skew(1deg);transform:rotate(-25deg) scale(1) skew(1deg)}20%,40%{-webkit-transform:rotate(25deg) scale(1) skew(1deg);transform:rotate(25deg) scale(1) skew(1deg)}}.inner-pulsing-helpline-btn.btn.btn-warning{position:relative;-webkit-transition-property:color;transition-property:color;-webkit-transition-duration:2.5s;transition-duration:2.5s;overflow:hidden;-webkit-transform:perspective(1px) translateZ(0);transform:perspective(1px) translateZ(0);background-color:#ff9e15}.inner-pulsing-helpline-btn.btn.btn-warning::before{content:"";position:absolute;z-index:-1;top:0;left:0;right:0;bottom:0;background:#fff;border-radius:100%;-webkit-transform:scale(0);transform:scale(0);-webkit-transition-property:transform;transition-property:transform;-webkit-transition-timing-function:ease-out;transition-timing-function:ease-out;opacity:.18;animation:inner-pulsing 2s linear infinite}@keyframes inner-pulsing{0%{transform:scale(0)}70%{transform:scale(1.3)}80%{transform:scale(1.7)}90%{transform:scale(1.9)}100%{transform:scale(2)}}.border-effect-helpline-btn.btn.btn-warning{position:relative;--border-color:#fff}.border-effect-helpline-btn-2.btn.btn-warning{border:0!important;--border-color:#f7700ae3}.border-effect-helpline-btn.btn.btn-warning::before,.border-effect-helpline-btn.btn.btn-warning::after{content:'';box-sizing:border-box;position:absolute;border:2px solid transparent;width:0;height:0;border-radius:3px}.border-effect-helpline-btn-2.btn.btn-warning::before,.border-effect-helpline-btn-2.btn.btn-warning::after{border:4px solid transparent}.border-effect-helpline-btn.btn.btn-warning::before{top:0;left:0;border-top-color:var(--border-color);border-right-color:var(--border-color);animation:border-effect 3s infinite}.border-effect-helpline-btn-2.btn.btn-warning::before{top:-3px;left:0}.border-effect-helpline-btn.btn.btn-warning::after{bottom:0;right:0;animation:border-effect 3s 1.5s infinite,borderColor-effect 3s 1.5s infinite}.border-effect-helpline-btn-2.btn.btn-warning::after{bottom:-3px;right:0}@keyframes border-effect{0%{width:0;height:0}25%{width:100%;height:0}50%{width:100%;height:100%}100%{width:100%;height:100%}}@keyframes borderColor-effect{0%{border-bottom-color:var(--border-color);border-left-color:var(--border-color)}50%{border-bottom-color:var(--border-color);border-left-color:var(--border-color)}51%{border-bottom-color:transparent;border-left-color:transparent}100%{border-bottom-color:transparent;border-left-color:transparent}}.underline-animate .outter{flex-direction:column;line-height:normal}.btn .no-booking.no-booking-underline{position:relative;width:auto;overflow:hidden;padding-bottom:3px}.no-booking-underline:after{position:absolute;content:'';bottom:0;height:2px;background:#fff;animation:no-booking-underline 2s ease-in-out infinite}@keyframes no-booking-underline{0%{left:-30%;width:0}100%{left:100%;width:100%}}.practice-locations-card .seeonmap-icon-holder{width:24px;margin-left:-2px;margin-right:5px}.deals-badges-item{--style:#9aaac1;color:var(--style);cursor:pointer;position:relative;height:33px;display:inline-flex;align-items:center;font-size:11.2px;margin:4px 0}.deals-badges-item .icon{--size:33px;width:var(--size);height:var(--size);border-radius:var(--size);border:solid 1px var(--style);background:white;display:flex;align-items:center;justify-content:center;position:absolute;top:50%;transform:translateY(-50%);z-index:1}.deals-badges-item span{display:block;border-radius:50px;height:25px;padding:0 15px 0 38px;line-height:26px;background:var(--style);color:white}.overflow-auto::-webkit-scrollbar{height:5px;width:5px}.overflow-auto::-webkit-scrollbar-track{background:#f1f1f1}.overflow-auto::-webkit-scrollbar-thumb{background:var(--primary-color)}.overflow-auto::-webkit-scrollbar-thumb:hover{background:var(--warning-color)}.services-link-list{--text-color:#5F646D;display:flex;flex-wrap:wrap;color:var(--text-color)}.services-link-list a,.services-link-list button{color:var(--text-color)}.services-link-list li+li{position:relative;padding-left:20px}.services-link-list li+li:before{content:'\002e';color:var(--text-color);font-size:1.5rem;position:absolute;left:7px;line-height:.2rem}.services-link-list li span{max-width:120px;display:block}.alternate-doc-slider.overflow-auto{padding:0;overflow:visible;margin:0 -5px}.alternate-doc-slider .card-body{min-height:126px;cursor:pointer}.alternate-doc-slider .slick-arrow{--size:36px;z-index:9;background:#F2F2F2;width:var(--size);height:var(--size);border-radius:var(--size);-webkit-transition:opacity 0.5s,visibility 0.5s;transition:opacity 0.5s,visibility 0.5s;opacity:.6;border:1px solid #dfe1e5;box-shadow:0 0 0 1px rgba(0,0,0,.04),0 4px 8px 0 rgba(0,0,0,.2)}.alternate-doc-slider .slick-arrow:hover{opacity:1}.alternate-doc-slider .slick-arrow.slick-disabled:hover,.alternate-doc-slider .slick-arrow.slick-disabled{opacity:0}.alternate-doc-slider .slick-next{right:-16px}.alternate-doc-slider .slick-prev{left:-16px}.alternate-doc-slider .slick-arrow:after{background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z'%3E%3C/path%3E%3C/svg%3E");background-size:24px;content:'';width:var(--size);height:var(--size);display:block;background-repeat:no-repeat;background-position:49% 50%}.alternate-doc-slider .slick-next:after{transform:rotate(180deg)}.deals-badges-item{--style:#9aaac1;color:var(--style);cursor:pointer;position:relative;height:33px;display:inline-flex;align-items:center;font-size:11.2px;margin:4px 0}.deals-badges-item .icon{--size:33px;width:var(--size);height:var(--size);border-radius:var(--size);border:solid 1px var(--style);background:white;display:flex;align-items:center;justify-content:center;position:absolute;top:50%;transform:translateY(-50%);z-index:1}.deals-badges-item span{display:block;border-radius:50px;height:25px;padding:0 15px 0 38px;line-height:26px;background:var(--style);color:white}.dropdown-menu .overflow-auto{max-height:227px;overflow:auto}.first-letter-text{--size:27px;width:var(--size);height:var(--size);border-radius:var(--size);background:#F0F0F0;color:#787878;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:13px}.sect-patient-experience .name-holder{font-size:11.5px;color:#787878}.sect-patient-experience .like-icon{color:var(--light-green-color)}.sect-patient-experience .bg-success{background:var(--light-green-color)}.multi-patient-exp>div{border-bottom:1px solid #F0F0F0;margin:0 0 20px}.multi-patient-exp>div:last-child{border:0;margin:0}.multi-patient-exp svg.unlike{transform:rotateX(180deg)}.back-to-top-button{--size:43px;height:var(--size);width:var(--size);display:flex;align-items:center;justify-content:center;background:#9aaac1;color:#fff;z-index:9;position:fixed;right:20px;bottom:16px;box-shadow:0 .125rem .25rem rgba(0,0,0,.075);border-radius:5px}.discount-price{background:rgba(0,0,102,.2);border:1px solid var(--primary-color);border-radius:2px;color:#000}.disc-list .list-item+.list-item{position:relative;padding-left:20px}.disc-list .list-item+.list-item:before{content:' • ';color:#000;font-size:16px;position:absolute;left:7px;top:1.5px}.dropdown-disc-list.disc-list .list-item+.list-item:before{line-height:1}.border-bottom.border-dashed{border-bottom:2px dashed #9999C2!important}.border-bottom.border-dashed-indianred{border-bottom:2px dashed var(--indianred-color)!important}.bookappointment-mobile-model .modal-body a,.doc-listing-card .dropdown-menu a.dropdown-item{padding-right:2.5rem!important;position:relative}.bookappointment-mobile-model .modal-body a:after,.doc-listing-card .dropdown-menu a.dropdown-item:after{position:absolute;right:10px;top:50%;transform:translateY(-50%);content:'';height:11px;width:7px;background-image:url("data:image/svg+xml,%3Csvg width='6' height='11' viewBox='0 0 6 11' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 9L3.75 5.25L0 1.5L0.75 0L6 5.25L0.75 10.5L0 9Z' fill='%23000066'/%3E%3C/svg%3E%0A");background-repeat:no-repeat}.close.bg-light{--size:30px;width:var(--size);height:var(--size);background:var(--mediumgray-default-color)!important;color:#040404;opacity:1;display:flex;align-items:center;justify-content:center}.slick-dotted.slick-slider{margin-bottom:30px}.slick-dots{position:absolute;bottom:-17px;display:block;width:auto;padding:0;margin:0;list-style:none;text-align:center}.slick-dots li{position:relative;display:inline-block;margin:0 5px;padding:0;cursor:pointer}.slick-dots li button{--size:5px;font-size:0;line-height:0;display:block;width:16px;height:var(--size);border-radius:var(--size);cursor:pointer;color:transparent;border:0;outline:none;background:rgba(154,170,193,.6)}.slick-dots li.slick-active button,.slick-dots li button:hover,.slick-dots li button:focus{background:#434392}.doc-listing-card.card{--border-color:#E8E8E8;border-color:var(--border-color)!important}.doc-listing-card .text-muted{color:var(--muted-color-2)!important}.doctor-card-badge{font-size:var(--body-text-size);display:flex;flex-wrap:wrap}.doctor-card-badge .badge-frame{border:1px solid var(--border-color);display:flex;align-items:center;padding:1px .5rem;margin-right:.5rem;color:var(--primary-dark-color)}.doctor-card-badge .badge-frame.discount-badge{border-color:var(--light-purple-color);background:var(--light-purple-color);color:#fff}.featured-doctors-slider.alternate-doc-slider .card-body{min-height:130px}hr{border-color:var(--mediumgray-default-color)!important}@media only screen and (max-width:1200px){.dd-slider .slide-item{height:60px}.dd-slider .slide-item img{max-height:60px}.faq_accordion>.frame.col-md-6{flex:0 0 49%;max-width:49%}.listing_links_holder .btn{width:48%}}@media only screen and (max-width:991px){.btn-holder.border-bottom{border:0!important}.booking-btn-holder{padding-top:.7rem}}@media only screen and (max-width:767px){.dd-modal .modal-content{-webkit-transform:translate(0,-58%);-ms-transform:translate(0,-58%);-o-transform:translate(0,-58%);transform:translate(0,-58%);padding:0;height:auto;background:transparent}.faq_accordion>.col-12{flex:0 0 100%;max-width:100%;border-bottom:0}.sect-filters_and_sort{position:sticky;top:66px;box-shadow:0 .225rem .25rem rgba(0,0,0,.075);z-index:1020}@supports ((position:-webkit-sticky) or (position:sticky)){.sect-filters_and_sort{position:-webkit-sticky;position:sticky}}.filters_sort_modal .modal-dialog{height:100%}.login-signup-model.filters_sort_modal .modal-content{height:100%;min-height:100%;-webkit-transition:all 0.6s ease;-moz-transition:all 0.3s ease;-o-transition:all 0.3s ease;-ms-transition:all 0.3s ease;transition:all 0.6s ease}body.modal-open{position:absolute;left:0;top:0;right:0;overflow:hidden}.faq_accordion>.frame.col-md-6{flex:0 0 100%;max-width:100%}#footer{padding-bottom:50px}.overflow-auto{-ms-overflow-style:none;scrollbar-width:none;-webkit-overflow-scrolling:touch;-webkit-webkit-scrollbar-width:none;-moz-webkit-scrollbar-width:none;-ms-webkit-scrollbar-width:none;-o-webkit-scrollbar-width:none}.overflow-auto::-webkit-scrollbar{display:none;background:transparent;width:0;height:0;-webkit-appearance:none}.overflow-auto::-webkit-scrollbar-track{background:transparent}.overflow-auto::-webkit-scrollbar-thumb{background:transparent}.overflow-auto::-webkit-scrollbar-thumb:hover{background:transparent}.alternate-doc-slider.overflow-auto{overflow:auto}.alternate-doc-slider{padding:0}.alternate-doc-slider .card-body{min-height:101px}.alternate-doc-slider{overflow:auto;display:flex;flex-wrap:nowrap}.alternate-doc-slider>div{flex:0 0 75%;max-width:75%;padding-right:7.5px;padding-left:7.5px}.similar-doc-card .border-bottom:last-child{border:0!important}.bottomfixed_btn-holder.fixed-bottom .btn{height:50px}.featured-doctors-slider.alternate-doc-slider.overflow-auto{overflow:visible}.featured-doctors-slider.alternate-doc-slider>div{flex:0 0 100%;max-width:100%;padding-right:25vw;padding-left:0}.call-button-tooltip,.tooltip{display:none!important}.practice-locations-card .seeonmap-icon-holder{width:30px;margin:0 auto}.call-button-tooltip,.tooltip{display:none!important}.featured-doctors-slider .avatar{padding:0 .25rem}.featured-doctors-slider.alternate-doc-slider .card-body{min-height:111px}.doctor-card-badge .badge-frame{margin-right:.2rem}.disc-list .list-item+.list-item{padding-left:12px}.disc-list .list-item+.list-item:before{left:4px}.sect-filters_and_sort.bg-light,.as-search-section.bg-light{background-color:#fff!important}}@media only screen and (max-width:575px){.dd-slider .slide-item{height:60px}.dd-slider .slide-item img{max-height:60px}.listing_links_holder .btn{width:auto;display:block}.sect-filters_and_sort .mobile-filters .custom-control{padding-left:1.3rem}}@media only screen and (max-width:374px){.sect-filters_and_sort .mobile-filters li.available-in-3days{display:none}.sect-filters_and_sort .mobile-filters li.allfilters{padding-left:0!important}.allfilters .tooltip-bottom{left:16vw;transform:translate(0);right:0;margin:10px auto}.bottomfixed_btn-holder .btn{font-size:4.45vw}.tooltip-bottom:after{left:auto;right:15px}.patient_review_chart{font-size:14px}.alternate-doc-slider>div{flex:0 0 85%;max-width:85%}.bottomfixed_btn-holder.fixed-bottom .btn{height:43px}.featured-doctors-slider.alternate-doc-slider .card-body{min-height:95px}}.featured-ser-list span+span{position:relative;padding-left:20px}.featured-ser-list span+span:before{content:'\002e';color:var(--text-color);font-size:1.5rem;position:absolute;left:7px;line-height:.2rem}.featured-doctors-list{padding-bottom:13px}.featured-doctors-slider.slick-dotted.slick-slider{margin-bottom:18px}.featured-doctors-slider .title{font-weight:600}.featured-doctors-slider .doc-listing-card{border:1px solid #E8E8E8;box-shadow:0 4px 4px rgba(0,0,0,.1);margin-bottom:10px;border-radius:5px}@media only screen and (max-width:575px){.row .doctor-card-img-width{max-width:20%}.row .featured-doctor-card-img-width{max-width:28%}}.shownearme-switcher{padding-left:.5rem;padding-right:4.2rem}.shownearme-switcher .custom-control-input:disabled~.custom-control-label{color:var(--dark-color)}.shownearme-switcher .custom-control-label::before{height:1.64rem;width:3.2rem;border-radius:50rem;left:auto;right:-3.7rem;top:50%;transform:translateY(-47%);background:var(--border-color);border-color:var(--border-color)}.shownearme-switcher.custom-switch .custom-control-label::after{--size:1.6rem;border-radius:100%;width:calc(var(--size) - 4px);height:calc(var(--size) - 4px);top:calc(-.1px + 2px);right:calc(-2.12rem + 2px);left:auto;background-color:#fff;background-image:url("data:image/svg+xml,%3Csvg width='14' height='14' viewBox='0 0 14 14' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 4.45455C5.59364 4.45455 4.45455 5.59364 4.45455 7C4.45455 8.40636 5.59364 9.54545 7 9.54545C8.40636 9.54545 9.54545 8.40636 9.54545 7C9.54545 5.59364 8.40636 4.45455 7 4.45455ZM12.6891 6.36364C12.5449 5.07317 11.9663 3.87007 11.0481 2.9519C10.1299 2.03372 8.92683 1.45505 7.63636 1.31091V0H6.36364V1.31091C5.07317 1.45505 3.87007 2.03372 2.9519 2.9519C2.03372 3.87007 1.45505 5.07317 1.31091 6.36364H0V7.63636H1.31091C1.45505 8.92683 2.03372 10.1299 2.9519 11.0481C3.87007 11.9663 5.07317 12.5449 6.36364 12.6891V14H7.63636V12.6891C8.92683 12.5449 10.1299 11.9663 11.0481 11.0481C11.9663 10.1299 12.5449 8.92683 12.6891 7.63636H14V6.36364H12.6891ZM7 11.4545C4.53727 11.4545 2.54545 9.46273 2.54545 7C2.54545 4.53727 4.53727 2.54545 7 2.54545C9.46273 2.54545 11.4545 4.53727 11.4545 7C11.4545 9.46273 9.46273 11.4545 7 11.4545Z' fill='%236666A3'/%3E%3C/svg%3E%0A");background-repeat:no-repeat;background-position:50%}.shownearme-switcher.custom-switch .custom-control-input:checked~.custom-control-label::after{-webkit-transform:translateX(1.62rem);transform:translateX(1.62rem);background-image:url("data:image/svg+xml,%3Csvg width='11' height='8' viewBox='0 0 11 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10.7255 1.60679L4.64061 7.7241C4.45806 7.90763 4.21842 8 3.97879 8C3.73916 8 3.49953 7.90763 3.31697 7.7241L0.2746 4.66545C-0.0915335 4.29753 -0.0915335 3.70265 0.2746 3.33473C0.640563 2.96663 1.2321 2.96663 1.59824 3.33473L3.97879 5.72802L9.40189 0.27607C9.76785 -0.0920234 10.3594 -0.0920234 10.7255 0.27607C11.0915 0.643991 11.0915 1.2387 10.7255 1.60679Z' fill='%236666A3'/%3E%3C/svg%3E%0A")}.shownearme-switcher.custom-switch .custom-control-input:disabled:checked~.custom-control-label::before,.shownearme-switcher .custom-control-input:not(:disabled):active~.custom-control-label::before,.shownearme-switcher .custom-control-input:checked~.custom-control-label::before{border-color:var(--light-purple-color);background-color:var(--light-purple-color)}.onoffswitch{position:relative;width:107px;display:inline-block;font-size:13.6px;text-align:left}.onoffswitch .onoffswitch-label{display:block;overflow:hidden;cursor:pointer;border:1px solid var(--lavender-color);-moz-border-radius:20px;-webkit-border-radius:20px;border-radius:20px;margin:0}.onoffswitch .onoffswitch-inner{width:200%;margin-left:-100%;-webkit-transition:margin 0.15s ease-in-out;-o-transition:margin 0.15s ease-in-out;-moz-transition:margin 0.15s ease-in-out;transition:margin 0.15s ease-in-out;font-weight:600}.onoffswitch .onoffswitch-inner:before,.onoffswitch .onoffswitch-inner:after{float:left;width:50%;height:24px;padding:0;line-height:24px;font-size:var(--body-text-size);color:hsl(0,0%,100%);-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box}.onoffswitch .onoffswitch-inner:before{content:"Discounts";padding-left:10px;background-color:var(--light-purple-color);color:hsl(0,0%,100%)}.onoffswitch .onoffswitch-inner:after{content:"Discounts";padding-right:10px;background-color:var(--lavender-color);color:var(--light-purple-color);text-align:right}.onoffswitch .onoffswitch-switch{--size:22px;width:var(--size);height:var(--size);margin:0;background-image:url("data:image/svg+xml,%3Csvg width='16' height='16' viewBox='0 0 18 18' color='%236666A3' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M12.7714 2.33137L13.2176 5.15493L15.7852 6.4643L14.4904 9.02453L15.7925 11.5848L13.203 12.8941L12.7568 15.7177L9.91127 15.2715L7.88503 17.2904L5.85148 15.2422L3.02792 15.7104L2.57439 12.8649L0.0214844 11.5628L1.32354 9.00258L0.0287993 6.4643L2.59634 5.1403L3.04255 2.33868L5.87343 2.80684L7.90698 0.751343L9.93321 2.77758L12.7714 2.33137ZM6.07824 5.36706C5.78724 5.36706 5.50815 5.48266 5.30238 5.68844C5.09661 5.89421 4.98101 6.1733 4.98101 6.4643C4.98101 6.75531 5.09661 7.03439 5.30238 7.24017C5.50815 7.44594 5.78724 7.56154 6.07824 7.56154C6.36925 7.56154 6.64834 7.44594 6.85411 7.24017C7.05988 7.03439 7.17548 6.75531 7.17548 6.4643C7.17548 6.1733 7.05988 5.89421 6.85411 5.68844C6.64834 5.48266 6.36925 5.36706 6.07824 5.36706ZM9.73571 10.4875C9.4447 10.4875 9.16562 10.6031 8.95984 10.8089C8.75407 11.0147 8.63847 11.2937 8.63847 11.5848C8.63847 11.8758 8.75407 12.1548 8.95984 12.3606C9.16562 12.5664 9.4447 12.682 9.73571 12.682C10.0267 12.682 10.3058 12.5664 10.5116 12.3606C10.7173 12.1548 10.8329 11.8758 10.8329 11.5848C10.8329 11.2937 10.7173 11.0147 10.5116 10.8089C10.3058 10.6031 10.0267 10.4875 9.73571 10.4875ZM5.28092 12.682L11.5644 6.39847L10.533 5.36706L4.24951 11.6506L5.28092 12.682Z' fill='currentColor'%3E%3C/path%3E%3C/svg%3E");background-position:70% 50%;background-repeat:no-repeat;background-color:var(--ghostwhite-color);box-shadow:0 0 3px rgba(0,0,0,.3);-moz-border-radius:50%;-webkit-border-radius:50%;border-radius:50%;position:absolute;top:2px;bottom:0;right:83px;-webkit-transition:right 0.15s ease-in-out;-o-transition:right 0.15s ease-in-out;-moz-transition:right 0.15s ease-in-out;transition:right 0.15s ease-in-out}.discount-filter-switcher{position:relative;height:27px;display:inline-block}.discount-filter-switcher input[type=checkbox]{position:absolute;left:10px;opacity:0}.discount-filter-switcher input[type=checkbox]:checked~.onoffswitch .onoffswitch-label .onoffswitch-inner{margin-left:0}.discount-filter-switcher input[type=checkbox]:checked~.onoffswitch .onoffswitch-label .onoffswitch-switch{right:1px;box-shadow:0 0 3px rgba(0,0,0,.5);background-image:url("data:image/svg+xml,%3Csvg width='11' height='8' viewBox='0 0 11 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10.7255 1.60679L4.64061 7.7241C4.45806 7.90763 4.21842 8 3.97879 8C3.73916 8 3.49953 7.90763 3.31697 7.7241L0.2746 4.66545C-0.0915335 4.29753 -0.0915335 3.70265 0.2746 3.33473C0.640563 2.96663 1.2321 2.96663 1.59824 3.33473L3.97879 5.72802L9.40189 0.27607C9.76785 -0.0920234 10.3594 -0.0920234 10.7255 0.27607C11.0915 0.643991 11.0915 1.2387 10.7255 1.60679Z' fill='%236666A3'/%3E%3C/svg%3E%0A");background-position:50%}.discount-filter-switcher input[type=checkbox]:focus~.onoffswitch{outline:thin dotted #333;outline:0}.discount-filter-switcher label{position:absolute;cursor:pointer;padding-left:30px;display:inline-block;text-align:left;line-height:26px;width:100%;z-index:1;height:26px;font-weight:200}.aural{clip:rect(1px,1px,1px,1px);height:1px;overflow:hidden;position:absolute;width:1px}.aural:focus{clip:rect(0,0,0,0);font-size:1em;height:auto;outline:thin dotted;position:static!important;width:auto;overflow:visible}.popover__content{opacity:0;visibility:hidden;position:absolute;left:50%;top:37px;background-color:#6666A3;padding:12px 0 12px 0;box-shadow:0 2px 5px 0 rgba(0,0,0,.26);width:255.44px;z-index:10;opacity:1;visibility:visible;border-radius:3px}.popover__content:before{position:absolute;z-index:-1;content:"";right:calc(85% - 10px);top:-8px;border-style:solid;border-width:0 10px 10px 10px;border-color:transparent transparent #6666A3 transparent}.popover__title{text-align:left;width:223.1px;height:22.88px;left:82.16px;top:120px;font-weight:550;font-size:16px;line-height:19px;color:#fff;margin-bottom:auto;margin-left:15px;margin:7px 0 0 12px;}.popover__message{width:252px;height:33px;left:82px;top:145.88px;text-align:left;color:#fff;margin:0 0 12px 12px;}.popover__btn{border:none;color:#fff;font-weight:600;font-size:11.2px;line-height:14px;background:#54548A;border-radius:2px;display:flex;margin-left:215px}@media only screen and (max-width:380px){.sect-filters_and_sort .mobile-filters{font-size:var(--small-text-size)}.onoffswitch{width:88px}.onoffswitch .onoffswitch-switch{right:68px}.onoffswitch .onoffswitch-switch{--size:18px}.onoffswitch .onoffswitch-inner:before,.onoffswitch .onoffswitch-inner:after{font-size:var(--small-text-size);height:20px;line-height:20px}.btn.btn-outline-indianred svg{display:none}}.nearme-distance{background:var(--light-gray);color:var(--dark-muted-color);display:inline-block;position:absolute;right:10px;top:10px;font-size:11.2px;font-weight:600;padding:2px 6px;border-radius:3px}.mobile-actionsheet-modal .btn{padding:9px 12px}.mobile-actionsheet-modal figure{max-width:150px;margin:0 auto 1rem}.video-consulation-slider.des-video-consult>div{flex:0 0 100%;max-width:100%;padding-right:0;padding-left:0;background-color:var(--indianred-color);border-radius:5px}.des-video-consult div .vc-slide{--height-size:72px;background-size:auto var(--height-size);min-height:var(--height-size);max-width:650px;margin:0 auto;padding:11px;padding-left:80px;background-position:0 100%}.des-video-consult div .vc-slide .badge{font-size:13.6px;padding:12px 15px}.dd-hospital-carddetails.overflow-auto::-webkit-scrollbar{display:none;background:transparent;width:0;height:0;-webkit-appearance:none}.dd-hospital-carddetails.overflow-auto::-webkit-scrollbar-track{background:transparent}.dd-hospital-carddetails.overflow-auto::-webkit-scrollbar-thumb{background:transparent}.dd-hospital-carddetails.overflow-auto::-webkit-scrollbar-thumb:hover{background:transparent}.dd-hospital-carddetails.overflow-auto{display:flex;flex-wrap:nowrap;padding:7px 5px 0 0;margin:0 0 0 -5px;overflow:auto}.dd-hospital-carddetails>div{flex:0 0 32.5%;max-width:32.5%;padding-right:7.5px;padding-left:7.5px}.dd-hospital-carddetails .frame{background:#F9F8FB;border-radius:5px;color:var(--dark-color);overflow:hidden}@media only screen and (max-width:767px){.dd-hospital-carddetails.overflow-auto{overflow:auto;margin:0 -7.5px 0 0}.dd-hospital-carddetails>div{flex:0 0 70%;max-width:70%}}@media only screen and (max-width:374px){.dd-hospital-carddetails>div{flex:0 0 85%;max-width:85%}}.jazzcash-banner{padding:11px 24px;justify-content:center;border-radius:0;margin:0 0 8px;color:#fff;border-radius:5px}.jazzcash-banner a{color:#fff}.jazzcash-banner .btn{background:var(--indianred-color-2);border-color:var(--indianred-color-2);font-weight:600}.jazzcash-banner .text{display:flex;align-items:center}.jazzcash-banner img{width:100px}@media only screen and (max-width:767px){.jazzcash-banner{flex-direction:row-reverse}.jazzcash-banner .text{flex-wrap:wrap}}.videoconsult-top-strip{font-size:16px;background:var(--lavender-color);padding:6px 0}.videoconsult-top-strip .btn{font-weight:700;margin-left:1rem!important}body.body-videoconsult-top-strip{padding-top:102px}@media only screen and (max-width:767px){.videoconsult-top-strip .text{display:none}.videoconsult-top-strip .btn{font-weight:700;margin-left:0rem!important}}
                </style>
                <script>
function imgError(image, gender) {
                image.onerror = "";
                if ( gender == undefined ) {
                    image.src = "https://s3-eu-west-1.amazonaws.com/mdpk/images/profile-pics/doctors/default/general_doc_orig.png";
                }
                else if (gender.toLowerCase() == "female") {
                    image.src = "https://s3-eu-west-1.amazonaws.com/mdpk/images/profile-pics/doctors/default/doc_female_orig.png";
                } else if (gender.toLowerCase() == "male") {
                    image.src = "https://s3-eu-west-1.amazonaws.com/mdpk/images/profile-pics/doctors/default/doc_male_orig.png";
                } else {
                    image.src = "https://s3-eu-west-1.amazonaws.com/mdpk/images/profile-pics/doctors/default/general_doc_orig.png"
                }
                return true;
            }
            function hospImgError(image, gender) {
                image.onerror = "";
                image.src = "https://s3-eu-west-1.amazonaws.com/mdpk/images/profile-pics/hospitals/default/hospital1.png";
                return true;
            }
</script>





</head>
<body class="body-videoconsult-top-strip">

<div class="common-svg d-none">
<svg>
<defs>

<g id="location-icon">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 238.53">
<g data-name="Layer 2">
<g data-name="Layer 2">
<path fill="#ff9e15" d="M100,140a40,40,0,1,1,40-40A40,40,0,0,1,100,140Zm0-66.67A26.67,26.67,0,1,0,126.67,100,26.69,26.69,0,0,0,100,73.33Z"></path>
<path fill="#9aaac1" d="M100,238.53a6.65,6.65,0,0,1-4.71-2L27.22,168.51A99.81,99.81,0,0,1,8.64,140.64,98.71,98.71,0,0,1,0,100a100,100,0,0,1,200,0,99.81,99.81,0,0,1-27.07,68.35l-68.22,68.22A6.65,6.65,0,0,1,100,238.53Zm0-225.2A86.77,86.77,0,0,0,13.33,100,86.45,86.45,0,0,0,36.8,159.24l63.2,63.2,63.35-63.35A86.52,86.52,0,0,0,186.67,100,86.77,86.77,0,0,0,100,13.33Z"></path>
</g>
</g>
</svg>
</g>
<g id="price-icon">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 239.38 239.38">
<g data-name="Layer 2">
<g data-name="Layer 2">
<path class="price-icon-1" d="M127.21,60.92v11.6a24.42,24.42,0,0,1,11.42,4.62q4.44,3.49,8.46,10.71L135.55,94.3q-5.21-9.47-13.61-9.47a12.47,12.47,0,0,0-8.64,3.08,9.91,9.91,0,0,0-3.43,7.69,9.47,9.47,0,0,0,2.78,7q2.72,2.72,11,6.45a110,110,0,0,1,11.84,6.13,31.57,31.57,0,0,1,7,5.53,24.79,24.79,0,0,1,6.69,17.46,28,28,0,0,1-6,17.76,29.22,29.22,0,0,1-16,10.3v12.25H116.85v-11.9q-11.6-1.89-17.7-8t-9-18.82l13-2.72q2.67,9,6.51,12.84,4,3.67,10.71,3.67a15.11,15.11,0,0,0,10.89-4.2,14.18,14.18,0,0,0,4.32-10.71,12.61,12.61,0,0,0-3.61-9.41,33.55,33.55,0,0,0-5.41-3.88,93.26,93.26,0,0,0-9.15-4.7q-11.48-5.15-15.09-9.47A23.7,23.7,0,0,1,98,87.79a21.68,21.68,0,0,1,3.94-6.66A24.46,24.46,0,0,1,108.27,76a34.19,34.19,0,0,1,8.58-3.43V60.92Z"></path>
<path fill="#9aadc3" class="price-icon-2" d="M35,204.37a119.75,119.75,0,1,1,169.35,0A119.89,119.89,0,0,1,35,204.37ZM195,44.42A106.44,106.44,0,1,0,195,195,106.57,106.57,0,0,0,195,44.42Z"></path>
</g>
</g>
</svg>
</g>

<g id="price-rs-icon">
<circle cx="8" cy="8" r="7.5" stroke="#9AAAC1" />
<path d="M5.51081 8.44955V10.8246H4.84675V5.11362H6.41315C7.11367 5.11362 7.6306 5.24773 7.96393 5.51596C8.29987 5.78419 8.46784 6.18784 8.46784 6.7269C8.46784 7.48211 8.08503 7.99252 7.3194 8.25815L8.87018 10.8246H8.08503L6.70222 8.44955H5.51081ZM5.51081 7.87924H6.42097C6.88972 7.87924 7.23347 7.78679 7.45222 7.6019C7.67097 7.4144 7.78034 7.13445 7.78034 6.76205C7.78034 6.38445 7.66836 6.11231 7.4444 5.94565C7.22305 5.77898 6.86628 5.69565 6.37409 5.69565H5.51081V7.87924ZM12.4561 9.65659C12.4561 10.055 12.3077 10.3623 12.0108 10.5785C11.7139 10.7946 11.2973 10.9027 10.7608 10.9027C10.1931 10.9027 9.75039 10.8128 9.43268 10.6331V10.0316C9.63841 10.1358 9.85847 10.2178 10.0928 10.2777C10.3298 10.3376 10.5577 10.3675 10.7764 10.3675C11.115 10.3675 11.3754 10.3141 11.5577 10.2074C11.74 10.098 11.8311 9.93263 11.8311 9.71127C11.8311 9.54461 11.7582 9.40268 11.6124 9.28549C11.4691 9.1657 11.1879 9.02508 10.7686 8.86362C10.3702 8.71518 10.0863 8.58627 9.91706 8.4769C9.75039 8.36492 9.62539 8.23862 9.54206 8.09799C9.46133 7.95737 9.42097 7.7894 9.42097 7.59409C9.42097 7.24513 9.56289 6.97039 9.84675 6.76987C10.1306 6.56674 10.5199 6.46518 11.0147 6.46518C11.4757 6.46518 11.9262 6.55893 12.3663 6.74643L12.1358 7.27377C11.7061 7.09669 11.3168 7.00815 10.9678 7.00815C10.6605 7.00815 10.4288 7.05633 10.2725 7.15268C10.1163 7.24903 10.0382 7.38185 10.0382 7.55112C10.0382 7.6657 10.0668 7.76336 10.1241 7.84409C10.184 7.92481 10.279 8.00164 10.4092 8.07455C10.5395 8.14747 10.7895 8.25294 11.1592 8.39096C11.6671 8.57586 12.0095 8.76205 12.1866 8.94955C12.3663 9.13705 12.4561 9.37273 12.4561 9.65659Z" fill="#EFA13E" />
</g>
<g id="doctor_availability-icon">
<svg viewBox="0 0 292 296" version="1.1">
<defs></defs>
<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
<g transform="translate(-8.000000, -2.000000)" stroke-width="15">
<rect stroke="#9AAAC1" x="15.5" y="28.5" width="277" height="262" rx="41"></rect>
<g transform="translate(42.000000, 159.000000)">
<rect stroke="#9AAAC1" x="7.5" y="7.5" width="48" height="44" rx="11"></rect>
<rect id="Rectangle-Copy" stroke="#9AAAC1" x="168.5" y="7.5" width="48" height="44" rx="11"></rect>
<rect id="Rectangle-Copy-2" stroke="#FF9900" x="88.5" y="7.5" width="48" height="44" rx="11"></rect>
</g>
<path d="M16.5,98.5 L291.5,98.5" stroke="#9AAAC1" stroke-linecap="square"></path>
<g id="Group-3" transform="translate(80.000000, 9.000000)" stroke="#9AAAC1" stroke-linecap="square">
<path d="M1,40.5032466 L1,0.5"></path>
<path d="M146,40.5032466 L146,0.5"></path>
</g>
</g>
</g>
</svg>
</g>
<g id="select-location-icon">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 351.41 305.25">
<defs>
<style>
                            .select-location-icon-1,
                            .select-location-icon-2 {
                                fill: none;
                                stroke-miterlimit: 10;
                                stroke-width: 13.5px;
                            }

                            .select-location-icon-1 {
                                stroke: #9aaac1;
                            }

                            .select-location-icon-2 {
                                stroke: #f90;
                                stroke-linecap: round;
                            }
                        </style>
</defs>
<title>icon_location</title>
<g data-name="Layer 2">
<g data-name="Layer 1">
<path class="select-location-icon-1" d="M305.37,298.5H50a30.08,30.08,0,0,1-30.08-30.08V169.89a30.08,30.08,0,0,1,13.6-25.16L159.92,61.95a30.08,30.08,0,0,1,32.75-.14l129,82.95a30.08,30.08,0,0,1,13.81,25.3v98.37A30.08,30.08,0,0,1,305.37,298.5Z" />
<path class="select-location-icon-2" d="M6.75,116.16,159.55,12a30.08,30.08,0,0,1,33.56-.22L344.66,112.19" />
<line class="select-location-icon-2" x1="126.61" y1="187.66" x2="224.8" y2="187.66" />
<line class="select-location-icon-2" x1="175.7" y1="138.56" x2="175.7" y2="236.75" />
</g>
</g>
</svg>
</g>

<g id="thumbnail-svg">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#fff">
<path d="M104 224H24c-13.255 0-24 10.745-24 24v240c0 13.255 10.745 24 24 24h80c13.255 0 24-10.745 24-24V248c0-13.255-10.745-24-24-24zM64 472c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24zM384 81.452c0 42.416-25.97 66.208-33.277 94.548h101.723c33.397 0 59.397 27.746 59.553 58.098.084 17.938-7.546 37.249-19.439 49.197l-.11.11c9.836 23.337 8.237 56.037-9.308 79.469 8.681 25.895-.069 57.704-16.382 74.757 4.298 17.598 2.244 32.575-6.148 44.632C440.202 511.587 389.616 512 346.839 512l-2.845-.001c-48.287-.017-87.806-17.598-119.56-31.725-15.957-7.099-36.821-15.887-52.651-16.178-6.54-.12-11.783-5.457-11.783-11.998v-213.77c0-3.2 1.282-6.271 3.558-8.521 39.614-39.144 56.648-80.587 89.117-113.111 14.804-14.832 20.188-37.236 25.393-58.902C282.515 39.293 291.817 0 312 0c24 0 72 8 72 81.452z"></path>
</svg>
</g>
<g id="filter-listing-svg" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
<g id="Group-5" transform="translate(-1.000000, -3.000000)">
<polygon id="Stroke-1" stroke-opacity="0.0117647061" stroke="#000000" stroke-width="1.33333336e-11" points="0 0 14.9999994 0 14.9999994 14.9999994 0 14.9999994"></polygon>
<path d="M6.24999963,11.2499993 L8.74999947,11.2499993 L8.74999947,9.9999994 L6.24999963,9.9999994 L6.24999963,11.2499993 Z M1.87499989,3.74999977 L1.87499989,4.9999997 L13.1249992,4.9999997 L13.1249992,3.74999977 L1.87499989,3.74999977 Z M3.74999978,8.12499951 L11.2499993,8.12499951 L11.2499993,6.87499959 L3.74999978,6.87499959 L3.74999978,8.12499951 Z" id="Fill-3" fill="currentColor"></path>
</g>
</g>

<g id="close-icon-svg">
<rect x="0" y="0" fill="transparent" class="stencil__selection-helper"></rect>
<path d="M6.999999999999998 0C10.871 0 13.999999999999998 3.129 13.999999999999998 6.999999999999998 13.999999999999998 10.871 10.871 13.999999999999998 6.999999999999998 13.999999999999998 3.129 13.999999999999998 0 10.871 0 6.999999999999998 0 3.129 3.129 0 6.999999999999998 0M9.512999999999998 3.4999999999999996C9.512999999999998 3.4999999999999996 6.999999999999998 6.013 6.999999999999998 6.013 6.999999999999998 6.013 4.487 3.4999999999999996 4.487 3.4999999999999996 4.487 3.4999999999999996 3.4999999999999996 4.487 3.4999999999999996 4.487 3.4999999999999996 4.487 6.013 6.999999999999998 6.013 6.999999999999998 6.013 6.999999999999998 3.4999999999999996 9.512999999999998 3.4999999999999996 9.512999999999998 3.4999999999999996 9.512999999999998 4.487 10.499999999999998 4.487 10.499999999999998 4.487 10.499999999999998 6.999999999999998 7.986999999999998 6.999999999999998 7.986999999999998 6.999999999999998 7.986999999999998 9.512999999999998 10.499999999999998 9.512999999999998 10.499999999999998 9.512999999999998 10.499999999999998 10.499999999999998 9.512999999999998 10.499999999999998 9.512999999999998 10.499999999999998 9.512999999999998 7.986999999999998 6.999999999999998 7.986999999999998 6.999999999999998 7.986999999999998 6.999999999999998 10.499999999999998 4.487 10.499999999999998 4.487 10.499999999999998 4.487 9.512999999999998 3.4999999999999996 9.512999999999998 3.4999999999999996 9.512999999999998 3.4999999999999996 9.512999999999998 3.4999999999999996 9.512999999999998 3.4999999999999996" stroke-width="0" stroke="none" stroke-dasharray="none" fill="rgb(255, 255, 255)" fill-rule="evenOdd"></path>
</g>

<g id="pictorial_mark_oladoc_svg" data-name="Layer 2">
<g data-name="Layer 1">
<path fill="#21205f" d="M69,0C32.52,0,0,26.17,0,65.31c0,39.38,32.52,65.55,69,65.55,36.69,0,69-26.42,69-65.55C138,26.42,105.66,0,69,0Zm35.78,77H80.51v24.24H57.43V77H33.2V53.89H57.43V29.65H80.51V53.89h24.24Z" />
</g>
</g>

<g id="chrome_logo_svg">
<path style="fill:#26A6D1;" d="M145.683,90.937c30.17,0,54.622,24.471,54.622,54.622c0,30.179-24.453,54.622-54.622,54.622
                c-30.152,0-54.622-24.453-54.622-54.622C91.061,115.408,115.532,90.937,145.683,90.937z" />
<path style="fill:#3DB39E;" d="M145.683,218.398c-36.852,0-67.231-27.384-72.074-62.925L23.402,68.414l-0.055-0.127l-5.617,8.111
                c-1.384,2.54-2.731,5.116-3.969,7.747l-2.686,6.282c-0.892,2.167-1.775,4.361-2.567,6.6c-0.892,2.485-1.666,4.998-2.403,7.52
                l-1.62,5.799c-0.674,2.704-1.247,5.408-1.766,8.13l-0.983,5.744c-0.401,2.667-0.71,5.317-0.947,7.966l-0.473,6.345
                c-0.118,2.422-0.164,4.834-0.164,7.256s0.036,4.843,0.164,7.256l0.473,6.345c0.246,2.649,0.564,5.317,0.947,7.966l0.983,5.744
                c0.528,2.722,1.092,5.426,1.766,8.13l1.62,5.799c0.747,2.504,1.511,5.034,2.403,7.52c0.792,2.221,1.684,4.406,2.567,6.6
                c0.874,2.094,1.711,4.197,2.686,6.272c1.238,2.631,2.585,5.189,3.978,7.756l1.812,3.56l0.838,1.302
                c1.602,2.74,3.368,5.353,5.153,7.966l2.859,4.251c1.721,2.349,3.605,4.588,5.49,6.846l3.769,4.515
                c1.639,1.793,3.396,3.505,5.125,5.226c1.73,1.739,3.432,3.523,5.235,5.134l4.515,3.787c2.258,1.866,4.497,3.751,6.846,5.48
                l4.215,2.877c2.622,1.793,5.253,3.56,7.966,5.153l1.293,0.838l3.55,1.812c2.549,1.384,5.116,2.758,7.747,3.987l0.756,0.391
                l3.687,1.511c9.85,4.197,20.137,7.165,30.625,9.122l41.558-72.065C155.907,217.843,150.863,218.398,145.683,218.398z" />
<path style="fill:#EFC75E;" d="M290.851,135.636l-0.191-2.403c-1.029-12.163-6.027-29.769-10.178-41.586h-85.966
                c14.702,13.319,23.997,32.5,23.997,53.912c0,23.105-10.788,43.652-27.539,56.989l-51.208,88.816c18.007,0,42.25-3.25,59.693-10.223
                l0.592-0.191l0.929-0.391c5.945-2.467,11.826-5.171,17.552-8.485c5.125-2.95,9.923-6.263,14.557-9.723l0.264-0.209
                c4.461-3.378,8.639-6.973,12.627-10.761l0.619-0.537l2.012-2.048c8.812-8.822,16.378-18.562,22.55-29.068l0.701-1.029l1.265-2.558
                c1.985-3.605,3.824-7.292,5.499-11.043l2.148-5.053c1.42-3.56,2.658-7.165,3.796-10.815l1.502-4.698
                c1.393-5.071,2.531-10.187,3.378-15.367l0.355-2.95c0.628-4.443,1.074-8.913,1.302-13.428l0.082-3.614
                C291.261,144.676,291.17,140.152,290.851,135.636z" />
<path style="fill:#E2574C;" d="M271.779,72.73c-3.05-5.28-6.464-10.205-10.051-14.957l-1.174-1.457
                c-3.223-4.16-6.637-8.111-10.242-11.826l-2.44-2.504c-3.96-3.896-8.066-7.593-12.372-10.97l-0.947-0.801
                c-4.798-3.696-9.823-7.019-15.003-10.06l-1.038-0.692l-3.942-2.048c-2.276-1.229-4.543-2.458-6.882-3.56
                c-2.249-1.047-4.515-1.976-6.782-2.913l-5.708-2.276c-2.758-0.992-5.544-1.83-8.339-2.686l-4.643-1.347
                c-3.041-0.783-6.109-1.402-9.167-1.994l-4.333-0.856c-2.986-0.482-5.972-0.783-8.967-1.065l-4.907-0.501
                c-2.567-0.164-5.125-0.146-7.711-0.182L140.813,0l-4.916,0.355c-10.87,0.728-21.74,2.667-32.418,5.899l-2.212,0.601
                c-2.704,0.874-5.371,1.939-8.048,2.986l-5.134,2.03c-2.203,0.938-4.379,2.039-6.564,3.123c-2.112,1.038-4.233,2.085-6.309,3.241
                l-2.367,1.211l-3.496,2.258c-2.067,1.275-4.115,2.576-6.127,3.96c-1.966,1.375-3.905,2.777-5.799,4.215l-5.007,3.997
                c-2.067,1.73-4.078,3.487-6.036,5.307l-3.714,3.623c-2.158,2.167-4.27,4.37-6.263,6.646l-1.356,1.639l41.431,71.874
                c9.513-29.141,36.888-50.234,69.216-50.234C145.692,72.73,271.779,72.73,271.779,72.73z" />
</g>

<g id="safari-icon-svg">
<circle style="fill:#1DA2F8;" cx="256" cy="256" r="256" />
<g>
<path style="fill:#F2F2F2;" d="M256,37.89c-1.724,0-3.122-1.398-3.122-3.122V20.482c0-1.724,1.398-3.122,3.122-3.122
                        s3.122,1.398,3.122,3.122v14.286C259.122,36.492,257.724,37.89,256,37.89z" />
<path style="fill:#F2F2F2;" d="M256,494.64c-1.724,0-3.122-1.398-3.122-3.122v-14.286c0-1.724,1.398-3.122,3.122-3.122
                        s3.122,1.398,3.122,3.122v14.286C259.122,493.242,257.724,494.64,256,494.64z" />
<path style="fill:#F2F2F2;" d="M217.58,41.252c-1.488,0-2.805-1.066-3.072-2.581l-2.481-14.069
                        c-0.299-1.698,0.835-3.318,2.532-3.616c1.703-0.296,3.319,0.835,3.617,2.533l2.481,14.069c0.299,1.698-0.835,3.318-2.532,3.616
                        C217.941,41.235,217.76,41.252,217.58,41.252z" />
<path style="fill:#F2F2F2;" d="M296.894,491.063c-1.488,0-2.805-1.066-3.072-2.581l-2.481-14.069
                        c-0.299-1.698,0.835-3.318,2.532-3.616c1.703-0.3,3.319,0.834,3.617,2.533l2.481,14.068c0.299,1.698-0.835,3.318-2.532,3.616
                        C297.255,491.047,297.074,491.063,296.894,491.063z" />
<path style="fill:#F2F2F2;" d="M180.334,51.232c-1.275,0-2.472-0.788-2.933-2.055l-4.887-13.424
                        c-0.588-1.621,0.247-3.412,1.867-4.002c1.615-0.587,3.412,0.245,4,1.866l4.886,13.424c0.59,1.621-0.246,3.412-1.866,4.002
                        C181.049,51.171,180.689,51.232,180.334,51.232z" />
<path style="fill:#F2F2F2;" d="M336.552,480.437c-1.275,0-2.472-0.788-2.933-2.055l-4.886-13.424
                        c-0.59-1.621,0.246-3.412,1.866-4.002c1.615-0.589,3.412,0.245,4,1.866l4.887,13.424c0.588,1.621-0.247,3.412-1.867,4.002
                        C337.267,480.376,336.907,480.437,336.552,480.437z" />
<path style="fill:#F2F2F2;" d="M145.387,67.53c-1.079,0-2.128-0.56-2.707-1.562l-7.143-12.372
                        c-0.861-1.493-0.351-3.402,1.143-4.264c1.491-0.866,3.402-0.351,4.265,1.142l7.143,12.372c0.861,1.493,0.351,3.402-1.143,4.264
                        C146.455,67.395,145.917,67.53,145.387,67.53z" />
<path style="fill:#F2F2F2;" d="M373.762,463.087c-1.079,0-2.128-0.56-2.707-1.562l-7.143-12.372
                        c-0.861-1.493-0.351-3.402,1.143-4.264c1.491-0.866,3.401-0.351,4.265,1.142l7.143,12.372c0.861,1.493,0.351,3.402-1.143,4.264
                        C374.83,462.952,374.292,463.087,373.762,463.087z" />
<path style="fill:#F2F2F2;" d="M113.796,89.648c-0.89,0-1.776-0.379-2.393-1.115L102.22,77.59c-1.109-1.321-0.936-3.29,0.386-4.399
                        c1.319-1.107,3.289-0.936,4.398,0.385l9.183,10.943c1.109,1.321,0.936,3.29-0.386,4.399
                        C115.217,89.409,114.505,89.648,113.796,89.648z" />
<path style="fill:#F2F2F2;" d="M407.389,439.539c-0.89,0-1.776-0.379-2.393-1.115l-9.182-10.943
                        c-1.109-1.321-0.936-3.29,0.386-4.399c1.319-1.105,3.289-0.936,4.398,0.385l9.181,10.943c1.109,1.321,0.936,3.29-0.386,4.399
                        C408.81,439.3,408.097,439.539,407.389,439.539z" />
<path style="fill:#F2F2F2;" d="M86.525,116.917c-0.708,0-1.421-0.239-2.004-0.73l-10.943-9.183
                        c-1.322-1.109-1.494-3.077-0.386-4.399c1.109-1.322,3.079-1.492,4.398-0.385l10.943,9.183c1.322,1.109,1.494,3.077,0.386,4.399
                        C88.301,116.537,87.415,116.917,86.525,116.917z" />
<path style="fill:#F2F2F2;" d="M436.415,410.51c-0.708,0-1.421-0.239-2.006-0.73l-10.942-9.183
                        c-1.32-1.109-1.492-3.077-0.385-4.399c1.109-1.322,3.077-1.492,4.399-0.385l10.942,9.183c1.32,1.109,1.492,3.077,0.385,4.399
                        C438.19,410.131,437.305,410.51,436.415,410.51z" />
<path style="fill:#F2F2F2;" d="M64.404,148.506c-0.529,0-1.066-0.135-1.558-0.419l-12.372-7.143
                        c-1.494-0.862-2.004-2.771-1.143-4.264c0.863-1.492,2.767-2.007,4.265-1.142l12.372,7.143c1.494,0.862,2.004,2.771,1.143,4.264
                        C66.533,147.946,65.484,148.506,64.404,148.506z" />
<path style="fill:#F2F2F2;" d="M459.961,376.881c-0.529,0-1.067-0.135-1.558-0.419l-12.371-7.143
                        c-1.494-0.862-2.004-2.771-1.143-4.264s2.771-2.009,4.265-1.142l12.371,7.143c1.494,0.862,2.004,2.771,1.143,4.264
                        C462.088,376.321,461.04,376.881,459.961,376.881z" />
<path style="fill:#F2F2F2;" d="M48.11,183.457c-0.355,0-0.715-0.061-1.067-0.189l-13.425-4.886
                        c-1.621-0.59-2.456-2.381-1.866-4.002c0.588-1.621,2.384-2.453,4-1.866l13.425,4.886c1.621,0.59,2.456,2.381,1.866,4.002
                        C50.582,182.669,49.385,183.457,48.11,183.457z" />
<path style="fill:#F2F2F2;" d="M477.315,339.674c-0.355,0-0.715-0.061-1.069-0.189l-13.424-4.886
                        c-1.619-0.59-2.454-2.381-1.864-4.002c0.588-1.621,2.379-2.452,4.002-1.866l13.424,4.886c1.619,0.59,2.454,2.381,1.864,4.002
                        C479.787,338.888,478.588,339.674,477.315,339.674z" />
<path style="fill:#F2F2F2;" d="M38.131,220.706c-0.18,0-0.362-0.016-0.545-0.048l-14.069-2.481c-1.698-0.3-2.831-1.919-2.532-3.616
                        c0.299-1.697,1.911-2.83,3.617-2.533l14.069,2.481c1.698,0.3,2.831,1.919,2.532,3.616C40.936,219.64,39.619,220.706,38.131,220.706
                        z" />
<path style="fill:#F2F2F2;" d="M487.942,300.02c-0.18,0-0.362-0.016-0.545-0.048l-14.068-2.481c-1.698-0.3-2.831-1.919-2.532-3.616
                        s1.909-2.83,3.617-2.533l14.069,2.481c1.698,0.3,2.831,1.919,2.532,3.616C490.748,298.954,489.43,300.02,487.942,300.02z" />
<path style="fill:#F2F2F2;" d="M34.767,259.122H20.482c-1.724,0-3.122-1.398-3.122-3.122s1.398-3.122,3.122-3.122h14.285
                        c1.724,0,3.122,1.398,3.122,3.122S36.491,259.122,34.767,259.122z" />
<path style="fill:#F2F2F2;" d="M491.519,259.122h-14.287c-1.724,0-3.122-1.398-3.122-3.122s1.398-3.122,3.122-3.122h14.287
                        c1.724,0,3.122,1.398,3.122,3.122C494.641,257.724,493.243,259.122,491.519,259.122z" />
<path style="fill:#F2F2F2;" d="M24.057,300.02c-1.488,0-2.805-1.066-3.072-2.581c-0.299-1.697,0.834-3.318,2.532-3.616
                        l14.069-2.481c1.704-0.297,3.319,0.834,3.617,2.533c0.299,1.697-0.834,3.318-2.532,3.616l-14.069,2.481
                        C24.418,300.004,24.236,300.02,24.057,300.02z" />
<path style="fill:#F2F2F2;" d="M473.867,220.706c-1.488,0-2.805-1.066-3.072-2.581c-0.299-1.697,0.834-3.318,2.532-3.616
                        l14.069-2.481c1.701-0.297,3.319,0.834,3.617,2.533c0.299,1.697-0.834,3.318-2.532,3.616l-14.068,2.481
                        C474.229,220.69,474.047,220.706,473.867,220.706z" />
<path style="fill:#F2F2F2;" d="M34.684,339.674c-1.275,0-2.472-0.788-2.933-2.055c-0.59-1.621,0.246-3.412,1.866-4.002
                        l13.425-4.886c1.615-0.587,3.412,0.246,4,1.866c0.59,1.621-0.246,3.412-1.866,4.002l-13.425,4.886
                        C35.4,339.614,35.04,339.674,34.684,339.674z" />
<path style="fill:#F2F2F2;" d="M463.891,183.457c-1.275,0-2.472-0.788-2.933-2.055c-0.59-1.621,0.246-3.412,1.864-4.002
                        l13.424-4.886c1.624-0.587,3.413,0.246,4.002,1.866c0.59,1.621-0.246,3.412-1.864,4.002l-13.424,4.886
                        C464.605,183.396,464.246,183.457,463.891,183.457z" />
<path style="fill:#F2F2F2;" d="M52.038,376.881c-1.079,0-2.128-0.56-2.707-1.562c-0.861-1.493-0.351-3.402,1.143-4.264
                        l12.372-7.143c1.495-0.866,3.401-0.351,4.265,1.142c0.861,1.493,0.351,3.402-1.143,4.264l-12.372,7.143
                        C53.104,376.746,52.568,376.881,52.038,376.881z" />
<path style="fill:#F2F2F2;" d="M447.597,148.506c-1.079,0-2.128-0.56-2.707-1.562c-0.861-1.493-0.351-3.402,1.143-4.264
                        l12.371-7.143c1.491-0.865,3.401-0.35,4.265,1.142c0.861,1.493,0.351,3.402-1.143,4.264l-12.371,7.143
                        C448.664,148.371,448.125,148.506,447.597,148.506z" />
<path style="fill:#F2F2F2;" d="M75.584,410.51c-0.89,0-1.776-0.379-2.393-1.115c-1.109-1.321-0.936-3.29,0.386-4.399l10.943-9.183
                        c1.319-1.107,3.289-0.936,4.398,0.385s0.936,3.29-0.386,4.399l-10.943,9.183C77.005,410.271,76.293,410.51,75.584,410.51z" />
<path style="fill:#F2F2F2;" d="M425.476,116.917c-0.89,0-1.776-0.379-2.393-1.115c-1.109-1.321-0.936-3.289,0.385-4.399
                        l10.942-9.183c1.322-1.107,3.291-0.936,4.399,0.385c1.109,1.321,0.936,3.289-0.385,4.399l-10.942,9.183
                        C426.896,116.677,426.185,116.917,425.476,116.917z" />
<path style="fill:#F2F2F2;" d="M104.61,439.539c-0.708,0-1.421-0.239-2.004-0.73c-1.322-1.109-1.494-3.077-0.386-4.399
                        l9.183-10.943c1.11-1.321,3.08-1.492,4.398-0.385c1.322,1.109,1.494,3.077,0.386,4.399l-9.183,10.943
                        C106.386,439.16,105.5,439.539,104.61,439.539z" />
<path style="fill:#F2F2F2;" d="M398.204,89.648c-0.708,0-1.421-0.239-2.004-0.73c-1.322-1.109-1.494-3.077-0.386-4.399
                        l9.182-10.943c1.109-1.321,3.08-1.492,4.398-0.385c1.322,1.109,1.494,3.078,0.386,4.399l-9.181,10.943
                        C399.981,89.269,399.095,89.648,398.204,89.648z" />
<path style="fill:#F2F2F2;" d="M138.238,463.087c-0.529,0-1.066-0.135-1.558-0.419c-1.494-0.862-2.004-2.771-1.143-4.264
                        l7.143-12.372c0.863-1.493,2.767-2.008,4.265-1.142c1.494,0.862,2.004,2.771,1.143,4.264l-7.143,12.372
                        C140.366,462.527,139.317,463.087,138.238,463.087z" />
<path style="fill:#F2F2F2;" d="M366.613,67.53c-0.529,0-1.066-0.135-1.558-0.419c-1.494-0.862-2.004-2.771-1.143-4.264
                        l7.143-12.372c0.863-1.493,2.767-2.009,4.265-1.142c1.494,0.862,2.004,2.771,1.143,4.264l-7.143,12.372
                        C368.741,66.97,367.692,67.53,366.613,67.53z" />
<path style="fill:#F2F2F2;" d="M175.449,480.437c-0.355,0-0.715-0.061-1.067-0.189c-1.621-0.59-2.456-2.381-1.867-4.002
                        l4.887-13.424c0.59-1.622,2.382-2.456,4-1.866c1.621,0.59,2.456,2.381,1.866,4.002l-4.886,13.424
                        C177.921,479.65,176.723,480.437,175.449,480.437z" />
<path style="fill:#F2F2F2;" d="M331.666,51.232c-0.355,0-0.715-0.061-1.067-0.189c-1.621-0.59-2.456-2.381-1.866-4.002
                        l4.886-13.424c0.588-1.622,2.384-2.453,4-1.866c1.621,0.59,2.456,2.381,1.867,4.002l-4.887,13.424
                        C334.14,50.445,332.941,51.232,331.666,51.232z" />
<path style="fill:#F2F2F2;" d="M215.106,491.063c-0.18,0-0.362-0.016-0.545-0.048c-1.697-0.3-2.831-1.918-2.532-3.616l2.481-14.068
                        c0.299-1.698,1.911-2.832,3.617-2.533c1.697,0.3,2.831,1.918,2.532,3.616l-2.481,14.069
                        C217.91,489.996,216.594,491.063,215.106,491.063z" />
<path style="fill:#F2F2F2;" d="M294.42,41.252c-0.18,0-0.362-0.016-0.545-0.048c-1.697-0.3-2.831-1.918-2.532-3.616l2.481-14.069
                        c0.299-1.697,1.911-2.827,3.617-2.533c1.697,0.3,2.831,1.918,2.532,3.616l-2.481,14.069
                        C297.224,40.185,295.908,41.252,294.42,41.252z" />
<path style="fill:#F2F2F2;" d="M238.735,61.821c-1.602,0-2.965-1.225-3.106-2.849l-3.265-37.321
                        c-0.15-1.718,1.12-3.232,2.838-3.382c1.72-0.157,3.232,1.121,3.381,2.838l3.265,37.321c0.15,1.718-1.12,3.232-2.838,3.382
                        C238.918,61.817,238.825,61.821,238.735,61.821z" />
<path style="fill:#F2F2F2;" d="M276.523,493.744c-1.602,0-2.965-1.225-3.106-2.849l-3.265-37.321
                        c-0.15-1.718,1.12-3.232,2.838-3.382c1.73-0.157,3.23,1.121,3.381,2.838l3.265,37.321c0.15,1.718-1.12,3.232-2.838,3.382
                        C276.706,493.739,276.613,493.744,276.523,493.744z" />
<path style="fill:#F2F2F2;" d="M204.738,67.817c-1.379,0-2.64-0.92-3.013-2.314l-9.697-36.187
                        c-0.446-1.666,0.541-3.377,2.207-3.823c1.665-0.455,3.378,0.542,3.823,2.207l9.697,36.187c0.446,1.666-0.541,3.377-2.207,3.823
                        C205.278,67.783,205.005,67.817,204.738,67.817z" />
<path style="fill:#F2F2F2;" d="M316.955,486.615c-1.379,0-2.64-0.92-3.013-2.314l-9.696-36.187
                        c-0.446-1.666,0.541-3.377,2.207-3.823c1.671-0.452,3.376,0.542,3.823,2.207l9.696,36.187c0.446,1.666-0.541,3.377-2.207,3.823
                        C317.492,486.581,317.222,486.615,316.955,486.615z" />
<path style="fill:#F2F2F2;" d="M172.301,79.624c-1.176,0-2.302-0.668-2.831-1.803l-15.833-33.954
                        c-0.728-1.562-0.053-3.42,1.509-4.148c1.561-0.728,3.422-0.053,4.149,1.51l15.833,33.954c0.728,1.562,0.053,3.42-1.509,4.148
                        C173.193,79.53,172.743,79.624,172.301,79.624z" />
<path style="fill:#F2F2F2;" d="M355.536,472.574c-1.176,0-2.302-0.668-2.831-1.803l-15.832-33.954
                        c-0.728-1.562-0.053-3.42,1.509-4.148s3.422-0.052,4.149,1.51l15.832,33.954c0.728,1.562,0.053,3.42-1.509,4.148
                        C356.427,472.48,355.978,472.574,355.536,472.574z" />
<path style="fill:#F2F2F2;" d="M142.404,96.885c-0.984,0-1.953-0.464-2.561-1.331l-21.489-30.689
                        c-0.987-1.413-0.645-3.359,0.767-4.348c1.418-0.991,3.361-0.644,4.349,0.767l21.489,30.689c0.987,1.413,0.645,3.359-0.767,4.348
                        C143.646,96.702,143.021,96.885,142.404,96.885z" />
<path style="fill:#F2F2F2;" d="M391.091,452.047c-0.984,0-1.953-0.464-2.561-1.331l-21.488-30.689
                        c-0.987-1.413-0.645-3.359,0.767-4.348c1.418-0.991,3.361-0.644,4.349,0.767l21.487,30.689c0.987,1.413,0.645,3.359-0.767,4.348
                        C392.333,451.864,391.707,452.047,391.091,452.047z" />
<path style="fill:#F2F2F2;" d="M115.954,119.077c-0.798,0-1.598-0.305-2.207-0.914L87.256,91.671c-1.219-1.218-1.219-3.196,0-4.415
                        s3.195-1.219,4.415,0l26.491,26.491c1.219,1.218,1.219,3.196,0,4.415C117.552,118.771,116.754,119.077,115.954,119.077z" />
<path style="fill:#F2F2F2;" d="M422.537,425.658c-0.798,0-1.598-0.305-2.207-0.914l-26.491-26.491
                        c-1.219-1.218-1.219-3.196,0-4.415s3.195-1.219,4.415,0l26.491,26.491c1.219,1.218,1.219,3.196,0,4.415
                        C424.135,425.353,423.336,425.658,422.537,425.658z" />
<path style="fill:#F2F2F2;" d="M93.76,145.523c-0.618,0-1.242-0.183-1.788-0.565L61.284,123.47
                        c-1.412-0.988-1.754-2.935-0.767-4.348c0.991-1.413,2.934-1.756,4.349-0.767l30.688,21.487c1.412,0.988,1.754,2.935,0.767,4.348
                        C95.713,145.058,94.744,145.523,93.76,145.523z" />
<path style="fill:#F2F2F2;" d="M448.923,394.21c-0.618,0-1.242-0.183-1.788-0.565l-30.689-21.487
                        c-1.412-0.988-1.754-2.935-0.767-4.348c0.991-1.411,2.933-1.756,4.349-0.767l30.689,21.488c1.412,0.988,1.754,2.935,0.767,4.348
                        C450.876,393.745,449.907,394.21,448.923,394.21z" />
<path style="fill:#F2F2F2;" d="M76.5,175.421c-0.442,0-0.89-0.094-1.317-0.294L41.23,159.295c-1.564-0.728-2.239-2.586-1.511-4.148
                        c0.728-1.562,2.587-2.237,4.148-1.51l33.954,15.832c1.564,0.728,2.239,2.586,1.511,4.148
                        C78.802,174.753,77.676,175.421,76.5,175.421z" />
<path style="fill:#F2F2F2;" d="M469.45,358.657c-0.442,0-0.891-0.094-1.319-0.294l-33.953-15.832
                        c-1.562-0.728-2.238-2.586-1.509-4.148s2.588-2.238,4.149-1.51l33.953,15.832c1.562,0.728,2.238,2.586,1.509,4.148
                        C471.752,357.989,470.625,358.657,469.45,358.657z" />
<path style="fill:#F2F2F2;" d="M64.696,207.863c-0.266,0-0.538-0.034-0.81-0.108l-36.188-9.696
                        c-1.667-0.446-2.654-2.158-2.207-3.823c0.445-1.665,2.154-2.658,3.823-2.207l36.188,9.696c1.667,0.446,2.654,2.158,2.207,3.823
                        C67.335,206.942,66.073,207.863,64.696,207.863z" />
<path style="fill:#F2F2F2;" d="M483.494,320.079c-0.266,0-0.538-0.034-0.81-0.108l-36.188-9.697
                        c-1.667-0.446-2.654-2.158-2.207-3.823c0.445-1.665,2.154-2.656,3.823-2.207l36.188,9.697c1.667,0.446,2.654,2.158,2.207,3.823
                        C486.135,319.16,484.872,320.079,483.494,320.079z" />
<path style="fill:#F2F2F2;" d="M58.701,241.86c-0.092,0-0.183-0.004-0.276-0.013l-37.321-3.265
                        c-1.717-0.15-2.987-1.663-2.837-3.382c0.149-1.718,1.668-2.993,3.382-2.838l37.321,3.265c1.717,0.15,2.987,1.663,2.837,3.382
                        C61.667,240.635,60.304,241.86,58.701,241.86z" />
<path style="fill:#F2F2F2;" d="M490.626,279.649c-0.09,0-0.183-0.004-0.275-0.013l-37.322-3.265
                        c-1.718-0.15-2.989-1.663-2.838-3.382c0.15-1.717,1.651-2.989,3.381-2.838l37.322,3.265c1.718,0.15,2.989,1.663,2.838,3.382
                        C493.59,278.425,492.227,279.649,490.626,279.649z" />
<path style="fill:#F2F2F2;" d="M21.375,279.649c-1.602,0-2.965-1.225-3.106-2.849c-0.15-1.718,1.12-3.232,2.837-3.382l37.321-3.265
                        c1.745-0.15,3.233,1.122,3.382,2.838c0.15,1.718-1.12,3.232-2.837,3.382l-37.321,3.265
                        C21.558,279.645,21.465,279.649,21.375,279.649z" />
<path style="fill:#F2F2F2;" d="M453.298,241.86c-1.602,0-2.965-1.225-3.106-2.849c-0.15-1.718,1.12-3.232,2.838-3.382l37.322-3.265
                        c1.728-0.162,3.23,1.122,3.381,2.838c0.15,1.718-1.12,3.232-2.838,3.382l-37.322,3.265
                        C453.48,241.856,453.387,241.86,453.298,241.86z" />
<path style="fill:#F2F2F2;" d="M28.505,320.079c-1.379,0-2.64-0.919-3.013-2.314c-0.446-1.666,0.541-3.377,2.207-3.823
                        l36.188-9.697c1.661-0.453,3.376,0.542,3.823,2.207c0.446,1.666-0.541,3.377-2.207,3.823l-36.188,9.697
                        C29.045,320.045,28.771,320.079,28.505,320.079z" />
<path style="fill:#F2F2F2;" d="M447.304,207.863c-1.379,0-2.64-0.92-3.013-2.314c-0.446-1.666,0.541-3.377,2.207-3.823
                        l36.188-9.696c1.664-0.451,3.376,0.542,3.823,2.207c0.446,1.666-0.541,3.377-2.207,3.823l-36.188,9.696
                        C447.843,207.828,447.571,207.863,447.304,207.863z" />
<path style="fill:#F2F2F2;" d="M42.549,358.657c-1.176,0-2.302-0.668-2.831-1.804c-0.728-1.562-0.053-3.42,1.511-4.148
                        l33.954-15.832c1.555-0.728,3.419-0.052,4.148,1.51c0.729,1.562,0.053,3.42-1.511,4.148l-33.954,15.832
                        C43.441,358.562,42.991,358.657,42.549,358.657z" />
<path style="fill:#F2F2F2;" d="M435.5,175.421c-1.176,0-2.302-0.668-2.831-1.803c-0.728-1.562-0.053-3.42,1.509-4.148
                        l33.953-15.832c1.562-0.727,3.421-0.052,4.149,1.51s0.053,3.42-1.509,4.148l-33.953,15.832
                        C436.392,175.327,435.943,175.421,435.5,175.421z" />
<path style="fill:#F2F2F2;" d="M63.078,394.21c-0.984,0-1.953-0.464-2.561-1.331c-0.987-1.413-0.645-3.359,0.767-4.348
                        l30.688-21.488c1.418-0.991,3.361-0.644,4.349,0.767c0.987,1.413,0.645,3.359-0.767,4.348l-30.688,21.487
                        C64.321,394.026,63.696,394.21,63.078,394.21z" />
<path style="fill:#F2F2F2;" d="M418.239,145.523c-0.984,0-1.953-0.464-2.561-1.331c-0.987-1.413-0.645-3.359,0.767-4.348
                        l30.689-21.487c1.418-0.991,3.359-0.644,4.349,0.767c0.987,1.413,0.645,3.359-0.767,4.348l-30.689,21.487
                        C419.482,145.339,418.857,145.523,418.239,145.523z" />
<path style="fill:#F2F2F2;" d="M89.464,425.658c-0.798,0-1.598-0.305-2.207-0.914c-1.219-1.218-1.219-3.196,0-4.415l26.491-26.491
                        c1.219-1.219,3.195-1.219,4.415,0c1.219,1.218,1.219,3.196,0,4.415l-26.491,26.491C91.062,425.353,90.262,425.658,89.464,425.658z" />
<path style="fill:#F2F2F2;" d="M396.047,119.077c-0.798,0-1.598-0.305-2.207-0.914c-1.219-1.218-1.219-3.196,0-4.415l26.491-26.491
                        c1.219-1.219,3.195-1.219,4.415,0c1.219,1.218,1.219,3.196,0,4.415l-26.491,26.491
                        C397.643,118.771,396.845,119.077,396.047,119.077z" />
<path style="fill:#F2F2F2;" d="M120.909,452.047c-0.618,0-1.242-0.183-1.788-0.565c-1.412-0.988-1.754-2.935-0.767-4.348
                        l21.489-30.689c0.991-1.411,2.934-1.756,4.349-0.767c1.412,0.988,1.754,2.935,0.767,4.348l-21.489,30.689
                        C122.861,451.583,121.894,452.047,120.909,452.047z" />
<path style="fill:#F2F2F2;" d="M369.596,96.885c-0.618,0-1.242-0.183-1.788-0.565c-1.412-0.988-1.754-2.935-0.767-4.348
                        l21.488-30.689c0.99-1.413,2.936-1.756,4.349-0.767c1.412,0.988,1.754,2.935,0.767,4.348l-21.487,30.689
                        C371.549,96.421,370.581,96.885,369.596,96.885z" />
<path style="fill:#F2F2F2;" d="M156.464,472.574c-0.442,0-0.891-0.094-1.319-0.294c-1.562-0.728-2.238-2.586-1.509-4.148
                        l15.833-33.954c0.727-1.562,2.588-2.238,4.149-1.51c1.562,0.728,2.238,2.586,1.509,4.148l-15.833,33.954
                        C158.766,471.906,157.64,472.574,156.464,472.574z" />
<path style="fill:#F2F2F2;" d="M339.701,79.624c-0.442,0-0.891-0.094-1.319-0.294c-1.562-0.728-2.238-2.586-1.509-4.148
                        l15.832-33.954c0.727-1.563,2.588-2.238,4.149-1.51c1.562,0.728,2.238,2.586,1.509,4.148L342.531,77.82
                        C342.001,78.957,340.875,79.624,339.701,79.624z" />
<path style="fill:#F2F2F2;" d="M195.045,486.615c-0.266,0-0.539-0.034-0.81-0.108c-1.667-0.446-2.654-2.158-2.207-3.823
                        l9.697-36.187c0.446-1.663,2.16-2.658,3.823-2.207c1.667,0.446,2.654,2.158,2.207,3.823l-9.697,36.187
                        C197.685,485.696,196.423,486.615,195.045,486.615z" />
<path style="fill:#F2F2F2;" d="M307.263,67.817c-0.266,0-0.538-0.034-0.81-0.108c-1.667-0.446-2.654-2.158-2.207-3.823
                        l9.696-36.187c0.446-1.665,2.151-2.661,3.823-2.207c1.667,0.446,2.654,2.158,2.207,3.823l-9.696,36.187
                        C309.903,66.896,308.641,67.817,307.263,67.817z" />
<path style="fill:#F2F2F2;" d="M235.476,493.744c-0.09,0-0.183-0.004-0.275-0.013c-1.718-0.15-2.989-1.664-2.838-3.382
                        l3.265-37.321c0.149-1.717,1.663-2.995,3.381-2.838c1.718,0.15,2.989,1.663,2.838,3.382l-3.265,37.321
                        C238.44,492.519,237.078,493.744,235.476,493.744z" />
<path style="fill:#F2F2F2;" d="M273.264,61.821c-0.09,0-0.183-0.004-0.275-0.013c-1.718-0.15-2.989-1.663-2.838-3.382l3.265-37.321
                        c0.149-1.717,1.647-2.996,3.381-2.838c1.718,0.15,2.989,1.663,2.838,3.382L276.37,58.97
                        C276.229,60.597,274.867,61.821,273.264,61.821z" />
<polygon style="fill:#F2F2F2;" points="286.928,286.928 424.877,87.123 225.072,225.072 87.123,424.877    " />
</g>
<polygon style="fill:#CCCCCC;" points="286.928,286.928 424.877,87.123 87.123,424.877 " />
<polygon style="fill:#FF525D;" points="286.928,286.928 424.877,87.123 225.072,225.072 " />
<polygon style="fill:#EF4152;" points="286.928,286.928 424.877,87.123 256,256 " />
</g>

<g id="wait_time_doc-card-text-success">
<path d="M8 0C5.87827 0 3.84344 0.842854 2.34315 2.34315C0.842855 3.84344 0 5.87827 0 8C5.46953e-05 9.05057 0.207035 10.0909 0.609123 11.0614C1.01121 12.032 1.60053 12.9139 2.34344 13.6567C3.08635 14.3996 3.96829 14.9888 4.93892 15.3908C5.90954 15.7928 6.94984 15.9996 8.00042 15.9996C9.05099 15.9995 10.0913 15.7925 11.0619 15.3905C12.0324 14.9884 12.9143 14.399 13.6571 13.6561C14.4 12.9132 14.9892 12.0313 15.3912 11.0607C15.7932 10.09 16.0001 9.04974 16 7.99917C16 3.58167 12.4175 0 8 0ZM8 14.3325C7.16829 14.3325 6.34473 14.1687 5.57634 13.8504C4.80794 13.5321 4.10976 13.0656 3.52166 12.4775C2.93355 11.8894 2.46704 11.1912 2.14876 10.4228C1.83048 9.65443 1.66667 8.83087 1.66667 7.99917C1.66667 7.16746 1.83048 6.3439 2.14876 5.5755C2.46704 4.80711 2.93355 4.10893 3.52166 3.52082C4.10976 2.93272 4.80794 2.46621 5.57634 2.14793C6.34473 1.82965 7.16829 1.66583 8 1.66583V8L13.66 5.17C14.1025 6.04776 14.3331 7.01701 14.3333 8C14.3331 9.67956 13.6658 11.2903 12.478 12.4778C11.2903 13.6654 9.67956 14.3325 8 14.3325Z" fill="currentColor" />
</g>
<g id="wait_time_doc-card-text-primary">
<path d="M8 0C5.87827 0 3.84344 0.842854 2.34315 2.34315C0.842855 3.84344 0 5.87827 0 8C5.46953e-05 9.05057 0.207035 10.0909 0.609123 11.0614C1.01121 12.032 1.60053 12.9139 2.34344 13.6567C3.08635 14.3996 3.96829 14.9888 4.93892 15.3908C5.90954 15.7928 6.94984 15.9996 8.00042 15.9996C9.05099 15.9995 10.0913 15.7925 11.0619 15.3905C12.0324 14.9884 12.9143 14.3991 13.6571 13.6561C14.4 12.9132 14.9892 12.0313 15.3912 11.0607C15.7932 10.09 16.0001 9.04974 16 7.99917C16 3.58167 12.4175 0 8 0ZM8 14.3325C7.16829 14.3325 6.34473 14.1687 5.57634 13.8504C4.80794 13.5321 4.10976 13.0656 3.52166 12.4775C2.93355 11.8894 2.46704 11.1912 2.14876 10.4228C1.83048 9.65443 1.66667 8.83087 1.66667 7.99917C1.66667 7.16746 1.83048 6.3439 2.14876 5.5755C2.46704 4.80711 2.93355 4.10893 3.52166 3.52082C4.10976 2.93272 4.80794 2.46621 5.57634 2.14793C6.34473 1.82965 7.16829 1.66583 8 1.66583V8L15 11.0607C15.4425 11.9384 14.3331 7.01701 14.3333 8C14.3331 9.67956 13.6658 11.2903 12.478 12.4778C11.2903 13.6654 9.67956 14.3325 8 14.3325Z" fill="currentColor" />
</g>
<g id="wait_time_doc-card-text-body">
<path d="M8 0C5.87827 0 3.84344 0.842854 2.34315 2.34315C0.842855 3.84344 0 5.87827 0 8C5.46953e-05 9.05057 0.207035 10.0909 0.609123 11.0614C1.01121 12.032 1.60053 12.9139 2.34344 13.6567C3.08635 14.3996 3.96829 14.9888 4.93892 15.3908C5.90954 15.7928 6.94984 15.9996 8.00042 15.9996C9.05099 15.9995 10.0913 15.7925 11.0619 15.3905C12.0324 14.9884 12.9143 14.3991 13.6571 13.6561C14.4 12.9132 14.9892 12.0313 15.3912 11.0607C15.7932 10.09 16.0001 9.04974 16 7.99917C16 3.58167 12.4175 0 8 0ZM8 14.3325C7.16829 14.3325 6.34473 14.1687 5.57634 13.8504C4.80794 13.5321 4.10976 13.0656 3.52166 12.4775C2.93355 11.8894 2.46704 11.1912 2.14876 10.4228C1.83048 9.65443 1.66667 8.83087 1.66667 7.99917C1.66667 7.16746 1.83048 6.3439 2.14876 5.5755C2.46704 4.80711 2.93355 4.10893 3.52166 3.52082C4.10976 2.93272 4.80794 2.46621 5.57634 2.14793C6.34473 1.82965 7.16829 1.66583 8 1.66583V8L1.5 11C1.94249 11.8778 6.84285 20 12.5 13.5C12.4998 15.1796 13.6658 11.2903 12.478 12.4778C11.2903 13.6654 9.67956 14.3325 8 14.3325Z" fill="currentColor" />
</g>
<g id="wait_time_doc-card-text-muted">
<path d="M8 0C5.87827 0 3.84344 0.842854 2.34315 2.34315C0.842855 3.84344 0 5.87827 0 8C5.46953e-05 9.05057 0.207035 10.0909 0.609123 11.0614C1.01121 12.032 1.60053 12.9139 2.34344 13.6567C3.08635 14.3996 3.96829 14.9888 4.93892 15.3908C5.90954 15.7928 6.94984 15.9996 8.00042 15.9996C9.05099 15.9995 10.0913 15.7925 11.0619 15.3905C12.0324 14.9884 12.9143 14.3991 13.6571 13.6561C14.4 12.9132 14.9892 12.0313 15.3912 11.0607C15.7932 10.09 16.0001 9.04974 16 7.99917C16 3.58167 12.4175 0 8 0ZM8 14.3325C7.16829 14.3325 6.34473 14.1687 5.57634 13.8504C4.80794 13.5321 4.10976 13.0656 3.52166 12.4775C2.93355 11.8894 2.46704 11.1912 2.14876 10.4228C1.83048 9.65443 1.66667 8.83087 1.66667 7.99917C1.66667 7.16746 1.83048 6.3439 2.14876 5.5755C2.46704 4.80711 2.93355 4.10893 3.52166 3.52082C4.10976 2.93272 4.80794 2.46621 5.57634 2.14793C6.34473 1.82965 7.16829 1.66583 8 1.66583V8L1.5 11C1.94249 11.8778 6.84285 20 12.5 13.5C12.4998 15.1796 13.6658 11.2903 12.478 12.4778C11.2903 13.6654 9.67956 14.3325 8 14.3325Z" fill="currentColor" />
</g>

<g id="discount-wallet-svg">
<path d="M12.7714 2.33137L13.2176 5.15493L15.7852 6.4643L14.4904 9.02453L15.7925 11.5848L13.203 12.8941L12.7568 15.7177L9.91127 15.2715L7.88503 17.2904L5.85148 15.2422L3.02792 15.7104L2.57439 12.8649L0.0214844 11.5628L1.32354 9.00258L0.0287993 6.4643L2.59634 5.1403L3.04255 2.33868L5.87343 2.80684L7.90698 0.751343L9.93321 2.77758L12.7714 2.33137ZM6.07824 5.36706C5.78724 5.36706 5.50815 5.48266 5.30238 5.68844C5.09661 5.89421 4.98101 6.1733 4.98101 6.4643C4.98101 6.75531 5.09661 7.03439 5.30238 7.24017C5.50815 7.44594 5.78724 7.56154 6.07824 7.56154C6.36925 7.56154 6.64834 7.44594 6.85411 7.24017C7.05988 7.03439 7.17548 6.75531 7.17548 6.4643C7.17548 6.1733 7.05988 5.89421 6.85411 5.68844C6.64834 5.48266 6.36925 5.36706 6.07824 5.36706ZM9.73571 10.4875C9.4447 10.4875 9.16562 10.6031 8.95984 10.8089C8.75407 11.0147 8.63847 11.2937 8.63847 11.5848C8.63847 11.8758 8.75407 12.1548 8.95984 12.3606C9.16562 12.5664 9.4447 12.682 9.73571 12.682C10.0267 12.682 10.3058 12.5664 10.5116 12.3606C10.7173 12.1548 10.8329 11.8758 10.8329 11.5848C10.8329 11.2937 10.7173 11.0147 10.5116 10.8089C10.3058 10.6031 10.0267 10.4875 9.73571 10.4875ZM5.28092 12.682L11.5644 6.39847L10.533 5.36706L4.24951 11.6506L5.28092 12.682Z" fill="currentColor" />
</g>
<g id="video-chat-icon">
<path fill-rule="evenodd" clip-rule="evenodd" d="M12.48 10.0534C12.48 10.1699 12.4166 10.2771 12.3146 10.3334C12.2125 10.3898 12.088 10.3862 11.9894 10.3238L9.94784 9.03648V10.24C9.94784 10.4166 9.80451 10.56 9.62784 10.56H3.84C3.66336 10.56 3.52 10.4166 3.52 10.24V5.75999C3.52 5.58335 3.66336 5.44 3.84 5.44H9.62784C9.80451 5.44 9.94784 5.58335 9.94784 5.75999V6.96351L11.9894 5.67616C12.088 5.61376 12.2125 5.61024 12.3146 5.66656C12.4166 5.72288 12.48 5.83008 12.48 5.94656V10.0534ZM13.657 2.34304C12.146 0.831996 10.137 -3.8147e-06 8 -3.8147e-06C5.86304 -3.8147e-06 3.85408 0.831996 2.34304 2.34304C0.83232 3.85408 0 5.86304 0 7.99999C0 9.46943 0.40032 10.9008 1.15936 12.1498L0.0163203 15.5789C-0.0217597 15.6938 0.00799976 15.8205 0.0937597 15.9062C0.15488 15.9674 0.23648 16 0.32 16C0.35392 16 0.38816 15.9946 0.42112 15.9837L3.85024 14.8406C5.0992 15.5997 6.53056 16 8 16C10.137 16 12.146 15.168 13.657 13.657C15.168 12.1459 16 10.137 16 7.99999C16 5.86304 15.168 3.85408 13.657 2.34304Z" fill="currentColor" />
</g>
</defs>
</svg>
</div><div class="listing-svg d-none">
<svg>
<defs>

<g id="electronic-file-svg">
<path d="M8.40002 12H45.6L38.4 33.6H2.40002L8.40002 12Z" fill="#000066" />
<path fill-rule="evenodd" clip-rule="evenodd" d="M43.7697 14.428L37.8301 33.0192C37.8028 33.1064 37.7233 33.164 37.6323 33.164H3.04732C2.97759 33.164 2.92075 33.1352 2.87906 33.0783C2.83814 33.0207 2.82753 32.9586 2.84875 32.8926L8.78912 14.3015C8.81641 14.2151 8.89599 14.1567 8.98693 14.1567H43.5712C43.6371 14.1567 43.7 14.1886 43.7394 14.2416C43.7788 14.2954 43.7894 14.3651 43.7697 14.428ZM46.0298 12.5697C45.4591 11.7875 44.5405 11.3207 43.5712 11.3207H8.98693C7.65759 11.3207 6.49195 12.1718 6.08723 13.4382L0.146854 32.0301C-0.151756 32.9654 0.00967524 33.9575 0.588707 34.751C1.16016 35.5331 2.07948 36 3.04732 36H37.6323C38.9624 36 40.1273 35.1489 40.5328 33.8824L46.4716 15.2905C46.7657 14.3682 46.6005 13.3511 46.0298 12.5697Z" fill="#000066" />
<path fill-rule="evenodd" clip-rule="evenodd" d="M27.8464 21.9342H25.0354V19.1232C25.0354 18.1705 24.2631 17.3975 23.3089 17.3975C22.3562 17.3975 21.5839 18.1705 21.5839 19.1232V21.9342H18.7721C17.8194 21.9342 17.0464 22.7073 17.0464 23.6607C17.0464 24.6141 17.8194 25.3864 18.7721 25.3864H21.5839V28.1975C21.5839 29.1509 22.3562 29.9224 23.3089 29.9224C24.2631 29.9224 25.0354 29.1509 25.0354 28.1975V25.3864H27.8464C28.7998 25.3864 29.5721 24.6141 29.5721 23.6607C29.5721 22.7073 28.7998 21.9342 27.8464 21.9342Z" fill="white" />
<path fill-rule="evenodd" clip-rule="evenodd" d="M3.92642 12.7478C4.63278 10.5362 6.66697 9.05078 8.98688 9.05078H40.2387V6.3125C40.2394 5.35907 39.4664 4.58678 38.5137 4.58678H17.2919V1.72573C17.2919 0.773052 16.5188 0 15.5662 0H1.80129C0.847856 0 0.0755615 0.773052 0.0755615 1.72573V6.3125C0.0755615 6.31326 0.0755615 6.31402 0.0755615 6.31402V24.7998L3.92642 12.7478Z" fill="#EFA13E" />
</g>
</defs>
</svg>
</div>
<div class="bg-light pt-3 pb-2 py-md-3 as-search-section" id="as-search-section">
<div class="container">
<div class="row d-lg-none">
<div class="col-12">
<div class="d-flex align-items-center m-0 border h-100 position-relative bg-white rounded p-2 text-muted" id="modal-locality-filter" data-toggle="modal" data-target="#search-modal">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 250.89 250.89" height="20px" width="20px" style="min-width:20px;">
<g data-name="Layer 2">
<g data-name="Layer 2">
<rect fill="#f90" x="208.41" y="173.75" width="14.89" height="84.21" transform="translate(-89.41 215.86) rotate(-45)" />
<path class="search-2" fill="#9aaac1" d="M111.65,223.3A111.65,111.65,0,1,1,223.3,111.65,111.78,111.78,0,0,1,111.65,223.3Zm0-208.41a96.76,96.76,0,1,0,96.76,96.76A96.87,96.87,0,0,0,111.65,14.89Z" />
</g>
</g>
</svg>
<span class="px-2 text-truncate" id="mobile-filter-placeholder">Search for doctors, hospitals, specialties, services, diseases</span>
</div>
</div>
</div>
<div class="row d-none d-lg-block">
<div class="col-12">
<div class="row search-from m-0">

<div class="col-12 col-md-5 p-0">
<div class="form-group d-flex m-0 border h-100 position-relative bg-white rounded-left" id="aa-input-container">
<input type="search" id="locality-search-input" class="aa-input-search form-control m-0 border-0 bg-transparent shadow-none btn-outline-none h-auto" placeholder="Enter locality or city" name="search" autocomplete="off">
<div id="city_search_loader" class="lds-ring lds-border-primary m-2">
<div></div>
<div></div>
<div></div>
<div></div>
</div>
<span class="input-group-append btn-mediumgray-default btn-sm text-sm m-1 mx-2 py-1 px-3 d-flex align-items-center text-primary" id="gps_icon">
<svg width="20px" height="20px" viewBox="0 0 561 561" fill="#006">
<path d="M280.5,178.5c-56.1,0-102,45.9-102,102c0,56.1,45.9,102,102,102c56.1,0,102-45.9,102-102 C382.5,224.4,336.6,178.5,280.5,178.5z M507.45,255C494.7,147.9,410.55,63.75,306,53.55V0h-51v53.55 C147.9,63.75,63.75,147.9,53.55,255H0v51h53.55C66.3,413.1,150.45,497.25,255,507.45V561h51v-53.55 C413.1,494.7,497.25,410.55,507.45,306H561v-51H507.45z M280.5,459C181.05,459,102,379.95,102,280.5S181.05,102,280.5,102 S459,181.05,459,280.5S379.95,459,280.5,459z" />
</svg>
<span class="d-inline-block mx-1">Detect</span>
</span>
</div>
</div>

<div class="col-12 col-md-7 p-0">
<div class="form-group d-flex m-0 border h-100 bg-white rounded-right" id="aa-input-container">
<input type="search" id="filters-search-input" class="aa-input-search form-control m-0 border-0 bg-transparent shadow-none btn-outline-none h-auto" placeholder="Search for doctors, hospitals, specialties, services, diseases" name="search" autocomplete="off">
<div class="input-group-append p-1 px-2 d-flex align-items-center text-lg" style="cursor:pointer;display:none!important;" id="clear-filter-search"><strong>&times;</strong></div>
<div id="filter_search_loader" class="lds-ring lds-border-primary m-2">
<div></div>
<div></div>
<div></div>
<div></div>
</div>
<div class="input-group-append p-0">
<button type="submit" id="filter-search-button" class="btn btn-primary btn-block m-0 px-4">Search</button>
<div id="navigation_loader" class="lds-ring lds-border-primary m-2">
<div></div>
<div></div>
<div></div>
<div></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="sect-filters_and_sort bg-light pb-2 text-sm">
<div class="container">
<div class="row">
<div class="col-12">
<form action="#">
<div class="row align-items-center d-none d-lg-flex">
<div class="col-12 col-lg-auto mb-3 mb-lg-0 pl-2 pr-0">

<div class="custom-control custom-checkbox custom-control-inline bg-white py-2 pr-2 mr-0 border">
<input type="checkbox" id="maledoc1" class="custom-control-input apply-listing-filter-check">
<label class="custom-control-label" for="maledoc1">Male</label>
</div>
<div class="custom-control custom-checkbox custom-control-inline bg-white py-2 pr-2 mr-0 border mr-0">
<input type="checkbox" id="femaledoc1" class="custom-control-input apply-listing-filter-check" checked>
<label class="custom-control-label" for="femaledoc1">Female</label>
</div>
<div class="availability d-inline-block">

<div class="custom-control custom-checkbox custom-control-inline bg-white py-2 pr-2 mr-0 border">
<input type="checkbox" id="nextthreedays1" class="custom-control-input apply-listing-filter-check">
<label class="custom-control-label" for="nextthreedays1">Available in next 3 days</label>
</div>
<div class="custom-control custom-checkbox custom-control-inline bg-white py-2 pr-2 mr-0 border">
<input type="checkbox" id="today1" class="custom-control-input apply-listing-filter-check">
<label class="custom-control-label" for="today1">Available today</label>
</div>
<div class="custom-control custom-checkbox custom-control-inline bg-white py-2 pr-2 mr-0 border">
<input type="checkbox" id="video_consultation" class="custom-control-input apply-listing-filter-check">
<label class="custom-control-label" for="video_consultation">Video consultation available</label>
</div>
</div>
</div>
<div class="col-12 col-lg-auto d-flex align-items-center pl-1 pr-0 ml-auto">
<div class="sortby px-2 d-flex align-items-center ml-xl-2">
<strong class="title mr-2">Sort by:</strong>
<select class="form-control pr-4 select-sortby apply-listing-filter-check">
<option value="">Relevance</option>
<option value="lowest-fee">Fees (Low to High)</option>
<option value="highest-fee">Fees (High to Low)</option>
<option value="rating">Patient rating</option>
<option value="experience">Years of experience</option>
</select>
</div>
</div>
</div>
<div class="row text-center d-lg-none text-muted font-size-12-8">
<div class="col-12 d-flex align-items-center">
<span class="flex-shrink-0 mr-2 font-weight-medium">Filters</span>
<ul class="list-unstyled d-flex mobile-filters m-0 overflow-auto">
<li>
<input type="checkbox" id="video_consult_check">
<label for="video_consult_check">Video consult</label>
</li>

<li class="available-in-3days d-none">
<div class="custom-control custom-checkbox">
<input type="checkbox" id="available_three_day" class="custom-control-input apply-listing-filter-check">
<label class="custom-control-label" for="available_three_day">Available in next 3 days</label>
</div>
</li>
<li class="allfilters">
<a data-toggle="modal" id="filters_sort_btn" data-target="#filters_sort_modal" class="outline-none">+ More filters <span id="filters_count">(1)</span></a>
</li>

</ul>
</div>
 <div class="col-12 d-flex pt-2">
<div class="text-truncate font-weight-medium" id="showing_results_count">5 results • Sorted by "Best match"</div>
<a data-toggle="modal" data-target="#filters_sort_modal" class="outline-none ml-auto text-primary font-weight-medium text-uppercase font-size-13-6 flex-shrink-0 pl-1">
<svg fill="currentColor" width="12px" height="12px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
<g>
<path d="m496.1,138.3l-120.4-120.4c-7.9-7.9-20.6-7.9-28.5-7.10543e-15l-120.3,120.4c-7.9,7.9-7.9,20.6 0,28.5 7.9,7.9 20.6,7.9 28.5,0l85.7-85.7v352.8c0,11.3 9.1,20.4 20.4,20.4 11.3,0 20.4-9.1 20.4-20.4v-352.8l85.7,85.7c7.9,7.9 20.6,7.9 28.5,0 7.9-7.8 7.9-20.6 5.68434e-14-28.5z" />
<path d="m287.1,347.2c-7.9-7.9-20.6-7.9-28.5,0l-85.7,85.7v-352.8c0-11.3-9.1-20.4-20.4-20.4-11.3,0-20.4,9.1-20.4,20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5,0-7.9,7.9-7.9,20.6 0,28.5l120.4,120.4c7.9,7.9 20.6,7.9 28.5,0l120.4-120.4c7.8-7.9 7.8-20.7-0.1-28.5l0,0z" />
</g>
</svg>
<span class="align-middle" id="sort_filter_text">Sort</span>
</a>
</div>
</div>
</form>
</div>
</div>
</div>
</div>

<div id="filter_sort_loader" style="display:none;" class="lds-ring lds-lg-ring position-fixed"><div></div><div></div><div></div><div></div><div class="lds-text text-sm">Please wait…</div></div><section class="bg-light">
<div class="container">
<div class="row">
<div class="col py-2">
<h1 class="font-size-13-6 font-weight-medium my-1">
<span id="showing_results_title"><span>Top 5 Dermatologists in Bahria Town, Lahore</span></span>
</h1>
<p class="mb-1 text-light-muted font-weight-medium font-size-11-2 text-truncate">
Also known as
Skin Specialist ,ماہرامراض جلد
and Mahir-e-imraz-e-jild </p>
</div>
</div>



<div class="row d-lg-block" id="breadcrum_container_top">
<nav aria-label="breadcrumb" class="col px-0 px-lg-2">
<ol class="breadcrumb bg-transparent p-0">
<li class="breadcrumb-item"><a href="">Home</a></li><li class="breadcrumb-item"><a href="#pakistan">Pakistan</a></li><li class="breadcrumb-item"><a href="#pakistan/lahore">Lahore</a></li><li class="breadcrumb-item pl-1 active" aria-current="page">Dermatologists in Bahria Town, Lahore</a></li> </ol>
</nav> </div>


<div class="py-5 position-relative" id="top-loader" style="display: none;height: 220px">
<div id="infinite-loader-listing" style="display:flex;" class="lds-ring lds-lg-ring"><div></div><div></div><div></div><div></div>
<div class="lds-text text-sm">Fetching doctors…</div>
</div>
</div>
<div id="top-infinite-scroll-check"></div>
<div class="row">
<div class="col px-0 px-lg-2" id="doctors-result">
<div class="listitempage" data-url="#pakistan/lahore/bahria-town/dermatologist" data-offset="0">
<div class="custom-auto-slider video-consulation-slider overflow-auto py-2 d-lg-none">
<div>
<a href="#pakistan/lahore/bahria-town/dermatologist?only-video-consult=true" class="frame vc-slide">
<span class="badge mb-2 py-1 py-lg-2 px-lg-3">Video consultations</span>
<div class="mb-1 d-none d-lg-inline-block ml-2">Look for the <svg class="mx-1 text-white align-text-top" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><use xlink:href="#video-chat-icon"></use></svg> symbol on doctor images</div>
<p class="mb-1 d-lg-none">Consult doctors from the comfort of your home</p>
<strong class="font-size-13-6 text-white d-lg-none">See video consult doctors <svg width="8" height="10" viewBox="0 0 5 8" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g fill="currentColor"><polygon points="0.589999685 6.92749977 3.26166629 4.24999966 0.589999685 1.57249954 1.41249957 0.749999655 4.91249957 4.24999966 1.41249957 7.74999966"></polygon></g></g></svg></strong>
</a>
</div>

</div>
<div class="custom-auto-slider video-consulation-slider des-video-consult py-2 d-none d-lg-block">
<div>
<a href="#pakistan/lahore/bahria-town/dermatologist?only-video-consult=true" class="frame vc-slide">
<div class="text">
<strong class="text-white font-size-16">Video Consultations</strong>
<p class="mb-1">Consult doctors from the comfort of your home</p>
</div>
<span class="badge ml-auto">See video consult doctors</span>
</a>
</div>
</div> 
<div class="card mb-2 rounded-0 border-md-0 doc-listing-card doc-card-1 filter  cosmetologist dermatologist" style="position:relative;" id="doc-card-01">
<div class="card-body p-2 py-lg-3 shiner_laoder listing-_hiner_laoder bg-white">
<div class="row align-items-center">
<div class="col-12 col-lg-2 align-self-start">

<div class="row css-row-picture-name">
<div class="col-3 col-lg-12 px-3 px-lg-3 pb-2">
<div class="avatar position-relative"> <a href="#" class="css-avatar-img rounded-circle d-block overflow-hidden position-relative overflow-hidden shadow-none shine"></a>
</div>
</div>
<div class="col-9 col-lg-9 mobil-offset d-lg-none">
<div class="row">
<div class="col-12 pr-2 pr-sm-5">
<div class="row css-name-offset">
<div class="col-12">
<lines class="shine" style="height: 21px; max-width:166px;"></lines>
<lines class="shine" style="height: 21px;"></lines>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-12 col-lg-7 order-3 order-lg-2">
<div class="row mobil-offset mb-2 d-none d-lg-block">
<div class="col-12 pr-5">
<div class="row css-name-offset">
<div class="col-12">
<lines class="shine" style="height: 21px; max-width:166px;"></lines>
<lines class="shine" style="height: 15px;"></lines>
<lines class="shine" style="height: 21px; max-width:120px;"></lines>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="row align-items-center">
<div class="col-12 pr-lg-5">
<div class="row">
<div class="col-12">
<div class="row">
<div class="col-6 col-lg-4 mb-2"><lines class="shine rounded" style="height: 26px;"></lines></div>
<div class="col-6 col-lg-4 mb-2"><lines class="shine rounded" style="height: 26px;"></lines></div>
</div>
</div>
</div>
<div class="row pt-2 pt-lg-0">
<div class="col-6 col-lg-5 col-xl-4 mb-2 mb-lg-0 d-lg-none"><lines class="shine rounded" style="height: 38px;"></lines></div>
<div class="col-6 col-lg-5 col-xl-4 mb-2"><lines class="shine rounded" style="height: 38px;"></lines></div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="col-12 col-lg-3 order-2 css-col-stats py-2 py-lg-0">
<div class="row">
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:170px"></lines>
</div>
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:150px"></lines>
</div>
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:120px"></lines>
</div>
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:170px"></lines>
</div>
</div>
</div>
</div>
</div> <div class="card-body p-2 py-lg-3">

<div class="row align-items-center" onclick="redirect('1','#pakistan/lahore/dr/cosmetologist/Aleena-irteza-khan/379718')">
<div class="col-md-2 align-self-start">

<div class="row doctor-picture-frame">
<div class="doctor-card-img-width col-3 col-md-12 px-md-3">
<div class="avatar position-relative">
<div class="vc-doctor-img position-relative border-0">
<a href="#pakistan/lahore/dr/cosmetologist/Aleena-irteza-khan/379718" class="css-avatar-img rounded-circle d-block overflow-hidden position-relative overflow-hidden shadow-none" style="cursor:pointer;" onclick="event.stopPropagation();redirect('1','#pakistan/lahore/dr/cosmetologist/Aleena-irteza-khan/379718');">
<img data-src="https://s3-eu-west-1.amazonaws.com/mdpk/images/profile-pics/doctors/1594201484_AleenaIrtezaKhan.jpeg?t=1594201496" alt="Top Dermatologist in Bahria Town, Lahore - Dr. Aleena Irteza Khan" class="img-fluid card-img-overlay p-0 lazy" onerror="imgError(this, 'Female');" />
</a>
</div>
<div class="d-flex flex-column align-items-center" style="display:none !important;"><span class="badge badge-success text-white font-weight-normal d-flex align-items-center body-textsize"><svg viewBox="0 0 100 100" class="d-inline-block common-svg mr-1" width="12" height="12">
<use xlink:href="#thumbnail-svg"></use>
</svg> 0% </span> <small class="text-muted text-nowrap body-textsize">1 patient</small>
</div>
</div>
</div>
<div class="col-9 pl-1 mobil-offset d-md-none">
<h2 class="doctor-name m-0">
<a href="#pakistan/lahore/dr/cosmetologist/Aleena-irteza-khan/379718" onclick="event.stopPropagation();">Dr. Aleena Irteza Khan</a>
</h2>
<p class="m-0 text-truncate text-muted text-sm"> M.B.B.S, M.C.P.S (Dermatology), M.D</p>
<h3 class="text-sm mb-1 font-weight-normal">Cosmetologist, Dermatologist</h3>
<div class="disc-list row m-0">
<div class="list-item">
<small class="col p-0 text-sm"><strong>10 years </strong> experience</small>
</div>
 </div>
</div>
</div>
</div>
<div class="col-md-10 pr-lg-5">
<div class="row css-name-offset">
<div class="col-lg-8 col-xl-9 pt-2 pt-md-0 px-0 pl-md-2 pr-md-4 mb-2 pb-md-2 border-bottom mx-2 mx-md-0">
<div class="d-none d-md-block">
<h2 class="doctor-name m-0">
<a href="#pakistan/lahore/dr/cosmetologist/Aleena-irteza-khan/379718" onclick="event.stopPropagation();">Dr. Aleena Irteza Khan</a>
</h2>
<p class="m-0 text-truncate text-muted text-sm"> M.B.B.S, M.C.P.S (Dermatology), M.D</p>
<h3 class="mb-1 body-textsize font-weight-normal">Cosmetologist, Dermatologist</h3>
</div>
<div class="disc-list row m-0 mb-1 d-none d-md-flex">
<div class="list-item">
<small class="col p-0 text-sm"><span class="font-weight-medium">10 years </span> experience</small>
</div>
</div>

</div>
<div class="col-lg-4 col-xl-3 mb-lg-2 pb-lg-2 btn-holder border-bottom order-3 order-lg-2">
<div class="row booking-btn-holder pt-lg-0">


<div class="col-6 col-lg-12 top-arrow-dropdown dropdown mb-2">
<a href="#appointment/4681/379718#select-date" class="btn btn-block btn-outline-indianred font-weight-bold no-booking-btn" onclick="event.stopPropagation();"> <svg class="mx-1" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><use xlink:href="#video-chat-icon"></use></svg> Video Consultation </a> </div>

<div class="col-6 col-lg-12 top-arrow-dropdown dropdown mb-2">
<div class="modal fade bookappointment-mobile-model p-0" tabindex="-1" role="dialog" aria-hidden="true" id="bookappointment-mobile-model-379718" onclick="event.stopPropagation(); return false;" style="display: none;">
<div class="modal-dialog m-0 mw-100 d-flex h-100 align-items-end" role="document">
<div class="modal-content border-0 rounded-0">
<div class="modal-body pb-0 text-sm">
<div class="titile pb-1">
<span class="text-dark-muted">Book appointment with Dr. Aleena Irteza Khan at</span>
</div><a href="#appointment/4681/379718#select-date" class="border-bottom d-block text-body py-2 outline-none bg-focus-none text-decoration-none" onclick="event.stopPropagation();">
<div class="disc-list"><strong class="list-item">Online Video Consultation
</strong><span class="">(Online)</span></div><div class="my-1"><div class="row align-items-center text-available">
<span class="mx-2 text-center d-flex justify-content-center align-items-center">
<i class="icon-available"></i>
</span>
<span class="col pl-0">Available Wed, Jul 15</span>
</div></div><div class="d-flex align-items-center flex-wrap"><div class="d-inline-flex">
Fee: <span class="px-1">Rs. 1,500 </span>
</div><div class="d-inline-flex align-items-center align-middle">
<svg width="22" height="18" viewBox="0 0 22 18" color="#434392" xmlns="http://www.w3.org/2000/svg">
<use xlink:href="#discount-wallet-svg"></use>
</svg>
<span class="border-bottom border-dashed text-primary-dark">Rs. 1350 if you pay online</span>
</div> </div>
</a><a href="#appointment/7940/379718#select-date" class="border-bottom d-block text-body py-2 outline-none bg-focus-none text-decoration-none" onclick="event.stopPropagation();">
<div class="disc-list"><strong class="list-item">Dr Safooras Skin Care Clinic
</strong><span class="">(Faisal Town)</span></div><div class="my-1"><div class="row align-items-center text-available">
<span class="mx-2 text-center d-flex justify-content-center align-items-center">
<i class="icon-available"></i>
</span>
<span class="col pl-0">Available Wed, Jul 15</span>
</div></div><div class="d-flex align-items-center flex-wrap"><div class="d-inline-flex">
Fee: <span class="px-1">Rs. 1,500 </span>
</div> </div>
</a><a href="#appointment/194/379718#select-date" class="border-bottom d-block text-body py-2 outline-none bg-focus-none text-decoration-none" onclick="event.stopPropagation();">
<div class="disc-list"><strong class="list-item">Bahria International Hospital
</strong><span class="">(Bahria Town)</span></div><div class="my-1"><div class="row align-items-center text-available">
<span class="mx-2 text-center d-flex justify-content-center align-items-center">
<i class="icon-available"></i>
</span>
<span class="col pl-0">Available tomorrow</span>
</div></div><div class="d-flex align-items-center flex-wrap"><div class="d-inline-flex">
Fee: <span class="px-1">Rs. 2,000 </span>
</div> </div>
</a></div>
</div>
</div>
</div><button class="btn btn-block btn-warning text-white font-weight-bold d-none d-lg-flex no-booking-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="event.stopPropagation(); return openDD('#bookapp-tooltip-379718')">Book Appointment <span class="no-booking d-block">No Booking Fee</span></button><button class="btn btn-block btn-warning text-white font-weight-bold m-0 d-lg-none no-booking-btn" onclick="event.stopPropagation(); return openModal('#bookappointment-mobile-model-379718')">Book Appointment <span class="no-booking d-block">No Booking Fee</span></button><div class="dropdown-menu dropdown-menu-right shadow border rounded pt-2 pb-0 my-3 text-sm" aria-labelledby="bookapp-tooltip" id="bookapp-tooltip-379718"><span class="dropdown-item d-flex align-items-center px-3 text-dark-muted">Book appointment with Dr. Aleena Irteza Khan at</span><a class="dropdown-item px-3 py-2 border-bottom outline-none bg-focus-none" href="#appointment/4681/379718#select-date"><div class="disc-list dropdown-disc-list d-flex flex-wrap"><div class="list-item font-weight-medium">Online Video Consultation</div><div class="list-item">Online</div></div><div class="my-1 col-12 pl-0">
<div class="row align-items-center text-available">
<span class="mx-2 text-center d-flex justify-content-center align-items-center">
<i class="icon-available"></i>
</span>
<span class="col pl-0">Available Wed, Jul 15</span>
</div>
</div><div class="d-flex align-items-center">
<div class="d-inline-flex">
Fee: <span class="px-1">Rs. 1,500 </span>
</div><div class="d-inline-flex align-items-center align-middle">
<svg width="22" height="18" viewBox="0 0 22 18" color="#434392" xmlns="http://www.w3.org/2000/svg">
<use xlink:href="#discount-wallet-svg"></use>
</svg>
<span class="border-bottom border-dashed text-primary-dark">Rs. 1350 if you pay online</span>
</div></div>
</a><a class="dropdown-item px-3 py-2 border-bottom outline-none bg-focus-none" href="#appointment/7940/379718#select-date"><div class="disc-list dropdown-disc-list d-flex flex-wrap"><div class="list-item font-weight-medium">Dr Safooras Skin Care Clinic</div><div class="list-item">Faisal Town</div></div><div class="my-1 col-12 pl-0">
<div class="row align-items-center text-available">
<span class="mx-2 text-center d-flex justify-content-center align-items-center">
<i class="icon-available"></i>
</span>
<span class="col pl-0">Available Wed, Jul 15</span>
</div>
</div><div class="d-flex align-items-center">
<div class="d-inline-flex">
Fee: <span class="px-1">Rs. 1,500 </span>
</div></div>
</a><a class="dropdown-item px-3 py-2 border-bottom outline-none bg-focus-none" href="#appointment/194/379718#select-date"><div class="disc-list dropdown-disc-list d-flex flex-wrap"><div class="list-item font-weight-medium">Bahria International Hospital</div><div class="list-item">Bahria Town</div></div><div class="my-1 col-12 pl-0">
<div class="row align-items-center text-available">
<span class="mx-2 text-center d-flex justify-content-center align-items-center">
<i class="icon-available"></i>
</span>
<span class="col pl-0">Available tomorrow</span>
</div>
</div><div class="d-flex align-items-center">
<div class="d-inline-flex">
Fee: <span class="px-1">Rs. 2,000 </span>
</div></div>
</a></div></div> </div>
</div>
<div class="col-12 pl-0 pl-md-2 px-lg-0 order-lg-3" onclick="event.stopPropagation();">
<div class="dd-hospital-carddetails overflow-auto">
<div>
<a href="#appointment/4681/379718#select-date" class="frame d-block text-decoration-none available-video-hospitalcard">
 <div class="p-2">
<span class="text-truncate d-block mb-1 text-sm font-weight-medium">Online Video Consultation (Online)</span>
<div class="d-flex">
<div class="px-2 text-truncate">
<div class="row align-items-center text-available text-decoration-none">
<span class="mr-2 text-center d-flex justify-content-center align-items-center">
<i class="icon-available"></i>
</span>
<small class="col pl-0 text-truncate">Available Wed, Jul 15</small>
</div>
</div>
<div class="d-inline-flex flex-shrink-0 ml-auto">

<small class="col pl-0 doctor-fee">Rs. 1,500</small>
</div>
</div>
</div>
<div class="discount-strip p-1">
<svg width="22" height="18" viewBox="0 0 22 18" xmlns="http://www.w3.org/2000/svg">
<use xlink:href="#discount-wallet-svg"></use>
</svg>
<span>Rs. 1350 if you pay online</span>
</div>
</a>
</div>
<div>
<a href="#appointment/194/379718#select-date" class="frame d-block text-decoration-none ">
<div class="p-2">
<span class="text-truncate d-block mb-1 text-sm font-weight-medium">Bahria International Hospital (Bahria Town)</span>
<div class="d-flex">
<div class="px-2 text-truncate">
<div class="row align-items-center text-available text-decoration-none">
<span class="mr-2 text-center d-flex justify-content-center align-items-center">
<i class="icon-available"></i>
</span>
<small class="col pl-0 text-truncate">Available tomorrow</small>
</div>
</div>
<div class="d-inline-flex flex-shrink-0 ml-auto">

<small class="col pl-0 doctor-fee">Rs. 2,000</small>
</div>
</div>
</div>
</a>
</div>
<div>
<a href="#appointment/7940/379718#select-date" class="frame d-block text-decoration-none ">
<div class="p-2">
<span class="text-truncate d-block mb-1 text-sm font-weight-medium">Dr Safooras Skin Care Clinic (Faisal Town)</span>
<div class="d-flex">
<div class="px-2 text-truncate">
<div class="row align-items-center text-available text-decoration-none">
<span class="mr-2 text-center d-flex justify-content-center align-items-center">
<i class="icon-available"></i>
</span>
<small class="col pl-0 text-truncate">Available Wed, Jul 15</small>
</div>
</div>
<div class="d-inline-flex flex-shrink-0 ml-auto">

<small class="col pl-0 doctor-fee">Rs. 1,500</small>
</div>
</div>
</div>
</a>
</div>
</div> </div>
</div>
</div>
</div>
</div>
</div>

<div class="card mb-2 rounded-0 border-md-0 doc-listing-card doc-card-2 filter  dermatologist" style="position:relative;" id="doc-card-02">
<div class="card-body p-2 py-lg-3 shiner_laoder listing-_hiner_laoder bg-white">
<div class="row align-items-center">
<div class="col-12 col-lg-2 align-self-start">

<div class="row css-row-picture-name">
<div class="col-3 col-lg-12 px-3 px-lg-3 pb-2">
<div class="avatar position-relative"> <a href="#" class="css-avatar-img rounded-circle d-block overflow-hidden position-relative overflow-hidden shadow-none shine"></a>
</div>
</div>
<div class="col-9 col-lg-9 mobil-offset d-lg-none">
<div class="row">
<div class="col-12 pr-2 pr-sm-5">
<div class="row css-name-offset">
<div class="col-12">
<lines class="shine" style="height: 21px; max-width:166px;"></lines>
<lines class="shine" style="height: 21px;"></lines>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-12 col-lg-7 order-3 order-lg-2">
<div class="row mobil-offset mb-2 d-none d-lg-block">
<div class="col-12 pr-5">
<div class="row css-name-offset">
<div class="col-12">
<lines class="shine" style="height: 21px; max-width:166px;"></lines>
<lines class="shine" style="height: 15px;"></lines>
<lines class="shine" style="height: 21px; max-width:120px;"></lines>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="row align-items-center">
<div class="col-12 pr-lg-5">
<div class="row">
<div class="col-12">
<div class="row">
<div class="col-6 col-lg-4 mb-2"><lines class="shine rounded" style="height: 26px;"></lines></div>
<div class="col-6 col-lg-4 mb-2"><lines class="shine rounded" style="height: 26px;"></lines></div>
</div>
</div>
</div>
<div class="row pt-2 pt-lg-0">
<div class="col-6 col-lg-5 col-xl-4 mb-2 mb-lg-0 d-lg-none"><lines class="shine rounded" style="height: 38px;"></lines></div>
<div class="col-6 col-lg-5 col-xl-4 mb-2"><lines class="shine rounded" style="height: 38px;"></lines></div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="col-12 col-lg-3 order-2 css-col-stats py-2 py-lg-0">
<div class="row">
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:170px"></lines>
</div>
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:150px"></lines>
</div>
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:120px"></lines>
</div>
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:170px"></lines>
</div>
</div>
</div>
</div>
</div> <div class="card-body p-2 py-lg-3">

<div class="row align-items-center" onclick="redirect('2','#pakistan/lahore/dr/dermatologist/sumaira-taj/1695')">
<div class="col-md-2 align-self-start">

<div class="row doctor-picture-frame">
<div class="doctor-card-img-width col-3 col-md-12 px-md-3">
<div class="avatar position-relative">
<div class="position-relative border-0">
<a href="#pakistan/lahore/dr/dermatologist/sumaira-taj/1695" class="css-avatar-img rounded-circle d-block overflow-hidden position-relative overflow-hidden shadow-none" style="cursor:pointer;" onclick="event.stopPropagation();redirect('2','#pakistan/lahore/dr/dermatologist/sumaira-taj/1695');">
<img data-src="https://s3-eu-west-1.amazonaws.com/mdpk/images/profile-pics/doctors/default/doc_female_orig.png?t=0" alt="Top Dermatologist in Bahria Town, Lahore - Dr. Sumaira Taj" class="img-fluid card-img-overlay p-0 lazy" onerror="imgError(this, 'Female');" />
</a>
</div>
<div class="d-flex flex-column align-items-center" style="display:none !important;"><span class="badge badge-success text-white font-weight-normal d-flex align-items-center body-textsize"><svg viewBox="0 0 100 100" class="d-inline-block common-svg mr-1" width="12" height="12">
<use xlink:href="#thumbnail-svg"></use>
</svg> 0% </span> <small class="text-muted text-nowrap body-textsize">0 patient</small>
</div>
</div>
</div>
<div class="col-9 pl-1 mobil-offset d-md-none">
<h2 class="doctor-name m-0">
<a href="#pakistan/lahore/dr/dermatologist/sumaira-taj/1695" onclick="event.stopPropagation();">Dr. Sumaira Taj</a>
</h2>
<p class="m-0 text-truncate text-muted text-sm">MBBS, FCPS</p>
<h3 class="text-sm mb-1 font-weight-normal">Dermatologist</h3>
<div class="disc-list row m-0">
</div>
</div>
</div>
 </div>
<div class="col-md-10 pr-lg-5">
<div class="row css-name-offset">
<div class="col-lg-8 col-xl-9 pt-2 pt-md-0 px-0 pl-md-2 pr-md-4 mb-2 pb-md-2 border-bottom mx-2 mx-md-0">
<div class="d-none d-md-block">
<h2 class="doctor-name m-0">
<a href="#pakistan/lahore/dr/dermatologist/sumaira-taj/1695" onclick="event.stopPropagation();">Dr. Sumaira Taj</a>
</h2>
<p class="m-0 text-truncate text-muted text-sm">MBBS, FCPS</p>
<h3 class="mb-1 body-textsize font-weight-normal">Dermatologist</h3>
</div>

</div>
<div class="col-lg-4 col-xl-3 mb-lg-2 pb-lg-2 btn-holder border-bottom order-3 order-lg-2">
<div class="row booking-btn-holder pt-lg-0">
<div class="col-6 col-lg-12 mb-2">
<a href="#pakistan/lahore/dr/dermatologist/sumaira-taj/1695" class="btn btn-block btn-outline-primary font-weight-bold text-size-14">View Profile</a>
</div>
<div class="col-6 col-lg-12 dropdown top-arrow-dropdown mb-2">
<a href="tel:04238375255" class="call-number btn btn-block btn-primary font-weight-bold d-flex align-items-center justify-content-center text-size-14" onclick="event.stopPropagation(); return openDD('#call-tooltip-1695')" role="button" id="call-tooltip-opner" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Call Helpline</a><div class="dropdown-menu shadow border rounded py-1 my-3 call-button-tooltip" aria-labelledby="call-tooltip-opner" id="call-tooltip-1695">
<span class="px-3 d-block">04238375255</span>
</div></div> </div>
</div>
<div class="col-12 pl-0 pl-md-2 px-lg-0 order-lg-3" onclick="event.stopPropagation();">
<div class="dd-hospital-carddetails overflow-auto">
<div>
<a href="#hospital-244" class="frame d-block text-decoration-none">
<div class="p-2">
<span class="text-truncate d-block mb-0 text-sm font-weight-medium">Citi Hospital (Bahria Town)</span>
</div>
</a>
</div>
</div> </div>
</div>
</div>
</div>
</div>
</div>

<div class="card mb-2 rounded-0 border-md-0 doc-listing-card doc-card-3 filter  dermatologist" style="position:relative;" id="doc-card-03">
<div class="card-body p-2 py-lg-3 shiner_laoder listing-_hiner_laoder bg-white">
<div class="row align-items-center">
<div class="col-12 col-lg-2 align-self-start">
 
<div class="row css-row-picture-name">
<div class="col-3 col-lg-12 px-3 px-lg-3 pb-2">
<div class="avatar position-relative"> <a href="#" class="css-avatar-img rounded-circle d-block overflow-hidden position-relative overflow-hidden shadow-none shine"></a>
</div>
</div>
<div class="col-9 col-lg-9 mobil-offset d-lg-none">
<div class="row">
<div class="col-12 pr-2 pr-sm-5">
<div class="row css-name-offset">
<div class="col-12">
<lines class="shine" style="height: 21px; max-width:166px;"></lines>
<lines class="shine" style="height: 21px;"></lines>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-12 col-lg-7 order-3 order-lg-2">
<div class="row mobil-offset mb-2 d-none d-lg-block">
<div class="col-12 pr-5">
<div class="row css-name-offset">
<div class="col-12">
<lines class="shine" style="height: 21px; max-width:166px;"></lines>
<lines class="shine" style="height: 15px;"></lines>
<lines class="shine" style="height: 21px; max-width:120px;"></lines>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="row align-items-center">
<div class="col-12 pr-lg-5">
<div class="row">
<div class="col-12">
<div class="row">
<div class="col-6 col-lg-4 mb-2"><lines class="shine rounded" style="height: 26px;"></lines></div>
<div class="col-6 col-lg-4 mb-2"><lines class="shine rounded" style="height: 26px;"></lines></div>
</div>
</div>
</div>
<div class="row pt-2 pt-lg-0">
<div class="col-6 col-lg-5 col-xl-4 mb-2 mb-lg-0 d-lg-none"><lines class="shine rounded" style="height: 38px;"></lines></div>
<div class="col-6 col-lg-5 col-xl-4 mb-2"><lines class="shine rounded" style="height: 38px;"></lines></div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="col-12 col-lg-3 order-2 css-col-stats py-2 py-lg-0">
<div class="row">
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:170px"></lines>
</div>
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:150px"></lines>
</div>
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:120px"></lines>
</div>
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:170px"></lines>
</div>
</div>
</div>
</div>
</div> <div class="card-body p-2 py-lg-3">

<div class="row align-items-center" onclick="redirect('3','#pakistan/lahore/dr/dermatologist/saira-taj/21255')">
<div class="col-md-2 align-self-start">
 
<div class="row doctor-picture-frame">
<div class="doctor-card-img-width col-3 col-md-12 px-md-3">
<div class="avatar position-relative">
<div class="position-relative border-0">
<a href="#pakistan/lahore/dr/dermatologist/saira-taj/21255" class="css-avatar-img rounded-circle d-block overflow-hidden position-relative overflow-hidden shadow-none" style="cursor:pointer;" onclick="event.stopPropagation();redirect('3','#pakistan/lahore/dr/dermatologist/saira-taj/21255');">
<img data-src="https://s3-eu-west-1.amazonaws.com/mdpk/images/profile-pics/doctors/1505973508_saira-taj.JPG?t=1590140003" alt="Top Dermatologist in Bahria Town, Lahore - Dr. Saira Taj" class="img-fluid card-img-overlay p-0 lazy" onerror="imgError(this, 'Female');" />
</a>
</div>
<div class="d-flex flex-column align-items-center" style="display:none !important;"><span class="badge badge-success text-white font-weight-normal d-flex align-items-center body-textsize"><svg viewBox="0 0 100 100" class="d-inline-block common-svg mr-1" width="12" height="12">
<use xlink:href="#thumbnail-svg"></use>
</svg> 0% </span> <small class="text-muted text-nowrap body-textsize">1 patient</small>
</div>
</div>
</div>
<div class="col-9 pl-1 mobil-offset d-md-none">
<h2 class="doctor-name m-0">
<a href="#pakistan/lahore/dr/dermatologist/saira-taj/21255" onclick="event.stopPropagation();">Dr. Saira Taj</a>
</h2>
<p class="m-0 text-truncate text-muted text-sm"> MBBS, MSc Dermatology Skills and Treatment, U.K, Fellowship Diploma AAA U.S.A</p>
<h3 class="text-sm mb-1 font-weight-normal">Dermatologist</h3>
<div class="disc-list row m-0">
<div class="list-item">
<small class="col p-0 text-sm"><strong>7 years </strong> experience</small>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-10 pr-lg-5">
<div class="row css-name-offset">
<div class="col-lg-8 col-xl-9 pt-2 pt-md-0 px-0 pl-md-2 pr-md-4 mb-2 pb-md-2 border-bottom mx-2 mx-md-0">
<div class="d-none d-md-block">
<h2 class="doctor-name m-0">
<a href="#pakistan/lahore/dr/dermatologist/saira-taj/21255" onclick="event.stopPropagation();">Dr. Saira Taj</a>
</h2>
<p class="m-0 text-truncate text-muted text-sm"> MBBS, MSc Dermatology Skills and Treatment, U.K, Fellowship Diploma AAA U.S.A</p>
<h3 class="mb-1 body-textsize font-weight-normal">Dermatologist</h3>
</div>

</div>
<div class="col-lg-4 col-xl-3 mb-lg-2 pb-lg-2 btn-holder border-bottom order-3 order-lg-2">
<div class="row booking-btn-holder pt-lg-0">
<div class="col-6 col-lg-12 mb-2">
<a href="#pakistan/lahore/dr/dermatologist/saira-taj/21255" class="btn btn-block btn-outline-primary font-weight-bold text-size-14">View Profile</a>
</div>
<div class="col-6 col-lg-12 dropdown top-arrow-dropdown mb-2">
<a href="tel:04238375255" class="call-number btn btn-block btn-primary font-weight-bold d-flex align-items-center justify-content-center text-size-14" onclick="event.stopPropagation(); return openDD('#call-tooltip-21255')" role="button" id="call-tooltip-opner" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Call Helpline</a><div class="dropdown-menu shadow border rounded py-1 my-3 call-button-tooltip" aria-labelledby="call-tooltip-opner" id="call-tooltip-21255">
<span class="px-3 d-block">04238375255</span>
</div></div> </div>
</div>
<div class="col-12 pl-0 pl-md-2 px-lg-0 order-lg-3" onclick="event.stopPropagation();">
<div class="dd-hospital-carddetails overflow-auto">
<div>
<a href="#hospital-194" class="frame d-block text-decoration-none">
<div class="p-2">
<span class="text-truncate d-block mb-0 text-sm font-weight-medium">Bahria International Hospital (Bahria Town)</span>
</div>
</a>
</div>
</div> </div>
</div>
</div>
</div>
</div>
</div>

<div class="card mb-2 rounded-0 border-md-0 doc-listing-card doc-card-4 filter  dermatologist cosmetologist" style="position:relative;" id="doc-card-04">
<div class="card-body p-2 py-lg-3 shiner_laoder listing-_hiner_laoder bg-white">
<div class="row align-items-center">
<div class="col-12 col-lg-2 align-self-start">

<div class="row css-row-picture-name">
<div class="col-3 col-lg-12 px-3 px-lg-3 pb-2">
<div class="avatar position-relative"> <a href="#" class="css-avatar-img rounded-circle d-block overflow-hidden position-relative overflow-hidden shadow-none shine"></a>
</div>
</div>
<div class="col-9 col-lg-9 mobil-offset d-lg-none">
<div class="row">
<div class="col-12 pr-2 pr-sm-5">
<div class="row css-name-offset">
<div class="col-12">
<lines class="shine" style="height: 21px; max-width:166px;"></lines>
<lines class="shine" style="height: 21px;"></lines>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-12 col-lg-7 order-3 order-lg-2">
<div class="row mobil-offset mb-2 d-none d-lg-block">
<div class="col-12 pr-5">
<div class="row css-name-offset">
<div class="col-12">
<lines class="shine" style="height: 21px; max-width:166px;"></lines>
<lines class="shine" style="height: 15px;"></lines>
<lines class="shine" style="height: 21px; max-width:120px;"></lines>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="row align-items-center">
<div class="col-12 pr-lg-5">
<div class="row">
<div class="col-12">
<div class="row">
<div class="col-6 col-lg-4 mb-2"><lines class="shine rounded" style="height: 26px;"></lines></div>
<div class="col-6 col-lg-4 mb-2"><lines class="shine rounded" style="height: 26px;"></lines></div>
</div>
</div>
</div>
<div class="row pt-2 pt-lg-0">
<div class="col-6 col-lg-5 col-xl-4 mb-2 mb-lg-0 d-lg-none"><lines class="shine rounded" style="height: 38px;"></lines></div>
<div class="col-6 col-lg-5 col-xl-4 mb-2"><lines class="shine rounded" style="height: 38px;"></lines></div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="col-12 col-lg-3 order-2 css-col-stats py-2 py-lg-0">
<div class="row">
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:170px"></lines>
</div>
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:150px"></lines>
</div>
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:120px"></lines>
</div>
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:170px"></lines>
</div>
</div>
</div>
</div>
</div> <div class="card-body p-2 py-lg-3">

<div class="row align-items-center" onclick="redirect('4','#pakistan/lahore/dr/dermatologist/zahida-ghufran/73576')">
<div class="col-md-2 align-self-start">

<div class="row doctor-picture-frame">
<div class="doctor-card-img-width col-3 col-md-12 px-md-3">
<div class="avatar position-relative">
<div class="position-relative border-0">
<a href="#pakistan/lahore/dr/dermatologist/zahida-ghufran/73576" class="css-avatar-img rounded-circle d-block overflow-hidden position-relative overflow-hidden shadow-none" style="cursor:pointer;" onclick="event.stopPropagation();redirect('4','#pakistan/lahore/dr/dermatologist/zahida-ghufran/73576');">
<img data-src="https://s3-eu-west-1.amazonaws.com/mdpk/images/profile-pics/doctors/1583215972_doc_male_orig.png.jpg?t=1590140287" alt="Top Dermatologist in Bahria Town, Lahore - Dr. Zahida Ghufran" class="img-fluid card-img-overlay p-0 lazy" onerror="imgError(this, 'Female');" />
</a>
</div>
<div class="d-flex flex-column align-items-center" style="display:none !important;"><span class="badge badge-success text-white font-weight-normal d-flex align-items-center body-textsize"><svg viewBox="0 0 100 100" class="d-inline-block common-svg mr-1" width="12" height="12">
<use xlink:href="#thumbnail-svg"></use>
</svg> 0% </span> <small class="text-muted text-nowrap body-textsize">0 patient</small>
</div>
</div>
</div>
<div class="col-9 pl-1 mobil-offset d-md-none">
<h2 class="doctor-name m-0">
<a href="#pakistan/lahore/dr/dermatologist/zahida-ghufran/73576" onclick="event.stopPropagation();">Dr. Zahida Ghufran</a>
</h2>
<p class="m-0 text-truncate text-muted text-sm">M.B.B.S., F.C.P.S</p>
<h3 class="text-sm mb-1 font-weight-normal">Dermatologist, Cosmetologist</h3>
<div class="disc-list row m-0">
<div class="list-item">
<small class="col p-0 text-sm"><strong>14 years </strong> experience</small>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-10 pr-lg-5">
<div class="row css-name-offset">
<div class="col-lg-8 col-xl-9 pt-2 pt-md-0 px-0 pl-md-2 pr-md-4 mb-2 pb-md-2 border-bottom mx-2 mx-md-0">
<div class="d-none d-md-block">
<h2 class="doctor-name m-0">
<a href="#pakistan/lahore/dr/dermatologist/zahida-ghufran/73576" onclick="event.stopPropagation();">Dr. Zahida Ghufran</a>
</h2>
<p class="m-0 text-truncate text-muted text-sm">M.B.B.S., F.C.P.S</p>
<h3 class="mb-1 body-textsize font-weight-normal">Dermatologist, Cosmetologist</h3>
</div>

</div>
<div class="col-lg-4 col-xl-3 mb-lg-2 pb-lg-2 btn-holder border-bottom order-3 order-lg-2">
<div class="row booking-btn-holder pt-lg-0">
<div class="col-6 col-lg-12 mb-2">
<a href="#pakistan/lahore/dr/dermatologist/zahida-ghufran/73576" class="btn btn-block btn-outline-primary font-weight-bold text-size-14">View Profile</a>
</div>
<div class="col-6 col-lg-12 dropdown top-arrow-dropdown mb-2">
<a href="tel:04238375255" class="call-number btn btn-block btn-primary font-weight-bold d-flex align-items-center justify-content-center text-size-14" onclick="event.stopPropagation(); return openDD('#call-tooltip-73576')" role="button" id="call-tooltip-opner" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Call Helpline</a><div class="dropdown-menu shadow border rounded py-1 my-3 call-button-tooltip" aria-labelledby="call-tooltip-opner" id="call-tooltip-73576">
<span class="px-3 d-block">04238375255</span>
</div></div> </div>
</div>
<div class="col-12 pl-0 pl-md-2 px-lg-0 order-lg-3" onclick="event.stopPropagation();">
<div class="dd-hospital-carddetails overflow-auto">
<div>
<a href="#hospital-2836" class="frame d-block text-decoration-none">
<div class="p-2">
<span class="text-truncate d-block mb-0 text-sm font-weight-medium">Green PolyClinic (Bahria Town)</span>
</div>
</a>
</div>
</div> </div>
</div>
</div>
</div>
</div>
</div>

<div class="card mb-2 rounded-0 border-md-0 doc-listing-card doc-card-5 filter  dermatologist cosmetologist" style="position:relative;" id="doc-card-05">
<div class="card-body p-2 py-lg-3 shiner_laoder listing-_hiner_laoder bg-white">
<div class="row align-items-center">
<div class="col-12 col-lg-2 align-self-start">

<div class="row css-row-picture-name">
<div class="col-3 col-lg-12 px-3 px-lg-3 pb-2">
<div class="avatar position-relative"> <a href="#" class="css-avatar-img rounded-circle d-block overflow-hidden position-relative overflow-hidden shadow-none shine"></a>
</div>
</div>
<div class="col-9 col-lg-9 mobil-offset d-lg-none">
<div class="row">
<div class="col-12 pr-2 pr-sm-5">
<div class="row css-name-offset">
<div class="col-12">
<lines class="shine" style="height: 21px; max-width:166px;"></lines>
<lines class="shine" style="height: 21px;"></lines>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-12 col-lg-7 order-3 order-lg-2">
<div class="row mobil-offset mb-2 d-none d-lg-block">
<div class="col-12 pr-5">
<div class="row css-name-offset">
<div class="col-12">
<lines class="shine" style="height: 21px; max-width:166px;"></lines>
<lines class="shine" style="height: 15px;"></lines>
<lines class="shine" style="height: 21px; max-width:120px;"></lines>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="row align-items-center">
<div class="col-12 pr-lg-5">
<div class="row">
<div class="col-12">
<div class="row">
<div class="col-6 col-lg-4 mb-2"><lines class="shine rounded" style="height: 26px;"></lines></div>
<div class="col-6 col-lg-4 mb-2"><lines class="shine rounded" style="height: 26px;"></lines></div>
</div>
</div>
</div>
<div class="row pt-2 pt-lg-0">
<div class="col-6 col-lg-5 col-xl-4 mb-2 mb-lg-0 d-lg-none"><lines class="shine rounded" style="height: 38px;"></lines></div>
<div class="col-6 col-lg-5 col-xl-4 mb-2"><lines class="shine rounded" style="height: 38px;"></lines></div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="col-12 col-lg-3 order-2 css-col-stats py-2 py-lg-0">
<div class="row">
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:170px"></lines>
</div>
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:150px"></lines>
</div>
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:120px"></lines>
</div>
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:170px"></lines>
</div>
</div>
</div>
</div>
</div> <div class="card-body p-2 py-lg-3">

<div class="row align-items-center" onclick="redirect('5','#pakistan/lahore/dr/dermatologist/aisha-ahmad/396378')">
<div class="col-md-2 align-self-start">

<div class="row doctor-picture-frame">
<div class="doctor-card-img-width col-3 col-md-12 px-md-3">
<div class="avatar position-relative">
<div class="position-relative border-0">
<a href="#pakistan/lahore/dr/dermatologist/aisha-ahmad/396378" class="css-avatar-img rounded-circle d-block overflow-hidden position-relative overflow-hidden shadow-none" style="cursor:pointer;" onclick="event.stopPropagation();redirect('5','#pakistan/lahore/dr/dermatologist/aisha-ahmad/396378');">
<img data-src="https://s3-eu-west-1.amazonaws.com/mdpk/images/profile-pics/doctors/1583216319_doc_female_orig.png.jpg?t=1583216386" alt="Top Dermatologist in Bahria Town, Lahore - Dr. Aisha Ahmad" class="img-fluid card-img-overlay p-0 lazy" onerror="imgError(this, 'Female');" />
</a>
</div>
<div class="d-flex flex-column align-items-center" style="display:none !important;"><span class="badge badge-success text-white font-weight-normal d-flex align-items-center body-textsize"><svg viewBox="0 0 100 100" class="d-inline-block common-svg mr-1" width="12" height="12">
<use xlink:href="#thumbnail-svg"></use>
</svg> 0% </span> <small class="text-muted text-nowrap body-textsize">0 patient</small>
</div>
</div>
</div>
 <div class="col-9 pl-1 mobil-offset d-md-none">
<h2 class="doctor-name m-0">
<a href="#pakistan/lahore/dr/dermatologist/aisha-ahmad/396378" onclick="event.stopPropagation();">Dr. Aisha Ahmad</a>
</h2>
<p class="m-0 text-truncate text-muted text-sm"> MBBS, FCPS (Derma)</p>
<h3 class="text-sm mb-1 font-weight-normal">Dermatologist, Cosmetologist</h3>
<div class="disc-list row m-0">
<div class="list-item">
<small class="col p-0 text-sm"><strong>10 years </strong> experience</small>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-10 pr-lg-5">
<div class="row css-name-offset">
<div class="col-lg-8 col-xl-9 pt-2 pt-md-0 px-0 pl-md-2 pr-md-4 mb-2 pb-md-2 border-bottom mx-2 mx-md-0">
<div class="d-none d-md-block">
<h2 class="doctor-name m-0">
<a href="#pakistan/lahore/dr/dermatologist/aisha-ahmad/396378" onclick="event.stopPropagation();">Dr. Aisha Ahmad</a>
</h2>
<p class="m-0 text-truncate text-muted text-sm"> MBBS, FCPS (Derma)</p>
<h3 class="mb-1 body-textsize font-weight-normal">Dermatologist, Cosmetologist</h3>
</div>

</div>
<div class="col-lg-4 col-xl-3 mb-lg-2 pb-lg-2 btn-holder border-bottom order-3 order-lg-2">
<div class="row booking-btn-holder pt-lg-0">
<div class="col-6 col-lg-12 mb-2">
<a href="#pakistan/lahore/dr/dermatologist/aisha-ahmad/396378" class="btn btn-block btn-outline-primary font-weight-bold text-size-14">View Profile</a>
</div>
<div class="col-6 col-lg-12 dropdown top-arrow-dropdown mb-2">
<a href="tel:04238375255" class="call-number btn btn-block btn-primary font-weight-bold d-flex align-items-center justify-content-center text-size-14" onclick="event.stopPropagation(); return openDD('#call-tooltip-396378')" role="button" id="call-tooltip-opner" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Call Helpline</a><div class="dropdown-menu shadow border rounded py-1 my-3 call-button-tooltip" aria-labelledby="call-tooltip-opner" id="call-tooltip-396378">
<span class="px-3 d-block">04238375255</span>
</div></div> </div>
</div>
<div class="col-12 pl-0 pl-md-2 px-lg-0 order-lg-3" onclick="event.stopPropagation();">
<div class="dd-hospital-carddetails overflow-auto">
<div>
<a href="#hospital-6804" class="frame d-block text-decoration-none">
<div class="p-2">
<span class="text-truncate d-block mb-0 text-sm font-weight-medium">Skinnovation </span>
</div>
</a>
</div>
<div>
<a href="#hospital-2836" class="frame d-block text-decoration-none">
<div class="p-2">
<span class="text-truncate d-block mb-0 text-sm font-weight-medium">Green PolyClinic (Bahria Town)</span>
</div>
</a>
</div>
</div> </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div id="bottom-infinite-scroll-check"></div>
<div class="card-body p-2 py-lg-3 shiner_laoder bg-white bottom-loader" style="display: none;">
<div class="row align-items-center">
<div class="col-12 col-lg-2 align-self-start">

<div class="row css-row-picture-name">
<div class="col-3 col-lg-12 px-3 px-lg-3 pb-2">
<div class="avatar position-relative"> <a href="#" class="css-avatar-img rounded-circle d-block overflow-hidden position-relative overflow-hidden shadow-none shine"></a>
</div>
</div>
<div class="col-9 col-lg-9 mobil-offset d-lg-none">
<div class="row">
<div class="col-12 pr-2 pr-sm-5">
<div class="row css-name-offset">
<div class="col-12">
<lines class="shine" style="height: 21px; max-width:166px;"></lines>
<lines class="shine" style="height: 21px;"></lines>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-12 col-lg-7 order-3 order-lg-2">
<div class="row mobil-offset mb-2 d-none d-lg-block">
<div class="col-12 pr-5">
<div class="row css-name-offset">
<div class="col-12">
<lines class="shine" style="height: 21px; max-width:166px;"></lines>
<lines class="shine" style="height: 15px;"></lines>
<lines class="shine" style="height: 21px; max-width:120px;"></lines>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="row align-items-center">
<div class="col-12 pr-lg-5">
<div class="row">
<div class="col-12">
<div class="row">
<div class="col-6 col-lg-4 mb-2"><lines class="shine rounded" style="height: 26px;"></lines></div>
<div class="col-6 col-lg-4 mb-2"><lines class="shine rounded" style="height: 26px;"></lines></div>
</div>
</div>
</div>
<div class="row pt-2 pt-lg-0">
<div class="col-6 col-lg-5 col-xl-4 mb-2 mb-lg-0 d-lg-none"><lines class="shine rounded" style="height: 38px;"></lines></div>
<div class="col-6 col-lg-5 col-xl-4 mb-2"><lines class="shine rounded" style="height: 38px;"></lines></div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="col-12 col-lg-3 order-2 css-col-stats py-2 py-lg-0">
<div class="row">
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:170px"></lines>
</div>
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:150px"></lines>
</div>
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:120px"></lines>
</div>
<div class="my-1 col-6 col-lg-12">
<lines class="shine rounded" style="height: 20px; max-width:170px"></lines>
</div>
</div>
</div>
</div>
</div>
<div class="py-5 position-relative bottom-loader" style="display: none;">
<div id="infinite-loader-listing" style="display:flex;" class="lds-ring lds-lg-ring"><div></div><div></div><div></div><div></div>
<div class="lds-text text-sm">Fetching doctors…</div>
</div>
</div>

<nav aria-label="Card list pagination" class="pb-3 bottom-pagination"></nav>
</div>
</section>
<div class="modal fade mobile-actionsheet-modal p-0" tabindex="-1" role="dialog" aria-hidden="true" id="video-consulation-modal" style="display: none;">
<div class="modal-dialog" role="document">
<div class="modal-content border-0 rounded-0">
<div class="modal-body text-center">
<div class="titile overflow-hidden">
<span class="overflow-hidden font-weight-medium d-inline-block pt-1">Staying home due to COVID-19?</span>
<button type="button" class="close rounded-circle bg-light outline-none" data-dismiss="modal" aria-label="Close" id="listing_video_consultation_bottom_sheet_blocker_dismiss" onclick="setCookie('dontShowVCActionSheet', '1',1)">
<svg height="10" width="10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 47.971 47.971">
<g>
<path d="M28.228,23.986L47.092,5.122c1.172-1.171,1.172-3.071,0-4.242c-1.172-1.172-3.07-1.172-4.242,0L23.986,19.744L5.121,0.88
                            c-1.172-1.172-3.07-1.172-4.242,0c-1.172,1.171-1.172,3.071,0,4.242l18.865,18.864L0.879,42.85c-1.172,1.171-1.172,3.071,0,4.242
                            C1.465,47.677,2.233,47.97,3,47.97s1.535-0.293,2.121-0.879l18.865-18.864L42.85,47.091c0.586,0.586,1.354,0.879,2.121,0.879
                            s1.535-0.293,2.121-0.879c1.172-1.171,1.172-3.071,0-4.242L28.228,23.986z" />
</g>
</svg>
</button>
</div>
<p class="font-size-13-6 text-muted">Book an <strong>online video consultation</strong></p>
<figure>
<img src="/dist/images/actionsheet-img-compr.png" alt="image">
</figure>
<a id="listing_video_consultation_bottom_sheet_blocker_btn" href="#pakistan/lahore/bahria-town/dermatologist?only-video-consult=true" class="btn btn-indianred btn-block font-size-13-6">Show doctors offering video consultation</a>
</div>
</div>
</div>
</div>
<a href="#" class="back-to-top-button" style="display: none;">
<svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 492.002 492.002">
<g>
<path style="fill:#fff;" d="M484.136,328.473L264.988,109.329c-5.064-5.064-11.816-7.844-19.172-7.844c-7.208,0-13.964,2.78-19.02,7.844
            L7.852,328.265C2.788,333.333,0,340.089,0,347.297c0,7.208,2.784,13.968,7.852,19.032l16.124,16.124
            c5.064,5.064,11.824,7.86,19.032,7.86s13.964-2.796,19.032-7.86l183.852-183.852l184.056,184.064
            c5.064,5.06,11.82,7.852,19.032,7.852c7.208,0,13.96-2.792,19.028-7.852l16.128-16.132
            C494.624,356.041,494.624,338.965,484.136,328.473z" />
</g>
</svg>
</a>



<section class="bg-light pb-5">
<div class="container">
<div class="row">
<div class="col">
<h4 class="text-midgray font-weight-medium h6">
A brief intro to <span>Dermatologists?</span>
</h4>
<p class="text-muted m-0">
<small>Skin Specialists or Dermatologists help Patients deal with issues related to Skin. Some of the conditions they help manage include Acne, Acne Scars, Benign And Malignant Skin Tumors, Boils, Eczema, Herpes, Moles, Pimples, Psoriasis, Scabies, Skin Allergy, Skin Diseases, Skin Fungal Infections, Syphilis, Vitiligo and Warts.
oladoc can help book an appointment with a dermatologist in Bahria Town, Lahore and has specialists across Bahria Town, Lahore. Patients can call us at <a href='tel:0345-0435621'>0345-0435621</a> to book an appointment with a specialist for their needs.Patients can also book an online doctor video consultation with top skin specialists all across the country. Top dermatologists practicing in Bahria Town, Lahore include <a href='#pakistan/lahore/dr/cosmetologist/Aleena-irteza-khan/379718'>Dr. Aleena Irteza Khan</a> (practicing in <a href='#pakistan/lahore/h/bahria-hosp-lahore/194'>Bahria International Hospital</a>, and <a href='#pakistan/lahore/h/dr-safooras-skin-care-clinic/7940'>Dr Safooras Skin Care Clinic</a>).
Treatments and Services offered by Skin Specialists include Acne Treatment, Alopecia, Chemical Peel, Cosmetology, Dermal Fillers, Head Lice, Intense Pulsed Light (IPL), Intrauterine Insemination (IUI), Iontophoresis, LASER For Skin, Laser Hair Removal, Melasma, Meso Therapy, Microdermabrasion, Phototherapy, PRP, Skin Peeling, Skin Thightening, Skin Toning, Venereology and Xanthelasmas.</small>
</p>
</div>
</div>
</div>
</section> <section class="bg-light pb-5">
<div class="container">
<div class="row">
<div class="col">
<h4 class="text-midgray font-weight-medium h6">Dermatologists in hospitals near you</h4>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/h/bahria-hosp-lahore/194/s/dermatologist">
Dermatologists in Bahria International Hospital,Bahria Town, Lahore </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/h/green-polyclinic/2836/s/dermatologist">
Dermatologists in Green PolyClinic,Bahria Town, Lahore </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/h/citi-hospital/244/s/dermatologist">
Dermatologists in Citi Hospital,Bahria Town, Lahore </a>
</div>
</div>
</section>
<section class="bg-light pb-5">
<div class="container">
<div class="row">
<div class="col">
<h4 class="text-midgray font-weight-medium h6">Related Conditions</h4>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/condition/skin-diseases">
Skin Diseases </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/condition/acne">
Acne </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/condition/acne-scars">
Acne Scars </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/condition/benign-and-malignant-skin-tumors">
Benign And Malignant Skin Tumors </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/condition/moles">
Moles </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/condition/vitiligo">
Vitiligo </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/condition/warts">
Warts </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/condition/skin-allergy">
Skin Allergy </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/condition/skin-fungal-infections">
Skin Fungal Infections </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/condition/herpes">
Herpes </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/condition/psoriasis">
Psoriasis </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/condition/scabies">
Scabies </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/condition/syphilis">
Syphilis  </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/condition/eczema">
Eczema </a>
</div>
</div>
</section><section class="bg-light pb-5">
<div class="container">
<div class="row">
<div class="col">
<h4 class="text-midgray font-weight-medium h6">Related Treatments</h4>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/venereology">
Venereology </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/phototherapy">
Phototherapy </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/iontophoresis">
Iontophoresis </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/laser-for-skin">
LASER For Skin </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/melasma">
Melasma </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/meso-therapy">
Meso Therapy </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/microdermabrasion">
Microdermabrasion </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/pimples">
Pimples </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/prp">
PRP </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/skin-care-consultation">
Skin Care Consultation </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/skin-peeling">
Skin Peeling </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/skin-tightening">
Skin Tightening </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/skin-toning">
Skin Toning </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/acne-treatment">
Acne Treatment </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/alopecia">
Alopecia </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/chemical-peel">
Chemical Peel </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/cosmetology">
Cosmetology </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/cryotherapy-electrocautery-for">
Cryotherapy & Electrocautery For Removal Of Warts </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/dermal-fillers">
Dermal Fillers </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/treatment/intense-pulsed-light-ipl">
Intense Pulsed Light (IPL) </a>
</div>
</div>
</section><section class="bg-light overflow-hidden">
<div class="container">
<div class="row">
<div class="col">
<h4 class="text-midgray font-weight-medium h6">Frequently Asked Questions</h4>
</div>
</div>
<div class="row m-0 mb-3 mb-md-0 pt-3 align-items-start justify-content-between text-sm faq_accordion accordion" id="listing_faq_accordion">
<div class="col-md-6 px-3 mb-md-3 frame">
<button class="p-0 py-3 btn btn-block bg-transparent white-space-normal text-left collapsed" data-toggle="collapse" data-target="#list_acc_faq_1" aria-expanded="true" aria-controls="list_acc_faq_1">
<h4 class="position-relative m-0 h6 pr-3 text-sm">How can I book an appointment with a Dermatologist in Lahore?</h4>
</button>
<div class="collapse text-muted" id="list_acc_faq_1" data-parent="#listing_faq_accordion">
<p><a href="#pakistan/lahore/bahria-town/dermatologist">Click here</a> to book an appointment with a top Dermatologist in Lahore. Or, you can also call at <a href="tel:0345-0435621">0345-0435621</a> from 9AM to 11PM to book your appointment.</p>
</div>
</div>
<div class="col-md-6 px-3 mb-md-3 frame">
<button class="p-0 py-3 btn btn-block bg-transparent white-space-normal text-left collapsed" data-toggle="collapse" data-target="#list_acc_faq_2" aria-expanded="true" aria-controls="list_acc_faq_2">
<h4 class="position-relative m-0 h6 pr-3 text-sm">What is the fee range of top Dermatologist in Lahore?</h4>
</button>
<div class="collapse text-muted" id="list_acc_faq_2" data-parent="#listing_faq_accordion">
<p>The fee for top Dermatologist in Lahore is 2000. You will pay at the reception when you visit the doctor.</p>
</div>
</div>
<div class="col-md-6 px-3 mb-md-3 frame">
<button class="p-0 py-3 btn btn-block bg-transparent white-space-normal text-left collapsed" data-toggle="collapse" data-target="#list_acc_faq_3" aria-expanded="true" aria-controls="list_acc_faq_3">
<h4 class="position-relative m-0 h6 pr-3 text-sm">Are there any additional charges to book an appointment with a Dermatologist in Lahore through oladoc?</h4>
</button>
<div class="collapse text-muted" id="list_acc_faq_3" data-parent="#listing_faq_accordion">
<p>There are no additional charges when you book through oladoc.</p>
</div>
</div>
<div class="col-md-6 px-3 mb-md-3 frame">
<button class="p-0 py-3 btn btn-block bg-transparent white-space-normal text-left collapsed" data-toggle="collapse" data-target="#list_acc_faq_4" aria-expanded="true" aria-controls="list_acc_faq_4">
<h4 class="position-relative m-0 h6 pr-3 text-sm">What does a Dermatologist do?</h4>
</button>
<div class="collapse text-muted" id="list_acc_faq_4" data-parent="#listing_faq_accordion">
<p>Skin Specialists or Dermatologists help Patients deal with issues related to Skin. Some of the conditions they help manage include Acne, Acne Scars, Benign And Malignant Skin Tumors, Boils, Eczema, Herpes, Moles, Pimples, Psoriasis, Scabies, Skin Allergy, Skin Diseases, Skin Fungal Infections, Syphilis, Vitiligo and Warts.
oladoc can help book an appointment with a dermatologist in Bahria Town, Lahore and has specialists across Bahria Town, Lahore. Patients can call us at <a href='tel:0345-0435621'>0345-0435621</a> to book an appointment with a specialist for their needs.Patients can also book an online doctor video consultation with top skin specialists all across the country. Top dermatologists practicing in Bahria Town, Lahore include <a href='#pakistan/lahore/dr/cosmetologist/Aleena-irteza-khan/379718'>Dr. Aleena Irteza Khan</a> (practicing in <a href='#pakistan/lahore/h/bahria-hosp-lahore/194'>Bahria International Hospital</a>, and <a href='#pakistan/lahore/h/dr-safooras-skin-care-clinic/7940'>Dr Safooras Skin Care Clinic</a>).
Treatments and Services offered by Skin Specialists include Acne Treatment, Alopecia, Chemical Peel, Cosmetology, Dermal Fillers, Head Lice, Intense Pulsed Light (IPL), Intrauterine Insemination (IUI), Iontophoresis, LASER For Skin, Laser Hair Removal, Melasma, Meso Therapy, Microdermabrasion, Phototherapy, PRP, Skin Peeling, Skin Thightening, Skin Toning, Venereology and Xanthelasmas.</p>
</div>
</div>
<div class="col-md-6 px-3 mb-md-3 frame">
<button class="p-0 py-3 btn btn-block bg-transparent white-space-normal text-left collapsed" data-toggle="collapse" data-target="#list_acc_faq_5" aria-expanded="true" aria-controls="list_acc_faq_5">
<h4 class="position-relative m-0 h6 pr-3 text-sm">Who are the top Dermatologists in Lahore?</h4>
</button>
<div class="collapse text-muted" id="list_acc_faq_5" data-parent="#listing_faq_accordion">
<p>Top 1 Dermatologist in Lahore is:<ul class="list-unstyled list-style-type-blue pl-3"><br><li><a href="#pakistan/lahore/dr/cosmetologist/Aleena-irteza-khan/379718">Dr. Aleena Irteza Khan</a></li></ul></p>
</div>
</div>
</div>
</div>
</section>





<section class="bg-light py-4 py-md-5">
<div class="container">
<div class="row">
<div class="col">
<h4 class="text-midgray font-weight-medium h6">Dermatologists in areas near you</h4>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/johar-town/dermatologist">
Dermatologists in Johar Town </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/shadman/dermatologist">
Dermatologists in Shadman </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/jail-road/dermatologist">
Dermatologists in Jail Road </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/gulberg/dermatologist">
Dermatologists in Gulberg </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/new-garden-town/dermatologist">
Dermatologists in New Garden Town </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/model-town/dermatologist">
Dermatologists in Model Town </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/allama-iqbal-town/dermatologist">
Dermatologists in Allama Iqbal Town </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/garden-town/dermatologist">
Dermatologists in Garden Town </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/anarkali/dermatologist">
Dermatologists in Anarkali </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/ferozepur-road/dermatologist">
Dermatologists in Ferozepur Road </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/raiwind-road/dermatologist">
Dermatologists in Raiwind Road </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/muslim-town/dermatologist">
Dermatologists in Muslim Town </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/faisal-town/dermatologist">
Dermatologists in Faisal Town </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/bahria-town/dermatologist">
Dermatologists in Bahria Town </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/zafar-ali-road/dermatologist">
Dermatologists in Zafar Ali Road </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/mughalpura/dermatologist">
Dermatologists in Mughalpura </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/bedian-road/dermatologist">
 Dermatologists in Bedian Road </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/cavalry-ground/dermatologist">
Dermatologists in Cavalry Ground </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/mozang/dermatologist">
Dermatologists in Mozang </a>
<a class="m-1 text-sm btn btn-outline-midgray btn-sm mb-1 mr-1 white-space-normal" href="#pakistan/lahore/jallo-mor/dermatologist">
Dermatologists in Jallo Mor </a>
</div>
</div>
</section>


       

        

        


        <div class="modal fade search-modal" tabindex="-1" role="dialog" aria-hidden="true" id="search-modal" style="display: none;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header border-0 bg-white m-0 fixed-top">
<h5 class="text-center w-100 m-0 text-primary">Search for doctors</h5>
<button type="button" class="close btn-outline-none" id="mobile-modal-close-button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body" style="padding-top:152px;">
<div class="row search-from m-0 px-3 bg-white fixed-top shadow-sm" style="top:56px;">
<div class="col-12 col-lg-5 p-0 mb-2 ">
<div class="form-group d-flex m-0 border h-100 position-relative bg-white rounded" id="aa-input-container">
<div class="input-group-append p-1 pl-2 d-flex align-items-center"><svg width="17px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 238.53">
<g data-name="Layer 2">
<g data-name="Layer 2">
<path fill="#ff9e15" d="M100,140a40,40,0,1,1,40-40A40,40,0,0,1,100,140Zm0-66.67A26.67,26.67,0,1,0,126.67,100,26.69,26.69,0,0,0,100,73.33Z"></path>
<path fill="#9aaac1" d="M100,238.53a6.65,6.65,0,0,1-4.71-2L27.22,168.51A99.81,99.81,0,0,1,8.64,140.64,98.71,98.71,0,0,1,0,100a100,100,0,0,1,200,0,99.81,99.81,0,0,1-27.07,68.35l-68.22,68.22A6.65,6.65,0,0,1,100,238.53Zm0-225.2A86.77,86.77,0,0,0,13.33,100,86.45,86.45,0,0,0,36.8,159.24l63.2,63.2,63.35-63.35A86.52,86.52,0,0,0,186.67,100,86.77,86.77,0,0,0,100,13.33Z"></path>
</g>
</g>
</svg></div>
<input type="search" id="mobile-locality-search-input" class="aa-input-search form-control m-0 border-0 bg-transparent shadow-none btn-outline-none mw-px-140 text-md" placeholder="Enter locality or city" name="search" autocomplete="new-password">
<div id="mobile_city_search_loader" class="lds-ring lds-border-primary m-2"><div></div><div></div><div></div><div></div></div>
<span class="input-group-append btn-mediumgray-default btn-sm text-sm m-1 ml-2 py-1 px-3 d-flex align-items-center text-primary" id="mobile-gps_icon">
<svg width="20px" height="20px" viewBox="0 0 561 561" fill="#006">
<path d="M280.5,178.5c-56.1,0-102,45.9-102,102c0,56.1,45.9,102,102,102c56.1,0,102-45.9,102-102 C382.5,224.4,336.6,178.5,280.5,178.5z M507.45,255C494.7,147.9,410.55,63.75,306,53.55V0h-51v53.55 C147.9,63.75,63.75,147.9,53.55,255H0v51h53.55C66.3,413.1,150.45,497.25,255,507.45V561h51v-53.55 C413.1,494.7,497.25,410.55,507.45,306H561v-51H507.45z M280.5,459C181.05,459,102,379.95,102,280.5S181.05,102,280.5,102 S459,181.05,459,280.5S379.95,459,280.5,459z" />
</svg>
<span class="d-inline-block mx-1">Detect</span>
</span>
</div>
</div>
<div class="col-12 col-lg-7 p-0 mb-2">
<div class="form-group d-flex m-0 border h-100 bg-white rounded" id="aa-input-container">
<div class="input-group-append py-1 pl-2 pr-0 d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 250.89 250.89" height="20px" width="20px" style="min-width:20px;"><g data-name="Layer 2"><g data-name="Layer 2"><rect fill="#f90" x="208.41" y="173.75" width="14.89" height="84.21" transform="translate(-89.41 215.86) rotate(-45)" /><path class="search-2" fill="#9aaac1" d="M111.65,223.3A111.65,111.65,0,1,1,223.3,111.65,111.78,111.78,0,0,1,111.65,223.3Zm0-208.41a96.76,96.76,0,1,0,96.76,96.76A96.87,96.87,0,0,0,111.65,14.89Z" /></g></g></svg></div>
<input type="search" id="mobile-filters-search-input" class="aa-input-search form-control m-0 border-0 bg-transparent shadow-none btn-outline-none mw-px-200 text-md" placeholder="Search for doctors, hospitals, specialties, services, diseases" name="search" autocomplete="new-password">
<div class="input-group-append p-1 px-2 d-flex align-items-center text-lg" style="cursor:pointer;display:none!important;" id="mobile-clear-filter-search"><strong>&times;</strong></div>
<div id="mobile_filter_search_loader" class="lds-ring lds-border-primary m-2"><div></div><div></div><div></div><div></div></div>
</div>
</div>
</div>
<div class="autocomplete-items-holder" id="autocomplete-items-holder"></div>
<div id="mobile_navigation_loader" class="lds-ring lds-lg-ring bg-white"><div></div><div></div><div></div><div></div><div class="lds-text text-sm">Please wait…</div></div>
</div>
</div>
</div>
</div>
<div class="modal fade login-signup-model filters_sort_modal" tabindex="-1" role="dialog" aria-hidden="true" id="filters_sort_modal" style="display: none;">
<div class="modal-dialog" role="document">
<div class="modal-content border-0 rounded-0 bg-lightgray">
<div class="modal-header border-0 bg-white m-0">
<button type="buttom" class="btn btn-link p-0 mr-auto text-sm" id="filters-reset">Reset</button>
<strong id="filter_sort_title">Filter & Sort</strong>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
<svg height="14" width="14" fill="#787887" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 47.971 47.971">
<g>
<path d="M28.228,23.986L47.092,5.122c1.172-1.171,1.172-3.071,0-4.242c-1.172-1.172-3.07-1.172-4.242,0L23.986,19.744L5.121,0.88
                            c-1.172-1.172-3.07-1.172-4.242,0c-1.172,1.171-1.172,3.071,0,4.242l18.865,18.864L0.879,42.85c-1.172,1.171-1.172,3.071,0,4.242
                            C1.465,47.677,2.233,47.97,3,47.97s1.535-0.293,2.121-0.879l18.865-18.864L42.85,47.091c0.586,0.586,1.354,0.879,2.121,0.879
                            s1.535-0.293,2.121-0.879c1.172-1.171,1.172-3.071,0-4.242L28.228,23.986z" />
</g>
</svg>
</button>
</div>
<div class="modal-body px-0 text-sm m-0">
<form action="#" id="sort-filter-form">
<div class="row filters-block">
<div class="col-12 mb-1 pt-3 pb-1 px-4 bg-white">
<strong class="title mb-3 d-block">Video Consultation</strong>
<div class="custom-control custom-checkbox mb-2">
<input type="checkbox" id="only_video_consult" name="only_video_consult" class="custom-control-input">
<label class="custom-control-label" for="only_video_consult">Video consultation available</label>
</div>
</div>
<div class="col-12 mb-1 pt-3 pb-1 px-4 bg-white">
<div class="availability">
<strong class="title mb-3 d-block">Availability</strong>
<div class="custom-control custom-checkbox mb-2">
<input type="checkbox" id="available_today2" name="today" class="custom-control-input">
<label class="custom-control-label" for="available_today2">Available today</label>
</div>
<div class="custom-control custom-checkbox mb-2">
<input type="checkbox" id="nextthreedays2" name="three_day" class="custom-control-input">
<label class="custom-control-label" for="nextthreedays2">Available in next 3 days, including today</label>
</div>
</div>
</div>
<div class="col-12 mb-1 pt-3 pb-1 px-4 bg-white">
<strong class="title mb-3 d-block">Gender</strong>
<div class="custom-control custom-checkbox mb-2">
<input type="checkbox" id="maledoc2" name="male" class="custom-control-input">
<label class="custom-control-label" for="maledoc2">Male</label>
</div>
<div class="custom-control custom-checkbox mb-2">
<input type="checkbox" id="femaledoc2" name="female" class="custom-control-input" checked>
<label class="custom-control-label" for="femaledoc2">Female</label>
</div>
</div>
<div class="col-12 mb-1 pt-3 pb-1 px-4 bg-white">
 <strong class="title mb-3 d-block h5 font-weight-bold">Sort by</strong>
<div class="custom-control custom-radio mb-2">
<input type="radio" id="relevance1" name="sortby_radio1" value="" data-radio="relevance" class="custom-control-input" checked>
<label class="custom-control-label" for="relevance1">Relevance</label>
</div>
<div class="custom-control custom-radio mb-2">
<input type="radio" id="lowestfee1" name="sortby_radio1" value="lowest-fee" data-radio="lowest-fee" class="custom-control-input">
<label class="custom-control-label" for="lowestfee1">Fees (Low to High)</label>
</div>
<div class="custom-control custom-radio mb-2">
<input type="radio" id="highest1" name="sortby_radio1" value="highest-fee" data-radio="highest-fee" class="custom-control-input">
<label class="custom-control-label" for="highest1">Fees (High to Low)</label>
</div>
<div class="custom-control custom-radio mb-2">
<input type="radio" id="rating1" name="sortby_radio1" value="rating" data-radio="rating" class="custom-control-input">
<label class="custom-control-label" for="rating1">Patient rating</label>
</div>
<div class="custom-control custom-radio mb-2">
<input type="radio" id="yearofexp1" name="sortby_radio1" value="experience" data-radio="experience" class="custom-control-input">
<label class="custom-control-label" for="yearofexp1">Years of experience</label>
</div>
</div>
</div>
<div class="row sort-by-block">
<div class="col-12 mb-1 pt-3 pb-1 px-4 bg-white">

<div class="custom-control custom-radio mb-2">
<input type="radio" id="relevance2" name="sortby_radio" value="" data-radio="relevance" class="custom-control-input" checked>
<label class="custom-control-label" for="relevance2">Relevance</label>
</div>
<div class="custom-control custom-radio mb-2">
<input type="radio" id="lowestfee2" name="sortby_radio" value="lowest-fee" data-radio="lowest-fee" class="custom-control-input">
<label class="custom-control-label" for="lowestfee2">Fees (Low to High)</label>
</div>
<div class="custom-control custom-radio mb-2">
<input type="radio" id="highest2" name="sortby_radio" value="highest-fee" data-radio="highest-fee" class="custom-control-input">
<label class="custom-control-label" for="highest2">Fees (High to Low)</label>
</div>
<div class="custom-control custom-radio mb-2">
<input type="radio" id="rating2" name="sortby_radio" value="rating" data-radio="rating" class="custom-control-input">
<label class="custom-control-label" for="rating2">Patient rating</label>
</div>
<div class="custom-control custom-radio mb-2">
<input type="radio" id="yearofexp2" name="sortby_radio" value="experience" data-radio="experience" class="custom-control-input">
<label class="custom-control-label" for="yearofexp2">Years of experience</label>
</div>
</div>
</div>
</form>
</div>
<div class="modal-footer bg-white py-2 px-3">
<button type="button" class="btn btn-primary btn-block py-2 ml-0" id="filter-apply-btn">Apply</button>
</div>
</div>
</div>
</div> 
</body>
</html>

@endsection