<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        @if( isset($cUser) )

            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{Utility::getProfilePicture($cUser->name)}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{$cUser->name}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                                class="fa fa-search"></i>
                    </button>
                </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                {{--<li class="header text-center bg-black disabled color-palette" style="padding: 10px 25px 10px 15px;"><b style="color:#b8c7ce;font-size: 14px;">General</b></li>--}}
{{-- 

                {{
                \MPA\Core\Helpers\SideNavHelper::menuBuilder([
                    'parent' => 'Customers',
                    'icon' => 'fa-address-card',
                    'childrens' => [

                        [
                            'name' => "Create Customer",
                            'route' => 'admin::customer-card::create::create-customer-card',
                            'permissions' => \MPA\Users\Config\UserPermissions::getCreateCustomerCard()
                        ] ,
                        [
                            'name' => "Compliance Approval",
                            'route' => 'admin::customer-card::compliance-confirmation::compliance_approval',
                            'permissions' => \MPA\Users\Config\UserPermissions::getApproveCustomerCard()
                        ] ,
                        [
                            'name' => "My Customers",
                            'route' => 'admin::customer-card::lists::my-list-customer-card',
                            'permissions' => \MPA\Users\Config\UserPermissions::getListCustomerCard()
                        ] ,

                        [
                            'name' => "All Customers",
                            'route' => 'admin::customer-card::lists::all-list-customer-card',
                            'permissions' => \MPA\Users\Config\UserPermissions::getListCustomerCardAll()
                        ]

                    ]
                ])}}
 --}}



            </ul>

        @endif

    </section>
    <!-- /.sidebar -->
</aside>

<div class="control-sidebar-bg"></div>

