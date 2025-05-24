@extends('front.app_front')

@section('content')

<div class="search-section" style="background-image:url('{{ asset('uploads/site_photos/'.$page_home_items->search_background) }}');">
	<div class="bg"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>{{ $page_home_items->search_heading }}</h1>
				<p>
					{{ $page_home_items->search_text }}
				</p>
				<div class="box">
					<form action="{{ url('listing-result') }}" method="get">
						<div class="input-group input-box mb-3">
							<input type="text" class="form-control" placeholder="{{ FIND_ANYTHING }}" name="text" style="min-height: 40px;">

                            <select name="location" class="form-control select2" >
                                <option value="">{{ SELECT_LOCATION }}</option>
                                @foreach($listing_locations as $row)
                                    <option value="{{ $row->id }}">{{ $row->listing_location_name }}</option>
                                @endforeach
                            </select>

                            <select name="category" class="form-control select2">
                                <option value="">{{ SELECT_CATEGORY }}</option>
                                @foreach($listing_categories as $row)
                                    <option value="{{ $row->id }}">{{ $row->listing_category_name }}</option>
                                @endforeach
                            </select>

							<div class="input-group-append">
								<button type="submit"><i class="fa fa-search"></i> {{ SEARCH }}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
document.querySelector('form').addEventListener('submit', function (e) {
    const form = this;

    ['location', 'category'].forEach(function(field) {
        const selects = form.querySelectorAll('select[name="' + field + '"] option:checked');
        const values = Array.from(selects).map(opt => opt.value).join(',');

        // Remove original selects to prevent duplication
        form.querySelectorAll('select[name="' + field + '"]').forEach(el => el.disabled = true);

        if (values) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = field;
            input.value = values;
            form.appendChild(input);
        }
    });
});
</script>

@if($page_home_items->category_status == 'Show')
<div class="popular-category">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading">
					<h2>{{ $page_home_items->category_heading }}</h2>
					<h3>{{ $page_home_items->category_subheading }}</h3>
				</div>
			</div>
		</div>
		<div class="row">
            @php $i=0; @endphp
			@foreach($orderwise_listing_categories as $row)
                @php $i++; @endphp
                @if($i>$page_home_items->category_total)
                    @break;
                @endif
				@if($row->total == '')
        		@php $row->total = 0; @endphp
        		@endif
				<div class="col-lg-4 col-md-6 col-sm-6 wow fadeInUp">
					<div class="popular-category-item" style="background-image: url({{ asset('uploads/listing_category_photos/'.$row->listing_category_photo) }});">
						<div class="bg"></div>
						<div class="text">
							<h4>{{ $row->listing_category_name }}</h4>
							<p>{{ $row->listings_count }} {{ LISTINGS }}</p>
						</div>
						<a href="{{ route('front_listing_category_detail',$row->listing_category_slug) }}"></a>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>
@endif



@if($page_home_items->listing_status == 'Show')
<div class="listing">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading">
					<h2>{{ $page_home_items->listing_heading }}</h2>
					<h3>{{ $page_home_items->listing_subheading }}</h3>
				</div>
			</div>
		</div>
		<div class="row">
            @foreach($listings as $row)
            <div class="col-md-4 wow fadeInUp">
                <div class="listing-item effect-item">
                    <div class="photo image-effect">
                        <a href="{{ route('front_listing_detail',$row->listing_slug) }}"><img src="{{ asset('uploads/listing_featured_photos/'.$row->listing_featured_photo) }}" alt=""></a>
                        <div class="category">
                            <a href="{{ route('front_listing_category_detail',$row->rListingCategory->listing_category_slug) }}">{{ $row->rListingCategory->listing_category_name }}</a>
                        </div>
                        <div class="wishlist">
                            <a href="{{ route('front_add_wishlist',$row->id) }}"><i class="fas fa-heart"></i></a>
                        </div>
                        <div class="featured-text">{{ FEATURED }}</div>
                    </div>
                    <div class="text">
                        <h3><a href="{{ route('front_listing_detail',$row->listing_slug) }}">{{ $row->listing_name }}</a></h3>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i> {{ $row->rListingLocation->listing_location_name }}
                        </div>

                        @php
                            $count=0;
                            $total_number = 0;
                            $overall_rating = 0;
                            $reviews = \App\Models\Review::where('listing_id',$row->id)->get();
                        @endphp

                        @if($reviews->isEmpty())

                        @else

                        @foreach($reviews as $item)
                            @php
                                $count++;
                                $total_number = $total_number + $item->rating;
                            @endphp
                        @endforeach

                        @php
                            $overall_rating = $total_number/$count;
                        @endphp

                        @if($overall_rating>0 && $overall_rating<=1)
                            @php $overall_rating = 1; @endphp

                        @elseif($overall_rating>1 && $overall_rating<=1.5)
                            @php $overall_rating = 1.5; @endphp

                        @elseif($overall_rating>1.5 && $overall_rating<=2)
                            @php $overall_rating = 2; @endphp

                        @elseif($overall_rating>2 && $overall_rating<=2.5)
                            @php $overall_rating = 2.5; @endphp

                        @elseif($overall_rating>2.5 && $overall_rating<=3)
                            @php $overall_rating = 3; @endphp

                        @elseif($overall_rating>3 && $overall_rating<=3.5)
                            @php $overall_rating = 3.5; @endphp

                        @elseif($overall_rating>3.5 && $overall_rating<=4)
                            @php $overall_rating = 4; @endphp

                        @elseif($overall_rating>4 && $overall_rating<=4.5)
                            @php $overall_rating = 4.5; @endphp

                        @elseif($overall_rating>4.5 && $overall_rating<=5)
                            @php $overall_rating = 5; @endphp

                        @endif

                        @endif

                        <div class="review">
                            @if($overall_rating == 5)
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            @elseif($overall_rating == 4.5)
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            @elseif($overall_rating == 4)
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            @elseif($overall_rating == 3.5)
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                            @elseif($overall_rating == 3)
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            @elseif($overall_rating == 2.5)
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            @elseif($overall_rating == 2)
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            @elseif($overall_rating == 1.5)
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            @elseif($overall_rating == 1)
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            @elseif($overall_rating == 0)
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            @endif
                            <span>({{ $count }} {{ REVIEWS }})</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

		</div>
	</div>
</div>
@endif


@if($page_home_items->location_status == 'Show')
<div class="popular-city">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading">
					<h2>{{ $page_home_items->location_heading }}</h2>
					<h3>{{ $page_home_items->location_subheading }}</h3>
				</div>
			</div>
		</div>
		<div class="row">
            @php $i=0; @endphp
			@foreach($orderwise_listing_locations as $row)
				@php $i++; @endphp
				@if($i>$page_home_items->location_total)
					@break;
				@endif
				@if($row->total == '')
					@php $row->total = 0; @endphp
				@endif
				<div class="col-lg-4 col-md-6 col-sm-6 wow fadeInUp">
					<div class="popular-city-item effect-item">
						<div class="photo image-effect">
							<img src="{{ asset('uploads/listing_location_photos/'.$row->listing_location_photo) }}" alt="">
						</div>
						<div class="text">
							<h4>{{ $row->listing_location_name }}</h4>
							<p>{{ $row->listings_count }} {{ LISTINGS }}</p>
						</div>
						<a href="{{ route('front_listing_location_detail',$row->listing_location_slug) }}"></a>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>
@endif

@endsection
