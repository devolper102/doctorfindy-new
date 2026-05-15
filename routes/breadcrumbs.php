<?php
/**
 * Breadcrumbs registration
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
Breadcrumbs::for(
    'home', function ($trail) {
        $trail->push(trans('lang.home'), route('home'));
    }
);
// Home > About
Breadcrumbs::for('about', function ($trail) {
    $trail->parent('home');
    $trail->push('About', url('/about'));
});

// Home > Contact us
Breadcrumbs::for('contact', function ($trail) {
    $trail->parent('home');
    $trail->push('contact', url('/contact'));
});
// Home > Privacy
Breadcrumbs::for('privacy', function ($trail) {
    $trail->parent('home');
    $trail->push('privacy', url('/privacy'));
});
// Home > Disclaimer
Breadcrumbs::for('disclaimer', function ($trail) {
    $trail->parent('home');
    $trail->push('disclaimer', url('/disclaimer'));
});
// Home > practice-as-doctor
Breadcrumbs::for('practice-as-doctor', function ($trail) {
    $trail->parent('home');
    $trail->push('practice as doctor', url('/practice-as-doctor'));
});
// Home > for-hospital
Breadcrumbs::for('for-hospital', function ($trail) {
    $trail->parent('home');
    $trail->push('For Hospital', url('/for-hospital'));
});
// Home > for-lab
Breadcrumbs::for('for-lab', function ($trail) {
    $trail->parent('home');
    $trail->push('For Lab', url('/for-lab'));
});
// Home > diseases
Breadcrumbs::for('diseases', function ($trail) {
    $trail->parent('home');
    $trail->push('diseases', url('/diseases'));
});
// Home > doctors
Breadcrumbs::for('doctors', function ($trail) {
    $trail->parent('home');
    $trail->push('doctors', url('/doctors'));
});
// Home > hospitals
Breadcrumbs::for('hospitals', function ($trail) {
    $trail->parent('home');
    $trail->push('hospitals', url('/hospitals'));
});
// Home > find-a-doctor-near-you
Breadcrumbs::for('find-a-doctor-near-you', function ($trail) {
    $trail->parent('home');
    $trail->push('find a doctor near you', url('/find-a-doctor-near-you'));
});
// Home > treatments
Breadcrumbs::for('treatments', function ($trail) {
    $trail->parent('home');
    $trail->push('treatments', url('/treatments'));
});
// Home > online-doctor-video-consultation-in-pakistan
Breadcrumbs::for('online-doctor-video-consultation-in-pakistan', function ($trail) {
    $trail->parent('home');
    $trail->push('online doctor video consultation in pakistan', url('/online-doctor-video-consultation-in-pakistan'));
});

// Home > surgeries
Breadcrumbs::for('surgeries', function ($trail) {
    $trail->parent('home');
    $trail->push('surgeries', url('/surgeries'));
});

// Home > surgeries > [city]
Breadcrumbs::for('surgery-city', function ($trail, $get_procedures) {
    $trail->parent('surgeries');
    $trail->push($get_procedures->title,url('/surgeries',$get_procedures->slug));
});

// Home > surgeries > [city] > [slug]
Breadcrumbs::for('surgery-city-slug', function ($trail, $location, $procedure) {
    $trail->parent('surgery-city',$location);
    $trail->push($procedure->title,url('/surgeries',$location->slug,$procedure->slug));
});

// Home > health-articles
Breadcrumbs::for('health-articles', function ($trail) {
    $trail->parent('home');
    $trail->push('health-articles', url('/health-articles/categories'));
});

// Home > health-articles > profile
Breadcrumbs::for('health-article-profile', function ($trail) {
    $trail->parent('health-articles');
    $trail->push('Profile', url('/health-articles/categories'));
});

// Home > health-articles > categories
Breadcrumbs::for('article-category', function ($trail, $categories) {
    $trail->parent('health-articles');
    $trail->push('Categories',url('/health-articles/categories'));
});

// Home > health-articles > categories >[category]
Breadcrumbs::for('article-category-slug', function ($trail, $categories,$category) {
    $trail->parent('article-category',$categories);
  $trail->push($category->title,url('/health-articles/categories/',$category->slug));
});

// Home > health-articles > Profile > [writer]

Breadcrumbs::for('article-profile-writer', function ($trail,$categories,$user) {
    $trail->parent('health-article-profile');
    $name = $user->first_name.' '.$user->last_name ;
    $trail->push($name,url('/health-articles/profile/',$user->slug));
});

// Home > health-articles > [slug]
Breadcrumbs::for('article-show', function ($trail, $article) {
    $trail->parent('health-articles');
    $trail->push($article->title,url('/health-articles/',$article->slug));
});

// Home > subscribe-now
Breadcrumbs::for('subscribe-now', function ($trail) {
    $trail->parent('home');
    $trail->push('subscribe now', url('/subscribe-now'));
});

// Home > find-near-laboratory
Breadcrumbs::for('find-near-laboratory', function ($trail) {
    $trail->parent('home');
    $trail->push('find near lab', url('/find-near-laboratory'));
});

// Home > book-a-lab-test
Breadcrumbs::for('book-a-lab-test', function ($trail) {
    $trail->parent('home');
    $trail->push('book a lab test', url('/book-a-lab-test'));
});
// Home > tests by labs
Breadcrumbs::for('tests-by-labs', function ($trail ,$test) {
    $trail->parent('book-a-lab-test');
    $trail->push('tests by labs', route('tests-by-labs',$test));
    
  
});
// Home > Lab-test-report-online
Breadcrumbs::for('lab-test-report-online', function ($trail) {
    $trail->parent('home');
    $trail->push('Lab test report online', url('/lab-test-report-online'));
});
// Home > book-a-lab-test > Get Online Reports
Breadcrumbs::for('get-online-test-reports', function ($trail ,$slug,$title) {
    $trail->parent('lab-test-report-online');
    $trail->push('Get online test reports '.$title, url('/get-online-test-reports-'.$slug));
    
  
});
// Home > ask-a-doctor-online
Breadcrumbs::for('ask-a-doctor-online', function ($trail) {
    $trail->parent('home');
    $trail->push('ask a doctor online', url('/ask-a-doctor-online'));
});

// Home > ask-a-doctor-online > speciality
Breadcrumbs::for('ask-a-doctor-online-speciality', function ($trail) {
    $trail->parent('ask-a-doctor-online');
    $trail->push('Speciality', url('/ask-a-doctor-online'));
});

// Home > ask-a-doctor-online > speciality > [slug]
Breadcrumbs::for('ask-a-doctor-online-speciality-slug', function ($trail,$specialty) {
    $trail->parent('ask-a-doctor-online-speciality');
    $trail->push($specialty->title, url('/ask-a-doctor-online/speciality/',$specialty->slug));
});

// Home > ask-a-doctor-online > profile
Breadcrumbs::for('ask-a-doctor-online-profile', function ($trail) {
    $trail->parent('ask-a-doctor-online');
    $trail->push('Profile', url('/ask-a-doctor-online'));
});

// Home > ask-a-doctor-online > profile > [name]
Breadcrumbs::for('ask-a-doctor-online-profile-name', function ($trail,$doctor) {
    $trail->parent('ask-a-doctor-online-profile');
    $name = $doctor->first_name.' '.$doctor->last_name ;
    $trail->push($name, url('/ask-a-doctor-online/profile/',$doctor->slug));
});

Breadcrumbs::for('post', function ($trail, $post, $category) {
    dd($trail, $post, $category);
    $trail->parent('category', $category);
    $trail->push($post->title, route('post', $post->slug));
});

// Home > Blog > [Category]url('/surgeries',$city->slug)
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category->id));
});

// Home > doctors > [city]
Breadcrumbs::for('doctors-by-city', function ($trail, $location) {
    $trail->parent('doctors');
    $trail->push($location ? $location->title:'lahore',url('/doctors',$location->slug));
});

// Home > doctors > [city] > [area]
Breadcrumbs::for('doctors-by-city-area', function ($trail, $location,$area) {
    $trail->parent('doctors-by-city',$location);
    $name = str_replace("-", " ", $area);
    $trail->push($name,url('/doctors',$location->slug,$area));
});

// Home > dermatologist-in-Pakistan 
Breadcrumbs::for('speciality-in-Pakistan', function ($trail,$speciality) {
    $trail->parent('home');
    $name = $speciality->title.' in pakistan';
    $trail->push($name, url($speciality->slug.'-in-pakistan'));
});
// Home >  dermatologist-in-lahore 
Breadcrumbs::for('speciality-in-city', function ($trail,$speciality,$location) {
    $trail->parent('home');
    $name = $speciality->slug.' in '.$location;
    $trail->push($name, url($speciality->slug.'-in-'.$location));
});
// Home >online-doctor-consultation
Breadcrumbs::for('online-doctor-consultation', function ($trail) {
    $trail->parent('home');
    $trail->push('online doctor consultation', url('online-doctor-consultation'));
});
// Home >online-doctor-consultation > [speciality]
Breadcrumbs::for('online-doctor-consultation-speciality', function ($trail,$speciality) {
    $trail->parent('online-doctor-consultation');
    $trail->push($speciality->title, url('online-doctor-consultation/'.$speciality->slug));
});
// Home >online-doctor-consultation > [speciality] > [city]
Breadcrumbs::for('online-doctor-consultation-speciality-city', function ($trail,$speciality,$location) {
    $trail->parent('online-doctor-consultation-speciality',$speciality);
    $trail->push($location ? $location->title:'lahore', url('online-doctor-consultation/'.$speciality->slug.'/'.$location->slug));
});

// Home >doctor  > [city] > [area] > [speciality]
Breadcrumbs::for('doctor-city-area-speciality', function ($trail,$location,$area,$speciality) {
    $trail->parent('doctors-by-city-area',$location,$area);
    $trail->push($speciality->title, url('doctor/'.$location->slug.'/'.$area.'/'.$speciality->slug));
});

// Home >labs
Breadcrumbs::for('labs', function ($trail) {
    $trail->parent('home');
    $trail->push('labs', url('find-a-lab-near-you'));
});
// Home >doctor > [city] > [area] > [speciality]
Breadcrumbs::for('city-area-speciality', function ($trail,$location,$second,$third) {
    $trail->parent('doctors-by-city-area',$location,$second);
    $trail->push($third, url('/doctor',$location->slug,$second,$third));
});
// Home > diseases > [slug]
Breadcrumbs::for('diseases-slug', function ($trail,$disease) {
    $trail->parent('diseases');
    $trail->push($disease->title, url('diseases/'.$disease->slug));
});
// Home > diseases > [slug] > [city]
Breadcrumbs::for('diseases-slug-city', function ($trail,$disease,$location) {
    $trail->parent('diseases-slug',$disease);
    $trail->push($location ? $location->title:'lahore', url('diseases/'.$disease->slug.'/'.$location->slug));
});

// Home > diseases > [slug] > [city] > [area]
Breadcrumbs::for('diseases-slug-city-area', function ($trail,$disease,$location,$area) {
    $trail->parent('diseases-slug-city',$disease,$location);
    $name = str_replace("-", " ", $area);
    $trail->push($name, url('diseases/'.$disease->slug.'/'.$location->slug.'/'.$area));
});

// Home > treatments > [slug]
Breadcrumbs::for('treatments-slug', function ($trail,$service) {
    $trail->parent('treatments');
    $trail->push($service->title, url('treatments/'.$service->slug));
});
// Home > treatments > [slug] > [city]
Breadcrumbs::for('treatments-slug-city', function ($trail,$service,$location) {
    $trail->parent('treatments-slug',$service);
    $trail->push($location ? $location->title:'lahore', url('treatments/'.$service->slug.'/'.$location->slug));
});

// Home > treatments > [slug] > [city] > [area]
Breadcrumbs::for('treatments-slug-city-area', function ($trail,$service,$location,$area) {
    $trail->parent('treatments-slug-city',$service,$location);
    $name = str_replace("-", " ", $area);
    $trail->push($name, url('treatments/'.$service->slug.'/'.$location->slug.'/'.$area));
});

// Home > labs > [city]
Breadcrumbs::for('labs-city', function ($trail,$location) {
    $trail->parent('labs');
    $trail->push($location ? $location->title:'lahore', url('labs/'.$location->slug));
});

// Home > labs > [city] > [area]
Breadcrumbs::for('labs-city-area', function ($trail,$location,$area) {
    $trail->parent('labs-city',$location);
     $name = str_replace("-", " ", $area->slug);
    $trail->push($name, url('labs/'.$location->slug.'/'.$area->slug));
});

// Home > labs > [city] > [speciality]
Breadcrumbs::for('all-labs-city-speciality', function ($trail,$location,$speciality) {
    $trail->parent('labs-city',$location);
    $trail->push($speciality->slug, url('labs/'.$location->slug.'/'.$speciality->slug));
});

// Home > hospitals > [city]
Breadcrumbs::for('hospitals-city', function ($trail,$location) {
    $trail->parent('hospitals');
    $trail->push($location ? $location->title:'lahore', url('hospitals/'.$location->slug));
});

// Home > labs > [city] > [area] // labs > [city] > [speciality]
Breadcrumbs::for('hospitals-city-area', function ($trail,$location,$area) {
    $trail->parent('hospitals-city',$location);
     $name = str_replace("-", " ", $area);
    $trail->push($name, url('hospitals/'.$location->slug.'/'.$area));
});


// Home > speciality-by-doctor
Breadcrumbs::for('speciality-by-doctor', function ($trail,$location,$speciality) {
    $trail->parent('doctors-by-city',$location);
    $trail->push($speciality->slug, url($speciality->slug.'-in-pakistan'));
});

// Home > speciality-by-doctor-gender
Breadcrumbs::for('speciality-by-doctor-gender', function ($trail,$location,$speciality) {
    $trail->parent('speciality-by-doctor',$location,$speciality);
    $trail->push('gender', url('/doctors'));
});
// Home > speciality-by-doctor-gender-wise
Breadcrumbs::for('speciality-by-doctor-gender-wise', function ($trail,$location,$speciality,$gender_name) {
    $trail->parent('speciality-by-doctor-gender',$location,$speciality);
    $trail->push($gender_name, url('doctors/'.$location->slug.'/'.$speciality->slug.'/gender/'.$gender_name));
});


// Home > speciality-get-routes
Breadcrumbs::for('speciality-get-routes', function ($trail,$location,$area,$speciality) {
    $trail->parent('doctors-by-city-area',$location,$area);
    $trail->push($speciality->slug, url($speciality->slug.'-in-pakistan'));
});
// Home > speciality-get-routes-gender
Breadcrumbs::for('speciality-get-routes-gender', function ($trail,$location,$area,$speciality) {
    $trail->parent('speciality-get-routes',$location,$area,$speciality);
    $trail->push('gender', url('/doctors'));
});
// Home > speciality-get-routes-gender-wise
Breadcrumbs::for('speciality-get-routes-gender-wise', function ($trail,$location,$area,$speciality,$gender_name) {
    $trail->parent('speciality-get-routes-gender',$location,$area,$speciality);
    $trail->push($gender_name, url('doctors/'.$location->slug.'/'.$area.'/'.$speciality->slug.'/gender/'.$gender_name));
});

// Home > doctor-profile
Breadcrumbs::for('doctor-profile', function ($trail,$location,$speciality,$user) {
    $trail->parent('speciality-by-doctor',$location,$speciality);
    $name = $user->first_name.' '.$user->last_name ;
    $trail->push($name, url('doctors/'.$location->slug.'/'.$speciality->slug.'/'.$user->slug));
});

// Home > hospital-profile-user
Breadcrumbs::for('hospital-profile-user', function ($trail,$location,$user) {
    $trail->parent('hospitals-city',$location);
    $name = $user->first_name.' '.$user->last_name ;
    $trail->push($name, url('/doctors'));
});

// Home > hospital-profile
Breadcrumbs::for('hospital-profile', function ($trail,$location,$user) {
    $trail->parent('hospital-profile-user',$location,$user);
    $name = "";
    $trail->push($name, url('hospitals/'.$location->slug.'/'.$user->slug));
});

// Home > lab-profile-user
Breadcrumbs::for('lab-profile-user', function ($trail,$location,$user) {
    $trail->parent('labs-city',$location);
    // $name = $user->first_name.' '.$user->last_name ;
    // $trail->push($name, url('/labs'));
});

// Home > lab-profile
Breadcrumbs::for('lab-profile', function ($trail,$location,$area,$user) {
    $trail->parent('lab-profile-user',$location,$user);
    $name = $user->first_name.' '.$user->last_name ;
    $trail->push($name, url('labs/'.$location->slug.'/'.$user->slug));
});
// Home > lab-profile
Breadcrumbs::for('test-detail', function ($trail,$location,$user,$test) {
    $trail->parent('home');
    $trail->push($user, route('laboratories-city-laboratory-area',[$location,$user]));
    $trail->push($test, route('laboratories-city-test',[$user,$test]));
  
});
// Home > all-doctors
Breadcrumbs::for('all-doctors', function ($trail) {
    $trail->parent('home');
    $trail->push('all doctors', url('all-doctors'));
});

// Home > all-hospitals
Breadcrumbs::for('all-hospitals', function ($trail) {
    $trail->parent('home');
    $trail->push('all hospitals', url('all-hospitals'));
});

// Home > search-results
Breadcrumbs::for('search-results', function ($trail) {
    $trail->parent('home');
    $trail->push('search results', url('search-results'));
});
Breadcrumbs::for(
    'searchResults', function ($trail) {
        $trail->parent('home');
        $trail->push(trans('lang.search_results'), route('searchResults'));
    }
);

Breadcrumbs::for(
    'showPage', function ($trail, $page) {
        $trail->parent('home');
        if (!empty($page)) {
            $trail->push($page->title, route('showPage', ['slug' => $page->slug]));
        }
    }
);

Breadcrumbs::for(
    'showArticle', function ($trail, $article) {
        $trail->parent('home');
        if (!empty($article)) {
            $trail->push($article->title, route('articleDetail', ['slug' => $article->slug]));
        }
    }
);

Breadcrumbs::for(
    'articleListing', function ($trail) {
        $trail->parent('home');
        $trail->push(trans('lang.article_listing'), route('articleListing'));
    }
);

Breadcrumbs::for(
    'userListing', function ($trail) {
        $trail->parent('home');
        $trail->push(trans('lang.users'), route('userListing'));
    }
);

Breadcrumbs::for(
    'userProfile', function ($trail, $user) {
        $trail->parent('home');
        $trail->push(trans('lang.profile'), route('userProfile', ['slug' => $user->slug]));
    }
);

Breadcrumbs::for(
    'forumQuestions', function ($trail) {
        $trail->parent('home');
        $trail->push(trans('lang.health_forum'), route('forumQuestions'));
    }
);

// Home > Pharmacy
Breadcrumbs::for('pharmacy', function ($trail) {
    $trail->parent('home');
    $trail->push('Pharmacy', route('pharmacy.index'));
});

// Home > Pharmacy > [Category]
Breadcrumbs::for('pharmacy-category', function ($trail, $category) {
    $trail->parent('pharmacy');
    $trail->push($category->name, route('pharmacy.category', $category->slug));
});


