<?php
use App\EnxRtc\Errors;
use App\Http\Controllers\Product\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
// Route::view('discount','front-end.laboratory.discount');
// Route::get('/update-loc-id','GoutteController@updateSGDloc_id');
// Route::get('/update-pindi-loc-id','GoutteController@updatePINDIloc_id');
// Route::get('/update-doc-status','GoutteController@updateDoctorStatus');
// Route::get('/update-pindi-doc-status','GoutteController@updatePindiDoctorStatus');
// Route::get('/updateteamslots','GoutteController@updateTeamSlots');
// Route::get('/updateareas','GoutteController@getAreas');
// Route::get('/adddiseases','GoutteController@addDiseases');
// Route::get('/deleteduplicate','GoutteController@deleteDuplicate');
// Route::get('/updatevideowilling','GoutteController@updateVideoConsultacyAvailable');
// Route::get('/addlatlng','GoutteController@addlatlng');
// Route::get('/missing-online','GoutteController@addMissingOnlineConsultation');

// Route::get('/profile-web-scraping','GoutteController@doWebScraping');
// Route::get('/profile-doctor','GoutteController@addDoctorDetails');
// Route::get('/getmarham-specialities','GoutteController@getSpecialities');
// Route::get('/getmarham-services','GoutteController@getServices');

// Route::get('/profile-hospital','GoutteController@addHospitalDetails');
// Route::get('/get-hospital-areas','GoutteController@getAllAreas');
// Route::get('/get-hospital-cities','GoutteController@getAllCities');
// Route::get('/hospital-profile-web-scraping','GoutteController@hospitalWebScraping');
// Route::get('/lab-test-scraping','GoutteController@labTestScraping');
// Route::get('/test-detail-scraping','GoutteController@testDetailScraping');
// Route::get('/lab-test-price','GoutteController@addLabTestPrice');
// Route::get('/add-slug','GoutteController@addSlug');
// Route::get('/add-discounted-price','GoutteController@addDiscountedPrice');
Route::get('/delete-duplicate-records','Speciality_TestController@deleteDuplicatesRecords');
Route::get('testing', 'DoctorController@testing');
Route::get('ask-a-doctor-online', 'ForumController@index')->name('forumQuestions');
Route::get('/ask-a-doctor-online/speciality/{slug}', 'ForumController@getForumAnswers')->name('getForumAnswers');
Route::post('health-forum/post-question', 'ForumController@store')->name('storeForumQuestions');
Route::post('health-forum/post-answer', 'ForumController@postAnswer')->name('ForumAnswers');
Route::post('health-forum/post-comment', 'ForumController@postComment')->name('ForumComments');
Route::post('health-forum/post-like', 'ForumController@postLike')->name('ForumLike');
Route::get('ask-a-doctor-online/profile/{slug}', 'ForumController@showProfile')->name('forum-doctor-profile');
Route::post('follow-doctor', 'ForumController@addFollowings')->name('forum.doctor.follow');
Route::post('unfollow-doctor', 'ForumController@removeFollowings')->name('forum.doctor.unfollow');

Route::post('/import_excel/import', 'ImportExcelController@import');

Route::get('ask-a-doctor-online/index', 'ForumController@show')->name('health.index');
Route::get('ask-a-doctor-online/search-query', 'ForumController@index')->name('searchQueryFilter');
Route::get('health-forum/filter-questions', 'ForumController@index')->name('getFilteredQuestions');
Route::get('/product/creat/catalogue', 'Product\ProductController@creatProducts');
Route::get('/product/catalogue', 'Product\ProductController@catalogue');
Route::get('/product/catalogue/edit/{id}', 'Product\ProductController@creatProducts');
Route::get('/product/categories', 'Product\ProductController@categories');
Route::get('/product/tag', 'Product\ProductController@tag');
Route::get('/product/brand', 'Product\ProductController@brand');
Route::get('/product/attributes', 'Product\ProductController@attributes');
Route::get('/product/reviews', 'Product\ProductController@reviews');
Route::get('/product/order', 'Product\ProductController@order');
Route::get('/product/page/setting', 'Product\ProductController@PageSetting');
Route::get('/product/transcations', 'Product\ProductController@transcations');
Route::get('/brands-and-offers', 'Product\ProductController@brandAndOfferProducts');
Route::get('/products/category/{category_slug}', [ProductController::class,'categoryListProduct']);
Route::get('/product/getMoreCategories/{count}', [ProductController::class,'getMoreCategories']);
Route::get('/product/getMoreBrands/{count}', [ProductController::class,'getMoreBrands']);
Route::get('/product/category/search/{query}', [ProductController::class,'getSearchCategory']);
Route::get('/product-detail/{product_slug}', [ProductController::class,'productDetail']);
Route::get('/product/checkout', [ProductController::class,'checkoutProduct']);
Route::get('/product/brand/{brand_slug}', [ProductController::class,'brandListProduct']);
Route::get('/products', [ProductController::class,'index']);
Route::post('/checkout/orderSave', [ProductController::class, 'cashOnDeliveryOrderSave']);
Route::get('/filter_category_products/{filter_id}/{category}/{query}', [ProductController::class,'filterCategoryProducts'])->name('filterCategoryProducts');
Route::get('/filter_products/{filter_id}/{query}', [ProductController::class,'filterProducts'])->name('filterProducts');
Route::get('/filter_brand_products/{filter_id}/{brand}/{query}', [ProductController::class,'filterBrandProducts'])->name('filterBrandProducts');
Route::post('/product/getPriceRangeProduct', [ProductController::class,'getProductWithinPrice']);
// Route::get('/product-listing', function () {
//     return view('front-end.product-listing.product-listing');
// });
// Route::get('/product-detail', function () {
//     return view('front-end.product-detail.product-detail');
// });
// Route::get('/product-checkout', function () {
//     return view('front-end.product-checkout.product-checkout');
// });
Route::get('get-search','PublicController@getSearch')->name('getSearch');
Route::get('get-location','PublicController@getLocation')->name('getLocation');
//articles
Route::get('/get-blog-health-articles-categories','ArticleController@getArticlesPaginateData')->name('articlePagination');
Route::get('/get-searched-articles/{value}','ArticleController@getArticlesForSearched')->name('getArticlesForSearched');
Route::get('/get-recent-added-articles','ArticleController@getRecentAddedArticles')->name('getRecentAddedArticles');
Route::get('health-articles/categories', 'ArticleController@articlesCategories')->name('articleListing');
Route::get('health-articles/categories/{slug}', 'ArticleController@categoryDetail')->name('articleDetail');
Route::get('health-articles/{slug}', 'ArticleController@articleDetail')->name('article-show');
Route::get('/get-article-selected-categories-related-doctors/{id}', 'ArticleController@articleSelectedCatogoryDoctors')->name('get-article-selected-categories-related-doctors');
Route::get('/save-share-count-of-blog/{id}', 'ArticleController@articleDetailShareCount')->name('articleDetailShareCount');
Route::get('health-articles/profile/{slug}', 'ArticleController@articleProfileDetail')->name('article.profile.show');

Route::get('online-doctor-video-consultation-in-pakistan', 'OnlineConsultationController@index')->name('online-video-consultation');

// Pharmacy Routes
Route::get('pharmacy', 'PharmacyController@index')->name('pharmacy.index');
Route::get('pharmacy/medicine/{slug}', 'PharmacyController@medicine')->name('pharmacy.medicine');
Route::get('pharmacy/{slug}', 'PharmacyController@category')->name('pharmacy.category');

Route::post('register-user', 'Auth\RegisterController@vueRegistration');
Route::post('/register/checkout/client','Auth\RegisterController@createClientCheckout');
Route::post('/code/verification', 'CodeController@codeVerification');

Route::post('vueLogin', 'Auth\LoginController@vueLogin');

Route::get('patient/payout-setting', 'PatientController@payoutSetting');
Route::get('/patient/payout-setting/{id}','PatientController@payoutAppointment');
Route::post('patient-payment', 'UserController@storePatientPayment');
Route::get('/show-invoice/{id}','PatientController@showInvoice');
 Route::get('/download/{time}/{date}', 'UserController@generatePDFRecept');
 Route::get('/download/test/{date}/{lastInsertId}', 'UserController@generateTestPDFRecept');

// Cache clear route
Route::get(
    'cache-clear',
    function () {
        \Artisan::call('config:cache');
        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        return redirect()->back();
    }
);
// Authentication|Guest Routes
Auth::routes();
//Video Routes

Route::get('/joinvideo', function () {
    return view('front-end.video.index');
});

Route::get('/confo/{room}/{type}/{ref}',  "EnxRtc\RoomController@confo");
// Home
/*Route::get(
    '/',
    function () {
        if (Schema::hasTable('users')) {
            if (file_exists(resource_path('views/extend/front-end/index.blade.php'))) {
                return view('extend.front-end.index');
            } else {
                return view('front-end.index');
            }
        } else {
            if (!empty(env('DB_DATABASE'))) {
                return Redirect::to('/install');
            } else {
                return trans('lang.configure_database');
            }
        }
    }
)->name('home');*/

/*Home Page Route*/
Route::get('/', 'HomeController@index')->name('home');
Route::get('/get-data-for-home-search', 'HomeController@homeSearchSuggestion')->name('homeSearchSuggestion');
Route::get('/all-data', 'HomeController@getData')->name('getData');
Route::get('/all-spec', 'HomeController@getSpec')->name('getSpec');
Route::get('/all-docs', 'HomeController@getDocs')->name('getDocs');
Route::get('/all-hosp', 'HomeController@getHosp')->name('getHosp');
Route::get('/all-dise', 'HomeController@getDise')->name('getDise');
Route::get('/all-labs', 'HomeController@getLabs')->name('getLabs');
Route::get('/all-services', 'HomeController@getServices')->name('getServices');
Route::get('/all-cities', 'HomeController@getCities')->name('getCities');
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/get-all-hospital', 'PublicController@getAllHos');
Route::get('/nexthospital', 'PublicController@getNextHospital');
Route::get('/nextlaboratories', 'PublicController@getNextLaboratories');
Route::get('/hospitalShowMore/{show}','LocationController@viewMoreHospital');
Route::get('/nextdoctor', 'PublicController@getNextDoctor');
Route::get('/treatment-nextdoctor', 'PublicController@getTreatmentNextDoctor');

Route::get('/dashboard-all-doctors', 'UserController@getDoc')->name('getDoc');
Route::get('/dashboard-all-hospitals', 'UserController@getHos')->name('getHos');

