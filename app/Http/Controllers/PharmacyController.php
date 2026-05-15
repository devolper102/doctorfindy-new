<?php

namespace App\Http\Controllers;

use App\Models\MedicineCategory;
use App\Models\MedicineSubcategory;
use App\Models\PharmacyMedicine;
use App\User;
use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class PharmacyController extends Controller
{
    /**
     * Display the pharmacy page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get active categories (or all if status field doesn't exist or is null)
        $categories = MedicineCategory::where(function($query) {
                $query->where('status', 'active')
                      ->orWhereNull('status');
            })
            ->with('subcategories')
            ->orderBy('name', 'asc')
            ->get();

        // Get top selling products (by rating or sales - adjust as needed)
        $topSellingProducts = PharmacyMedicine::where(function($query) {
                $query->where('status', 'active')
                      ->orWhereNull('status');
            })
            ->with(['category', 'subcategory'])
            ->orderBy('rating', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(12)
            ->get();
        
        // Ensure all medicines have slugs
        foreach ($topSellingProducts as $medicine) {
            $medicine->ensureSlug();
        }

        // Get all medicines for "Explore all Medicines" section
        $allMedicines = PharmacyMedicine::where(function($query) {
                $query->where('status', 'active')
                      ->orWhereNull('status');
            })
            ->with(['category', 'subcategory'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        // Ensure all medicines have slugs
        foreach ($allMedicines as $medicine) {
            $medicine->ensureSlug();
        }

        // Get logged user if any
        $user = Auth::check() ? User::where('id', Auth::id())->with('profile', 'roles')->first() : null;
        if ($user && !$user->profile) {
            $user->profile = (object)['avatar' => null];
        }
        $logged_user = $user ? $user : [];
        
        // Get other data needed for the page
        $locations = \App\Location::select('id', 'title', 'slug')->get();
        $specialities = \App\Speciality::select('id', 'title', 'slug', 'image')->orderBy("created_at", "asc")->limit(8)->get();
        $services = \App\Service::select('id', 'title', 'slug', 'image')->latest()->limit(4)->get();
        $diseases = \App\Disease::select('id', 'title', 'slug', 'flag')->latest()->limit(4)->get();
        $doctors = \App\User::role('doctor')->with('location', 'specialities')->orderBy("trending", "desc")->limit(4)->get();
        $hospitals = \App\User::role('hospital')->orderBy("trending", "desc")->with('location')->limit(6)->get();
        $laboratories = \App\User::role('laboratory')->with('location')->limit(6)->get();
        $managements = \App\SiteManagement::select('meta_key', 'meta_value')->get();

        return View::make('front-end.pharmacy.index', compact(
            'categories',
            'topSellingProducts',
            'allMedicines',
            'logged_user',
            'locations',
            'specialities',
            'services',
            'diseases',
            'doctors',
            'hospitals',
            'laboratories',
            'managements'
        ));
    }

    /**
     * Display the category detail page with subcategories and medicines.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function category($slug)
    {
        // Get category by slug
        $category = MedicineCategory::where('slug', $slug)
            ->where(function($query) {
                $query->where('status', 'active')
                      ->orWhereNull('status');
            })
            ->with('subcategories')
            ->firstOrFail();

        // Get subcategories for this category
        $subcategories = MedicineSubcategory::where('category_id', $category->id)
            ->where(function($query) {
                $query->where('status', 'active')
                      ->orWhereNull('status');
            })
            ->orderBy('name', 'asc')
            ->get();

        // Get all medicines for this category (will be filtered by subcategory via AJAX or query param)
        $subcategorySlug = request()->get('subcategory');
        $medicinesQuery = PharmacyMedicine::where('medicine_category_id', $category->id)
            ->where(function($query) {
                $query->where('status', 'active')
                      ->orWhereNull('status');
            })
            ->with(['category', 'subcategory']);

        // Filter by subcategory if provided
        if ($subcategorySlug) {
            $subcategory = MedicineSubcategory::where('slug', $subcategorySlug)
                ->where('category_id', $category->id)
                ->first();
            if ($subcategory) {
                $medicinesQuery->where('medicine_subcategory_id', $subcategory->id);
            }
        }

        $medicines = $medicinesQuery->orderBy('created_at', 'desc')->paginate(20);
        
        // Ensure all medicines have slugs
        foreach ($medicines as $medicine) {
            $medicine->ensureSlug();
        }

        // Get logged user if any
        $user = Auth::check() ? User::where('id', Auth::id())->with('profile', 'roles')->first() : null;
        if ($user && !$user->profile) {
            $user->profile = (object)['avatar' => null];
        }
        $logged_user = $user ? $user : [];
        
        // Get other data needed for the page
        $locations = \App\Location::select('id', 'title', 'slug')->get();
        $specialities = \App\Speciality::select('id', 'title', 'slug', 'image')->orderBy("created_at", "asc")->limit(8)->get();
        $services = \App\Service::select('id', 'title', 'slug', 'image')->latest()->limit(4)->get();
        $diseases = \App\Disease::select('id', 'title', 'slug', 'flag')->latest()->limit(4)->get();
        $doctors = \App\User::role('doctor')->with('location', 'specialities')->orderBy("trending", "desc")->limit(4)->get();
        $hospitals = \App\User::role('hospital')->orderBy("trending", "desc")->with('location')->limit(6)->get();
        $laboratories = \App\User::role('laboratory')->with('location')->limit(6)->get();
        $managements = \App\SiteManagement::select('meta_key', 'meta_value')->get();

        return View::make('front-end.pharmacy.category', compact(
            'category',
            'subcategories',
            'medicines',
            'logged_user',
            'locations',
            'specialities',
            'services',
            'diseases',
            'doctors',
            'hospitals',
            'laboratories',
            'managements'
        ));
    }

    /**
     * Display the medicine detail page.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function medicine($slug)
    {
        // Get medicine by slug
        $medicine = PharmacyMedicine::where('slug', $slug)
            ->where(function($query) {
                $query->where('status', 'active')
                      ->orWhereNull('status');
            })
            ->with(['category', 'subcategory', 'details'])
            ->firstOrFail();
        
        // Ensure medicine has slug (in case it was missing)
        $medicine->ensureSlug();

        // Get related medicines (same category)
        $relatedMedicines = PharmacyMedicine::where('medicine_category_id', $medicine->medicine_category_id)
            ->where('id', '!=', $medicine->id)
            ->where(function($query) {
                $query->where('status', 'active')
                      ->orWhereNull('status');
            })
            ->with(['category', 'subcategory'])
            ->limit(8)
            ->get();

        // Get logged user if any
        $user = Auth::check() ? User::where('id', Auth::id())->with('profile', 'roles')->first() : null;
        if ($user && !$user->profile) {
            $user->profile = (object)['avatar' => null];
        }
        $logged_user = $user ? $user : [];
        
        // Get other data needed for the page
        $locations = \App\Location::select('id', 'title', 'slug')->get();
        $specialities = \App\Speciality::select('id', 'title', 'slug', 'image')->orderBy("created_at", "asc")->limit(8)->get();
        $services = \App\Service::select('id', 'title', 'slug', 'image')->latest()->limit(4)->get();
        $diseases = \App\Disease::select('id', 'title', 'slug', 'flag')->latest()->limit(4)->get();
        $doctors = \App\User::role('doctor')->with('location', 'specialities')->orderBy("trending", "desc")->limit(4)->get();
        $hospitals = \App\User::role('hospital')->orderBy("trending", "desc")->with('location')->limit(6)->get();
        $laboratories = \App\User::role('laboratory')->with('location')->limit(6)->get();
        $managements = \App\SiteManagement::select('meta_key', 'meta_value')->get();

        return View::make('front-end.pharmacy.medicine', compact(
            'medicine',
            'relatedMedicines',
            'logged_user',
            'locations',
            'specialities',
            'services',
            'diseases',
            'doctors',
            'hospitals',
            'laboratories',
            'managements'
        ));
    }
}

