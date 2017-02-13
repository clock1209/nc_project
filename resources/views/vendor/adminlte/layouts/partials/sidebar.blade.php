<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='glyphicon glyphicon-home'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>

            @permission('see_user','create_user','edit_user', 'delete_user')
            <li class="treeview">
                <a href="#"><i class='glyphicon glyphicon-user'></i> <span>{{ trans('adminlte_lang::message.users') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('create_user')
                    <li><a href="{!!URL::to('user/create')!!}">{{ trans('adminlte_lang::message.adduser') }}</a></li>
                    @endpermission
                    @permission('see_user')
                    <li><a href="{!!URL::to('user')!!}">{{ trans('adminlte_lang::message.userslist') }}</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('see_role','create_role','edit_role', 'delete_role')
            <li class="treeview">
                <a href="#"><i class='glyphicon glyphicon-tags'></i> <span>{{ trans('adminlte_lang::message.roles') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('create_role')
                    <li><a href="{!!URL::to('role/create')!!}">{{ trans('adminlte_lang::message.addrole') }}</a></li>
                    @endpermission
                    @permission('see_role')
                    <li><a href="{!!URL::to('role')!!}">{{ trans('adminlte_lang::message.rolelist') }}</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('see_motive','create_motive','edit_motive', 'delete_motive')
            <li class="treeview">
                <a href="#"><i class='glyphicon glyphicon-comment'></i> <span>{{ trans('adminlte_lang::message.motives') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('create_motive')
                    <li><a href="{!!URL::to('motive/create')!!}">{{ trans('adminlte_lang::message.addmotive') }}</a></li>
                    @endpermission
                    @permission('see_motive')
                    <li><a href="{!!URL::to('motive')!!}">{{ trans('adminlte_lang::message.motiveslist') }}</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('see_websupport','create_websupport','edit_websupport', 'delete_websupport')
            <li class="treeview">
                <a href="#"><i class='glyphicon glyphicon-wrench'></i> <span>{{ trans('adminlte_lang::message.websupport') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('create_websupport')
                    <li><a href="{{ url('websupport/create') }}">{{ trans('adminlte_lang::message.addwebsupport') }}</a></li>
                    @endpermission
                    @permission('see_websupport')
                    <li><a href="{!!URL::to('websupport')!!}">{{ trans('adminlte_lang::message.supportlist') }}</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
