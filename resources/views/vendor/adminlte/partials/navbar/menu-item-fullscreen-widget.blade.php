@if (Auth::user()->role == '1' || Auth::user()->role == '4')
    <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
        </a>
    </li>
@elseif (Auth::user()->role == '0' || Auth::user()->role == '3')
    <li class="nav-item">
        <a class="nav-link" href="{{ url('detailcompany') }}" role="button"><i class="fa fa-university"
                aria-hidden="true"></i>ข้อมูลสถานประกอบการ</a>
    </li>
@endif
