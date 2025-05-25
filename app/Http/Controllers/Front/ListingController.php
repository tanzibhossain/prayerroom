<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\EmailTemplate;
use App\Models\GeneralSetting;
use App\Models\Listing;
use App\Models\ListingAdditionalFeature;
use App\Models\ListingAmenity;
use App\Models\ListingReligion;
use App\Models\ListingCategory;
use App\Models\ListingLocation;
use App\Models\ListingPhoto;
use App\Models\ListingSocialItem;
use App\Models\ListingVideo;
use App\Models\Amenity;
use App\Models\Religion;
use App\Models\PageListingCategoryItem;
use App\Models\PageListingItem;
use App\Models\PageListingLocationItem;
use App\Models\Review;
use App\Models\Wishlist;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Pagination\Paginator;

class ListingController extends Controller
{
	public function index() {
        abort(404);
	}

    public function detail($slug) {
        $g_setting = GeneralSetting::where('id', 1)->first();
        $currentDate = date('Y-m-d');

        $detail = Listing::with('rListingLocation', 'rListingCategory')
            ->where('listing_slug', $slug)
            ->first();

        if (!$detail) {
            return redirect()->route('front_home')->with('error', ERR_LISTING_NOT_FOUND);
        }

        $listingValid = DB::table('listings')
            ->leftJoin('package_purchases', function($join) use ($currentDate) {
                $join->on('listings.user_id', '=', 'package_purchases.user_id')
                    ->where('package_purchases.package_end_date', '>=', $currentDate)
                    ->where('package_purchases.currently_active', '=', 1);
            })
            ->where('listings.listing_slug', $slug)
            ->where(function($query) use ($currentDate) {
                $query->where(function($subQuery) use ($currentDate) {
                    $subQuery->where('listings.user_id', '>', 0)
                        ->where('package_purchases.package_end_date', '>=', $currentDate)
                        ->where('package_purchases.currently_active', '=', 1);
                })
                ->orWhere('listings.admin_id', '>', 0);
            })
            ->exists();

        if (!$listingValid || $detail->listing_status == 'Pending') {
            return redirect()->route('front_home');
        }

        // Additional data fetching
        $listing_social_items = ListingSocialItem::where('listing_id', $detail->id)->get();
        $listing_photos = ListingPhoto::where('listing_id', $detail->id)->get();
        $listing_videos = ListingVideo::where('listing_id', $detail->id)->get();
        $listing_amenities = ListingAmenity::where('listing_id', $detail->id)->get();
        $listing_religions = ListingReligion::where('listing_id', $detail->id)->get();

        $listing_additional_features = ListingAdditionalFeature::where('listing_id', $detail->id)->get();
        $listing_categories = ListingCategory::orderBy('listing_category_name', 'asc')->get();
        $listing_locations = ListingLocation::orderBy('listing_location_name', 'asc')->get();

        $reviews = Review::where('listing_id', $detail->id)->orderBy('id', 'asc')->get();

        // Calculate overall rating
        $overall_rating = 0;
        if (!$reviews->isEmpty()) {
            $total_number = $reviews->sum('rating');
            $count = $reviews->count();
            $average = $total_number / $count;

            $overall_rating = round($average * 2) / 2; // rounds to nearest 0.5 (1, 1.5, 2, ... 5)
        }

        // Agent details
        $agent_detail = $detail->user_id == 0
            ? Admin::where('id', $detail->admin_id)->first()
            : User::where('id', $detail->user_id)->first();

        $current_auth_user_id = Auth::check() ? Auth::user()->id : 0;

        $already_given = Review::where('listing_id', $detail->id)
            ->where('agent_id', $current_auth_user_id)
            ->where('agent_type', 'Customer')
            ->count();

        return view('front.listing_detail', compact(
            'detail',
            'g_setting',
            'listing_social_items',
            'listing_photos',
            'listing_videos',
            'listing_amenities',
            'listing_religions',
            'listing_additional_features',
            'listing_categories',
            'listing_locations',
            'agent_detail',
            'reviews',
            'current_auth_user_id',
            'already_given',
            'overall_rating'
        ));
    }


