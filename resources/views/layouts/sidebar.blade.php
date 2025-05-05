<aside class="left-sidebar" @if(Config::get('app.locale')=='ar' ) style="right: 0;direction: rtl;" @endif>
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">

            <div style="display: flex;align-items: center;gap: 10px;justify-content: space-between;width: 100%;">
            <img src="{{asset('assets/images/hr.png')}}" alt=""  width="50"/>
             <select style="width: 100%;  background: transparent;border: none;font-size: 18px;" id="programme">
                 <option value="cooling"  > {{__('main.cool_pro')}} </option>
                 <option value="salting"> {{__('main.salt_pro')}} </option>
                 <option value="hr"> {{__('main.hr_pro')}} </option>
                 <option value="erp"> {{__('main.erp_pro')}} </option>
                 <option value="balance"> {{__('main.balance_pro')}} </option>
             </select>

            </div>


          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
         <ul id="sidebarnav" style="display: none" class="cooling">
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('index')}}" aria-expanded="false">
                <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                <span class="hide-menu">{{__('main.main')}}</span>
              </a>
            </li>

            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>

            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('clients')}}" aria-expanded="false">

                <iconify-icon icon="ic:baseline-people"></iconify-icon>
                <span class="hide-menu">{{__('main.clients')}}</span>
              </a>
            </li>
            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('items') }}" aria-expanded="false">
              <iconify-icon icon="material-symbols:more-time-rounded"></iconify-icon>
                <span class="hide-menu">{{__('main.items')}}</span>
              </a>
            </li>
            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('meals_enter') }}" aria-expanded="false">
              <iconify-icon icon="hugeicons:money-add-01"></iconify-icon>
                <span class="hide-menu">{{__('main.meals_enter')}}</span>
              </a>
            </li>

            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('meals_exit') }}" aria-expanded="false">
              <iconify-icon icon="game-icons:take-my-money"></iconify-icon>
                <span class="hide-menu">{{__('main.meals_exit')}}</span>
              </a>
            </li>
            <li>
              <span class="sidebar-divider lg"></span>
            </li>
              <li class="sidebar-item">
                  <a class="sidebar-link" href="{{ route('meals_report') }}" aria-expanded="false">
                      <iconify-icon icon="game-icons:take-my-money"></iconify-icon>
                      <span class="hide-menu">{{__('main.client_meals')}}</span>
                  </a>
              </li>


              <li>
                  <span class="sidebar-divider lg"></span>
              </li>
              <li class="sidebar-item">
                  <a class="sidebar-link" href="{{ route('client_Account') }}" aria-expanded="false">
                      <iconify-icon icon="game-icons:take-my-money"></iconify-icon>
                      <span class="hide-menu">{{__('main.client_account')}}</span>
                  </a>
              </li>

              <li>
                  <span class="sidebar-divider lg"></span>
              </li>

              <li class="sidebar-item">
                  <a class="sidebar-link" href="{{route('settings')}}" aria-expanded="false">
                      <iconify-icon icon="ooui:settings"></iconify-icon>
                      <span class="hide-menu">{{__('main.settings')}}</span>
                  </a>
              </li>
              <li>
                  <span class="sidebar-divider lg"></span>
              </li>

              <li class="sidebar-item" >
                  <a class="sidebar-link" href="{{route('users')}}" aria-expanded="false">
                      <iconify-icon icon="ooui:settings"></iconify-icon>
                      <span class="hide-menu">{{__('main.users')}}</span>
                  </a>
              </li>
              <li>
                  <span class="sidebar-divider lg"></span>
              </li>

          </ul>

         <ul id="sidebarnav" style="display: none" class="salting">
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('index')}}" aria-expanded="false">
                        <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                        <span class="hide-menu">{{__('main.main')}}</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>

                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('clients')}}" aria-expanded="false">

                        <iconify-icon icon="ic:baseline-people"></iconify-icon>
                        <span class="hide-menu">{{__('main.clients')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('items') }}" aria-expanded="false">
                        <iconify-icon icon="material-symbols:more-time-rounded"></iconify-icon>
                        <span class="hide-menu">{{__('main.items')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>


                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('salting_enter') }}" aria-expanded="false">
                        <iconify-icon icon="game-icons:take-my-money"></iconify-icon>
                        <span class="hide-menu">{{__('main.salting_enter')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('salting_exit') }}" aria-expanded="false">
                        <iconify-icon icon="game-icons:take-my-money"></iconify-icon>
                        <span class="hide-menu">{{__('main.salting_exit')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>

              <li class="sidebar-item">
                  <a class="sidebar-link" href="{{ route('salting_report') }}" aria-expanded="false">
                      <iconify-icon icon="game-icons:take-my-money"></iconify-icon>
                      <span class="hide-menu">{{__('main.salting_report')}}</span>
                  </a>
              </li>
              <li>
                  <span class="sidebar-divider lg"></span>
              </li>


                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('client_Account') }}" aria-expanded="false">
                        <iconify-icon icon="game-icons:take-my-money"></iconify-icon>
                        <span class="hide-menu">{{__('main.client_account')}}</span>
                    </a>
                </li>

                <li>
                    <span class="sidebar-divider lg"></span>
                </li>



                <li class="sidebar-item" >
                    <a class="sidebar-link" href="{{route('users')}}" aria-expanded="false">
                        <iconify-icon icon="ooui:settings"></iconify-icon>
                        <span class="hide-menu">{{__('main.users')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>

            </ul>

         <ul id="sidebarnav" style="display: none" class="hr">
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
             <li class="sidebar-item">
                 <a class="sidebar-link" href="{{route('departments')}}" aria-expanded="false">

                     <iconify-icon icon="carbon:category"></iconify-icon>
                     <span class="hide-menu">{{__('main.departments')}}</span>
                 </a>
             </li>
             <li>
                 <span class="sidebar-divider lg"></span>
             </li>
             <li class="sidebar-item">
                 <a class="sidebar-link" href="{{route('jobs')}}" aria-expanded="false">

                     <iconify-icon icon="hugeicons:job-share"></iconify-icon>
                     <span class="hide-menu">{{__('main.jobs')}}</span>
                 </a>
             </li>
             <li>
                 <span class="sidebar-divider lg"></span>
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
                    <a class="sidebar-link" href="{{ route('deductionAndBonse') }}" aria-expanded="false">
                        <iconify-icon icon="material-symbols:more-time-rounded"></iconify-icon>
                        <span class="hide-menu">{{__('main.deduction_boins')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('financialDeductionAndBonse') }}" aria-expanded="false">
                        <iconify-icon icon="hugeicons:money-add-01"></iconify-icon>
                        <span class="hide-menu">{{__('main.financial_deduction_boins')}}</span>
                    </a>
                </li>

                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('advances') }}" aria-expanded="false">
                        <iconify-icon icon="game-icons:take-my-money"></iconify-icon>
                        <span class="hide-menu">{{__('main.advances')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
             <li class="sidebar-item">
                 <a class="sidebar-link" href="{{ route('attend') }}" aria-expanded="false">
                     <iconify-icon icon="game-icons:take-my-money"></iconify-icon>
                     <span class="hide-menu">{{__('main.attend')}}</span>
                 </a>
             </li>
             <li>
                 <span class="sidebar-divider lg"></span>
             </li>
             <li class="sidebar-item">
                 <a class="sidebar-link" href="{{ route('monthClose') }}" aria-expanded="false">
                     <iconify-icon icon="game-icons:take-my-money"></iconify-icon>
                     <span class="hide-menu">{{__('main.monthly_close')}}</span>
                 </a>
             </li>
             <li>
                 <span class="sidebar-divider lg"></span>
             </li>
                <li class="sidebar-item" >
                    <a class="sidebar-link" href="{{route('settings_hr')}}" aria-expanded="false">
                        <iconify-icon icon="ooui:settings"></iconify-icon>
                        <span class="hide-menu">{{__('main.settings')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
             <li class="sidebar-item" >
                 <a class="sidebar-link" href="{{route('users')}}" aria-expanded="false">
                     <iconify-icon icon="ooui:settings"></iconify-icon>
                     <span class="hide-menu">{{__('main.users')}}</span>
                 </a>
             </li>
             <li>
                 <span class="sidebar-divider lg"></span>
             </li>


            </ul>

         <ul id="sidebarnav" style="display: none" class="erp">
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
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('safes')}}" aria-expanded="false">

                        <iconify-icon icon="vaadin:safe"></iconify-icon>
                        <span class="hide-menu">{{__('main.safes')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('items')}}" aria-expanded="false">

                        <iconify-icon icon="hugeicons:job-share"></iconify-icon>
                        <span class="hide-menu">{{__('main.items')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('clients')}}" aria-expanded="false">

                        <iconify-icon icon="ic:baseline-people"></iconify-icon>
                        <span class="hide-menu">{{__('main.clients')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('purchases') }}" aria-expanded="false">
                        <iconify-icon icon="material-symbols:more-time-rounded"></iconify-icon>
                        <span class="hide-menu">{{__('main.purchases')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('returnPurchase') }}" aria-expanded="false">
                        <iconify-icon icon="material-symbols:more-time-rounded"></iconify-icon>
                        <span class="hide-menu">{{__('main.return_purchase_bill')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('sales') }}" aria-expanded="false">
                        <iconify-icon icon="hugeicons:money-add-01"></iconify-icon>
                        <span class="hide-menu">{{__('main.sales')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('returnSales') }}" aria-expanded="false">
                        <iconify-icon icon="hugeicons:money-add-01"></iconify-icon>
                        <span class="hide-menu">{{__('main.return_Sales_bill')}}</span>
                    </a>
                </li>

                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('recipits') }}" aria-expanded="false">
                        <iconify-icon icon="game-icons:take-my-money"></iconify-icon>
                        <span class="hide-menu">{{__('main.recipits')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('cathes') }}" aria-expanded="false">
                        <iconify-icon icon="game-icons:take-my-money"></iconify-icon>
                        <span class="hide-menu">{{__('main.cathes')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('paymentTypes') }}" aria-expanded="false">
                        <iconify-icon icon="game-icons:take-my-money"></iconify-icon>
                        <span class="hide-menu">{{__('main.paymentTypes')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item" >
                    <a class="sidebar-link" href="{{route('boxRecipits')}}" aria-expanded="false">
                        <iconify-icon icon="ooui:settings"></iconify-icon>
                        <span class="hide-menu">{{__('main.boxRecipits')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item" >
                    <a class="sidebar-link" href="{{route('client_Account')}}" aria-expanded="false">
                        <iconify-icon icon="ooui:settings"></iconify-icon>
                        <span class="hide-menu">{{__('main.client_account')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item" >
                    <a class="sidebar-link" href="{{route('safeReport')}}" aria-expanded="false">
                        <iconify-icon icon="ooui:settings"></iconify-icon>
                        <span class="hide-menu">{{__('main.safeReport')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item" >
                    <a class="sidebar-link" href="{{route('stockReport')}}" aria-expanded="false">
                        <iconify-icon icon="ooui:settings"></iconify-icon>
                        <span class="hide-menu">{{__('main.stockReport')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item" >
                    <a class="sidebar-link" href="{{route('users')}}" aria-expanded="false">
                        <iconify-icon icon="ooui:settings"></iconify-icon>
                        <span class="hide-menu">{{__('main.users')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item" >
                    <a class="sidebar-link" href="{{route('fix_client_Account')}}" aria-expanded="false">
                        <iconify-icon icon="ooui:settings"></iconify-icon>
                        <span class="hide-menu">{{__('main.fix_accounts')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>

            </ul>

         <ul id="sidebarnav" style="display: none" class="balance">
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('index')}}" aria-expanded="false">
                        <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                        <span class="hide-menu">{{__('main.main')}}</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>

                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('clients')}}" aria-expanded="false">

                        <iconify-icon icon="ic:baseline-people"></iconify-icon>
                        <span class="hide-menu">{{__('main.clients')}}</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('balance') }}" aria-expanded="false">
                        <iconify-icon icon="hugeicons:money-add-01"></iconify-icon>
                        <span class="hide-menu">{{__('main.weight_statment')}}</span>
                    </a>
                </li>

                <li>
                    <span class="sidebar-divider lg"></span>
                </li>


            </ul>

        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        $( document ).ready(function() {
           let programme = sessionStorage.getItem("programme");
           console.log('programme' , programme);
           if(programme == null){
               $('#programme').val("cooling");
               $('.erp').hide();
               $('.hr').hide();
               $('.salting').hide();
               $('.cooling').hide();
               $('.cooling').show();

               sessionStorage.setItem("programme", "cooling");
           } else {
               $('#programme').val(programme);
            //   console.log('programmeValue' ,   $('#programme').val());
               $('.erp').hide();
               $('.hr').hide();
               $('.salting').hide();
               $('.cooling').hide();
               $("." + programme).show();

           }

            $('#programme').change((e) => {
                console.log('change' ,  e.target.value);
                sessionStorage.setItem("programme", e.target.value);
                $('.erp').hide();
                $('.hr').hide();
                $('.salting').hide();
                $('.cooling').hide();
                $("." +  e.target.value).show();
                let url = "{{ route('index') }}";
                document.location.href=url;

            });


        });

    </script>
