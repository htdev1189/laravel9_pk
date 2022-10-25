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
            
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">11</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            
                    {{-- @foreach ($notice_not_seen as $item) --}}
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('admin_assets/dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                    {{-- @endforeach --}}
            
                    <a href="/admin/thongbao/all" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>

            
            
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