    public function category_detail($slug) {
    	$g_setting = GeneralSetting::where('id', 1)->first();
        $listing_category_page_data = PageListingCategoryItem::where('id', 1)->first();
        $listing_category_detail = ListingCategory::where('listing_category_slug',$slug)->first();
    	$currentDate = date('Y-m-d');
        $listing_items = Listing::with('rListingCategory', 'rListingLocation')
            ->leftJoin('package_purchases', function($join) use ($currentDate) {
                $join->on('listings.user_id', '=', 'package_purchases.user_id')
                    ->where('package_purchases.package_end_date', '>=', $currentDate)
                    ->where('package_purchases.currently_active', '=', 1);
            })
            ->where('listing_category_id', $listing_category_detail->id)
            ->where('listing_status', 'Active')
            ->where(function($query) use ($currentDate) {
                $query->where(function($subQuery) use ($currentDate) {
                    $subQuery->where('listings.user_id', '>', 0)
                            ->where('package_purchases.package_end_date', '>=', $currentDate)
                            ->where('package_purchases.currently_active', '=', 1);
                })
                ->orWhere('listings.admin_id', '>', 0);
            })
            ->select('listings.*') // Ensure we only select the listings columns
            ->paginate(15);
    	return view('front.listing_category_detail', compact('g_setting', 'listing_category_detail', 'listing_items', 'listing_category_page_data'));
    }

    public function location_all() {
        $g_setting = GeneralSetting::where('id', 1)->first();
        $listing_location_page_data = PageListingLocationItem::where('id', 1)->first();

        $currentDate = date('Y-m-d');

        $orderwise_listing_locations = ListingLocation::select(
            'listing_locations.id',
            'listing_locations.listing_location_name',
            'listing_locations.listing_location_slug',
            'listing_locations.listing_location_photo',
            DB::raw('COUNT(listings.id) as listings_count')
        )
        ->leftJoin('listings', 'listing_locations.id', '=', 'listings.listing_location_id')
        ->leftJoin('package_purchases', function($join) use ($currentDate) {
            $join->on('listings.user_id', '=', 'package_purchases.user_id')
                 ->where('package_purchases.package_end_date', '>=', $currentDate)
                 ->where('package_purchases.currently_active', '=', 1);
        })
        ->where(function($query) use ($currentDate) {
            $query->where(function($subQuery) use ($currentDate) {
                $subQuery->where('listings.user_id', '>', 0)
                         ->where('package_purchases.package_end_date', '>=', $currentDate)
                         ->where('package_purchases.currently_active', '=', 1);
            })
            ->orWhere('listings.admin_id', '>', 0);
        })
        ->groupBy('listing_locations.id', 'listing_locations.listing_location_name', 'listing_locations.listing_location_slug', 'listing_locations.listing_location_photo')
        ->orderBy('listings_count', 'desc')
        ->get();


        return view('front.listing_locations', compact('g_setting', 'listing_location_page_data', 'orderwise_listing_locations'));
    }

    public function location_detail($slug) {
        $g_setting = GeneralSetting::where('id', 1)->first();
        $listing_location_page_data = PageListingLocationItem::where('id', 1)->first();
        $listing_location_detail = ListingLocation::where('listing_location_slug',$slug)->first();
        $currentDate = date('Y-m-d');
        $listing_items = Listing::with('rListingCategory', 'rListingLocation')
            ->leftJoin('package_purchases', function($join) use ($currentDate) {
                $join->on('listings.user_id', '=', 'package_purchases.user_id')
                    ->where('package_purchases.package_end_date', '>=', $currentDate)
                    ->where('package_purchases.currently_active', '=', 1);
            })
            ->where('listing_location_id', $listing_location_detail->id)
            ->where('listing_status', 'Active')
            ->where(function($query) use ($currentDate) {
                $query->where(function($subQuery) use ($currentDate) {
                    $subQuery->where('listings.user_id', '>', 0)
                            ->where('package_purchases.package_end_date', '>=', $currentDate)
                            ->where('package_purchases.currently_active', '=', 1);
                })
                ->orWhere('listings.admin_id', '>', 0);
            })
            ->select('listings.*') // Ensure we only select the listings columns
            ->paginate(15);
        return view('front.listing_location_detail', compact('g_setting', 'listing_location_detail', 'listing_items', 'listing_location_page_data'));
    }

