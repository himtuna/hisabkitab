<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('assets/admin-lte/img/davender-nath-thakur.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Davender Nath Thakur</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
               
        <li class="treeview {!! Request::is('orders/*') ? 'active' : '' !!}">
          <a href="#"><i class="fa fa-link"></i> <span>Orders</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="{!! Request::is('orders/add') ? 'active' : '' !!}"><a href="{{url('orders/add')}}">New Order</a></li>
            <li class="{!! Request::is('orders/draft') ? 'active' : '' !!}"><a href="{{url('orders/draft')}}">Draft Orders</a></li>            
          </ul>
        </li>

        <li class="treeview {!! Request::is('orders/*') ? 'active' : '' !!}">
          <a href="#"><i class="fa fa-link"></i> <span>Invoices</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="{!! Request::is('invoices/add') ? 'active' : '' !!}"><a href="{{url('orders/confirmed')}}">Add new Invoice</a></li>
            <li class="{!! Request::is('orders/confirmed') ? 'active' : '' !!}"><a href="{{url('orders/confirmed')}}">Dispatched Invoices</a></li>
            <li class="{!! Request::is('orders/received') ? 'active' : '' !!}"><a href="{{url('orders/received')}}">Received Invoices</a></li>
            <li class="{!! Request::is('orders/lost') ? 'active' : '' !!}"><a href="{{url('orders/lost')}}">Lost Invoices</a></li>
         </ul>
        </li> 
        <li class="treeview {!! Request::is('customers/*') ? 'active' : '' !!} {!! Request::is('customers') ? 'active' : '' !!}">
          <a href="#"><i class="fa fa-link"></i> <span>Customers</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
            <li class="{!! Request::is('customers') ? 'active' : '' !!}"><a href="{{url('customers')}}">All Customers</a></li>           
            <li class="{!! Request::is('customers/orderstotal') ? 'active' : '' !!}"><a href="{{url('customers/orderstotal')}}">Orders Total</a></li>           
          </ul>
        </li>
        <li class="tree view {!! Request::is('products') ? 'active' : '' !!} {!! Request::is('colours') ? 'active' : '' !!}">
        <a href="#"><i class="fa fa-link"></i> <span>Products</span></a>
        <ul class="treeview-menu">
            <li class="{!! Request::is('products') ? 'active' : '' !!}"><a href="{{url('products')}}">All Products</a></li>
            <li class="{!! Request::is('colours') ? 'active' : '' !!}"><a href="{{url('colours')}}">Colours codes</a></li>           
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>