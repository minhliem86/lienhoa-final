  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('public/backend')}}/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->username}}</p>
          <!-- Status -->
          <span><i class="fa fa-circle text-success"></i> Online</span>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="{{\Active::setActive(2,'dashboard')}}"><a href=""><i class="fa fa-photo"></i> <span>Thống kê</span></a></li>
        <li class="{{\Active::setActive(2,'album')}}"><a href="{{route('admin.album.index')}}"><i class="fa fa-photo"></i> <span>Albums</span></a></li>
        <li class="{{\Active::setActive(2,'contact')}}"><a href="{{route('admin.contact')}}"><i class="fa fa-home"></i> <span>Thông tin liên hệ</span></a></li>
        <li class="{{\Active::setActive(2,'tintuc')}}"><a href="{{route('admin.tintuc.index')}}"><i class="fa fa-newspaper-o"></i> <span>Tin Tức</span></a></li>
        <li class="{{\Active::setActive(2,'gioithieu')}}"><a href="{{route('admin.gioithieu.index')}}"><i class="fa fa-info-circle"></i> <span>Giới thiệu</span></a></li>
        <li class="{{\Active::setActive(2,'danhmuc')}}"><a href="{{route('admin.danhmuc.index')}}"><i class="fa fa-object-group"></i> <span>Danh mục sản phẩm</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-shopping-cart"></i> <span>Sản phẩm</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            @if(Cache::has('danhmuc-cache'))
                @foreach($danhmuc as $item_danhmuc)
                  <li><a href="{{route('admin.sanpham.index',$item_danhmuc->id)}}">{{$item_danhmuc->title}}</a></li>
                @endforeach
            @else
                <li><a href="javascript:avoid()">Chưa có sản phẩm</a></li>
            @endif
          </ul>
        </li>
        <li class="{{\Active::setActive(2,'customer')}}"><a href="{{route('admin.customer.index')}}"><i class="fa fa-envelope"></i> <span>Khách hàng liên hệ</span></a></li>
         <li class="{{\Active::setActive(2,'support')}}"><a href="{{route('admin.support.index')}}"><i class="fa fa-support"></i> <span>Hỗ trợ</span></a></li>
        <!-- <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li> -->
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>