    public function agent_detail($type,$id) {

        $g_setting = GeneralSetting::where('id', 1)->first();

        if ($type == 'admin') {
            $agent_detail = Admin::where('id', $id)->first();
            $all_listings = Listing::with('rListingCategory', 'rListingLocation')
                ->where('admin_id', $id)
                ->where('listing_status', 'Active')
                ->paginate(15);
        } else {
            $agent_detail = User::where('id', $id)->first();

            $currentDate = date('Y-m-d');
            $isExpired = DB::table('package_purchases')
                ->where('user_id', $id)
                ->where('package_end_date', '>=', $currentDate)
                ->where('currently_active', '=', 1)
                ->doesntExist();

            if ($isExpired) {
                return redirect()->route('front_home')->with('error', 'Access expired.');
            }

            $all_listings = Listing::with('rListingCategory', 'rListingLocation')
                ->where('user_id', $id)
                ->where('listing_status', 'Active')
                ->paginate(15);
        }
    	return view('front.listing_agent_detail', compact('g_setting','agent_detail','all_listings'));
    }

    public function listing_result(Request $request)
    {
        $g_setting = GeneralSetting::where('id', 1)->first();
        $listing_page_data = PageListingItem::where('id', 1)->first();
        $listing_categories = ListingCategory::get();
        $listing_locations = ListingLocation::get();
        $amenities = Amenity::get();
        $religions = Religion::get();

        $all_text = $request->text;
        $category_ids = $request->category ? explode(',', $request->category) : [];
        $location_ids = $request->location ? explode(',', $request->location) : [];
        $amenity_ids = $request->amenity ? explode(',', $request->amenity) : [];
        $religion_ids = $request->religion ? explode(',', $request->religion) : [];

        $category_counts = DB::table('listings')
            ->select('listing_category_id', DB::raw('count(*) as count'))
            ->groupBy('listing_category_id')
            ->pluck('count', 'listing_category_id')->toArray();

        $location_counts = DB::table('listings')
            ->select('listing_location_id', DB::raw('count(*) as count'))
            ->groupBy('listing_location_id')
            ->pluck('count', 'listing_location_id')->toArray();

        $amenity_counts = DB::table('listing_amenities')
            ->select('amenity_id', DB::raw('count(*) as count'))
            ->groupBy('amenity_id')
            ->pluck('count', 'amenity_id')->toArray();

        $religion_counts = DB::table('listing_religions')
            ->select('religion_id', DB::raw('count(*) as count'))
            ->groupBy('religion_id')
            ->pluck('count', 'religion_id')->toArray();

        $currentDate = date('Y-m-d');
        $listing_items = DB::table('listings');

        if ($request->text != '') {
            $matchedCategoryIds = ListingCategory::where('listing_category_name', 'LIKE', '%' . $request->text . '%')->pluck('id')->toArray();
            $matchedLocationIds = ListingLocation::where('listing_location_name', 'LIKE', '%' . $request->text . '%')->pluck('id')->toArray();

            $listing_items = $listing_items->where(function ($query) use ($request, $matchedCategoryIds, $matchedLocationIds) {
                $query->where('listings.listing_name', 'LIKE', '%' . $request->text . '%');

                if (!empty($matchedCategoryIds)) {
                    $query->orWhereIn('listings.listing_category_id', $matchedCategoryIds);
                }

                if (!empty($matchedLocationIds)) {
                    $query->orWhereIn('listings.listing_location_id', $matchedLocationIds);
                }
            });
        }

        if (!empty($category_ids)) {
            $listing_items = $listing_items->whereIn('listings.listing_category_id', $category_ids);
        }

        if (!empty($location_ids)) {
            $listing_items = $listing_items->whereIn('listings.listing_location_id', $location_ids);
        }

        if (!empty($amenity_ids)) {
            $listing_items = $listing_items
                ->join('listing_amenities', 'listings.id', '=', 'listing_amenities.listing_id')
                ->whereIn('listing_amenities.amenity_id', $amenity_ids);
        }

        if (!empty($religion_ids)) {
            $listing_items = $listing_items
                ->join('listing_religions', 'listings.id', '=', 'listing_religions.listing_id')
                ->whereIn('listing_religions.religion_id', $religion_ids);
        }

        $listing_items = $listing_items
            ->join('listing_categories', 'listings.listing_category_id', '=', 'listing_categories.id')
            ->join('listing_locations', 'listings.listing_location_id', '=', 'listing_locations.id')
            ->leftJoin('package_purchases', function($join) use ($currentDate) {
                $join->on('listings.user_id', '=', 'package_purchases.user_id')
                    ->where('package_purchases.package_end_date', '>=', $currentDate)
                    ->where('package_purchases.currently_active', '=', 1);
            })
            ->where(function($query) use ($currentDate) {
                $query->where(function($subQuery) use ($currentDate) {
                    $subQuery->where('listings.user_id', '>', 0)
                        ->where('package_purchases.package_end_date', '>=', $currentDate)
                        ->where('package_purchases.currently_active', '=', 1);
                })
                ->orWhere('listings.admin_id', '>', 0);
            })
            ->where('listings.listing_status', 'Active')
            ->select(
                'listings.*',
                'listing_categories.listing_category_name',
                'listing_categories.listing_category_slug',
                'listing_locations.listing_location_name',
                'listing_locations.listing_location_slug'
            )
            ->groupBy('listings.id')
            ->paginate(4);

        return view('front.listing_result', compact(
            'g_setting',
            'listing_page_data',
            'listing_items',
            'listing_categories',
            'listing_locations',
            'amenities',
            'religions',
            'all_text',
            'category_ids',
            'location_ids',
            'amenity_ids',
            'religion_ids',
            'category_counts',
            'location_counts',
            'amenity_counts',
            'religion_counts'
        ));
    }



