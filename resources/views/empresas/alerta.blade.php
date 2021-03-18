<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <span class="badge badge-danger badge-counter">{{count($notifications)}}</span>
    </a>
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">
        @if (count($notifications)>0)
        <h6 class="dropdown-header">
            Centro de notificaciones
        </h6>
        @foreach ($notifications as $notification)
        <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
                <div class="icon-circle bg-info">
                    <i class="fas fa-info text-white"></i>
                </div>
            </div>
            <div>
                <div class="small text-gray-500">{{\FormatTime::LongTimeFilter($notification->created_at)}}</div>
                {{$notification->titulo}}
            </div>
        </a>
        @endforeach
        @endif
    </div>
</li>