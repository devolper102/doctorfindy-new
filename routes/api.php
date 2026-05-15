<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\VideoCallController;
use App\Http\Controllers\EncryptionController;
use App\Http\Controllers\SocialController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
Route::post('/login', 'Api\AuthController@loginUser');
Route::post('/register', 'Api\AuthController@registerUser');
Route::post('/user-login', 'Api\AuthController@UserLogin');
Route::post('/user-register', 'Api\AuthController@UserRegister');
Route::get('/logout', 'Api\AuthController@logout');
    Route::get('/redirect/{provider}', 'Api\AuthController@redirect');
    Route::get('/callback/{provider}', 'Api\AuthController@callback');
Route::post('/change-password', 'Api\AuthController@changePassword');
Route::post('/report-user', 'Api\HomeController@reportUser');
Route::post('/add-prescription', 'Api\HomeController@addPrescription');
Route::post('/add-review', 'Api\HomeController@AddReview');
Route::get('/redirect/{provider}', 'Api\AuthController@redirect');
Route::get('/callback/{provider}', 'Api\AuthController@callback');
Route::post('/signin-with-google', 'Api\AuthController@siginWithGoogle');
});
// Route::middleware(['web'])->group(function () {
//     Route::get('login/{provider}', [SocialAuthController::class, 'redirect']);
//     Route::get('login/{provider}/callback', [SocialAuthController::class, 'callback']);
// });
// login with google
// Route::get('auth/redirect/{provider}', [SocialController::class, 'redirect']);

// Route::get('auth/callback/{provider}', [SocialController::class, 'callback']);
// Change Password
Route::group([
    'middleware' => 'auth:api'

], function ($router) {
Route::post('/change-password', 'Api\AuthController@changePassword');
});
Route::get('/patient-detail', 'Api\HomeController@patientDetail');
Route::get('/dashboard', 'Api\HomeController@getDoctorDashboard');
Route::get('/doctor-clinics', 'Api\HomeController@getDoctorClinics');
Route::get('/add-clinics-data', 'Api\HomeController@addClinicsData');
Route::get('/patient-appointments', 'Api\HomeController@showAppointmentsToAdmin');
Route::get('/doctor-appointments/{date}', 'Api\HomeController@patientAppointment');
Route::get('/patient-management', 'Api\HomeController@patientManagement');

Route::get('/patient-appointments-list', 'Api\HomeController@getAppointmentsByDate');
Route::get('/get-profile', 'Api\HomeController@getDoctorProfile');

Route::get('/get-all-specialities', 'Api\HomeController@getAllSpecialities');
Route::get('/get-all-location', 'Api\HomeController@getAllLocations');
Route::post('/update-appointment-status', 'Api\HomeController@updateAppointment');
Route::post('/update-visit-status', 'Api\HomeController@updateVisitStatus');
Route::post('/set-clinic-data', 'Api\HomeController@setClinicData');
Route::get('/get-appointment-slot', 'Api\HomeController@getAppointmentSlots');
Route::post('/user-report', 'Api\HomeController@addReport');
Route::get('/appointmentHistory', 'Api\HomeController@appointmentHistory');
Route::get('/hospitals', 'Api\HomeController@getDoctorHospitals');
Route::post('/remove/clinic', 'Api\HomeController@removeClinicData');
Route::get('/edit-doctor-profile', 'Api\ProfileController@editDoctorProfile');
Route::get('/edit-clinic-data/{id}', 'Api\HomeController@editClinicData');
Route::post('/update-clinic', 'Api\HomeController@updateClinicData');
// Route::get('/edit-doctor-profile', 'Api\ProfileController@editDoctorProfile');
Route::post('/update-doctor-profile', 'Api\ProfileController@updateDoctorProfile');
Route::post('/change-profile-image', 'MediaController@changeProfileImage');
Route::post('/{user_id}/update-avatar', [UserController::class, 'updateAvatarr']);
// Route::post('/change-profile-image/{type}/{file_name}/{img_type?}', 'MediaController@changeProfileImage');
// profile image start
Route::post('/store-profile-image/{user_id}', 'Api\ProfileController@storeProfileImage');
// end profileimage
Route::get('/prescriptions-list', 'Api\HomeController@getPrescriptions');
Route::post('/reset-password', 'Api\AuthController@resetPassword');
// Route::get('/generate-access-token', 'Api\AuthController@generateAccessToken');
Route::get('/homepage/get-specialties', 'Api\AuthController@getSpecialties');
Route::get('/homepage/get-doctors', 'Api\AuthController@getDoctors');
Route::get('/homepage/get-hospitals', 'Api\AuthController@getHospitals');
Route::get('/homepage/get-laboratories', 'Api\AuthController@getLaboratories');
Route::get('/homepage/get-diseases', 'Api\AuthController@getDiseases');
Route::get('/homepage/get-services', 'Api\AuthController@getServices');
Route::get('/homepage/get-cities', 'Api\AuthConhController@getArticles');
Route::get('/homepage/get-feedbacks', 'Api\Atroller@getCities');
Route::get('/homepage/get-articles', 'Api\AututhController@getFeedbacks');
Route::get('/homepage/get-procedures', 'Api\AuthController@getProcedures');
Route::get('/homepage/get-managements', 'Api\AuthController@getManagements');
Route::get('/homepage/get-auth-user', 'Api\AuthController@getAuthUser');
Route::get('/homepage/get-homepage-data', 'Api\HomeController@getHomepageData');

