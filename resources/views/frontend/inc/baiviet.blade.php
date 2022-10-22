<div id="baiviet" class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            @foreach ($news_posts as $new)
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card">
                        <img src="{{ $new->image }}">
                        <div class="card-body">
                            <div class="baiviet-abs">
                                <div class="baiviet-abs-sub">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="baiviet-top pt-2 pb-2">
                                {{-- <span><i class="fa fa-clock-o" aria-hidden="true"></i> February 5, 2018</span> / --}}
                                <span><i class="fa fa-clock-o" aria-hidden="true"></i>{{ date('F j, Y', strtotime($new->created_at)) }}</span> /
                                <span><i class="fa fa-user-circle-o" aria-hidden="true"></i> by {{ App\Models\Post::find($new->id)->admin->name }}</span>
                            </div>
                            <h5 class="card-title"><a href="{{ URL::to($new->slug . '.html') }}">{{ $new->title }}</a>
                            </h5>
                            <p class="card-text">
                                {!! $new->description !!}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