Route::get('/all-articles', 'OnlineConsultationController@getAllarticles');
Route::get('/all-blogs', 'OnlineConsultationController@getAllblogs');
Route::get('/home-page-lab-discount-slider-data', 'HomeController@getLabDiscountData')->name('getLabDiscountData');
Route::get('/home-page-symptoms-slider-data', 'HomeController@getSymptomsData')->name('getSymptomsData');
Route::get('/get-header-default-data', 'HomeController@getHeaderDefaultData')->name('getHeaderDefaultData');

/*Get speciality and location options for register*/
Route::get('/get-specialities-and-location-options','PublicController@getSpecialityAndLocation');
/* All Diseases */

Route::get('/get-all-diseases', 'ServiceController@getdisease')->name('getDisease');
/* All specialities */
Route::get('/get-all-specialities', 'SpecialityController@getallspecialities')->name('getAllSpecialities');
Route::get('/specialities-by-city/{city}', 'SpecialityController@getSpecialitiesByCity');
/* All services */
Route::get('/get-all-services', 'ServiceController@getallservicess')->name('getAllServices');

/* All specialities fro health-forum*/
Route::get('/get-all-specialities-health-forum', 'ForumController@getallspecialitiesHealthForum')->name('getallspecialitiesHealthForum');

/* All Locations */
Route::get('/get-all-locations', 'LocationController@getalllocations')->name('getAllLocations');

Route::get('cookie', function (Illuminate\Http\Request $request) {
    dd(
        $request,
        $request->cookie(),
        $request->session(),
        $request->header('User-Agent'),
    Cookie::get(),
        Request::cookie('uuid')
    );
});

Route::post('user/add-wishlist', 'UserController@addWishlist');
Route::post('user/remove-wishlist', 'UserController@removeWishlist');
Route::post('user/add-liked-answer', 'UserController@addLikedAnswer');
Route::post('profile/get-liked-answer', 'UserController@getLikedAnswer');
Route::post('profile/get-wishlist', 'UserController@getUserWishlist');
Route::post('submit-report', 'UserController@storeReport');

Route::post('user-message', 'UserController@storeUserMessage');
Route::post('doctor-demo-request', 'UserController@storeDoctorDemoRequest');
Route::post('demo-request', 'UserController@storeDemoRequest');



