<header class="main-header">
    <!-- Logo -->
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                @if( isset($cUser) )

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{Utility::getProfilePicture($cUser->name)}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{$cUser->name}}({{$cUser->email}})</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{Utility::getProfilePicture($cUser->name)}}" class="img-circle" alt="User Image">

                                <p>
                                    {{$cUser->name}} ({{$cUser->email}})
                                    <small>Member since {{$cUser->created_at}}</small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                </div>
                                <div class="pull-right">
                                    <a href="{{route("logout")}}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"  data-toggle="control-sidebar" aria-expanded="true">
                            <i :class="[ notifications.length > 0 ? 'faa-ring animated' : '' ,'fa fa-bell']"></i>
                            <span class="label label-danger">@{{ notifications.length }}</span>
                        </a>
                    </li>

                @endif

            </ul>
        </div>
    </nav>
</header>
