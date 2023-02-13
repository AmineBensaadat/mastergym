@extends('layouts.master')
@section('title') @lang('translation.dashboards') @endsection
@section('content')

    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.dashboards') @endslot
        @slot('title') @lang('translation.dashboards') @endslot
    @endcomponent

<!--datatable css-->
@section('css')
<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/dataTables.bootstrap5.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/buttons.dataTables.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
@endsection
            <div class="row">
                <div class="col-xl-3">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span
                                        class="avatar-title bg-soft-primary text-primary rounded-2 fs-2">
                                        <i class="ri-team-fill text-primary"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                    @lang('translation.Total-Members')</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                data-target="{{ $allMembers }}">0</span></h4>
                                        <span class="badge badge-soft-danger fs-12"><i
                                                class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>5.02
                                            %</span>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">@lang('translation.Total-Members-active')</p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->

                <div class="col-xl-3">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span
                                        class="avatar-title bg-soft-success text-success rounded-2 fs-2">
                                        <i class="ri-user-add-fill text-success"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-medium text-muted mb-3">@lang('translation.Monthly-Joinings')</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                data-target="{{ $monthlyJoined }}">0</span></h4>
                                        <span class="badge badge-soft-success fs-12"><i
                                                class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>3.58
                                            %</span>
                                    </div>
                                    <p class="text-muted mb-0">@lang('translation.Members-joines-per-month')</p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->

                <div class="col-xl-3">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-info text-info rounded-2 fs-2">
                                        <i class="ri-coin-line text-info"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                    @lang('translation.Pending-Payments')</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                            data-target="{{ $pending_paiment }}">0</span></h4>
                                        <span class="badge badge-soft-danger fs-12"><i
                                                class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>10.35
                                            %</span>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">@lang('translation.Member-Pending-Payments')</p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->

                <div class="col-xl-3">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-danger text-danger rounded-2 fs-2">
                                        <i data-feather="clock" class="text-danger"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                    @lang('translation.Expired')</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                            data-target="{{ $expired_members }}">0</span></h4>
                                        <span class="badge badge-soft-danger fs-12"><i
                                                class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>10.35
                                            %</span>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">@lang('translation.Subscription-Expire')</p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->

    <div class="row">
        <!-- start col -->
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#nav-badge-home" role="tab" aria-selected="false" tabindex="-1">
                                Inscriptions mensuelles
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link align-middle" data-bs-toggle="tab" href="#nav-badge-profile" role="tab" aria-selected="false" tabindex="-1">
                                PAIEMENTS EN ATTENTE <span class="badge bg-success">Done</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link align-middle active" data-bs-toggle="tab" href="#nav-badge-messages" role="tab" aria-selected="true">
                                EXPIRÉ <span class="badge bg-danger rounded-circle">5</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Nav tabs -->
                    <div class="tab-content text-muted">
                        <div class="tab-pane" id="nav-badge-home" role="tabpanel">
                            <table id="members_dt" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th >@lang('translation.member')</th>
                                        <th >@lang('translation.gym')</th>
                                        <th >@lang('translation.services')</th>
                                        <th >@lang('translation.plans')</th>
                                        <th >@lang('translation.Joined-at')</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tab-pane" id="nav-badge-profile" role="tabpanel">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="ri-checkbox-circle-fill text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    In some designs, you might adjust your tracking to create a certain artistic effect. It can also help you fix fonts that are poorly spaced to begin with.
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                <div class="flex-shrink-0">
                                    <i class="ri-checkbox-circle-fill text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active show" id="nav-badge-messages" role="tabpanel">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="ri-checkbox-circle-fill text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    Each design is a new, unique piece of art birthed into this world, and while you have the opportunity to be creative and make your own style choices.
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                <div class="flex-shrink-0">
                                    <i class="ri-checkbox-circle-fill text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    For that very reason, I went on a quest and spoke to many different professional graphic designers and asked them what graphic design tips they live.
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div>
        </div>
        <!-- end col -->
        <div class="col-xl-4">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Statistiques</h4>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <a class="text-reset dropdown-btn" href="#"
                                data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <span class="text-muted">Report<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="store-visits-source"
                        data-colors='["--vz-success", "--vz-primary", "--vz-danger", "--vz-danger", "--vz-info"]'
                        class="apex-charts" dir="ltr"></div>
                </div>
            </div> <!-- .card-->
        </div> 
        <!-- end col -->


    </div><!-- end row -->