Route::delete('remove-saved-wishlist/{id}', 'UserController@removeSaved');
Route::group(
    ['middleware' => ['role:admin|doctor|hospital|patient']],
    function () {
 // Account Settings Routes
        Route::get('profile/settings/account-settings', 'UserController@accountSettings')->name('accountSettings');
 }
);
//Admin Routes
Route::group(
    ['middleware' => ['role:admin','auth']],
    function () {
        /////////////////////* Product Admin Route*/////////////////////////////////
/* Product*/
Route::get('/get_admin_products',[ProductController::class,'getAllProduct']);
Route::get('/get_product_details',[ProductController::class,'getProductDetail']);
Route::post('/save-product-general',[ProductController::class,'saveProductGeneral']);
Route::post('/save-product-price',[ProductController::class,'saveProductPrice']);
Route::post('/save-product-inventory',[ProductController::class,'saveProductInventory']);
Route::post('/save-product-seo',[ProductController::class,'saveProductSeo']);
Route::get('/get_attribute_value/{id}',[ProductController::class,'getAttributeValue']);
Route::post('/save-product-attribute',[ProductController::class,'saveProductAttribute']);
Route::post('/save-product-images',[ProductController::class,'saveProductImage']);
Route::get('/admin/product/delete/{id}',[ProductController::class,'deleteProduct']);
Route::get('/get_product_data/{id}',[ProductController::class,'getProduct']);
Route::get('/admin/product/markfeature/{id}',[ProductController::class,'markFeatureProduct']);
Route::get('/admin/product/unmarkfeature/{id}',[ProductController::class,'unmarkFeatureProduct']);
Route::get('/admin/product/marktop/{id}',[ProductController::class,'markTopProduct']);
Route::get('/admin/product/unmarktop/{id}',[ProductController::class,'unmarkTopProduct']);
Route::get('/admin/product/category/marktop/{id}',[ProductController::class,'markTopProductCategory']);
Route::get('/admin/product/category/unmarktop/{id}',[ProductController::class,'unmarkTopProductCategory']);

Route::get('/get_admin_product_orders',[ProductController::class,'getAllProductOrder']);
Route::get('/admin/delete_order/{id}',[ProductController::class,'deleteProductOrder']);
Route::get('/admin/mark_pending_order/{id}',[ProductController::class,'markPendingProductOrder']);
Route::get('/admin/mark_confirm_order/{id}',[ProductController::class,'markConfirmProductOrder']);
Route::get('/admin/mark_deliver_order/{id}',[ProductController::class,'markDeliverProductOrder']);
Route::get('/admin/mark_complete_order/{id}',[ProductController::class,'markCompleteProductOrder']);
Route::get('/admin/mark_cancel_order/{id}',[ProductController::class,'markCancelProductOrder']);
Route::get('/admin/view_order/{id}',[ProductController::class,'viewProductOrder']);

Route::get('/get_admin_transactions',[ProductController::class,'getAllOrderTransaction']);
Route::get('/admin/delete_transaction/{id}',[ProductController::class,'deleteOrderTransaction']);

Route::get('/get_admin_product_reviews',[ProductController::class,'getAllProductReview']);
Route::get('/product/review/approve/{id}',[ProductController::class,'approveProductReview']);
Route::get('/product/review/decline/{id}',[ProductController::class,'declineProductReview']);

/* Attribute Admin Route*/
Route::get('/get_admin_product_attributes',[ProductController::class,'getAllProductAttribute']);
Route::get('/admin/product-attribute/delete/{id}',[ProductController::class,'deleteProductAttribute']);
Route::post('/save-product-attribute-general',[ProductController::class,'saveProductAttributeGeneral']);
Route::post('/save-product-attribute-value',[ProductController::class,'saveProductAttributeValue']);
Route::get('/get_admin_product_attribute/{id}',[ProductController::class,'getProductAttribute']);

/*Category Admin Route*/
Route::post('/save-product-category',[ProductController::class,'saveProductCategory']);
Route::post('/update-product-category/{id}',[ProductController::class,'updateProductCategory']);
Route::get('/get_admin_all_product_category',[ProductController::class,'getAllProductsCategory']);
Route::delete('/admin/delete-product-category/{id}',[ProductController::class,'deleteProductCategory']);
Route::get('/admin/enable-product-category/{id}',[ProductController::class,'enableProductCategory']);
Route::get('/admin/disable-product-category/{id}',[ProductController::class,'disableProductCategory']);

/*Tag Admin Route*/
Route::post('/save-product-tag',[ProductController::class,'saveTag']);
Route::get('/admin_get_all_tag',[ProductController::class,'getAllTags']);
Route::post('/update-product-tag/{id}',[ProductController::class,'updateTag']);
Route::delete('/admin/delete-tag/{id}',[ProductController::class,'deleteProductTag']);

/*Brand Admin Route*/
Route::get('/admin/get-all-brands',[ProductController::class,'getAllBrands']);
Route::post('/admin/save-brand',[ProductController::class,'saveBrand']);
Route::post('/admin/update-brand/{id}',[ProductController::class,'updateBrand']);
Route::get('/admin/disable-brand/{id}',[ProductController::class,'disableBrand']);
Route::get('/admin/enable-brand/{id}',[ProductController::class,'enableBrand']);
Route::delete('/admin/delete-brand/{id}',[ProductController::class,'deleteBrand']);
/*Setting Product Admin Route*/
Route::get('/get_admin_all_product_setting',[ProductController::class,'getAllProductSetting']);
Route::post('/save-product-page-setting',[ProductController::class,'saveProductPageSetting']);

        //Lab Routes
        Route::resource('admin/labs/branches','LabBranchController', ['names' => 'labs']);

        Route::post('admin/update/medical-verify', 'UserController@updateUserMedical');
        Route::get('admin/labs/upload_discount', 'LabBranchController@uploadDiscount')->name('upload-discount');
        Route::get('admin/labs/lab_code_listing', 'LabBranchController@labListing')->name('lab_code_listing');
        Route::post('admin/lab-discount/delete', 'LabBranchController@deleteLabDiscount');
Route::get('export-lab-tests', 'LabBranchController@labTestExport')->name('export-lab-tests');
Route::get('import-export-view', 'LabBranchController@labTestImportExportView');
Route::post('import-lab-tests', 'LabBranchController@labTestImport')->name('import-lab-tests');
Route::post('import-lab-code', 'LabBranchController@labCodeImport')->name('import-lab-code');
        //Symptoms

        Route::get('admin/symptom', 'SymptomController@index')->name('symptom');
        Route::get('admin/symptom/edit/{slug}', 'SymptomController@edit')->name('editSymptom');
        Route::post('admin/store-symptom', 'SymptomController@store');
        Route::post('admin/store-symptoms', 'SymptomController@store_symptoms');
        Route::get('admin/symptoms/search', 'SymptomController@index')->name('searchSymptom');
        Route::post('admin/symptom/delete', 'SymptomController@destroy');
        Route::post('admin/symptom/deleted', 'SymptomController@destroy_top');
        Route::post('admin/symptom/update/{id}', 'SymptomController@update');
        Route::post('admin/delete-checked-symptoms', 'SymptomController@deleteSelected');

// Getting All Demos
Route::get('admin/doctor/demo-request', 'UserController@demoRequestDoctor');
Route::get('admin/hospital/demo-request', 'UserController@demoRequestHospital');
Route::get('admin/laboratory/demo-request', 'UserController@demoRequestLab');

//Getting contact-us users
Route::get('admin/contact-us-users', 'UserController@contactsUsers');



        //Specialities
        Route::get('admin/specialities', 'SpecialityController@index')->name('specialities');
        Route::get('admin/uploads/specialities/content','SpecialityController@uploadSpecialitiesContent')->name('uploadSpecialitiesContent');
        Route::post('import-specialities-content', 'SpecialityController@specilitiesContentImport')->name('specilitiesContentImport');
        Route::get('admin/specialities/edit/{slug}', 'SpecialityController@edit')->name('editSpeciality');
        Route::post('admin/store-speciality', 'SpecialityController@store');
        Route::post('admin/store-specialities', 'SpecialityController@store_speciality');
        Route::get('admin/specialities/search', 'SpecialityController@index')->name('searchSpecialities');
        Route::post('admin/specialities/delete', 'SpecialityController@destroy');
        Route::post('admin/specialities/deleted', 'SpecialityController@destroy_top');
        Route::post('admin/specialities/update/{id}', 'SpecialityController@update');
        Route::post('admin/delete-checked-specialities', 'SpecialityController@deleteSelected');

        // Treatments
        Route::get('admin/treatments', 'TreatmentController@index')->name('admin-treatments');
        Route::post('admin/store-treatment', 'TreatmentController@store');
        Route::post('admin/treatments/delete', 'TreatmentController@destroy');
        Route::get('admin/treatments/edit/{id}', 'TreatmentController@edit');
        Route::post('admin/treatments/update/{id}', 'TreatmentController@update');
        Route::get('admin/treatments/search', 'TreatmentController@index')->name('searchTreatments');
        Route::post('admin/delete-checked-treatments', 'TreatmentController@deleteSelected');

        // Affairs Routes
        Route::get('admin/affairs', 'AffairController@index')->name('affairs');
        Route::post('admin/store-affair', 'AffairController@store');
        Route::post('admin/affairs/delete', 'AffairController@destroy');
        Route::get('admin/affairs/edit/{id}', 'AffairController@edit');
        Route::post('admin/affairs/update/{id}', 'AffairController@update');
        Route::get('admin/affairs/search', 'AffairController@index')->name('searchAffairs');

        // Affairs Details Routes
        Route::get('admin/affair-details', 'AffairDetailController@index')->name('affair-details');
        Route::post('admin/store-affair-details', 'AffairDetailController@store');
        Route::post('admin/affairs-details/delete', 'AffairDetailController@destroy');
        Route::get('admin/affairs-details/edit/{id}', 'AffairDetailController@edit');
        Route::post('admin/affairs-details/update/{id}', 'AffairDetailController@update');
        Route::get('admin/affairs-details/search', 'AffairDetailController@index')->name('searchAffairDetails');


        // Category Routes
        Route::get('admin/categories', 'CategoryController@index')->name('categories');
        Route::get('admin/categories/edit/{slug}', 'CategoryController@edit')->name('editCategories');
        Route::post('admin/store-category', 'CategoryController@store');
        Route::get('admin/categories/search', 'CategoryController@index')->name('categoriesSearch');
        Route::post('admin/categories/delete', 'CategoryController@destroy');
        Route::post('admin/categories/update/{id}', 'CategoryController@update');
        Route::post('admin/delete-checked-categories', 'CategoryController@deleteSelected');
        // Improvement Options Routes
        Route::get('admin/improvement-options', 'ImprovementOptionController@index')->name('improvement-opts');
        Route::get('admin/improvement-options/edit/{slug}', 'ImprovementOptionController@edit')->name('edit-improvement-opts');
        Route::post('admin/store-improvement-opts', 'ImprovementOptionController@store');
        Route::get('admin/improvement-options/search', 'ImprovementOptionController@index')->name('search-improvement-opts');
        Route::post('admin/improvement-options/delete', 'ImprovementOptionController@destroy');
        Route::post('admin/improvement-options/update/{id}', 'ImprovementOptionController@update');
        Route::post('admin/delete-checked-imprv-opts', 'ImprovementOptionController@deleteSelected');
        // Location Routes
        Route::get('admin/locations', 'LocationController@index')->name('locations');
        Route::get('admin/locations/edit/{slug}', 'LocationController@edit')->name('editLocations');
        Route::post('admin/store-location', 'LocationController@store');
        Route::post('admin/store-locations', 'LocationController@store_location');
        Route::get('admin/locations/search', 'LocationController@index')->name('searchLocations');
        Route::post('admin/locations/delete', 'LocationController@destroy');
        Route::post('admin/locations/deleted', 'LocationController@destroy_top');
        Route::post('admin/locations/update/{id}', 'LocationController@update');
        Route::post('admin/get-location-flag', 'LocationController@getFlag');
        Route::post('admin/delete-checked-locations', 'LocationController@deleteSelected');
        // Urls Routes or Pages Routes
        Route::get('admin/url', 'UrlController@index');
        Route::post('admin/store-url', 'UrlController@store');
        Route::post('admin/url/delete', 'UrlController@destroy');
        Route::get('admin/url/edit/{id}', 'UrlController@edit');
        Route::post('admin/url/update/{id}', 'UrlController@update');
        Route::get('admin/url/show/{id}', 'UrlController@show');

         // Roles Routes
        Route::get('admin/role', 'RolesController@index');
        Route::post('admin/store-role', 'RolesController@store');
        Route::post('admin/role/delete', 'RolesController@destroy');
        Route::get('admin/role/edit/{id}', 'RolesController@edit');
        Route::post('admin/role/update/{id}', 'RolesController@update');


            // Vaccinations Routes
        Route::get('admin/vaccination', 'VaccinationController@index');
        Route::post('admin/store-vaccination', 'VaccinationController@store');
        Route::post('admin/vaccination/delete', 'VaccinationController@destroy');
        Route::get('admin/vaccination/edit/{id}', 'VaccinationController@edit');
        Route::post('admin/vaccination/update/{id}', 'VaccinationController@update');

            // Vaccination location Routes
        Route::get('admin/vaccination-location', 'VaccinationLocationController@index');
        Route::post('admin/store-vaccination-location', 'VaccinationLocationController@store');
        Route::post('admin/vaccination-location/delete', 'VaccinationLocationController@destroy');
        Route::get('admin/vaccination-location/edit/{id}', 'VaccinationLocationController@edit');
        Route::post('admin/vaccination-location/update/{id}', 'VaccinationLocationController@update');

            // Vaccination alerts Routes
        Route::get('admin/vaccination-alert', 'VaccinationAlertController@index');
        Route::post('admin/store-vaccination-alert', 'VaccinationAlertController@store');
        Route::post('admin/vaccination-alert/delete', 'VaccinationAlertController@destroy');
        Route::get('admin/vaccination-alert/edit/{id}', 'VaccinationAlertController@edit');
        Route::post('admin/vaccination-alert/update/{id}', 'VaccinationAlertController@update');
        // attachments
        Route::get('get/{type}/{id}/{attachment}', 'MediaController@getFile')->name('getfile');

        // Departments Routes
        Route::get('admin/department', 'DepartmentController@index');
        Route::post('admin/store-department', 'DepartmentController@store');
        Route::post('admin/department/delete', 'DepartmentController@destroy');
        Route::get('admin/department/edit/{id}', 'DepartmentController@edit');
        Route::post('admin/department/update/{id}', 'DepartmentController@update');

        // Department Service Routes
        Route::get('admin/department-service', 'DepartmentServiceController@index');
        Route::post('admin/store-department-service', 'DepartmentServiceController@store');
        Route::post('admin/department-service/delete', 'DepartmentServiceController@destroy');
        Route::get('admin/department-service/edit/{id}', 'DepartmentServiceController@edit');
        Route::post('admin/department-service/update/{id}', 'DepartmentServiceController@update');

          // Ppeciality Tests Routes
        Route::get('admin/speciality-test', 'Speciality_TestController@index');
        Route::get('admin/lab-tests-meta', 'Speciality_TestController@labTestMetaIndex');
        Route::post('admin/store-test', 'Speciality_TestController@store');
        Route::post('admin/test/delete', 'Speciality_TestController@destroy');
        Route::get('admin/test/edit/{id}', 'Speciality_TestController@edit');
        Route::get('admin/test/editLabMeta/{id}', 'Speciality_TestController@editLabMeta');
        Route::post('admin/test/update/{id}', 'Speciality_TestController@update');
        Route::post('admin/test/updateLabMeta/{id}', 'Speciality_TestController@updateLabMeta');


        // Diagnosis Routes
        Route::get('admin/diagnose', 'DiagnoseController@index');
        Route::post('admin/store-diagnose', 'DiagnoseController@store');
        Route::post('admin/diagnose/delete', 'DiagnoseController@destroy');
        Route::get('admin/diagnose/edit/{id}', 'DiagnoseController@edit');
        Route::post('admin/diagnose/update/{id}', 'DiagnoseController@update');

          // Medicines Routes
        Route::get('admin/medicine', 'MedicineController@index');
        Route::post('admin/store-medicine', 'MedicineController@store');
        Route::post('admin/medicine/delete', 'MedicineController@destroy');
        Route::get('admin/medicine/edit/{id}', 'MedicineController@edit');
        Route::post('admin/medicine/update/{id}', 'MedicineController@update');

        // Pharmacy Routes - Medicine Category
        Route::get('admin/medicine-category', 'Admin\MedicineCategoryController@index')->name('medicine-category.index');
        Route::post('admin/store-medicine-category', 'Admin\MedicineCategoryController@store');
        Route::post('admin/medicine-category/delete', 'Admin\MedicineCategoryController@destroy');
        Route::get('admin/medicine-category/edit/{id}', 'Admin\MedicineCategoryController@edit');
        Route::post('admin/medicine-category/update/{id}', 'Admin\MedicineCategoryController@update');

        // Pharmacy Routes - Medicine Subcategory
        Route::get('admin/medicine-subcategory', 'Admin\MedicineSubcategoryController@index')->name('medicine-subcategory.index');
        Route::post('admin/store-medicine-subcategory', 'Admin\MedicineSubcategoryController@store');
        Route::post('admin/medicine-subcategory/delete', 'Admin\MedicineSubcategoryController@destroy');
        Route::get('admin/medicine-subcategory/edit/{id}', 'Admin\MedicineSubcategoryController@edit');
        Route::post('admin/medicine-subcategory/update/{id}', 'Admin\MedicineSubcategoryController@update');

        // Pharmacy Routes - Medicines
        Route::get('admin/pharmacy-medicine', 'Admin\PharmacyMedicineController@index')->name('pharmacy-medicine.index');
        Route::post('admin/store-pharmacy-medicine', 'Admin\PharmacyMedicineController@store');
        Route::post('admin/pharmacy-medicine/delete', 'Admin\PharmacyMedicineController@destroy');
        Route::get('admin/pharmacy-medicine/edit/{id}', 'Admin\PharmacyMedicineController@edit');
        Route::post('admin/pharmacy-medicine/update/{id}', 'Admin\PharmacyMedicineController@update');

        // Video Blogs Routes
        Route::get('admin/video-blog', 'VideoBlogController@index');
        Route::post('admin/store-video-blog', 'VideoBlogController@store');
        Route::post('admin/video-blog/delete', 'VideoBlogController@destroy');
        Route::get('admin/video-blog/edit/{id}', 'VideoBlogController@edit');
        Route::post('admin/video-blog/update/{id}', 'VideoBlogController@update');

        // Facility Routes
        Route::get('admin/facility', 'FacilityController@index');
        Route::post('admin/store-facility', 'FacilityController@store');
        Route::post('admin/facility/delete', 'FacilityController@destroy');
        Route::get('admin/facility/edit/{id}', 'FacilityController@edit');
        Route::post('admin/facility/update/{id}', 'FacilityController@update');

        // Procedure Routes
        Route::get('admin/procedure', 'ProcedureController@index');
        Route::post('admin/store-procedure', 'ProcedureController@store');
        Route::post('admin/procedure/delete', 'ProcedureController@destroy');
        Route::get('admin/procedure/edit/{id}', 'ProcedureController@edit');
        Route::post('admin/procedure/update/{id}', 'ProcedureController@update');
        Route::post('admin/store-procedures', 'ProcedureController@store_procedures');
        Route::post('admin/procedure/deleted', 'ProcedureController@destroy_top');
        Route::post('admin/delete-checked-procedure', 'ProcedureController@deleteSelected');
        Route::get('admin/procedure-estimated-cost', 'ProcedureEstimatedCostController@index');

        // Procedure Cost 
        Route::get('admin/procedure-cost','ProcedureEstimatedCostController@index');
        Route::get('/admin/procedure-status-filter','ProcedureEstimatedCostController@procedureStatusFilter');
        Route::post('admin/procedure-cost/delete', 'ProcedureEstimatedCostController@destroy');
        // Booking Lab
        Route::get('admin/booking-tests', 'UserController@bookingLab');

         // Site Teams Routes
        Route::get('admin/site-team', 'SiteTeamController@index');
        Route::post('admin/store-site-team', 'SiteTeamController@store');
        Route::post('admin/site-team/delete', 'SiteTeamController@destroy');
        Route::get('admin/site-team/edit/{id}', 'SiteTeamController@edit');
        Route::post('admin/site-team/update/{id}', 'SiteTeamController@update');

        //Admin All Appointments
        Route::get('admin/edit-appointment/{id}','AppointmentBookingController@editAppointmentDetails')->name('edit-appointment-details');
        Route::post('admin/update-appointment-details/{id}','AppointmentBookingController@updateAppointmentDetails')->name('update-appointment-details');
        Route::post('admin/update-consultation-fee','AppointmentBookingController@updateConsultaionFee')->name('update-consultation-fee');
        Route::post('admin/changes-appointment-status','AppointmentBookingController@changeAppointmentStatus');
        Route::get('admin/visit-appointment', 'AppointmentBookingController@visit_appointment');
        Route::get('/visit-appointment-search','AppointmentBookingController@searchVisitAppointment');
        Route::post('admin/visit-appointment/delete', 'AppointmentBookingController@delete_visit');
        Route::get('admin/online-appointment', 'AppointmentBookingController@online_appointment');
        Route::get('admin/all-appointment', 'AppointmentBookingController@all_appointment');
        Route::get('admin/all-appointment-search', 'AppointmentBookingController@searchAllAppointment');
        Route::post('admin/online-appointment/delete', 'AppointmentBookingController@delete_online');
        Route::get('/admin/appointment-date-filter', 'AppointmentBookingController@appointmentDateFilter');
        Route::get('/admin/appointment-city-filter', 'AppointmentBookingController@appointmentCityFilter');
        Route::get('/admin/appointment-area-filter', 'AppointmentBookingController@appointmentAreaFilter');

        // Show appointment with different status.
        Route::get('admin/pending-appointment', 'AppointmentBookingController@pending_appointment');
        Route::get('admin/accepted-appointment', 'AppointmentBookingController@accepted_appointment');
        Route::get('admin/cancel-appointment', 'AppointmentBookingController@cancel_appointment');
        Route::get('admin/appointment-notifications','AppointmentBookingController@appointmentNotifications');
        Route::post('admin/mark-appointment-notification','AppointmentBookingController@adminMarkAppointmentNotification');


        // Get All Users Reports
        Route::get('admin/all-reports', 'UserController@all_reports');
        Route::post('admin/report/delete', 'UserController@delete_report');

        // FAQ'S Routes
        Route::get('admin/faq', 'FaqController@index');
        Route::post('admin/store-faq', 'FaqController@store');
        Route::post('admin/faq/delete', 'FaqController@destroy');
        Route::get('admin/faq/edit/{id}', 'FaqController@edit');
        Route::post('admin/faq/update/{id}', 'FaqController@update');
        Route::get('admin/faq/{status}/{id}','FaqController@approve');

        // Services Routes
        Route::get('admin/services', 'ServiceController@index')->name('services');
        Route::get('admin/services/edit/{slug}', 'ServiceController@edit')->name('editServices');
        Route::post('admin/store-service', 'ServiceController@store');
        Route::post('admin/store-services', 'ServiceController@store_service');
        Route::get('admin/services/search', 'ServiceController@index')->name('searchServices');
        Route::post('admin/services/delete', 'ServiceController@destroy');
        Route::post('admin/services/deleted', 'ServiceController@destroy_top');
        Route::post('admin/services/update/{id}', 'ServiceController@update');
        Route::post('admin/delete-checked-services', 'ServiceController@deleteSelected');
        //Home Page Settings Route
        Route::get('admin/settings/home-page-settings', 'SiteManagementController@homePageSettings')->name('homePageSettings');

        Route::get('admin/settings/general-settings', 'SiteManagementController@generalSettings')->name('generalSettings');
        Route::post('admin/store/reg-form-settings', 'SiteManagementController@storeRegistrationSettings')->name('storeRegFormSettings');
        Route::post('admin/store/home-slider-settings', 'SiteManagementController@storeHomeSliderSettings')->name('storeHomeSettings');
        Route::post('admin/store/home-search-banner-settings', 'SiteManagementController@storeHomeSearchBannerSettings')->name('storeSearchBannerSettings');
        Route::post('admin/store/onlin-video-section', 'SiteManagementController@storeOnlinVideoSection')->name('storeOnlinVideoSection');
         Route::post('admin/store/procedure-banner-section', 'SiteManagementController@storeProcedureBannerSection')->name('storeProcedureBannerSection');
           Route::post('admin/store/city-wise-doctor-section', 'SiteManagementController@storecitywisedoctorSection')->name('storecitywisedoctorSection');
             Route::post('admin/store/city-wise-hospital-section', 'SiteManagementController@storeCitywiseHospitalSection')->name('storeCitywiseHospitalSection');

             Route::post('admin/store/for-doctor-sign-up', 'SiteManagementController@storeForDoctorSignUp')->name('storeForDoctorSignUp');

             Route::post('admin/store/about-us-banner-section', 'SiteManagementController@storeAboutUsBannerSection')->name('storeAboutUsBannerSection');
             Route::post('admin/store/for-hospital-knockdoc-tool', 'SiteManagementController@storeForHospitalKnockdocTool')->name('storeForHospitalKnockdocTool');

             Route::post('admin/store/for-hospital-knockdoc-profile', 'SiteManagementController@storeForHospitalKnockdocProfile')->name('storeForHospitalKnockdocProfile');

             Route::post('admin/store/for-hospital-fourth-section', 'SiteManagementController@storeForHospitalFourthSection')->name('storeForHospitalFourthSection');

             Route::post('admin/store/for-labs-knockdoc', 'SiteManagementController@storeForLabsKnockdoc')->name('storeForLabsKnockdoc');

             Route::post('admin/store/for-labs-knockdoc-profile', 'SiteManagementController@storeForLabsKnockdocProfile')->name('storeForLabsKnockdocProfile');

             Route::post('admin/store/about-us-we-are-here', 'SiteManagementController@storeAboutUsWeAreHere')->name('storeAboutUsWeAreHere');
             Route::post('admin/store/about-us-our-dream', 'SiteManagementController@storeAboutUsOurDream')->name('storeAboutUsOurDream');


        Route::post('admin/store/home-about-us-settings', 'SiteManagementController@storeHomeAboutUsSettings')->name('storeAboutUsSettings');
        Route::post('admin/store/home-how-works-settings', 'SiteManagementController@storeHowItWorksSettings')->name('storeHowItWorksSettings');
        Route::post('admin/store/home-service-tabs-settings', 'SiteManagementController@storeServiceTabsSettings')->name('storeServiceTabsSettings');
        Route::post('admin/store/home-seo-settings', 'SiteManagementController@storeSeoSettings');
        Route::post('admin/store/home-how-work-tabs-settings', 'SiteManagementController@storeHowWorkTabSettings')->name('storeHowWorkTabSettings');
        Route::post('admin/store/home-header-service', 'SiteManagementController@storeHeaderServiceSettings')->name('storeHeaderServiceSettings');
         Route::post('admin/store/health-community-slider', 'SiteManagementController@storeHealthCommunitySlider')->name('storeHealthCommunitySlider');
        Route::post('admin/store/benefits-online-profile', 'SiteManagementController@storebenefitsonlineprofile')->name('storebenefitsonlineprofile');
        Route::post('admin/store/benefits-online-doctor', 'SiteManagementController@storebenefitsonlinedoctor')->name('storebenefitsonlinedoctor');
        Route::post('admin/store/doctor-slider-section-settings', 'SiteManagementController@storeDoctorSliderSettings');
        Route::post('admin/store/home-download-app-settings', 'SiteManagementController@storeDownloadAppSecSettings')->name('storeDownloadAppSecSettings');
        Route::post('admin/store/article-section-settings', 'SiteManagementController@storeArticleSectionSettings')->name('storeArticleSectionSettings');
        Route::post('admin/store/health-community-banner', 'SiteManagementController@storeHealthCommunityBanner')->name('storeHealthCommunityBanner');
         Route::post('admin/store/list-doctor-inner-section', 'SiteManagementController@storeDoctorInnerSection')->name('storeDoctorInnerSection');
        Route::post('admin/store/health-discussion-banner', 'SiteManagementController@storeHealthDiscussionBanner')->name('storeHealthDiscussionBanner');
        Route::post('admin/store/signup-section', 'SiteManagementController@storeSignUpSection')->name('storeSignUpSection');
         Route::post('admin/store/banner-video-section', 'SiteManagementController@storeBannerVideoSection')->name('storeBannerVideoSection');
          Route::post('admin/store/small-device-section', 'SiteManagementController@storeSmallDeviceSection')->name('storeSmallDeviceSection');
        Route::get('admin/get-homeslider-slides', 'SiteManagementController@getHomeSliderSlides');
        Route::get('admin/get-home-sections-display-settings', 'SiteManagementController@getHomeSectionsDisplaySettings');
        Route::get('admin/get-home-service-section-color', 'SiteManagementController@getHomeServiceSectionsColorSettings');
        Route::get('admin/settings/home-page-settings/services-section', 'SiteManagementController@homePageSettings')->name('homeServicesSection');
        //Map Image
        Route::post('admin/store/map-img', 'SiteManagementController@storeMapImageSection')->name('storeMapImageSection');
        // General Settings
        Route::post('admin/store/settings', 'SiteManagementController@storeGeneralSettings');
        Route::post('admin/store/sidebar-settings', 'SiteManagementController@storeSidebarSettings');
        Route::post('admin/store/forum-settings', 'SiteManagementController@storeforumSettings');
        Route::post('admin/store/topbar-settings', 'SiteManagementController@storeTopBarSettings');
        Route::post('admin/store/booking-settings', 'SiteManagementController@storeAppointmentBookingSettings');
        Route::get('admin/import-update', 'SiteManagementController@importUpdate');
        Route::post('admin/store/theme-styling-settings', 'SiteManagementController@storeThemeStylingSettings');
        Route::post('admin/store/social-settings', 'SiteManagementController@storeSocialSettings');
        Route::post('admin/store/footer-settings', 'SiteManagementController@storeFooterSettings');
        Route::get('admin/get-theme-color-display-setting', 'SiteManagementController@getThemeColorDisplaySetting');
        Route::get('admin/get-theme-language-setting', 'SiteManagementController@getThemeLanguageSetting');
        Route::get('admin/get-topbar-switch-settings', 'SiteManagementController@getTopbarSwicthSettings');
        Route::get('admin/get-booking-switch-settings', 'SiteManagementController@getBookingSwicthSettings');
        Route::get('admin/get-footer-settings', 'SiteManagementController@getFooterSettings');
        Route::get('admin/get-chat-display-setting', 'SiteManagementController@getchatDisplaySetting');
        Route::get('admin/get-sidebar-display-setting', 'SiteManagementController@getSidebarSetting');
        Route::middleware('optimizeImages')->group(function () {
            Route::post('admin/store/upload-icons', 'SiteManagementController@storeDashboardIcons');
        });
        Route::get('admin/get-roles', 'SiteManagementController@getRoles')->name('getRoles');
        Route::post('admin/update-role', 'SiteManagementController@updateRole')->name('updateRole');
        Route::post('admin/clear-cache', 'SiteManagementController@clearCache');
        Route::get('admin/clear-allcache', 'SiteManagementController@clearAllCache');
        Route::get('admin/import-demo', 'SiteManagementController@importDemo');
        Route::get('admin/remove-demo', 'SiteManagementController@removeDemoContent');
        Route::post('admin/store/chat-settings', 'SiteManagementController@storeChatSettings');
        Route::post('admin/store/email-settings', 'SiteManagementController@storeEmailSettings');
        Route::post('admin/store/payment-settings', 'SiteManagementController@storePaymentSettings');
        Route::post('admin/store/paypal-settings', 'SiteManagementController@storePaypalSettings');
        Route::post('admin/store/stripe-settings', 'SiteManagementController@storeStripeSettings');
        //Appointment Interval Routes
        Route::get('admin/appointment-interval', 'AppointmentIntervalController@index')->name('appointment-interval');
        Route::get('admin/appointment-interval/edit/{slug}', 'AppointmentIntervalController@edit')->name('edit-appointment-interval');
        Route::post('admin/store-appointment-interval', 'AppointmentIntervalController@store');
        Route::get('admin/appointment-interval/search', 'AppointmentIntervalController@index')->name('search-appointment-interval');
        Route::post('admin/appointment-interval/delete', 'AppointmentIntervalController@destroy');
        Route::post('admin/appointment-interval/update/{id}', 'AppointmentIntervalController@update');
        Route::post('admin/delete-checked-appnt-intrvl', 'AppointmentIntervalController@deleteSelected');
        // Appointment Duration Routes
        Route::get('admin/appointment-duration', 'AppointmentDurationController@index')->name('appointment-duration');
        Route::get('admin/appointment-duration/edit/{slug}', 'AppointmentDurationController@edit')->name('edit-appointment-duration');
        Route::post('admin/store-appointment-duration', 'AppointmentDurationController@store');
        Route::get('admin/appointment-duration/search', 'AppointmentDurationController@index')->name('search-appointment-duration');
        Route::post('admin/appointment-duration/delete', 'AppointmentDurationController@destroy');
        Route::post('admin/appointment-duration/update/{id}', 'AppointmentDurationController@update');
        Route::post('admin/delete-checked-appnt-dur', 'AppointmentDurationController@deleteSelected');
        // Pages Routes
        Route::get('admin/pages', 'PageController@index')->name('pages');
        Route::get('admin/create/page', 'PageController@create')->name('createPage');
        Route::get('admin/pages/edit-page/{id}', 'PageController@edit')->name('editPage');
        Route::post('admin/store-page', 'PageController@store');
        Route::get('admin/pages/search', 'PageController@index');
        Route::post('admin/pages/delete-page', 'PageController@destroy');
        Route::post('admin/pages/update-page', 'PageController@update');
        Route::post('admin/delete-checked-pages', 'PageController@deleteSelected');
        Route::post('admin/get-page-option', 'SiteManagementController@getPageOption');
        Route::post('admin/get/innerpage-settings', 'SiteManagementController@getInnerPageSettings');
        Route::post('admin/store/innerpage-settings', 'SiteManagementController@storeInnerPageSettings');
        //All packages
        Route::get('admin/packages', 'PackageController@create')->name('createPackage');
        Route::get('admin/packages/search', 'PackageController@create');
        Route::get('admin/packages/edit/{id}', 'PackageController@edit')->name('editPackage');
        Route::post('admin/packages/update', 'PackageController@update');
        Route::post('admin/store/package', 'PackageController@store');
        Route::post('admin/packages/delete-package', 'PackageController@destroy');
        Route::post('package/get-package-options', 'PackageController@getPackageOptions');
        Route::get('admin/payouts', 'UserController@getPayouts')->name('adminPayouts');

// Admin Invoice
        Route::get('admin/invoice', 'UserController@getinvoice');


        Route::get('admin/payouts/download/{year}/{month}', 'UserController@generatePDF');
        Route::get('admin/get/site-payment-option', 'SiteManagementController@getSitePaymentOption');
        Route::get('admin/email-templates', 'EmailTemplateController@index')->name('emailTemplates');
        Route::get('admin/email-templates/filter-templates', 'EmailTemplateController@index')->name('emailTemplatesFilter');
        Route::get('admin/email-templates/{id}', 'EmailTemplateController@edit')->name('editEmailTemplates');
        Route::post('admin/email-templates/update-content', 'EmailTemplateController@updateTemplateContent');
        Route::post('admin/email-templates/update-templates/{id}', 'EmailTemplateController@update');
        // Get user listing
        Route::get('users', 'UserController@userListing')->name('manageUsers');
        // Get user role
        Route::get('users/{role}','UserController@roleListing')->name('user-role');
        Route::get('/admin/city-filter','UserController@cityFilter');
        Route::get('/admin/area-filter','UserController@areaFilter');
        Route::get('/admin/date-filter','UserController@dateFilter');
        Route::post('/admin/status-change-user','UserController@changeUserStatus');
        Route::post('/admin/recomend-status-change-user','UserController@changeRecomendStatus');
        ///Get search users
        Route::get('users-search','UserController@searchListingData')->name('user-search');
        
        Route::post('admin/delete-user', 'UserController@deleteUser')->name('adminDeleteUser');
        Route::get('admin/edit-user/{id}', 'UserController@editUser')->name('adminEditUser');
        Route::get('admin/add-user', 'UserController@createUser')->name('adminAddUser');
        Route::post('admin/edit-user-detail', 'UserController@updateUserProfileSettings');
        Route::post('admin/create-user', 'UserController@storeUser');
        Route::get('/admin/dr-appoint-location/delete/{id}', 'UserController@deleteDrAppointmentLocation');
        Route::post('doctor/store/UpdateExperiences', 'DoctorController@storeUpdateExperiences')->name('storeUpdateExperiences');
        Route::post('doctor/store/UpdateEducations', 'DoctorController@storeUpdateEducations')->name('storeUpdateEducations');
        Route::post('doctor/store-update-award-downloads', 'DoctorController@storeUpdateAwardDownloadSettings')->name('storeUpdateAwardDownloadSettings');
        /*Extended Profile*/
        Route::post('/doctor/extend', 'DoctorController@Extend')->name('Extend');
        //All onnlin consultant doctors
        Route::get('admin/all-online', 'Allonline@index')->name('allOnline');
        Route::get('all-online-consultation-search','Allonline@searchAllOnlineDoctor')->name('search-all-online-doc');
        Route::get('admin/moredoc/{id}', 'Allonline@moredoc')->name('all-online');
        //All Doctors
        Route::get('admin/all-doctors', 'Allonline@doctors')->name('allDoctors');
        Route::get('registered-doctors-search','Allonline@registeredAllDocSearch');
        //All New Doctors
        Route::get('admin/all-new-doctors', 'Allonline@allNewDoctors')->name('allNewDoctors');
        Route::post('admin/approve-new-doctors', 'Allonline@adminApproveDoctors')->name('adminApproveDoctors');
        Route::get('admin/approve-all-new-doctors', 'Allonline@adminApproveAllDoctors')->name('adminApproveAllDoctors');


        Route::get('all-new-doctors-search', 'Allonline@allNewDoctorsSearch')->name('allNewDoctorsSearch');
        //All extended doctors
        Route::get('admin/all-extend-doctors', 'Allonline@extendDoctors')->name('all-extend-doctors');
        //All onboard doctors
        Route::get('admin/all-onboard-doctors', 'Allonline@onBoardDoctors')->name('all-onboard-doctors');
        Route::get('on-board-doctors-search','Allonline@onBoardDoctorsSearch')->name('on-board-doctors-search');
        Route::get('admin/change-status-onboard','Allonline@changeStatusOnboard');
        //All blocked doctors
        Route::get('admin/all-blocked-doctors','Allonline@allBlockedDoctors')->name('all-blocked-doctors');
        //All Registered Doctors Info
        Route::get('admin/all-register-doctors-info','Allonline@allRegisteredDoctorsInfo')->name('all-register-doctors-info');
        //all cities extended doctors
        Route::get('admin/all-cities-extend-doctors','AllCitiesExtendedDoctorController@index');
        //Feedback
        Route::get('admin/feedback','FeedbackController@index');
        //feedback approved/disapproved
        Route::get('admin/feedback/{status}/{id}','FeedbackController@approve');
        //Feedback Delete
        Route::post('admin/feedback/delete', 'FeedbackController@destroy');
        // Location Diseases
        Route::get('admin/diseases', 'DiseaseController@index')->name('disease');
        Route::get('admin/diseases/edit/{slug}', 'DiseaseController@edit')->name('editDiseases');
        Route::post('admin/store-disease', 'DiseaseController@store');
        Route::get('admin/diseases/search', 'DiseaseController@index')->name('searchDiseases');
        Route::post('admin/diseases/delete', 'DiseaseController@destroy');
        Route::post('admin/diseases/update/{id}', 'DiseaseController@update');
        Route::post('admin/delete-checked-diseases', 'DiseaseController@deleteSelected');
        //Doctor
        Route::get('/doctor/appointments/{id}', 'DoctorController@showAppointmentsToAdmin');

        //push notification
        Route::get('admin/notification', 'NotificationController@index');
        Route::post('admin/push-notification', 'NotificationController@store');
    }
);

