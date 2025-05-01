@extends('front.app_front')

@section('content')

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
                            <select name="category" class="form-control select2">
                                <option value="">{{ CATEGORIES }}</option>
                                @foreach($listing_categories as $row)
                                    <option value="{{ $row->id }}" @if($row->id == $category_id) selected @endif>{{ $row->listing_category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Location Checkboxes -->
                        <div class="lf-widget">
                            <label><strong>{{ LOCATIONS }}</strong></label>
                            @foreach($listing_locations as $row)
                                <div>
                                    <label>
                                        <input type="checkbox" name="location[]" value="{{ $row->id }}" {{ is_array(request()->location) && in_array($row->id, request()->location) ? 'checked' : '' }}>
                                        {{ $row->listing_location_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Amenity Checkboxes -->
                        <div class="lf-widget">
                            <label><strong>{{ AMENITIES }}</strong></label>
                            @foreach($amenities as $row)
                                <div>
                                    <label>
                                        <input type="checkbox" name="amenity[]" value="{{ $row->id }}" {{ is_array(request()->amenity) && in_array($row->id, request()->amenity) ? 'checked' : '' }}>
                                        {{ $row->amenity_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <input type="submit" class="form-control filter-button" value="{{ FILTER }}">
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-8 col-md-6 col-sm-12">

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

@endsection
