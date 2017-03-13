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
            <li class="header">{{ trans('adminlte_lang::message.customerservice') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview"><a href="{{ url('home') }}"><i class='glyphicon glyphicon-home'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>

            @permission('see_client','create_client','edit_client', 'delete_client', 'recover_client')
            <li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>{{ trans('adminlte_lang::message.clients') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('create_client')
                    <li><a href="{!!URL::to('client/create')!!}">{{ trans('adminlte_lang::message.addclient') }}</a></li>
                    @endpermission
                    @permission('see_client')
                    <li><a href="{!!URL::to('client')!!}">{{ trans('adminlte_lang::message.clientlist') }}</a></li>
                    @endpermission
                    @permission('recover_client')
                    <li><a href="{!!URL::to('client/recover')!!}">{{ trans('adminlte_lang::message.recoverclient') }}</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission

            @permission('see_product','create_product','edit_product', 'delete_product', 'recover_product')
            <li class="treeview">
                <a href="#"><i class='glyphicon glyphicon-bed'></i> <span>{{ trans('adminlte_lang::message.products') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('create_product')
                    <li><a href="{!!URL::to('product/create')!!}">{{ trans('adminlte_lang::message.addproduct') }}</a></li>
                    @endpermission
                    @permission('see_product')
                    <li><a href="{!!URL::to('product')!!}">{{ trans('adminlte_lang::message.productlist') }}</a></li>
                    @endpermission
                    @permission('recover_product')
                    <li><a href="{!!URL::to('product/recover')!!}">{{ trans('adminlte_lang::message.recoverproduct') }}</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission

            @permission('see_quote','create_quote','edit_quote', 'delete_quote', 'recover_quote')
            <li class="treeview">
                <a href="#"><i class='glyphicon glyphicon-briefcase'></i> <span>{{ trans('adminlte_lang::message.quotes') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('create_quote')
                    <li><a href="{!!URL::to('quote/create')!!}">{{ trans('adminlte_lang::message.addquote') }}</a></li>
                    @endpermission
                    @permission('see_quote')
                    <li><a href="{!!URL::to('quote')!!}">{{ trans('adminlte_lang::message.quotelist') }}</a></li>
                    @endpermission
                    @permission('recover_quote')
                    <li><a href="{!!URL::to('quote/recover')!!}">{{ trans('adminlte_lang::message.recoverquote') }}</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission

            @permission('see_order','create_order','edit_order', 'delete_order', 'recover_order')
            <li class="treeview">
                <a href="#"><i class='glyphicon glyphicon-paperclip'></i> <span>{{ trans('adminlte_lang::message.orders') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('create_order')
                    <li><a href="{!!URL::to('order/create')!!}">{{ trans('adminlte_lang::message.addorder') }}</a></li>
                    @endpermission
                    @permission('see_order')
                    <li><a href="{!!URL::to('order')!!}">{{ trans('adminlte_lang::message.orderlist') }}</a></li>
                    @endpermission
                    @permission('recover_order')
                    <li><a href="{!!URL::to('order/recover')!!}">{{ trans('adminlte_lang::message.recoverorder') }}</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            
            @permission('make_sale')
            <li class="treeview"><a href="{{ url('sale') }}"><i class='glyphicon glyphicon-usd'></i> <span>{{ trans('adminlte_lang::message.sale') }}</span></a></li>
            @endpermission

            @permission('see_user','create_user','edit_user', 'delete_user', 'recover_user')
            <li class="header">{{ trans('adminlte_lang::message.manage') }}</li>
            @endpermission
            
            @permission('see_user','create_user','edit_user', 'delete_user', 'recover_user')
            <li class="treeview">
                <a href="#"><i class='glyphicon glyphicon-user'></i> <span>{{ trans('adminlte_lang::message.users') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('create_user')
                    <li><a href="{!!URL::to('user/create')!!}">{{ trans('adminlte_lang::message.adduser') }}</a></li>
                    @endpermission
                    @permission('see_user')
                    <li><a href="{!!URL::to('user')!!}">{{ trans('adminlte_lang::message.userslist') }}</a></li>
                    @endpermission
                    @permission('recover_user')
                    <li><a href="{!!URL::to('user/recover')!!}">{{ trans('adminlte_lang::message.recoveruser') }}</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('see_role','create_role','edit_role', 'delete_role')
            <li class="treeview">
                <a href="#"><i class='glyphicon glyphicon-knight'></i> <span>{{ trans('adminlte_lang::message.roles') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
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

             @permission('report')
            <li class="treeview"><a href="{{ url('sale') }}"><i class='glyphicon glyphicon-list-alt'></i> <span>{{ trans('adminlte_lang::message.reports') }}</span></a></li>
            @endpermission


            {{-- @permission('see_motive','create_motive','edit_motive', 'delete_motive')
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
            @endpermission --}}
            {{-- @permission('see_websupport','create_websupport','edit_websupport', 'delete_websupport')
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
            @endpermission --}}
            {{-- <li class="treeview"><a href="{!!URL::to('report')!!}"><i class='glyphicon glyphicon-list-alt'></i> <span>{{ trans('adminlte_lang::message.report') }}</span></a></li>
            <li class="treeview"><a href="{!!URL::to('ticket')!!}"><i class='glyphicon glyphicon-list-alt'></i> <span>{{ trans('adminlte_lang::message.ticket') }}</span></a></li> --}}
            
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