Route::get('/doctors', 'LocationController@doctorsLocation')->name('doctors-in-pakistan');
Route::get('/hospitals', 'LocationController@hospitalsLocation')->name('hospitals-in-pakistan');





/*Start New Search Routes*/

//speciality
Route::get('specialties', 'SpecialityController@allSpecialties');
Route::get('find-a-doctor-near-you', 'SpecialityController@allSpecialties')->name('find-a-doctor-near-you');
// Route::get('specialties/{slug}', 'PublicController@getSearchResult')->name('specialityDetails');
Route::get('doctors/{location}/{slug}', 'PublicController@getSearchResult')->name('specialityDetailsLocation');

//doctor by online consultation
Route::get('/online-doctor-consultation', 'PublicController@onlineVideoConsultationData')->name('online-consultation');
Route::get('/online-doctor-consultation/{speciality}', 'PublicController@getSearchResult')->name('online-consultation-with-speciality');
Route::get('/online-doctor-consultation/{speciality}/{location}', 'PublicController@getSearchResult')->name('online-consultation-with-speciality-with-location');
//doctor by location
Route::get('/doctors/{location}', 'PublicController@cityDoctors')->name('doctors-by-city');
// Route::get('/doctors/{location}/{slug}', 'PublicController@getSearchResult')->name('doctors-speciality-city');
Route::get('/doctors/{location}/{area}', 'PublicController@cityAreaDoctors')->name('doctors-location-area');
Route::get('/doctor/specialities/{location}/{speciality}/{area}', 'PublicController@cityAreaDoctors')->name('doctors-location-area-speciality');
Route::get('/doctors/{location}/{area?}/filters/{video?}/{today?}/{experienced?}/{fee?}/{male?}/{female?}/{highest_rated?}/{time_slot?}/{filter_from?}/{filter_to?}','PublicController@doctorsDataLocationAreaFilters')->name('doctorsDetailsLocationAreaFilters');

 Route::get('/doctor/{location}/{area}/{slug}', 'PublicController@getSearchResult')->name('doctor-city-area-speciality');


