<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">{{ $breadcrumbs['title'] ?? 'Dashboard' }}</h4>
                <ul class="breadcrumbs pull-left">
                    @if(isset($breadcrumbs['list']))
                        @foreach($breadcrumbs['list'] as $item)
                            <li>
                                @if ($loop->last)
                                    <span>{{ ucfirst($item) }}</span>
                                @else
                                    <a href="#">{{ ucfirst($item) }}</a>
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            <div class="user-profile pull-right">
                <img class="avatar user-thumb" src="{{ asset('srtdash/assets/images/author/avatar.png') }}" alt="avatar">
                <h4 class="user-name dropdown-toggle" data-toggle="dropdown">Kumkum Rai <i class="fa fa-angle-down"></i></h4>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Message</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="{{ url('/logout') }}">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</div>
