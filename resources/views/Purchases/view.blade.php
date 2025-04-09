<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<body>


<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('layouts.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper edit_layout">
        <!--  Header Start -->
        @include('layouts.header')
        <!--  Header End -->
        <div class="body-wrapper-inner">
            <div class="container-fluid">

                    @csrf
                    <div class="card">
                        <div class="card-header"
                             style="display: flex ; justify-content: space-between ; align-items: center">
                            <h5 class="card-title fw-semibold " style="margin-bottom: 0 !important; color: #3cacc8 ">{{
                                __('main.view_purchase') }}</h5>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.billNumber') }} </label>
                                        <input type="text" name="billNumber" id="billNumber"
                                               class="form-control @error('billNumber') is-invalid @enderror"
                                               placeholder="" autofocus  readonly value="{{$purchase -> billNumber}}" />


                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.date') }} </label>
                                        <input type="text" name="text" id="date"
                                               class="form-control @error('date') is-invalid @enderror"
                                               placeholder="" autofocus readonly value="{{ \Carbon\Carbon::parse($purchase -> date) -> format('Y-m-d')}}"/>


                                    </div>
                                </div>
                            </div>
                            <div class="row" style="align-items: end ; margin-top: 5px">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.supplier') }}  </label>
                                        <input type="text" name="client" id="client"
                                               class="form-control @error('client') is-invalid @enderror"
                                                autofocus readonly value="{{$purchase -> client}}"/>

                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __('main.description') }}</label>
                                        <textarea  name="notes" id="notes" rows="3" disabled
                                                   class="form-control @error('notes') is-invalid @enderror"
                                                   placeholder="{{ __('main.notes') }}" autofocus >{{$purchase ->notes }}</textarea>


                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                @include('flash-message')

                            </div>
                        </div>
                        <div class="card-body">
                            <h2 class="text-center text-primary"> {{__('main.invoice_details')}}  </h2>
                            <div class="table-wrapper">
                                <div class="table-responsive">
                                    <table class="table table-striped  table-bordered table-hover">
                                        <thead>
                                        <th class="text-center" style="width:25%" > {{ __('main.item') }} </th>
                                        <th class="text-center" style="width:15%"> {{ __('main.quantity') }} </th>
                                        <th class="text-center" style="width:15%"> {{ __('main.weight') }} </th>
                                        <th class="text-center" style="width:15%"> {{ __('main.price') }} </th>
                                        <th class="text-center" style="width:25%"> {{ __('main.total') }} </th>
                                        </thead>
                                        <tbody >
                                        @foreach($details as $detail)
                                            <tr>
                                                <td class="text-center" >{{$detail -> item_code  }} -- {{$detail -> item_name}}</td>
                                                <td class="text-center">{{$detail -> quantity }}</td>
                                                <td class="text-center">{{$detail -> weight }}</td>
                                                <td class="text-center">{{$detail -> price }}</td>
                                                <td class="text-center">{{$detail -> total }}</td>

                                            </tr>


                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>


                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.total') }} </label>
                                        <input type="text" name="total" id="total"
                                               class="form-control @error('total') is-invalid @enderror"
                                               placeholder="" autofocus  readonly required  value="{{$purchase -> total}}"/>

                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.discount') }} </label>
                                        <input type="number" step="any" name="discount" id="discount"
                                               class="form-control @error('discount') is-invalid @enderror"
                                               placeholder="" autofocus required readonly value="{{$purchase -> discount}}"/>


                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 5px ;">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.net') }} </label>
                                        <input type="text" name="net" id="net"
                                               class="form-control @error('net') is-invalid @enderror"
                                               placeholder="" autofocus  readonly required value="{{$purchase -> net}}"/>


                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>


                @include('layouts.footer')


            </div>
        </div>
    </div>
</div>


</body>

</html>