// Products
Route::get('/get_products', 'Api\AuthController@getProducts');
Route::get('/get_product/{product_id}', 'Api\AuthController@getProduct');
Route::post('/encrypt', [EncryptionController::class, 'encrypt']);
Route::post('/decrypt', [EncryptionController::class, 'decrypt']);
// Doctor Listing by Specialty
Route::get('/get-specialty-doctors', 'Api\ListingController@getSpecialtyDoctors');
Route::get('/get-specialty-doctors/{location}', 'Api\ListingController@getSpecialtyCityDoctors');
// Doctor Listing by Disease
Route::get('/get-disease-doctors', 'Api\ListingController@getDiseaseDoctors');
Route::get('/get-disease-doctors/{location}', 'Api\ListingController@getDiseaseCityDoctors');
// Doctor Listing by Treatment
Route::get('/get-treatment-doctors', 'Api\ListingController@getTreatmentDoctors');
Route::get('/get-treatment-doctors/{location}', 'Api\ListingController@getTreatmentCityDoctors');
// Doctor Listing by Surgery
Route::get('/get-surgery-doctors/{location}', 'Api\ListingController@getSurgeryCityDoctors');
// Doctor Listing by City
Route::get('/get-city-wise-doctors', 'Api\ListingController@getCityWiseDoctors');
Route::get('/get-city-wise-online-doctors', 'Api\ListingController@getCityWiseOnlineDoctors');
// Labs Listing by City
Route::get('/get-city-wise-labs', 'Api\ListingController@getCityWiseLabs');
// Doctor Profile
Route::get('/doctor-profile', 'Api\ProfileController@getDoctorProfileData');
// Lab Profile
Route::get('/lab-profile', 'Api\ProfileController@getLabProfileData');

// Patient and Friend And Family Routes
Route::group(['middleware' => 'auth:api'], function () {
    // Edit Patient Profile 
Route::post('/edit-patient-profile/{id}', 'Api\ProfileController@updatePatientProfile');

    // Route for fetching records for a specific user
   Route::get('/get-friend-and-family/{user_id}', 'Api\FriendAndFamilyController@index');

    // Route for storing a new record
   Route::post('/add-friends-and-family', 'Api\FriendAndFamilyController@store');

   // Route for doctor's review
   Route::post('/submit-feedback', 'Api\HomeController@submitFeedback');
    
    // Fetch Patient Appointments
   Route::get('/get-patient-appointments', 'Api\BookingController@getPatientAppointments');
   // Cancel Doctor Appointment
Route::post('/cancel-appointment', 'Api\BookingController@cancelAppointment');
// Re-schedule Doctor Appointment
Route::post('/reschedule-appointment', 'Api\BookingController@rescheduleAppointment');
// get Medical Report
Route::get('/get-medical-report', 'Api\ProfileController@getMedicalReport');
// Add Medical Report
Route::post('/add-medical-report', 'Api\ProfileController@addMedicalReport');
// Update Medical Report
Route::post('/update-medical-report/{id}', 'Api\ProfileController@updateMedicalReport');

// Delete Medical Report
Route::delete('/medical-reports/{id}', 'Api\ProfileController@DeleteMedicalRecors');
});
 // Fetch All Blogs with Categories
   Route::get('/get-blogs', 'Api\HomeController@getBlogs');
    // Post a contact us message
   Route::post('/contact-us-message', 'Api\HomeController@contactUsMessage');
   // Get Lab discount Code
   Route::post('/get-discount-code', 'Api\HomeController@getLabDiscountCode');


// Top Surgeries, Treatments, Specialties and Diseases
Route::get('/get-specialties-treatments-surgeries-diseases', 'Api\ListingController@getTopSpecialtiesTreatmentsSurgeriesDiseases');
// Get Specialty by city with Doctor Count
Route::get('/get-search-specialties-by-city/{location}', 'Api\ListingController@getSearchSpecialtiesByCity');
// Book a Lab Test Page
Route::get('/book-a-lab-test', 'Api\ListingController@bookLabTestPage');
Route::get('/lab-available-tests', 'Api\ListingController@labAvailableTests');
// Get Main Search
Route::get('/get-search', 'Api\ListingController@getSearch');
// Book Doctor Appointment
Route::post('/book-appointment', 'Api\BookingController@bookAppointment');
// Book lab Test
Route::post('/book-test', 'Api\BookingController@bookLabTest');
// Tests Search
Route::get('/search-lab-tests', 'Api\ListingController@searchLabTests');
Route::get('/booked-tests', 'Api\BookingController@bookTestRecord');
Route::get('/discount-code-detail', 'Api\BookingController@getBookedTests');




