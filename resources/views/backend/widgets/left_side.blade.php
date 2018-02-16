<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            @foreach($menu as $el)
                @if (isset($el['items']))
                    <li class="treeview {{$el['active'] ? 'active' : ''}}">
                        <a href="#"><i class="fa {{$el['icon']}}"></i> <span>{{$el['name']}}</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                        <ul class="treeview-menu">
                            @foreach($el['items'] as $subEl)
                                <li class="{{$subEl['active'] ? 'active' : ''}}">
                                    <a href="{{url($subEl['url'])}}">{{$subEl['name']}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="{{$el['active'] ? 'active' : ''}}">
                        <a href="{{url($el['url'])}}">
                            <i class="fa {{$el['icon']}}"></i> <span>{{$el['name']}}</span></a>
                    </li>
                @endif
            @endforeach
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