    public function send_message(Request $request) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $g_setting = GeneralSetting::where('id', 1)->first();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ], [
            'name.required' => ERR_NAME_REQUIRED,
            'email.required' => ERR_EMAIL_REQUIRED,
            'email.email' => ERR_EMAIL_INVALID,
            'message.required' => ERR_MESSAGE_REQUIRED
        ]);

        if($g_setting->google_recaptcha_status == 'Show') {
            $request->validate([
                'g-recaptcha-response' => 'required'
            ], [
                'g-recaptcha-response.required' => ERR_RECAPTCHA_REQUIRED
            ]);
        }

        $listing_name = $request->listing_name;
        $listing_url = '<a href="'.url('listing/'.$request->listing_slug).'">'.url('listing/'.$request->listing_slug).'</a>';
        $agent_name = $request->agent_name;

        // Send Email
        $email_template_data = EmailTemplate::where('id', 9)->first();
        $subject = $email_template_data->et_subject;
        $message = $email_template_data->et_content;

        $message = str_replace('[[agent_name]]', $agent_name, $message);
        $message = str_replace('[[listing_name]]', $listing_name, $message);
        $message = str_replace('[[listing_url]]', $listing_url, $message);
        $message = str_replace('[[name]]', $request->name, $message);
        $message = str_replace('[[email]]', $request->email, $message);
        $message = str_replace('[[phone]]', $request->phone, $message);
        $message = str_replace('[[message]]', $request->message, $message);

        Mail::to($request->agent_email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success', SUCCESS_MESSAGE_SENT);
    }

    public function report_listing(Request $request) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $g_setting = GeneralSetting::where('id', 1)->first();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ], [
            'name.required' => ERR_NAME_REQUIRED,
            'email.required' => ERR_EMAIL_REQUIRED,
            'email.email' => ERR_EMAIL_INVALID,
            'message.required' => ERR_MESSAGE_REQUIRED,
        ]);

        if($g_setting->google_recaptcha_status == 'Show') {
            $request->validate([
                'g-recaptcha-response' => 'required'
            ], [
                'g-recaptcha-response.required' => ERR_RECAPTCHA_REQUIRED
            ]);
        }

        $listing_name = $request->listing_name;
        $listing_url = '<a href="'.url('listing/'.$request->listing_slug).'">'.url('listing/'.$request->listing_slug).'</a>';

        // Send Email
        $email_template_data = EmailTemplate::where('id', 10)->first();
        $subject = $email_template_data->et_subject;
        $message = $email_template_data->et_content;

        $message = str_replace('[[listing_name]]', $listing_name, $message);
        $message = str_replace('[[listing_url]]', $listing_url, $message);
        $message = str_replace('[[name]]', $request->name, $message);
        $message = str_replace('[[email]]', $request->email, $message);
        $message = str_replace('[[phone]]', $request->phone, $message);
        $message = str_replace('[[message]]', $request->message, $message);

        $admin_data = Admin::where('id',1)->first();

        Mail::to($admin_data->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success', SUCCESS_REPORT_SENT);
    }

    public function wishlist_add($id) {

        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

	    if(Auth::user() == null) {
            return redirect()->back()->with('error', ERR_LOGIN_FIRST);
        }

	    $check_previous = Wishlist::where('listing_id',$id)->count();
	    if($check_previous > 0) {
            return redirect()->back()->with('error', ERR_ALREADY_TO_WISHLIST);
        }

	    $user_data = Auth::guard('web')->user();

        $obj = new Wishlist;
        $obj->user_id = $user_data->id;
        $obj->listing_id = $id;
        $obj->save();

        return redirect()->back()->with('success', SUCCESS_WISHLIST_ADD);
    }
}
