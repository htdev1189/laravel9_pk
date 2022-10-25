@if ($notice_not_seen->count() > 0)

    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">{{ $notice_not_seen->count() }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

            @foreach ($notice_not_seen as $item)
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ App\Models\ThongBao::find($item->id)->admin->image }}" alt="User Avatar"
                            class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                {{ App\Models\ThongBao::find($item->id)->admin->name }}
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">{{ $item->title }}...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ $item->created_at }}</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
            @endforeach

            <a href="/admin/thongbao/all" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
    </li>

@endif