Route::get('v1/listing/get_hospital', 'RestAPIController@getHospital');
Route::get('v1/listing/get_hospital_team', 'RestAPIController@getHospitalTeam');
Route::get('v1/listing/get_consultation', 'RestAPIController@getDoctorConsulation');
Route::get('v1/listing/get_feedback', 'RestAPIController@getDoctorFeedback');
Route::get('v1/listing/get_location', 'RestAPIController@getDoctorLocation');
Route::get('v1/listing/get_articles', 'RestAPIController@getDoctorArticles');
Route::get('v1/listing/get_sinle_article', 'RestAPIController@getArticleDetail');
Route::get('v1/listing/get_doctors', 'RestAPIController@getUsers');
Route::post('v1/user/do-login', 'RestAPIController@userLogin');
Route::post('v1/user/do-logout', 'RestAPIController@userLogout');
Route::post('v1/user/signup', 'RestAPIController@createUser');
Route::post('v1/user/add_wishlist', 'RestAPIController@addWishlist');
Route::get('v1/user/get_wishlist', 'RestAPIController@getSavedItems');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('v1/profile/setting', 'RestAPIController@getUserProfileSettings');
Route::post('v1/profile/store_profile_setting', 'RestAPIController@storeProfileSettings');
Route::get('v1/taxonomies/get_list', 'RestAPIController@getTaxonomies');
Route::get('v1/profile/get_remove_reasons', 'RestAPIController@getRemoveReasons');
Route::get('v1/taxonomies/get-specilities', 'RestAPIController@getSpecilities');
Route::get('v1/forums/basic', 'RestAPIController@getForumSettings');
Route::get('v1/forums/get_listing', 'RestAPIController@getForumListing');
Route::post('v1/profile/get_remove_reasons', 'RestAPIController@removeAccount');
Route::post('v1/forums/add_question', 'RestAPIController@submitQuestion');
Route::get('v1/team/get_listing', 'RestAPIController@getTeam');
Route::get('v1/appointments/get_listing', 'RestAPIController@getDoctorAppointments');
Route::get('v1/appointments/get_patient_listing', 'RestAPIController@getPatientAppointments');
Route::get('v1/appointments/get_single', 'RestAPIController@getDoctorAppointmentSingle');
Route::get('v1/appointments/get_patient_single', 'RestAPIController@getPatientAppointmentSingle');
Route::post('v1/appointments/update_status', 'RestAPIController@updateAppointmentStatus');
Route::post('v1/appointmentBooking', 'RestAPIController@bookAppointment');
Route::get('v1/appointment/get_hospital', 'RestAPIController@getAppointmentHospitals');
Route::get('v1/appointment/get_hospital_services', 'RestAPIController@getHospitalServices');
Route::get('v1/appointment/get_appointment_slots', 'RestAPIController@getAppointmentSlots');
Route::post('v1/appointment/store_location', 'RestAPIController@storeAppointmentLocation');
Route::get('v1/appointment/get_locations', 'RestAPIController@getAppointmentLocation');
Route::get('v1/appointment/get_location_detail', 'RestAPIController@getLocationDetail');
Route::get('v1/appointment/get_location_services', 'RestAPIController@getLocationServices');
Route::post('v1/appointment/delete_all_slots', 'RestAPIController@deleteAllSlots');
Route::post('v1/appointment/delete_slot', 'RestAPIController@deleteSlot');
Route::post('v1/appointment/update_slots', 'RestAPIController@updateSlots');
Route::post('v1/appointment/update_selected_day_slots', 'RestAPIController@storeSelectedDaySlots');
Route::post('v1/submit_feedback', 'RestAPIController@submitFeedack');
Route::get('getRoom/{room?}', "EnxRtc\RoomController@getRoom");
Route::post('createRoom/', "EnxRtc\RoomController@createRoom");
Route::post('createToken/', "EnxRtc\RoomController@createToken");
//rtc token 
Route::get('/rtc-token', [TokenController::class, 'generateToken']);
Route::get('/generate-agora-keys', [EncryptionController::class, 'generateEncryptionKeys']);
// Route::get('/agora-token', [VideoCallController::class, 'getRtcToken']);
Route::get('/agora-token', "Api\VideoCallController@getRtcToken");