@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/js/jquery-3.6.0.min.js') }}" crossorigin="anonymous"></script>

    <script src="{{ URL::asset('/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/buttons.html5.min.js') }}"></script>
    
    

    {{-- <script src="{{ URL::asset('/assets/js/pages/dashboard-projects.init.js') }}"></script> --}}
    <script src="{{ URL::asset('/assets/js/app.js') }}"></script>
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/swiper/swiper.min.js')}}"></script>
    <!-- dashboard init -->
    {{-- <script src="{{ URL::asset('/assets/js/pages/dashboard-ecommerce.init.js') }}"></script> --}}
    <script>
        $(document).ready(function(){
            fill_datatable();
            function fill_datatable(global_filter = '' ,filter_firstname = '', filter_lastname = '', gymId = '', filter_cin = '', filter_phone = '', filter_address = '', filter_city= '', filter_service ='', filter_plans = '' )
                {
                    var dataTable = $('#members_dt').DataTable({
                        "processing" : true,
                        "serverSide" : true,
                        "order" : [],
                        "scrollX": true,
                        "searching" : false,
                        "ajax" : {
                        url:"../members/getMonthlyJoiningsMembers",
                        type:"POST",
                        data:{
                            "_token": "{{ csrf_token() }}",
                            global_filter:global_filter,
                            filter_firstname:filter_firstname,
                            filter_lastname:filter_lastname,
                            filter_cin:filter_cin,
                            filter_phone:filter_phone,
                            filter_address:filter_address,
                            filter_city:filter_city,
                            filter_service:filter_service,
                            filter_plans:filter_plans,
                            gymId:gymId
                        }
                        }
                    });
                }
   
            // get colors array from the string
function getChartColorsArray(chartId) {
    if (document.getElementById(chartId) !== null) {
      var colors = document.getElementById(chartId).getAttribute("data-colors");
  
      if (colors) {
        colors = JSON.parse(colors);
        return colors.map(function (value) {
          var newValue = value.replace(" ", "");
  
          if (newValue.indexOf(",") === -1) {
            var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
            if (color) return color;else return newValue;
            ;
          } else {
            var val = value.split(',');
  
            if (val.length == 2) {
              var rgbaColor = getComputedStyle(document.documentElement).getPropertyValue(val[0]);
              rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
              return rgbaColor;
            } else {
              return newValue;
            }
          }
        });
      } else {
        console.warn('data-colors atributes not found on', chartId);
      }
    }
  } // world map with line & markers
var chartDonutBasicColors = getChartColorsArray("store-visits-source");

if (chartDonutBasicColors) {
  $.ajax({
    type:'POST',
    url:'../members/getStatisticData',
    data: {'_token' : '{{ csrf_token() }}'},
    dataType: 'json',
    success:function(result) {
        //$("#msg").html(data.msg);
        $( "#all_members" ).attr( "data-target", 129);
        console.log(result);
        var options = {
    series: [result.monthlyJoined, result.pending_paiment, result.expired_members],
    labels: ["MONTHLY JOININGS", "PENDING PAYMENTS", "EXPIRED"],
    chart: {
      height: 333,
      type: "donut"
    },
    legend: {
      position: "bottom"
    },
    stroke: {
      show: false
    },
    dataLabels: {
      dropShadow: {
        enabled: false
      }
    },
    colors: chartDonutBasicColors
  };
  var chart = new ApexCharts(document.querySelector("#store-visits-source"), options);
  chart.render();
    }
    });

} // world map with markers
        });
    </script>


@endsection
