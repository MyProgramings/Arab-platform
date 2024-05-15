    <!-- Sidebar -->
    <ul class="pr-0 navbar-nav bg-primary-subtle sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #022a52">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center bg-white" href="/">
        <div class="sidebar-brand-icon">
          <img style="width: 80%" src="{!! asset('logo.png') !!}"> 
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
        <a class="nav-link text-right" href="{{ route('admin.index') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>الإحصائيات</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item {{ request()->is('admin/channels') ? 'active' : '' }}">
        <a class="nav-link text-right" href="{{ route('channels.index') }}">
        <i class="fas fa-user-lock"></i>
          <span>الصلاحيات</span>
        </a>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item {{ request()->is('admin/channels/blocked*') ? 'active' : '' }}">
        <a class="nav-link text-right" href="{{ route('channels.blocked') }}">
        <i class="fas fa-lock"></i>
          <span>الكورسات المحظورة</span>
        </a>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item {{ request()->is('admin/allChannels*') ? 'active' : '' }}">
        <a class="nav-link text-right" href="{{ route('channels.all') }}">
        <i class="fas fa-film"></i>
          <span>الكورسات</span>
        </a>
      </li>



      <!-- Nav Item - Charts -->
      <li class="nav-item {{ request()->is('admin/MostViewedVideos*') ? 'active' : '' }}">
        <a class="nav-link text-right" href="{{ route('most.viewed.video') }}">
        <i class="fas fa-table"></i>
          <span>الفيديوهات الأكثر مشاهدة</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->