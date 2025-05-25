<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CustomerController as CustomerControllerForAdmin;
use App\Http\Controllers\Admin\DashboardController as DashboardControllerForAdmin;
use App\Http\Controllers\Admin\DynamicPageController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\LoginController as LoginControllerForAdmin;
use App\Http\Controllers\Admin\PageAboutController;
use App\Http\Controllers\Admin\PageBlogController;
use App\Http\Controllers\Admin\PageContactController;
use App\Http\Controllers\Admin\PagePricingController;
use App\Http\Controllers\Admin\PageListingCategoryController;
use App\Http\Controllers\Admin\PageListingLocationController;
use App\Http\Controllers\Admin\PageListingController;
use App\Http\Controllers\Admin\PageFaqController;
use App\Http\Controllers\Admin\PageHomeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PageOtherController;
use App\Http\Controllers\Admin\PagePrivacyController;
use App\Http\Controllers\Admin\PageTermController;
use App\Http\Controllers\Admin\CategoryController as CategoryControllerForAdmin;
use App\Http\Controllers\Admin\BlogController as BlogControllerForAdmin;
use App\Http\Controllers\Admin\AmenityController as AmenityControllerForAdmin;
use App\Http\Controllers\Admin\ReligionController as ReligionControllerForAdmin;
use App\Http\Controllers\Admin\ListingCategoryController as ListingCategoryControllerForAdmin;
use App\Http\Controllers\Admin\ListingLocationController as ListingLocationControllerForAdmin;
use App\Http\Controllers\Admin\ListingController as ListingControllerForAdmin;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SocialMediaItemController;
use App\Http\Controllers\Admin\FaqController as FaqControllerForAdmin;
use App\Http\Controllers\Admin\PackageController as PackageControllerForAdmin;
use App\Http\Controllers\Admin\PurchaseHistoryController as PurchaseHistoryControllerForAdmin;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\ClearDatabaseController;


use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\PricingController;
use App\Http\Controllers\Front\BlogController as BlogControllerForFront;
use App\Http\Controllers\Front\CategoryController as CategoryControllerForFront;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\FaqController as FaqControllerForFront;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Front\PrivacyController;
use App\Http\Controllers\Front\TermController;
use App\Http\Controllers\Front\CustomerAuthController;
use App\Http\Controllers\Front\CustomerController as CustomerControllerForFront;
use App\Http\Controllers\Front\ListingController as ListingControllerForFront;


Route::get('/', [HomeController::class,'index'])->name('front_home');
Route::get('about', [AboutController::class,'index'])->name('front_about');
Route::get('pricing', [PricingController::class,'index'])->name('front_pricing');
Route::get('blog', [BlogControllerForFront::class,'index'])->name('front_blogs');
Route::get('post/{slug}', [BlogControllerForFront::class,'detail'])->name('front_post');
Route::post('post/comment', [BlogControllerForFront::class,'comment'])->name('front_comment');
Route::get('category/{slug}', [CategoryControllerForFront::class,'detail'])->name('front_category');
// Route::post('search', [SearchController::class,'index']);
// Route::get('search', function() {abort(404);});
Route::get('faq', [FaqControllerForFront::class,'index'])->name('front_faq');
Route::get('page/{slug}', [PageController::class,'detail'])->name('front_dynamic_page');
Route::get('contact', [ContactController::class,'index'])->name('front_contact');
Route::post('contact/store', [ContactController::class,'send_email'])->name('front_contact_form');
Route::get('terms-and-conditions', [TermController::class,'index'])->name('front_terms_and_conditions');
Route::get('privacy-policy', [PrivacyController::class,'index'])->name('front_privacy_policy');
Route::get('listing/{slug}', [ListingControllerForFront::class,'detail'])->name('front_listing_detail');
Route::post('listing/listing/send-message', [ListingControllerForFront::class,'send_message'])->name('front_listing_detail_send_message');
Route::post('listing/listing/report-listing', [ListingControllerForFront::class,'report_listing'])->name('front_listing_detail_report_listing');
Route::get('listing/category/all', [ListingControllerForFront::class,'category_all'])->name('front_listing_category_all');
Route::get('listing/category/{slug}', [ListingControllerForFront::class,'category_detail'])->name('front_listing_category_detail');
Route::get('listing/location/all', [ListingControllerForFront::class,'location_all'])->name('front_listing_location_all');
Route::get('listing/location/{slug}', [ListingControllerForFront::class,'location_detail'])->name('front_listing_location_detail');
Route::get('agent/{type}/{id}', [ListingControllerForFront::class,'agent_detail'])->name('front_listing_agent_detail');
Route::get('listing-result', [ListingControllerForFront::class,'listing_result'])->name('front_listing_result');
Route::get('customer/wishlist/add/{id}', [ListingControllerForFront::class,'wishlist_add'])->name('front_add_wishlist');



