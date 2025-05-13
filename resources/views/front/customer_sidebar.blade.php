@php
	$route = Route::currentRouteName();
@endphp
<ul>
	<li class="{{ $route == 'customer_dashboard' ? 'active' : '' }}">
		<a href="{{ route('customer_dashboard') }}" class="btn btn-md btn-block btn-dark">{{ DASHBOARD }}</a>
	</li>

	{{-- <li class="{{ $route == 'customer_package'||$route=='customer_package_buy' ? 'active' : '' }}">
		<a href="{{ route('customer_package') }}" class="btn btn-md btn-block btn-dark">{{ PACKAGES }}</a>
	</li>
	<li class="{{ $route == 'customer_package_purchase_history'||$route=='customer_package_purchase_invoice'||$route=='customer_package_purchase_history_detail' ? 'active' : '' }}">
		<a href="{{ route('customer_package_purchase_history') }}" class="btn btn-md btn-block btn-dark">{{ PURCHASE_HISTORY }}</a>
	</li> --}}
	<li class="{{ $route == 'customer_listing_view'||$route == 'customer_listing_view_detail'||$route == 'customer_listing_edit' ? 'active' : '' }}">
		<a href="{{ route('customer_listing_view') }}" class="btn btn-md btn-block btn-dark">{{ ALL_LISTINGS }}</a>
	</li>
	<li class="{{ $route == 'customer_listing_add' ? 'active' : '' }}">
		<a href="{{ route('customer_listing_add') }}" class="btn btn-md btn-block btn-dark">{{ ADD_LISTING }}</a>
	</li>
    <li class="{{ $route == 'customer_my_reviews'||$route=='customer_my_review_edit' ? 'active' : '' }}">
		<a href="{{ route('customer_my_reviews') }}" class="btn btn-md btn-block btn-dark">{{ MY_REVIEWS }}</a>
	</li>
    <li class="{{ $route == 'customer_wishlist' ? 'active' : '' }}">
		<a href="{{ route('customer_wishlist') }}" class="btn btn-md btn-block btn-dark">{{ WISHLIST }}</a>
	</li>
	<li class="{{ $route == 'customer_update_profile' ? 'active' : '' }}">
		<a href="{{ route('customer_update_profile') }}" class="btn btn-md btn-block btn-dark">{{ EDIT_PROFILE }}</a>
	</li>
	<li class="{{ $route == 'customer_update_password' ? 'active' : '' }}">
		<a href="{{ route('customer_update_password') }}" class="btn btn-md btn-block btn-dark">{{ EDIT_PASSWORD }}</a>
	</li>
	<li class="{{ $route == 'customer_update_photo' ? 'active' : '' }}">
		<a href="{{ route('customer_update_photo') }}" class="btn btn-md btn-block btn-dark">{{ EDIT_PHOTO }}</a>
	</li>
	{{-- <li class="{{ $route == 'customer_update_banner' ? 'active' : '' }}">
		<a href="{{ route('customer_update_banner') }}" class="btn btn-md btn-block btn-dark">{{ EDIT_BANNER }}</a>
	</li> --}}
	<li class="{{ $route == 'customer_logout' ? 'active' : '' }}">
		<a href="{{ route('customer_logout') }}" class="btn btn-md btn-block btn-dark">{{ LOGOUT }}</a>
	</li>
</ul>