//hospitals
Route::get('/hospitals/{city}', 'PublicController@hospitalByCity')->name('hospitals-by-city');
/*Route::get('/hospitals/{location}/{area}', 'PublicController@getSearchResult')->name('hospitals-location-area');*/
Route::get('/hospitals/{location}/{slug}', 'PublicController@showHospitalProfile')->name('hospitals-speciality-city');
Route::get('/get-hospital-top-doctor-name/{id}','PublicController@getHospitalsTopDoctor');
Route::get('/hospital-profile/get-other-hospitals/{user_id}/{location_id}','PublicController@getOtherHospital');
Route::get('/hospital-profile/get-top-city-specialities/{location_id}','PublicController@getTopCitySpecialities');


//laboratories
Route::get('/labs/{location}', 'PublicController@labLocationListingData')->name('laboratory-by-city');
Route::post('/labs/get-discount','LabBranchController@getLabDiscount');
Route::get('/lab/download-discount/{code}','LabBranchController@downloadDiscount');
// Route::get('/labs/{location}/{slug}', 'PublicController@getSearchResult')->name('laboratories-speciality-city');
Route::get('labs/{city}/{slug}', 'PublicController@labListingData')->name('laboratories-location-area');
Route::get('/find-a-lab-near-you', 'PublicController@allLabListingData')->name('all-laboratories');
//diseases
Route::get('diseases/{slug}', 'PublicController@diseaseDetailData')->name('diseasesDetails');
Route::get('/related-diseases-to-the-selected-disease/{slug}','PublicController@diseaseRelatedDiseaseData');
Route::get('diseases/{slug}/pakistan', 'PublicController@diseaseData')->name('diseasesDetailsPakistan');
Route::get('diseases/{slug}/{location}', 'PublicController@diseaseDataLocation')->name('diseasesDetailsLocation');
Route::get('diseases/{slug}/{location}/{area}', 'PublicController@diseaseDataLocationArea')->name('diseasesDetailsLocationArea');
Route::get('/diseases/{slug}/{location?}/{area?}/filters/{video?}/{today?}/{experienced?}/{fee?}/{male?}/{female?}/{highest_rated?}/{time_slot?}/{filter_from?}/{filter_to?}', 'PublicController@diseaseDataLocationAreaFilters')->name('diseasesDetailsLocationAreaFilters');
//all services
Route::get('treatments', 'ServiceController@allServices')->name('treatments');
// all diseses
Route::get('/diseases', 'ServiceController@getAllServices')->name('diseases');
//services
Route::get('treatments/{slug}', 'PublicController@treatmentData')->name('servicesDetails');
Route::get('treatments/{slug}/{location}', 'PublicController@treatmentDataLocation')->name('servicesDetailsLocation');
Route::get('treatments/{slug}/{location}/{area}', 'PublicController@treatmentDataLocationArea')->name('servicesDetailsLocationArea');
Route::get('/treatments/{slug}/{location?}/{area?}/filters/{video?}/{today?}/{experienced?}/{fee?}/{male?}/{female?}/{highest_rated?}/{time_slot?}/{filter_from?}/{filter_to?}', 'PublicController@treatmentsDataLocationAreaFilters')->name('treatmentsDetailsLocationAreaFilters');
//symptom
// Route::get('/pivot-data', 'PublicController@pivotData');