Route::prefix('customer')->group(function () {
    Route::get('login', [CustomerAuthController::class,'login'])->name('customer_login');
    Route::post('login/store', [CustomerAuthController::class,'login_store'])->name('customer_login_store');
    Route::get('logout', [CustomerAuthController::class,'logout'])->name('customer_logout');
    Route::get('register', [CustomerAuthController::class,'registration'])->name('customer_registration');
    Route::post('registration/store', [CustomerAuthController::class,'registration_store'])->name('customer_registration_store');
    Route::get('registration/verify/{token}/{email}', [CustomerAuthController::class,'registration_verify'])->name('customer_registration_verify');
    Route::get('forget-password', [CustomerAuthController::class,'forget_password'])->name('customer_forget_password');
    Route::post('forget-password/store', [CustomerAuthController::class,'forget_password_store'])->name('customer_forget_password_store');
    Route::get('reset-password/{token}/{email}', [CustomerAuthController::class,'reset_password']);
    Route::post('reset-password/update', [CustomerAuthController::class,'reset_password_update'])->name('customer_reset_password_update');
});



// User or Customer
Route::middleware('auth')->prefix('customer')->group(function () {
    Route::get('dashboard', [CustomerControllerForFront::class,'dashboard'])->name('customer_dashboard');
    Route::get('package', [CustomerControllerForFront::class,'package'])->name('customer_package');
    Route::get('package/free/{id}', [CustomerControllerForFront::class,'free_enroll'])->name('customer_package_free_enroll');
    Route::get('package/paid/buy/{id}', [CustomerControllerForFront::class,'buy_package'])->name('customer_package_buy');


    // Stripe
    Route::post('payment/stripe', [CustomerControllerForFront::class,'stripe'])->name('stripe');
    Route::get('payment/stripe-success', [CustomerControllerForFront::class, 'stripe_success'])->name('stripe_success');
    Route::get('payment/stripe-cancel', [CustomerControllerForFront::class, 'stripe_cancel'])->name('stripe_cancel');

    // PayPal
    Route::post('payment/paypal', [CustomerControllerForFront::class, 'paypal'])->name('paypal');
    Route::get('payment/paypal-success', [CustomerControllerForFront::class, 'paypal_success'])->name('paypal_success');
    Route::get('payment/paypal-cancel', [CustomerControllerForFront::class, 'paypal_cancel'])->name('paypal_cancel');


    Route::post('payment/bank', [CustomerControllerForFront::class,'bank'])->name('customer_payment_bank');

    Route::get('package/purchase/history', [CustomerControllerForFront::class,'purchase_history'])->name('customer_package_purchase_history');
    Route::get('package/purchase/{id}', [CustomerControllerForFront::class,'purchase_history_detail'])->name('customer_package_purchase_history_detail');
    Route::get('package/invoice/{id}', [CustomerControllerForFront::class,'invoice'])->name('customer_package_purchase_invoice');
    Route::get('profile-change', [CustomerControllerForFront::class,'update_profile'])->name('customer_update_profile');
    Route::post('profile-change/update', [CustomerControllerForFront::class,'update_profile_confirm'])->name('customer_update_profile_confirm');
    Route::get('password-change', [CustomerControllerForFront::class,'update_password'])->name('customer_update_password');
    Route::post('password-change/update', [CustomerControllerForFront::class,'update_password_confirm'])->name('customer_update_password_confirm');
    Route::get('photo-change', [CustomerControllerForFront::class,'update_photo'])->name('customer_update_photo');
    Route::post('photo-change/update', [CustomerControllerForFront::class,'update_photo_confirm'])->name('customer_update_photo_confirm');
    Route::get('banner-change', [CustomerControllerForFront::class,'update_banner'])->name('customer_update_banner');
    Route::post('banner-change/update', [CustomerControllerForFront::class,'update_banner_confirm'])->name('customer_update_banner_confirm');
    Route::get('listing/view', [CustomerControllerForFront::class,'listing_view'])->name('customer_listing_view');
    Route::get('listing-search-result', [CustomerControllerForFront::class,'search_result'])->name('customer_listing_search');
    Route::get('listing/detail/{id}', [CustomerControllerForFront::class,'listing_view_detail'])->name('customer_listing_view_detail');
    Route::get('listing/add', [CustomerControllerForFront::class,'listing_add'])->name('customer_listing_add');
    Route::post('listing/add/store', [CustomerControllerForFront::class,'listing_add_store'])->name('customer_listing_add_store');
    Route::get('listing/delete/{id}', [CustomerControllerForFront::class,'listing_delete'])->name('customer_listing_delete');
    Route::get('listing/edit/{id}', [CustomerControllerForFront::class,'listing_edit'])->name('customer_listing_edit');
    Route::post('listing/update/{id}', [CustomerControllerForFront::class,'listing_update'])->name('customer_listing_update');
    Route::get('reviews', [CustomerControllerForFront::class,'my_reviews'])->name('customer_my_reviews');
    Route::get('review/edit/{id}', [CustomerControllerForFront::class,'review_edit'])->name('customer_my_review_edit');
    Route::post('review/update/{id}', [CustomerControllerForFront::class,'review_update'])->name('customer_my_review_update');
    Route::get('review/delete/{id}', [CustomerControllerForFront::class,'review_delete'])->name('customer_my_review_delete');
    Route::get('wishlist', [CustomerControllerForFront::class,'wishlist'])->name('customer_wishlist');
    Route::get('wishlist/delete/{id}', [CustomerControllerForFront::class,'wishlist_delete'])->name('customer_wishlist_delete');
    Route::get('listing/delete-social-item/{id}', [CustomerControllerForFront::class,'listing_delete_social_item'])->name('customer_listing_delete_social_item');
    Route::get('listing/delete-photo/{id}', [CustomerControllerForFront::class,'listing_delete_photo'])->name('customer_listing_delete_photo');
    Route::get('listing/delete-video/{id}', [CustomerControllerForFront::class,'listing_delete_video'])->name('customer_listing_delete_video');
    Route::get('listing/delete-additional-feature/{id}', [CustomerControllerForFront::class,'listing_delete_additional_feature'])->name('customer_listing_delete_additional_feature');
    Route::post('review', [CustomerControllerForFront::class,'submit_review'])->name('customer_review');
});


