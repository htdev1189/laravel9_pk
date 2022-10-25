<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <ul class="navbar-nav ml-auto">

        <!-- Messages Dropdown Menu -->
        <div id="hkt_push">
            @if ($thongbaochuadoc->count() > 0)
                
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">{{ $thongbaochuadoc->count() }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            
                    @foreach ($thongbaochuadoc as $item)
                        <div class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ App\Models\ThongBao::find($item->id)->admin->image }}" alt="User Avatar"
                                class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        {{ App\Models\ThongBao::find($item->id)->admin->name }}
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">{{ $item->title }}</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ $item->created_at }}</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </div>
                        <div class="dropdown-divider"></div>
                    @endforeach
            
                    <a href="/admin/thongbao/all" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>

            @endif

            
            
        </div>



        <li class="nav-item">
            <a class="nav-link" href="/admin/logout">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</nav>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {

            $.ajax({
                    url: '/admin/thongbao/push',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: 10
                    },
                    success: function(response) {
                        // console.log(response);
                        document.getElementById('hkt_push').innerHTML = response.noidung;
                    }
                });
            // alert(JSON.stringify(data));
        });
    });
</script>
