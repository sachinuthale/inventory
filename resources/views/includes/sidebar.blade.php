<div class="list-group border-0 card text-center text-md-left">
  <a href="#" class="list-group-item d-inline-block collapsed"><i class="fa fa-home"></i> <span class="d-none d-md-inline">Home</span></a>
  <a href="#" class="list-group-item d-inline-block collapsed"><i class="fa fa-film"></i> <span class="d-none d-md-inline">Category</span></a>

  <!-- Products -->
  <a href="#menu1" class="list-group-item d-inline-block collapsed" data-toggle="collapse" aria-expanded="false">
    <i class="fa fa-shopping-basket"></i> <span class="d-none d-md-inline">Products</span>
  </a>
  <div class="collapse" id="menu1" data-parent="#sidebar">
    <a href="{{ route('addProduct') }}" class="list-group-item">Add Products </a>
    <a href="{{ route('addQuantity') }}" class="list-group-item">Add Quantity </a>
    <a href="{{ route('listProducts') }}" class="list-group-item">Update Products </a>
  </div>

  <!-- Issue/Return Hardware -->
  <a href="#menu2" class="list-group-item d-inline-block collapsed" data-toggle="collapse" aria-expanded="false">
    <i class="fa fa-random"></i> <span class="d-none d-md-inline">Issue/Return</span>
  </a>
  <div class="collapse" id="menu2" data-parent="#sidebar">
    <a href="{{ route('addConsumer') }}" class="list-group-item">Add Consumer </a>
    <a href="{{ route('issueProductsShow') }}" class="list-group-item">Issue Products </a>
    <a href="#" class="list-group-item">Return Products </a>
  </div>

  <!-- User Management -->
  <a href="#menu3" class="list-group-item d-inline-block collapsed" data-toggle="collapse" aria-expanded="false">
    <i class="fa fa-users"></i> <span class="d-none d-md-inline">User Management </span>
  </a>
  <div class="collapse" id="menu3" data-parent="#sidebar">
    <a href="#" class="list-group-item" data-parent="#menu3">Add User</a>
        <!-- <a href="#menu3sub2" class="list-group-item" data-toggle="collapse" aria-expanded="false">3.2 </a>
        <div class="collapse" id="menu3sub2">
          <a href="#" class="list-group-item" data-parent="#menu3sub2">3.2 a</a>
          <a href="#" class="list-group-item" data-parent="#menu3sub2">3.2 b</a>
          <a href="#" class="list-group-item" data-parent="#menu3sub2">3.2 c</a>
        </div> -->
        <a href="#" class="list-group-item" data-parent="#menu3">Update User</a>
      </div>

      <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
        <i class="fa fa-heart"></i> <span class="d-none d-md-inline">Broken/Lost/Gifted</span>
      </a>
      <a href="{{route('logout')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
        <i class="fa fa-sign-out"></i> <span class="d-none d-md-inline">Logout</span>
      </a>
      <!--
      <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-clock-o"></i> <span class="d-none d-md-inline">Link</span></a>
      <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-th"></i> <span class="d-none d-md-inline">Link</span></a>
      <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-gear"></i> <span class="d-none d-md-inline">Link</span></a>
      <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-calendar"></i> <span class="d-none d-md-inline">Link</span></a>
      <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-envelope"></i> <span class="d-none d-md-inline">Link</span></a>
      <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-bar-chart-o"></i> <span class="d-none d-md-inline">Link</span></a>
      <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-star"></i> <span class="d-none d-md-inline">Link</span></a> -->
    </div>
