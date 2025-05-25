@extends('front.app_front')

@section('content')

@php
    $selected_category_ids = request()->category ? explode(',', request()->category) : [];
    $selected_location_ids = request()->location ? explode(',', request()->location) : [];
    $selected_amenity_ids = request()->amenity ? explode(',', request()->amenity) : [];
@endphp

<div class="page-banner">
    <h1>{{ $listing_page_data->name }}</h1>
    <nav>
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
            <li class="breadcrumb-item active">{{ $listing_page_data->name }}</li>
        </ol>
    </nav>
</div>

<div class="page-content">
    <div class="container">
        <div class="row listing pb_0">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <form action="{{ url('listing-result') }}" method="get">
                    <div class="listing-filter">

                        <div class="lf-heading">
                            {{ FILTERS }}
                        </div>

                        <div class="lf-widget">
                            <input type="text" name="text" class="form-control" placeholder="{{ FIND_ANYTHING }}" @if($all_text!='') value="{{ $all_text }}" @endif>
                        </div>

                        <div class="lf-widget">
                            <label><strong>{{ CATEGORIES }}</strong></label>
                            @foreach($listing_categories as $row)
                                @php $count = $category_counts[$row->id] ?? 0; @endphp
                                @if($count > 0)
                                    <div>
                                        <label>
                                            <input type="checkbox" name="category" value="{{ $row->id }}" {{ in_array($row->id, $selected_category_ids) ? 'checked' : '' }}>
                                            {{ $row->listing_category_name }} ({{ $count }})
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!-- Location Checkboxes -->
                        <div class="lf-widget">
                            <label><strong>{{ LOCATIONS }}</strong></label>
                            @foreach($listing_locations as $row)
                                @php $count = $location_counts[$row->id] ?? 0; @endphp
                                @if($count > 0)
                                    <div>
                                        <label>
                                            <input type="checkbox" name="location" value="{{ $row->id }}" {{ in_array($row->id, $selected_location_ids) ? 'checked' : '' }}>
                                            {{ $row->listing_location_name }} ({{ $count }})
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!-- Amenity Checkboxes -->
                        <div class="lf-widget">
                            <label><strong>{{ AMENITIES }}</strong></label>
                            @foreach($amenities as $row)
                                @php $count = $amenity_counts[$row->id] ?? 0; @endphp
                                @if($count > 0)
                                    <div>
                                        <label>
                                            <input type="checkbox" name="amenity" value="{{ $row->id }}" {{ in_array($row->id, $selected_amenity_ids) ? 'checked' : '' }}>
                                            {{ $row->amenity_name }} ({{ $count }})
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!-- Religion Checkboxes -->
                        <div class="lf-widget">
                            <label><strong>{{ RELIGIONS }}</strong></label>
                            @foreach($religions as $row)
                                @php $count = $religion_counts[$row->id] ?? 0; @endphp
                                @if($count > 0)
                                    <div>
                                        <label>
                                            <input type="checkbox" name="religion[]" value="{{ $row->id }}" {{ in_array($row->id, $selected_religion_ids ?? []) ? 'checked' : '' }}>
                                            {{ $row->name }} ({{ $count }})
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="form-group">
                            <input type="submit" class="form-control filter-button" value="{{ FILTER }}">
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-8 col-md-6 col-sm-12">
                @if(count($selected_category_ids) || count($selected_location_ids) || count($selected_amenity_ids))
                    <div class="mb-3">
                        <h5><strong>Selected {{ FILTERS ?? 'Selected Filters' }}:</strong></h5>
                        <ul class="list-inline">
                            @foreach($listing_categories->whereIn('id', $selected_category_ids) as $cat)
                                <li class="list-inline-item badge bg-primary text-white">{{ $cat->listing_category_name }}</li>
                            @endforeach
                            @foreach($listing_locations->whereIn('id', $selected_location_ids) as $loc)
                                <li class="list-inline-item badge bg-success text-white">{{ $loc->listing_location_name }}</li>
                            @endforeach
                            @foreach($amenities->whereIn('id', $selected_amenity_ids) as $am)
                                <li class="list-inline-item badge bg-info text-white">{{ $am->amenity_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="right-area">
                    <div class="row">

                        @forelse($listing_items as $row)
                            <div class="col-md-6 wow fadeInUp">
                                <div class="listing-item effect-item">
                                    <div class="photo image-effect">
                                        <a href="{{ route('front_listing_detail',$row->listing_slug) }}"><img src="{{ asset('uploads/listing_featured_photos/'.$row->listing_featured_photo) }}" alt=""></a>
                                        <div class="category">
                                            <a href="{{ route('front_listing_category_detail',$row->listing_category_slug) }}">{{ $row->listing_category_name }}</a>
                                        </div>
                                        <div class="wishlist">
                                            <a href="{{ route('front_add_wishlist',$row->id) }}"><i class="fas fa-heart"></i></a>
                                        </div>
                                        @if($row->is_featured == 'Yes')
                                            <div class="featured-text">{{ FEATURED }}</div>
                                        @endif
                                    </div>
                                    <div class="text">
                                        <h3><a href="{{ route('front_listing_detail',$row->listing_slug) }}">{{ $row->listing_name }}</a></h3>
                                        <div class="location">
                                            <a href="{{ route('front_listing_location_detail',$row->listing_location_slug) }}"><i class="fas fa-map-marker-alt"></i> {{ $row->listing_location_name }}</a>
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
                        @empty
                            <div class="col-md-12 text-danger text-center">
                                {{ NO_RESULT_FOUND }}
                            </div>
                        @endforelse
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {{ $listing_items->appends($_GET)->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
document.querySelector('form').addEventListener('submit', function (e) {
    const form = this;

    ['category', 'location', 'amenity'].forEach(function(field) {
        const checkboxes = form.querySelectorAll('input[name="' + field + '"]:checked');
        const values = Array.from(checkboxes).map(cb => cb.value).join(',');

        // Remove checkboxes to avoid duplicated values
        checkboxes.forEach(cb => cb.disabled = true);

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
@endsection
