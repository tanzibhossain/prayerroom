<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\PageHomeItem;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\ListingCategory;
use App\Models\ListingLocation;
use DB;

class HomeController extends Controller
{
    public function index() {
    	$page_home_items = PageHomeItem::where('id',1)->first();

        $listing_categories = ListingCategory::orderBy('listing_category_name','asc')->get();
        $listing_locations = ListingLocation::orderBy('listing_location_name','asc')->get();

        $currentDate = date('Y-m-d');

        $orderwise_listing_categories = ListingCategory::select(
            'listing_categories.id',
            'listing_categories.listing_category_name',
            'listing_categories.listing_category_slug',
            'listing_categories.listing_category_photo',
            DB::raw('COUNT(listings.id) as listings_count')
        )
        ->leftJoin('listings', 'listing_categories.id', '=', 'listings.listing_category_id')
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
        ->groupBy('listing_categories.id', 'listing_categories.listing_category_name', 'listing_categories.listing_category_slug', 'listing_categories.listing_category_photo')
        ->orderBy('listings_count', 'desc')
        ->get();


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

        $listings = Listing::with('rListingCategory', 'rListingLocation')
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
            ->where('listing_status', 'Active')
            ->where('is_featured', 'Yes')
            ->orderBy('listing_name', 'asc')
            ->select('listings.*') // Ensure we only select the listings columns
            ->get();

        return view('front.index', compact('page_home_items','orderwise_listing_categories','orderwise_listing_locations','listings','listing_categories','listing_locations'));
    }
}