// Route::get('/hospitals-in-pakistan', 'LocationController@hospitalsLocation');
//Route::get('/doctors/{slug}', 'UserController@doctorsInCity');
//Route::get('/hospitals/{slug}', 'UserController@hospitalsInCity');
// Route::get('/diseases', 'DiseaseController@allDiseases');
// Route::get('/services', 'ServiceController@allSpecialities');
//Route::get('/find-a-doctor', 'ServiceController@getAllServices')->name('find-a-doctor');

Route::get('practice-as-doctor', 'DoctorController@practiceEnhance')->name('practice-as-doctor');

// for hospital
Route::get('for-hospital', 'HospitalController@forHospital')->name('for-hospital');
//get areas
Route::get('/get-selected-location-area/{location}','PublicController@getResultLocationArea');
Route::get('/get-area-filter-data/{type}/{result}/{detail_id}/{area_id}','PublicController@getSelectedAreaData');

// for laboratory
Route::get('for-lab', 'UserController@forLaboratory')->name('for-lab');
Route::get('book-a-lab-test', 'UserController@nearLaboratory')->name('find-near-lab');
Route::get('/get-online-test-reports-{slug}', 'UserController@getOnlineReportLaboratory')->name('get-online-test-reports');
Route::get('/lab-test-report-online', 'UserController@labsGivingOnlineReport')->name('lab-test-report-online');
Route::get('/get-all-laboratories', 'UserController@getallLaboratories')->name('getallLaboratories');
Route::get('/front-end-get-all-tests','UserController@getAllTests');
Route::get('/front-end-get-all-tests/{id}','UserController@getAllLabTests');
Route::get('book-a-lab-test/{slug}', 'PublicController@testsByLabs')->name('tests-by-labs');
Route::get('lab-tests-in-{city}', 'UserController@labCityTest')->name('lab-test-city');
Route::get('test-search', 'UserController@testSearch')->name('test-search');
Route::get('all-test-search', 'UserController@allTestSearch')->name('all-test-search');
Route::get('all-test-search-banner', 'UserController@allTestSearchBanner')->name('all-test-search-banner');
// speciality page
Route::get('/delete-hospitals','PublicController@deleteHospitalSpecialities');
Route::get('/{slug}-in-pakistan', 'PublicController@specialityDataInPakistan')->where('slug', '[A-Za-z0-9-]+')->name('speciality');
Route::get('/{slug}-in-{location}', 'PublicController@specialityDataInCity')->where('slug', '[A-Za-z0-9-]+')->name('speciality-in-city');
Route::get('/{slug}-in-{location}/{area}', 'PublicController@specialityDataInCityArea')->where('slug', '[A-Za-z0-9-]+')->name('speciality-in-city-area');
Route::get('/speciality/{slug}/{location?}/{area?}/filters/{video?}/{today?}/{experienced?}/{fee?}/{male?}/{female?}/{highest_rated?}/{time_slot?}/{filter_from?}/{filter_to?}', 'PublicController@specialityDataLocationAreaFilters')->name('specialityDetailsLocationAreaFilters');

Route::post('store-book-test', 'UserController@storetest');
// About Us page
Route::get('about', 'PageController@about')->name('about');

// Contact Us page
Route::get('contact', 'PageController@contact')->name('contact');

// Terms and Privacy policy Us page
Route::get('privacy', 'PageController@privacy')->name('privacy');
Route::get('/disclaimer', 'PageController@disclaimer')->name('disclaimer');
// Route::get('/disclaimer', function () {
//     return view('front-end.site-pages.disclaimer');
// });
//location area speciality gender wise
Route::get('doctors/{location}/{area}/{speciality}/gender/{gender}', 'PublicController@getSearchResult')->name('loc-area-spec-gen');
//location speciality gender wise
Route::get('doctors/{location}/{speciality}/gender/{gender}', 'PublicController@getSearchResult')->name('loc-spec-gen');

//Route::get('/{role}/{location}/{area}', 'SpecialityController@getDataByArea');

Route::get('search-results', 'PublicController@getSearchResult')->name('searchResults');
Route::get('/all-doctors', 'PublicController@getSearchResult')->name('all-doctors');
Route::get('all-hospitals', 'PublicController@getSearchResult')->name('all-hospitals');



/*End New Search Routes*/


Route::post('getChildLocations', 'LocationController@getChildLocations');
Route::post('booking', 'BookingController@index');


