const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
});

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/home.js', 'public/js').minify('public/js/home.js')
    .js('resources/js/login.js', 'public/js').minify('public/js/login.js')
    .js('resources/js/register.js', 'public/js').minify('public/js/register.js')
    .js('resources/js/dashboard.js', 'public/js').minify('public/js/dashboard.js')
    .js('resources/js/searchPage.js', 'public/js').minify('public/js/searchPage.js')
    .js('resources/js/profile.js', 'public/js').minify('public/js/profile.js')
    .js('resources/js/procedure.js', 'public/js').minify('public/js/procedure.js')
    .js('resources/js/listing.js', 'public/js').minify('public/js/listing.js')
    .js('resources/js/doctor.js', 'public/js').minify('public/js/doctor.js')
    .js('resources/js/laboratory.js', 'public/js').minify('public/js/laboratory.js')
    .js('resources/js/videoConsultation.js', 'public/js').minify('public/js/videoConsultation.js')
    .js('resources/js/blog.js', 'public/js').minify('public/js/blog.js')
    .js('resources/js/store.js', 'public/js').minify('public/js/store.js')
    .js('resources/js/forPages.js', 'public/js').minify('public/js/forPages.js')
    .js('resources/js/sitePages.js', 'public/js').minify('public/js/sitePages.js')
    .js('resources/js/pharmacy.js', 'public/js').minify('public/js/pharmacy.js')
    .js('resources/js/product-frontend.js', 'public/js')
    .js('resources/js/products-backend.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
     .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/home.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/home.css').minify('public/compiled/home.css')
 .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/profile-page.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
          'public/css/frontend/near-lab.css'
       ], 'public/compiled/user-profile.css').minify('public/compiled/user-profile.css')
   .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/custom-checkbox.css',
          'public/css/frontend/searchPage.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/search-pages.css').minify('public/compiled/search-pages.css')
    .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/procedures.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/surgery.css').minify('public/compiled/surgery.css')
    .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/blog.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/article-blogs.css').minify('public/compiled/article-blogs.css')
    .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/ask-a-doctor-online.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/forum.css').minify('public/compiled/forum.css')
    .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/ask-a-doctor-online-speciality.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/forum-speciality.css').minify('public/compiled/forum-speciality.css')
    .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/ask-a-doctor-online-speciality-profile.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/forum-doctor-profile.css').minify('public/compiled/forum-doctor-profile.css')
    .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/online-consultation.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/online-video-consultation.css').minify('public/compiled/online-video-consultation.css')
    .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/practice-as-doctor.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/for-doctor.css').minify('public/compiled/for-doctor.css')
    .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/for-hospital.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/for-hospital.css').minify('public/compiled/for-hospital.css')
    .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/for-lab.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/for-lab.css').minify('public/compiled/for-lab.css')
    .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/doctor-in-pakistan.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/doctors-pakistan.css').minify('public/compiled/doctors-pakistan.css')
    .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/hospital-in-pakistan.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/hospitals-pakistan.css').minify('public/compiled/hospitals-pakistan.css')
    .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/find-a-doctor-near-you.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/all-specialities.css').minify('public/compiled/all-specialities.css')
    .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/listing.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/all-diseses.css').minify('public/compiled/all-diseses.css')
    .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/listing.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/all-services.css').minify('public/compiled/all-services.css')
    .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/utilities.css',
          'public/css/frontend/about.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/about-page.css').minify('public/compiled/about-page.css')
    .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/utilities.css',
          'public/css/frontend/contant.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/contact-page.css').minify('public/compiled/contact-page.css')
    .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/utilities.css',
          'public/css/frontend/privacy.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/privacy.css').minify('public/compiled/privacy.css')
      .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/near-lab.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/find-near-laboratory.css').minify('public/compiled/find-near-laboratory.css')
      .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/register.css',
       ], 'public/compiled/register.css').minify('public/compiled/register.css')
      .combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/frontend/login.css',
       ], 'public/compiled/login.css').minify('public/compiled/login.css')
.combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/product-home.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/product-home.css').minify('public/compiled/product-home.css')
.combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/product-listing.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/product-listing.css').minify('public/compiled/product-listing.css')
.combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/product-checkout.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/product-checkout.css').minify('public/compiled/product-checkout.css')
.combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/product-detail.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/product-detail.css').minify('public/compiled/product-detail.css')
.combine([
          'public/css/frontend/bootstrap.min.css',
          'public/css/utilities.css',
          'public/css/frontend/responsive.css',
       ], 'public/compiled/pharmacy.css').minify('public/compiled/pharmacy.css');
