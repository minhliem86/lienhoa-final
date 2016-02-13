  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-warning">{{$customer->count() != 0 ? $customer->count()  : ''  }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Bạn có {{$customer->count()}} thông báo mới</li>
               @if( !is_null($customer))
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu">
                @foreach($customer as $item_customer)
                  <li><!-- start message -->
                    <a href="{{route('admin.customer.show',$item_customer->id)}}">
                      <!-- Message title and timestamp -->
                      <h4>
                        {{$item_customer->fullname}}
                      </h4>
                      <!-- The message -->
                      <p>{{Str::words($item_customer->messages,20)}}</p>
                    </a>
                  </li>
                  @endforeach
                  <!-- end message -->
                </ul>
                <!-- /.menu -->
              </li>
              @endif
              <li class="footer"><a href="{{route('admin.customer.index')}}">Tất cả liên hệ</a></li>
            </ul>
          </li>
          <!-- /.messages-menu -->





          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{asset('public/backend')}}/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{Auth::user()->username}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{asset('public/backend')}}/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <!-- <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p> -->
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('admin.user.changePass')}}" class="btn btn-default btn-flat">Thay đổi mật khẩu</a>
                </div>
                <div class="pull-right">
                  <a href="{{route('getLogout')}}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>