//Doctor Routes
Route::group(
    ['middleware' => ['role:doctor|admin','auth']],
    function () {

        Route::get('doctor/packages', 'PackageController@index')->name('doctorPackages');
        Route::get('doctor/package-checkout/{id}', 'DoctorController@checkout')->name('doctorCheckout');
        // Route::get('doctor/dashboard', 'DoctorController@doctorDashboard')->name('doctorDashboard');
        Route::post('doctor/store-award-downloads', 'DoctorController@storeAwardDownloadSettings')->name('storeAwardDownloadSettings');

        Route::get('doctor/get-awards', 'DoctorController@getDoctorAwards')->name('getDoctorAwards');
        Route::get('doctor/get-awards/{id}', 'DoctorController@getUserDoctorAwards');
        Route::post('doctor/store/experiences', 'DoctorController@storeExperiences')->name('storeExperiences');
        Route::post('doctor/store/educations', 'DoctorController@storeEducations')->name('storeEducations');

        Route::get('doctor/get-experiences', 'UserController@getExperiences');
        Route::get('getexperiences/{id}', 'UserController@getUserExperiences');
        Route::get('doctor/get-educations', 'UserController@getEducations');
        Route::get('doctor/get-educations/{id}', 'UserController@getUserEducations');
        Route::get('appointment-settings', 'DoctorController@addLocation')->name('addAppointmentLocation');
        Route::get('appointment-detail/{id}', 'DoctorController@editLocation')->name('editLocation');
        Route::post('doctor/store/appointment-location', 'DoctorController@storeAppointmentLocation');
        Route::post('doctor/store/admin-appointment-location', 'DoctorController@storeAdminAppointmentLocation');
        Route::post('doctor/update/slots/{id}', 'DoctorController@updateSlots');
        Route::post('doctor/update-day-slots/{id}', 'DoctorController@storeSelectedDaySlots');
        Route::post('doctor/update-location-services/{id}', 'DoctorController@updateLocationServices');
        Route::post('doctor/delete-slots/{slot_id}/{day}/{id}', 'DoctorController@deleteSlots');
        Route::post('doctor/delete-all-slots/{day}/{id}', 'DoctorController@deleteAllSlots');
        Route::get('doctor/appointments', 'DoctorController@showAppointments')->name('doctorAppointments');
        Route::delete('doctor/appointment-status/{id}', 'DoctorController@statusAppointments');
        Route::delete('doctor/appointment-Approve/{id}', 'DoctorController@approveAppointments');

         Route::get('doctor/blogs', 'DoctorController@showBlog')->name('doctorshowBlog');
        Route::post('/doctor/change-status/{id}', 'DoctorController@storeDoctorStatus');
        Route::post('doctor/appointments', 'DoctorController@getAppointmentsByDate')->name('doctorAppointmentsByDate');
        Route::post('doctor/get-appointments', 'DoctorController@getAppointments');
        Route::get('doctor/payout-settings', 'DoctorController@payoutSettings')->name('doctorPayoutsSettings');
        Route::get('doctor/payouts', 'DoctorController@getPayouts')->name('getDoctorPayouts');
        Route::post('doctor/accept-appointment', 'DoctorController@acceptAppointment');
        Route::post('doctor/decline-appointment', 'DoctorController@declineAppointment');
        Route::get('doctor/all-appointments', 'DoctorController@showAllAppointments');
        Route::get('/doctor/all-appointments-notification','DoctorController@AllAppointmentNotification');
        Route::get('doctor/orders-settings', 'DoctorController@paySettings');
        Route::delete('doctor/payment-verify/{id}', 'DoctorController@verifyPayment');
    }
);
Route::group(
    ['middleware' => ['role:admin|doctor|hospital|patient','auth']],
    function () {
        Route::get('/get_appointment_notification_alert','UserController@getAppointmentsNotificationAlert')->name('get-appointments-notification-alert');
        Route::get('{role}/dashboard', 'UserController@getDashboard')->name('dashboard');
        Route::get('user/products/thankyou', 'UserController@thankyou');
        Route::post('user/store-registration-detail', 'UserController@storeRegistrationSettings')->name('storeRegistrationSettings');
        Route::post('user/store-user-registration-detail', 'UserController@updateRegistrationSettings')->name('updateRegistrationSettings');

        Route::get('profile/settings/reset-password', 'UserController@resetPassword')->name('resetPassword');
        Route::post('profile/settings/request-password', 'UserController@requestPassword');
        Route::get('profile/settings/email-notification-settings', 'UserController@emailNotificationSettings')->name('emailNotificationSettings');
        Route::post('profile/settings/save-email-settings', 'UserController@saveEmailNotificationSettings');
        Route::post('profile/settings/save-account-settings', 'UserController@saveAccountSettings');
        Route::get('profile/settings/delete-account', 'UserController@deleteAccount')->name('deleteAccount');
        Route::post('user/settings/delete-account', 'UserController@destroy');
        Route::get('profile/settings/get-user-searchable-settings', 'UserController@getUserSearchableSettings');
        Route::get('checkout/{id}', 'UserController@checkout')->name('checkout');
        Route::post('user/update-payout-detail', 'UserController@updatePayoutDetail');
        Route::get('user/get-payout-detail', 'UserController@getPayoutDetail');
        Route::get('{role_type}/profile-settings', 'UserController@userProfileSettings')->name('profileSettings');
        Route::get('{role_type}/payment', 'UserController@getPayment')->name('getPayment');

        Route::post('patient-payment', 'UserController@storePatientPayment');

        Route::post('{role_type}/store-personal-detail', 'UserController@storeUserProfileSettings')->name('storeUserProfileSettings');
        Route::post('{role_type}/store-gallery', 'UserController@storeUserGallery');
        Route::post('{role_type}/store-update-gallery', 'UserController@storeupdateUserGallery');


    }
);
Route::group(
    ['middleware' => ['role:admin|doctor']],
    function () {
        Route::get('create-article', 'ArticleController@createArticle')->name('createArticle');
        Route::get('edit-article/{slug}', 'ArticleController@editArticle')->name('editArticle');
        Route::post('get-stored-cats', 'ArticleController@getStoredCategories')->name('getAllCategories');
        Route::post('get-article-cats', 'ArticleController@getArticleCats');
        Route::post('post/article', 'ArticleController@postArticle')->name('postArticle');
        Route::post('update/article', 'ArticleController@updateArticle')->name('updateArticle');
        Route::post('delete/article', 'ArticleController@destroy')->name('deleteArticle');
        Route::post('get/featured-article', 'ArticleController@getFeaturedArticleSetting')->name('getFeaturedArticleSetting');
    }
);
Route::group(
    ['middleware' => ['role:doctor|patient|admin']],
    function () {
        Route::get('user/invoice', 'UserController@getUserInvoices')->name('userInvoice');
        Route::get('show/invoice/{id}', 'UserController@showInvoice')->name('showInvoice');
        Route::get('user/invoices', 'UserController@getUserInvoicess')->name('userInvoices');
    }
);
Route::group(
    ['middleware' => ['role:patient|admin']],
    function () {
        Route::get('patient/appointments', 'PatientController@showAppointments')->name('userAppointments');
        Route::post('patient/get-appointments', 'PatientController@getAppointments');
        Route::delete('patient/appointment-status/{id}', 'PatientController@statusAppointments');
        Route::get('patient/all-appointments', 'PatientController@showAllAppointments');
        Route::post('/patient/change-status/{id}', 'PatientController@storePatientStatus');
    }
);
Route::group(
    ['middleware' => ['role:hospital|admin']],
    function () {
        Route::get('hospital/manage-team/{id?}', 'HospitalController@doctorListing')->name('manageTeams');
        Route::post('hospital/approve-user', 'HospitalController@approveUser')->name('approveUser');
        Route::post('hospital/reject-user', 'HospitalController@rejectUser')->name('rejectUser');
        Route::post('hospital/delete-user', 'HospitalController@deleteUser')->name('deleteUser');
    }
);
Route::fallback(
    function () {
       // return View('errors.404 ');
        return Redirect::to('/');
    }
);
Route::post('submit-appointment', 'PublicController@submitAppointment');
Route::post('verify-appointment-password', 'PublicController@verifyAppointmentPassword');
Route::post('verify-appointment-code', 'PublicController@verifyAppointmentCode');
Route::post('doctor/get-hospital-services', 'DoctorController@getHospitalServices');
Route::get('paypal/redirect-url', 'PaypalController@getIndex');
Route::get('paypal/ec-checkout', 'PaypalController@getExpressCheckout');
Route::get('paypal/ec-checkout-success', 'PaypalController@getExpressCheckoutSuccess');
Route::get('addmoney/stripe', array('as' => 'addmoney.paywithstripe', 'uses' => 'StripeController@payWithStripe',));
Route::post('addmoney/stripe', array('as' => 'addmoney.stripe', 'uses' => 'StripeController@postPaymentWithStripe',));
Route::post('stripe/generate-order', 'StripeController@generateOrder');

Route::post('submit-feedback', 'PublicController@submitFeedack');
Route::post('submit-feedback-procedures', 'ProcedureController@submitFeedack');
Route::post('message/send-private-message', 'MessageController@store');
Route::get('message-center', 'MessageController@index')->name('message');
Route::get('message-center/get-users', 'MessageController@getUsers');
Route::post('message-center/get-messages', 'MessageController@getUserMessages');
Route::post('message', 'MessageController@store')->name('message.store');
Route::get('get-user-specialities', 'UserController@getSpecialities');
Route::post('user/speciality_delete/{speciality_index}/{service_index?}', 'UserController@destroySpeciality');
Route::post('get-doctor-education', 'PublicController@getDoctorEducations')->name('getDoctorEducations');
Route::post('get-doctor-experience', 'PublicController@getDoctorExperiences')->name('getDoctorExperiences');
Route::post('store-appointment-data', 'PublicController@storeAppointmentInSession');
Route::post('user/store/services', 'UserController@storeServices');
Route::post('user/store/updateservices', 'UserController@updatestoreServices');
Route::post('user/store/updatehospitalservices', 'UserController@updatestoreHospitalServices');
Route::post('user/store/updatefaqs', 'UserController@updatestoreFaqs');
Route::post('user/store/updateBankData', 'UserController@updateBankData');
Route::post('send/app-link', 'PublicController@sendDownloadAppEmail');
Route::post('register/login-register-user', 'PublicController@loginUser')->name('loginUser');
Route::post('register/verify-user-code', 'PublicController@verifyUserCode');
Route::post('register/form-step1-custom-errors', 'PublicController@RegisterStep1Validation');
Route::post('register/form-step2-custom-errors', 'PublicController@RegisterStep2Validation');
Route::post('import-labCodes','LabBranchController@importLabCode')->name('save.lab.code');
Route::view('upload-labFile','back-end.importLabCodes');
Route::get('profile/{slug}', 'PublicController@showDoctorProfile')->name('userProfile');
Route::get('front-end/get-diseases-of-user/{user}/{speciality}', 'PublicController@getDiseasesOfUserSpeciality');
Route::get('doctors/{city}/{speciality}/{slug}', 'PublicController@showDoctorProfile')->name('citySpecialtyUserProfile');
Route::get('hospitals/{city}/area/{slug}', 'PublicController@areaSearch')->name('hospitals-city-area');
Route::get('lab/{city}/{slug}', 'PublicController@showLabProfile')->name('laboratories-city-laboratory-area');
Route::get('/get-lab-profile-page-all-feedbacks/{id}','PublicController@getAllLabFeedbacks');
Route::get('/get-other-labs-in-location/{id}/{user_id}','PublicController@getOtherLabsInCity');
Route::get('/get-lab-profile-all-tests/{id}','PublicController@getLabAllTests')->name('getLabAllTests');
Route::get('test/{slug}/{test}', 'PublicController@testDetail')->name('laboratories-city-test');
Route::get('/get-test-other-labs-offering/{slug}','PublicController@testOtherLabs');
// Route::get('test-price', 'GoutteController@testPrice');

