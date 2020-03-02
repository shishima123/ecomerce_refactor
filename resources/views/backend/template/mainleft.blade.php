<div class="container-fluid">
  <div class="row">
    <div class="col-2 navbar-nav Left-sidebar--Height">
      <!-- Sidebar -->
      <div class="nav-item ml-3 my-1">
        <a id="1" class="nav-link d-flex text-muted Admin--LeftBar--Effect--Hover SizebarList__item--height {{ Request::is('admin') ? 'Admin--LeftBar--Item--Active' : '' }}" href="{{ asset('admin') }}">
          <i class="fas fa-tachometer-alt mt-1 mr-2"></i>
          <span>Dashboard</span>
        </a>
      </div>

      <div class="nav-item ml-3 my-1">
        <a id="2" class="nav-link d-flex text-muted Admin--LeftBar--Effect--Hover SizebarList__item--height {{ Request::is('admin/user*') ? 'Admin--LeftBar--Item--Active' : '' }}" href="{{ route('user.index') }}">
          <i class="fas fa-users-cog mt-1 mr-2"></i>
          <span>User</span></a>
      </div>

      <div class="nav-item ml-3 my-1">
        <a id="3" class="nav-link d-flex text-muted Admin--LeftBar--Effect--Hover SizebarList__item--height {{ Request::is('admin/category*') ? 'Admin--LeftBar--Item--Active' : '' }}" href="{{ asset('admin/category') }}">
          <i class="fas fa-table mt-1 mr-2"></i>
          <span>Category</span></a>
      </div>

      <div class="nav-item ml-3 my-1">
        <a id="3" class="nav-link d-flex text-muted Admin--LeftBar--Effect--Hover SizebarList__item--height {{ Request::is('admin/order*') ? 'Admin--LeftBar--Item--Active' : '' }}" href="{{ asset('admin/order') }}">
          <i class="fas fa-cart-plus mt-1 mr-2"></i>
          <span>Order</span></a>
      </div>

      <div class="nav-item ml-3 my-1">
        <a id="4" class="nav-link d-flex text-muted Admin--LeftBar--Effect--Hover SizebarList__item--height {{ Request::is('admin/product*') ? 'Admin--LeftBar--Item--Active' : '' }}" href="{{ asset('admin/product') }}">
          <i class="fas fa-shopping-basket mt-1 mr-2"></i>
          <span>Product</span></a>
      </div>

      <div class="nav-item ml-3 my-1">
        <a id="5" class="nav-link d-flex text-muted Admin--LeftBar--Effect--Hover SizebarList__item--height {{ Request::is('admin/comment*') ? 'Admin--LeftBar--Item--Active' : '' }}" href="{{ asset('admin/comment') }}">
          <i class="far fa-comment-alt mt-1 mr-2"></i>
          <span>Comment</span></a>
      </div>
    </div>
    <div class="col-10 pt-3">
      @yield('content')
    </div>
  </div>
</div>