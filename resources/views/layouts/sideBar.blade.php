<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img src="{{asset('img/user-13.jpg')}}" alt=""/></a>
                </div>
                <div class="info">
                    {{ Auth::user()->name }}
                    <small>Front end developer</small>
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Navigation</li>
            @if (!Auth::guest())
                <li><a href="{{ url('/project') }}"><i class="fa fa-suitcase"></i>See Projects</a></li>
                <li><a href="{{ url('/project/create') }}"><i class="fa fa-cab"></i>Create Project</a></li>
                <li><a href="{{ url('/issue') }}"><i class="fa fa-leaf"></i>See Issue</a></li>
                <li><a href="{{ url('/issue/create') }}"><i class="fa fa-key"></i>Create issue</a></li>
            @endif

            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                            class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>