<aside class="left-sidebar" @if(Config::get('app.locale')=='ar' ) style="right: 0;direction: rtl;" @endif>
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="{{route('index')}}" class="text-nowrap logo-img">
            <div style="display: flex; align-items: center; gap: 10px;">
            <img src="{{asset('assets/images/hr.png')}}" alt=""  width="50"/>
            <h3 style="color: #00A1FF;">DEV-HR </h3>
            </div>
         
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('index')}}" aria-expanded="false">
                <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                <span class="hide-menu">{{__('main.main')}}</span>
              </a>
            </li>
            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              
            </li>
            
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('employee')}}" aria-expanded="false">

                <iconify-icon icon="ic:baseline-people"></iconify-icon>
                <span class="hide-menu">{{__('main.employee')}}</span>
              </a>
            </li>
            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-alerts.html" aria-expanded="false">
              <iconify-icon icon="material-symbols:more-time-rounded"></iconify-icon>
                <span class="hide-menu">{{__('main.deduction_boins')}}</span>
              </a>
            </li>
            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-card.html" aria-expanded="false">
              <iconify-icon icon="hugeicons:money-add-01"></iconify-icon>
                <span class="hide-menu">{{__('main.reward')}}</span>
              </a>
            </li>
            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-forms.html" aria-expanded="false">
              <iconify-icon icon="hugeicons:money-remove-01"></iconify-icon>
                <span class="hide-menu">{{__('main.deductions')}}</span>
              </a>
            </li>
            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
              <iconify-icon icon="game-icons:take-my-money"></iconify-icon>
                <span class="hide-menu">{{__('main.advances')}}</span>
              </a>
            </li>
            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
              <iconify-icon icon="ooui:settings"></iconify-icon>
                <span class="hide-menu">{{__('main.settings')}}</span>
              </a>
            </li>
            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
              <iconify-icon icon="ic:twotone-calendar-month"></iconify-icon>
                <span class="hide-menu">{{__('main.monthly_close')}}</span>
              </a>
            </li>
            <li>
            
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>