Route::get('get-specialities', 'SpecialityController@getSpecialities');
Route::post('get-speciality-service', 'SpecialityController@getSpecialityService');

Route::get('search/get-hospitals', 'UserController@getHospitals');
Route::get('search/get-locations', 'UserController@getLocations');
Route::get('page/{slug}', 'PageController@show')->name('showPage');
Route::get('{role}/saved-items', 'UserController@getSavedItems')->name('getSavedItems');


Route::post('appointment/status','UserController@approve');

    Route::middleware('optimizeImages')->group(function () {
        Route::post('media/upload-temp-image/{type}/{file_name}/{img_type?}', 'MediaController@uploadTempImage');
    });

Route::post('doctor/get-appointment-slots', 'DoctorController@getAppointmentSlots');

 Route::get('doctor/get-awards', 'DoctorController@getUpdateDoctorAwards')->name('getUpdateDoctorAwards');
        Route::get('doctor/get-experiences', 'UserController@getExperiences');
        Route::get('doctor/get-educations', 'UserController@getEducations');
//Blacklist
Route::get('black-list', 'LabBranchController@blacklistuser');
Route::post('blacklist/add', 'BlacklistController@add');
Route::post('blacklist/remove', 'BlacklistController@remove');
//Procedures
Route::get('/surgeries','ProcedureController@getAllProcedures')->name('all-surgeries');
Route::get('surgeries/{location}/{slug}','ProcedureController@showProcedure')->name('surgery-show');
Route::get('/get-procedure-hospitals/{spec_id}/{procedure_id}/{loc_id}','ProcedureController@getProcedureHospitals');
Route::get('/get-procedure-doctors/{spec_id}/{procedure_id}/{loc_id}','ProcedureController@getProcedureDoctors');
Route::get('surgeries/{location}','ProcedureController@Procedureslocation')->name('surgery-location');

//get All Diseases
Route::get('getAllDiseases','DiseaseController@getAllDiseases');
//get All Doctors Hospitals
Route::get('getAllDoctors','UserController@getAllDoctors');
//get Speciality By User Id
Route::get('getSpecialityByUserId/{id}','SpecialityController@getSpecialityByUserId');
// get unserialize data
Route::post('unserialize', 'UserController@unserialize');
// get current user's saved items
Route::get('getCurrentUsersSaved', 'UserController@getCurrentUsersSaved');

Route::get('/search', function (Request $request) {
    return App\User::role('doctor')->search($request->search)->get();
});

Route::post('/feedbackCheck', 'FeedbackController@feedbackCheck');
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

/*Quick Registration*/
Route::post('/quick-registration', 'UserController@quickReg');
/*Phone Number Verification*/
Route::post('/phone-number-verification', 'UserController@phoneNumVer');

/*phone number verification*/
Route::post('user/send-code', 'CodeController@sendVerificationCode');

//resend verification code
Route::post('user/resend-code', 'CodeController@resendCode');
Route::post('user/appointmentbookingstatus', 'CodeController@appointmentBookedMessage');


Route::get('/check-login', 'UserController@checkLogin');
Route::get('/current-affair-show/{id}', 'UserController@datashow');
Route::get('/cosult-online', function () {
    return view('welcome');
});
Route::get('/all-hospital', function () {
    return view('welcome');
});



Route::get('/jazz', function () {
    return view('jazz');
});

//Route::post('/testjazz', 'JazzController@index');


Route::get('video-call', function () {
    $zoom = new \MacsiDigital\Zoom\Support\Entry;
    $user = new \MacsiDigital\Zoom\User($zoom);
    $users = \Zoom::user()->all();
    //dd($user, $users);
   // $user = \MacsiDigital\Zoom\Facades\Zoom::user()->create(['email' => 'umer.ajmal.228@gmail.com']);
    //dd($user);
        $user = $zoom->user->create([
        'name' => 'Test Name',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'test@test.com',
        'password' => '1234567890',
        'type' => 1
    ]);
      return $user;
    $meetings = \MacsiDigital\Zoom\Facades\Zoom::User();
    dd($meetings);
});

//Route::get('/video', "VideoRoomsController@index");
Route::prefix('room')->middleware('auth')->group(function() {
    Route::get('join/{roomName}', 'VideoRoomsController@joinRoom');
    Route::post('create', 'VideoRoomsController@createRoom');
});

//csr booking route
Route::post('/callAppointmentBooking', 'AppointmentBookingController@callAppointmentBooking')->name('csrBookingAppointment');
Route::get('/online-appointment-booking', 'AppointmentBookingController@onlineAppointmentBooking')->name('csrOnlineBookingAppointment');
Route::get('/appointment-booking-system', 'UserController@appointmentBookingSystem');
Route::get('/search-for-doctors', 'UserController@searchDoctorsForAppointment');



Route::post('subscriber', 'SubscriberController@store')->name('subscribe');
Route::post('subscriber-now', 'SubscriberController@subscribeNow');
Route::get('subscribe-now', 'SubscriberController@index')->name('subscribe-now');

Route::post('store-estimated-cost', 'ProcedureEstimatedCostController@store');

// Add New Routes



/*Route::get('/doctors/pakistan', function () {
    return view('front-end.pages.doctors_pakistan');
});*/
Route::get('/dermatologist-Pakistan', function () {
    return view('front-end.pages.dermatologist');
});
Route::get('getMoreDoctors/{id}/{count}','PublicController@getMoreDoctors')->name('getMoreDoctors');
Route::get('getMoreOtherHospital/{id}/{top?}','PublicController@getMoreOtherHospital')->name('getMoreDoctors');
Route::get('/bahria-town/dermatologiest', function () {
    return view('front-end.pages.bahria_town_dermatologist');
});
// Route::get('/lab-profile-test', function () {
//     return view('front-end.lab-profile-test.lab-profile');
// });

Route::get('/pharmacyHome', function () {
    return view('front-end.pharmacyHome.pharmacyHome');
});
Route::get('/pharmacyListing', function () {
    return view('front-end.pharmacyListing.pharmacyListing');
});
Route::get('/pharmacyDetail', function () {
    return view('front-end.pharmacyDetail.pharmacyDetail');
});
Route::get('/pharmacyCheckout', function () {
    return view('front-end.pharmacyCheckout.pharmacyCheckout');
});
Route::get('/pharmacyUploadInformation', function () {
    return view('front-end.pharmacyUploadInformation.pharmacyUploadInformation');
});
Route::get('/dermatologist/female', function () {
    return view('front-end.pages.dermatologist_female');
});
Route::get('/dermatologist/male', function () {
    return view('front-end.pages.dermatologist_male');
});
Route::get('/lahore/johar-town/dermatologist/female', function () {
    return view('front-end.pages.johar_town_dermatologist_female');
});

Route::get('/lahore/johar-town/dermatologist/male', function () {
    return view('front-end.pages.johar_town_dermatologist_male');
});
Route::get('/lahore/dermatologist/dr-umer-mushtaq/callcenter', function () {
    return view('front-end.pages.callcenter');
});
Route::get('/lahore/dermatologist/dr-umer-mushtaq/review-doctor', function () {
    return view('front-end.pages.review_doctor');
});
Route::get('/hospital/pakistan', function () {
    return view('front-end.pages.hospitals_pakistan');
});

Route::get('/blog-profile', function () {
    return view('front-end.articles.blog-profile.blog-profile-auther');
});
Route::get('/diseases-categorey', function () {
    return view('front-end.find-a-doctor.disease-categorey');
});
Route::get('/hospitals-lahore-area-johar-town', function () {
    return view('front-end.pages.hospitals_lahore_johar_town');
});Route::get('/hospitals/lahore/hameed-latif-hospital/dermatologist', function () {
    return view('front-end.pages.hameed_latif_hospital_dermatologist');
});


/*Home Page Requests*/
Route::post('/like-article', 'ArticleController@likeArticle');
Route::post('/app-link-send', 'HomeController@appLinkSend');


Route::get('/sitemap.xml','SiteMapController@index');
Route::get('sitemap/diseases.xml', 'SiteMapController@diseasesFunction');
Route::get('sitemap/articles.xml', 'SiteMapController@healthArticlesFunction');
Route::get('/sitemap/specialities.xml', 'SiteMapController@specialitiesFunction');
// Route::get('/sitemap/specialities-cities.xml', 'SiteMapController@specialitiesCitiesFunction');
Route::get('sitemap/treatments.xml', 'SiteMapController@servicesFunction');
Route::get('sitemap/doctors.xml', 'SiteMapController@doctorsFunction');
// Route::get('sitemap/doctors-cities.xml', 'SiteMapController@doctorsCities');
// Route::get('sitemap/doctors-cities-area.xml', 'SiteMapController@doctorsCitiesArea');
Route::get('sitemap/hospitals.xml', 'SiteMapController@hospitalsFunction');
// Route::get('sitemap/hospitals-cities.xml', 'SiteMapController@hospitalsCities');
Route::get('sitemap/labortories.xml', 'SiteMapController@labortoriesFunction');
Route::get('sitemap/symptoms.xml', 'SiteMapController@symptomsFunction');
Route::get('sitemap/tests.xml', 'SiteMapController@testsFunction');
Route::get('sitemap/surgeries.xml','SiteMapController@procedureFunction');
// Route::get('sitemap/surgeries-cities.xml','SiteMapController@surgeriesCityFunction');

Route::get('csrf', function () {
    return csrf_token();
});


Route::get('logout', function (){
    \Auth::logout();
    $json = Array();
    return Redirect::to('/');
});