Route::get('admin', function () {return redirect('admin/login');});

// Admin
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardControllerForAdmin::class,'index'])->name('admin_dashboard');

    Route::get('password-change', [ProfileController::class,'password'])->name('admin_password_change');
    Route::post('password-change/update', [ProfileController::class,'password_update'])->name('admin_password_change_update');
    Route::get('profile-change', [ProfileController::class,'profile'])->name('admin_profile_change');
    Route::post('profile-change/update', [ProfileController::class,'profile_update'])->name('admin_profile_change_update');
    Route::get('photo-change', [ProfileController::class,'photo'])->name('admin_photo_change');
    Route::post('photo-change/update', [ProfileController::class,'photo_update'])->name('admin_photo_change_update');
    Route::get('banner-change', [ProfileController::class,'banner'])->name('admin_banner_change');
    Route::post('banner-change/update', [ProfileController::class,'banner_update'])->name('admin_banner_change_update');

    Route::get('payment/view', [SettingController::class,'payment_edit'])->name('admin_payment');
    Route::post('payment/update', [SettingController::class,'payment_update'])->name('admin_payment_update');

    Route::get('category/view', [CategoryControllerForAdmin::class,'index'])->name('admin_category_view');
    Route::get('category/create', [CategoryControllerForAdmin::class,'create'])->name('admin_category_create');
    Route::post('category/store', [CategoryControllerForAdmin::class,'store'])->name('admin_category_store');
    Route::get('category/delete/{id}', [CategoryControllerForAdmin::class,'destroy'])->name('admin_category_delete');
    Route::get('category/edit/{id}', [CategoryControllerForAdmin::class,'edit'])->name('admin_category_edit');
    Route::post('category/update/{id}', [CategoryControllerForAdmin::class,'update'])->name('admin_category_update');

    Route::get('blog/view', [BlogControllerForAdmin::class,'index'])->name('admin_blog_view');
    Route::get('blog/create', [BlogControllerForAdmin::class,'create'])->name('admin_blog_create');
    Route::post('blog/store', [BlogControllerForAdmin::class,'store'])->name('admin_blog_store');
    Route::get('blog/delete/{id}', [BlogControllerForAdmin::class,'destroy'])->name('admin_blog_delete');
    Route::get('blog/edit/{id}', [BlogControllerForAdmin::class,'edit'])->name('admin_blog_edit');
    Route::post('blog/update/{id}', [BlogControllerForAdmin::class,'update'])->name('admin_blog_update');

    Route::get('comment/approved', [CommentController::class,'approved'])->name('admin_comment_approved');
    Route::get('comment/make-pending/{id}', [CommentController::class,'make_pending'])->name('admin_comment_make_pending');
    Route::get('comment/pending', [CommentController::class,'pending'])->name('admin_comment_pending');
    Route::get('comment/make-approved/{id}', [CommentController::class,'make_approved'])->name('admin_comment_make_approved');
    Route::get('comment/delete/{id}', [CommentController::class,'destroy'])->name('admin_comment_delete');

    Route::get('dynamic-page/view', [DynamicPageController::class,'index'])->name('admin_dynamic_page_view');
    Route::get('dynamic-page/create', [DynamicPageController::class,'create'])->name('admin_dynamic_page_create');
    Route::post('dynamic-page/store', [DynamicPageController::class,'store'])->name('admin_dynamic_page_store');
    Route::get('dynamic-page/delete/{id}', [DynamicPageController::class,'destroy'])->name('admin_dynamic_page_delete');
    Route::get('dynamic-page/edit/{id}', [DynamicPageController::class,'edit'])->name('admin_dynamic_page_edit');
    Route::post('dynamic-page/update/{id}', [DynamicPageController::class,'update'])->name('admin_dynamic_page_update');

    Route::get('amenity/view', [AmenityControllerForAdmin::class,'index'])->name('admin_amenity_view');
    Route::get('amenity/create', [AmenityControllerForAdmin::class,'create'])->name('admin_amenity_create');
    Route::post('amenity/store', [AmenityControllerForAdmin::class,'store'])->name('admin_amenity_store');
    Route::get('amenity/delete/{id}', [AmenityControllerForAdmin::class,'destroy'])->name('admin_amenity_delete');
    Route::get('amenity/edit/{id}', [AmenityControllerForAdmin::class,'edit'])->name('admin_amenity_edit');
    Route::post('amenity/update/{id}', [AmenityControllerForAdmin::class,'update'])->name('admin_amenity_update');

    Route::get('religion/view', [ReligionControllerForAdmin::class, 'index'])->name('admin_religion_view');
    Route::get('religion/create', [ReligionControllerForAdmin::class, 'create'])->name('admin_religion_create');
    Route::post('religion/store', [ReligionControllerForAdmin::class, 'store'])->name('admin_religion_store');
    Route::get('religion/delete/{id}', [ReligionControllerForAdmin::class, 'destroy'])->name('admin_religion_delete');
    Route::get('religion/edit/{id}', [ReligionControllerForAdmin::class, 'edit'])->name('admin_religion_edit');
    Route::post('religion/update/{id}', [ReligionControllerForAdmin::class, 'update'])->name('admin_religion_update');

    Route::get('listing-category/view', [ListingCategoryControllerForAdmin::class,'index'])->name('admin_listing_category_view');
    Route::get('listing-category/create', [ListingCategoryControllerForAdmin::class,'create'])->name('admin_listing_category_create');
    Route::post('listing-category/store', [ListingCategoryControllerForAdmin::class,'store'])->name('admin_listing_category_store');
    Route::get('listing-category/delete/{id}', [ListingCategoryControllerForAdmin::class,'destroy'])->name('admin_listing_category_delete');
    Route::get('listing-category/edit/{id}', [ListingCategoryControllerForAdmin::class,'edit'])->name('admin_listing_category_edit');
    Route::post('listing-category/update/{id}', [ListingCategoryControllerForAdmin::class,'update'])->name('admin_listing_category_update');

    Route::get('listing-location/view', [ListingLocationControllerForAdmin::class,'index'])->name('admin_listing_location_view');
    Route::get('listing-location/create', [ListingLocationControllerForAdmin::class,'create'])->name('admin_listing_location_create');
    Route::post('listing-location/store', [ListingLocationControllerForAdmin::class,'store'])->name('admin_listing_location_store');
    Route::get('listing-location/delete/{id}', [ListingLocationControllerForAdmin::class,'destroy'])->name('admin_listing_location_delete');
    Route::get('listing-location/edit/{id}', [ListingLocationControllerForAdmin::class,'edit'])->name('admin_listing_location_edit');
    Route::post('listing-location/update/{id}', [ListingLocationControllerForAdmin::class,'update'])->name('admin_listing_location_update');


    Route::get('listing/view', [ListingControllerForAdmin::class,'index'])->name('admin_listing_view');
    Route::get('listing-search-result', [ListingControllerForAdmin::class,'search_result'])->name('admin_listing_search');
    Route::get('listing/create', [ListingControllerForAdmin::class,'create'])->name('admin_listing_create');
    Route::post('listing/store', [ListingControllerForAdmin::class,'store'])->name('admin_listing_store');
    Route::get('listing/delete/{id}', [ListingControllerForAdmin::class,'destroy'])->name('admin_listing_delete');
    Route::get('listing/edit/{id}', [ListingControllerForAdmin::class,'edit'])->name('admin_listing_edit');
    Route::post('listing/update/{id}', [ListingControllerForAdmin::class,'update'])->name('admin_listing_update');
    Route::get('listing/delete-social-item/{id}', [ListingControllerForAdmin::class,'delete_social_item'])->name('admin_listing_delete_social_item');
    Route::get('listing/delete-photo/{id}', [ListingControllerForAdmin::class,'delete_photo'])->name('admin_listing_delete_photo');
    Route::get('listing/delete-video/{id}', [ListingControllerForAdmin::class,'delete_video'])->name('admin_listing_delete_video');
    Route::get('listing/delete-additional-feature/{id}', [ListingControllerForAdmin::class,'delete_additional_feature'])->name('admin_listing_delete_additional_feature');
    Route::get('listing-status/{id}', [ListingControllerForAdmin::class,'change_status']);


    Route::get('admin-review/view', [ReviewController::class,'view_admin_review'])->name('admin_view_admin_review');
    Route::post('admin-review/store', [ReviewController::class,'store_admin_review'])->name('admin_store_admin_review');
    Route::post('admin-review/update/{id}', [ReviewController::class,'update_admin_review'])->name('admin_update_admin_review');
    Route::get('admin-review/delete/{id}', [ReviewController::class,'delete_admin_review'])->name('admin_delete_admin_review');
    Route::get('customer-review/view', [ReviewController::class,'view_customer_review'])->name('admin_view_customer_review');
    Route::get('customer-review/delete/{id}', [ReviewController::class,'delete_customer_review'])->name('admin_delete_customer_review');

    Route::get('setting/general', [SettingController::class,'edit'])->name('admin_setting_general');
    Route::post('setting/general/update', [SettingController::class,'update'])->name('admin_setting_general_update');

    Route::get('language/menu/view', [LanguageController::class,'language_menu_text'])->name('admin_language_menu_text');
    Route::post('language/menu/update', [LanguageController::class,'language_menu_text_update'])->name('admin_language_menu_text_update');

    Route::get('language/website/view', [LanguageController::class,'language_website_text'])->name('admin_language_website_text');
    Route::post('language/website/update', [LanguageController::class,'language_website_text_update'])->name('admin_language_website_text_update');

    Route::get('language/notification/view', [LanguageController::class,'language_notification_text'])->name('admin_language_notification_text');
    Route::post('language/notification/update', [LanguageController::class,'language_notification_text_update'])->name('admin_language_notification_text_update');

    Route::get('language/admin-panel/view', [LanguageController::class,'language_admin_panel_text'])->name('admin_language_admin_panel_text');
    Route::post('language/admin-panel/update', [LanguageController::class,'language_admin_panel_text_update'])->name('admin_language_admin_panel_text_update');


    Route::get('page-home/edit', [PageHomeController::class,'edit'])->name('admin_page_home_edit');
    Route::post('page-home/update', [PageHomeController::class,'update'])->name('admin_page_home_update');

    Route::get('page-about/edit', [PageAboutController::class,'edit'])->name('admin_page_about_edit');
    Route::post('page-about/update', [PageAboutController::class,'update'])->name('admin_page_about_update');

    Route::get('page-blog/edit', [PageBlogController::class,'edit'])->name('admin_page_blog_edit');
    Route::post('page-blog/update', [PageBlogController::class,'update'])->name('admin_page_blog_update');

    Route::get('page-faq/edit', [PageFaqController::class,'edit'])->name('admin_page_faq_edit');
    Route::post('page-faq/update', [PageFaqController::class,'update'])->name('admin_page_faq_update');

    Route::get('page-contact/edit', [PageContactController::class,'edit'])->name('admin_page_contact_edit');
    Route::post('page-contact/update', [PageContactController::class,'update'])->name('admin_page_contact_update');

    Route::get('page-pricing/edit', [PagePricingController::class,'edit'])->name('admin_page_pricing_edit');
    Route::post('page-pricing/update', [PagePricingController::class,'update'])->name('admin_page_pricing_update');

    Route::get('page-listing-category/edit', [PageListingCategoryController::class,'edit'])->name('admin_page_listing_category_edit');
    Route::post('page-listing-category/update', [PageListingCategoryController::class,'update'])->name('admin_page_listing_category_update');

    Route::get('page-listing-location/edit', [PageListingLocationController::class,'edit'])->name('admin_page_listing_location_edit');
    Route::post('page-listing-location/update', [PageListingLocationController::class,'update'])->name('admin_page_listing_location_update');

    Route::get('page-listing/edit', [PageListingController::class,'edit'])->name('admin_page_listing_edit');
    Route::post('page-listing/update', [PageListingController::class,'update'])->name('admin_page_listing_update');

    Route::get('page-term/edit', [PageTermController::class,'edit'])->name('admin_page_term_edit');
    Route::post('page-term/update', [PageTermController::class,'update'])->name('admin_page_term_update');

    Route::get('page-privacy/edit', [PagePrivacyController::class,'edit'])->name('admin_page_privacy_edit');
    Route::post('page-privacy/update', [PagePrivacyController::class,'update'])->name('admin_page_privacy_update');

    Route::get('page-other/edit', [PageOtherController::class,'edit'])->name('admin_page_other_edit');
    Route::post('page-other/update', [PageOtherController::class,'update'])->name('admin_page_other_update');


    Route::get('faq/view', [FaqControllerForAdmin::class,'index'])->name('admin_faq_view');
    Route::get('faq/create', [FaqControllerForAdmin::class,'create'])->name('admin_faq_create');
    Route::post('faq/store', [FaqControllerForAdmin::class,'store'])->name('admin_faq_store');
    Route::get('faq/delete/{id}', [FaqControllerForAdmin::class,'destroy'])->name('admin_faq_delete');
    Route::get('faq/edit/{id}', [FaqControllerForAdmin::class,'edit'])->name('admin_faq_edit');
    Route::post('faq/update/{id}', [FaqControllerForAdmin::class,'update'])->name('admin_faq_update');


    Route::get('package/view', [PackageControllerForAdmin::class,'index'])->name('admin_package_view');
    Route::get('package/create', [PackageControllerForAdmin::class,'create'])->name('admin_package_create');
    Route::post('package/store', [PackageControllerForAdmin::class,'store'])->name('admin_package_store');
    Route::get('package/delete/{id}', [PackageControllerForAdmin::class,'destroy'])->name('admin_package_delete');
    Route::get('package/edit/{id}', [PackageControllerForAdmin::class,'edit'])->name('admin_package_edit');
    Route::post('package/update/{id}', [PackageControllerForAdmin::class,'update'])->name('admin_package_update');


    Route::get('email-template/view', [EmailTemplateController::class,'index'])->name('admin_email_template_view');
    Route::get('email-template/edit/{id}', [EmailTemplateController::class,'edit'])->name('admin_email_template_edit');
    Route::post('email-template/update/{id}', [EmailTemplateController::class,'update'])->name('admin_email_template_update');


    Route::get('social-media/view', [SocialMediaItemController::class,'index'])->name('admin_social_media_view');
    Route::get('social-media/create', [SocialMediaItemController::class,'create'])->name('admin_social_media_create');
    Route::post('social-media/store', [SocialMediaItemController::class,'store'])->name('admin_social_media_store');
    Route::get('social-media/delete/{id}', [SocialMediaItemController::class,'destroy'])->name('admin_social_media_delete');
    Route::get('social-media/edit/{id}', [SocialMediaItemController::class,'edit'])->name('admin_social_media_edit');
    Route::post('social-media/update/{id}', [SocialMediaItemController::class,'update'])->name('admin_social_media_update');


    Route::get('purchase-history/view', [PurchaseHistoryControllerForAdmin::class,'index'])->name('admin_purchase_history_view');
    Route::get('purchase-history/detail/{id}', [PurchaseHistoryControllerForAdmin::class,'detail'])->name('admin_purchase_history_detail');
    Route::get('purchase-history/invoice/{id}', [PurchaseHistoryControllerForAdmin::class,'invoice'])->name('admin_purchase_history_invoice');
    Route::get('purchase-history/approve/{id}', [PurchaseHistoryControllerForAdmin::class,'approve'])->name('admin_purchase_history_approve');


    Route::get('customer/view', [CustomerControllerForAdmin::class,'index'])->name('admin_customer_view');
    Route::get('customer/detail/{id}', [CustomerControllerForAdmin::class,'detail'])->name('admin_customer_detail');
    Route::get('customer/delete/{id}', [CustomerControllerForAdmin::class,'destroy'])->name('admin_customer_delete');
    Route::get('customer-status/{id}', [CustomerControllerForAdmin::class,'change_status']);
    Route::get('clear-database', [ClearDatabaseController::class,'index'])->name('admin_clear_database');

});

Route::prefix('admin')->group(function () {
    Route::get('login', [LoginControllerForAdmin::class,'login'])->name('admin_login');
    Route::post('login/store', [LoginControllerForAdmin::class,'login_check'])->name('admin_login_store');
    Route::get('logout', [LoginControllerForAdmin::class,'logout'])->name('admin_logout');
    Route::get('forget-password', [LoginControllerForAdmin::class,'forget_password'])->name('admin_forget_password');
    Route::post('forget-password/store', [LoginControllerForAdmin::class,'forget_password_check'])->name('admin_forget_password_store');
    Route::get('reset-password/{token}/{email}', [LoginControllerForAdmin::class,'reset_password']);
    Route::post('reset-password-update/{token}/{email}', [LoginControllerForAdmin::class,'reset_password_update'])->name('admin_reset_password_update');
});
