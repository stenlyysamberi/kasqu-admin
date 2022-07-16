@extends('main.index')
@section('menu')

 <!-- start page title -->
 <div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $menu1 }}</a></li>
                    <li class="breadcrumb-item active">{{ $menu2 }}</li>
                </ol>
            </div>
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 

<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-sm bg-blue rounded">
                        <i class="fe-download avatar-title font-22 text-white"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3  class="text-dark my-1">Rp.<span data-plugin="counterup">{{number_format($saldo->saldo) }}</span></h3>
                        <p class="text-muted mb-1 text-truncate">Income status</p>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <h6 class="text-uppercase">Target <span class="float-right">60%</span></h6>
                <div class="progress progress-sm m-0">
                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                        <span class="sr-only">60% Complete</span>
                    </div>
                </div>
            </div>
        </div> <!-- end card-box-->
    </div> <!-- end col -->

    <div class="col-md-6 col-xl-3">
        <div class="card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-sm bg-success rounded">
                        <i class="fe-user avatar-title font-22 text-white"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="text-dark my-1"><span data-plugin="counterup">1576</span></h3>
                        <p class="text-muted mb-1 text-truncate">January's Sales</p>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <h6 class="text-uppercase">Target <span class="float-right">49%</span></h6>
                <div class="progress progress-sm m-0">
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="49" aria-valuemin="0" aria-valuemax="100" style="width: 49%">
                        <span class="sr-only">49% Complete</span>
                    </div>
                </div>
            </div>
        </div> <!-- end card-box-->
    </div> <!-- end col -->

    <div class="col-md-6 col-xl-3">
        <div class="card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-sm bg-warning rounded">
                        <i class="fe-bar-chart-2 avatar-title font-22 text-white"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="text-dark my-1">$<span data-plugin="counterup">8947</span></h3>
                        <p class="text-muted mb-1 text-truncate">Payouts</p>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <h6 class="text-uppercase">Target <span class="float-right">18%</span></h6>
                <div class="progress progress-sm m-0">
                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100" style="width: 18%">
                        <span class="sr-only">18% Complete</span>
                    </div>
                </div>
            </div>
        </div> <!-- end card-box-->
    </div> <!-- end col -->

    <div class="col-md-6 col-xl-3">
        <div class="card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-sm bg-info rounded">
                        <i class="fe-cpu avatar-title font-22 text-white"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="text-dark my-1"><span data-plugin="counterup">178</span></h3>
                        <p class="text-muted mb-1 text-truncate">Available Stores</p>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <h6 class="text-uppercase">Target <span class="float-right">74%</span></h6>
                <div class="progress progress-sm m-0">
                    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="74" aria-valuemin="0" aria-valuemax="100" style="width: 74%">
                        <span class="sr-only">74% Complete</span>
                    </div>
                </div>
            </div>
        </div> <!-- end card-box-->
    </div> <!-- end col -->


    <div class="col-md-12 col-xl-3">
        <div class="card-box">

            <h4 class="">Graph Income</h4>

            <div class="row">
                <div class="col-12">
                    <canvas id="myChart"></canvas>
                </div>
            </div>

        </div>
    </div>

    
</div>
<!-- end row -->
@endsection 