@extends('layouts.app')

@section('content')

<!-- Inline CSS for icons and colors -->
<style>
    .icon-box {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        border-radius: 5px;
        margin-right: 15px;
    }

    .icon-box i {
        font-size: 18px;
    }

    .card-body.d-flex {
        display: flex;
        align-items: center;
    }

    .icon-box.blue {
        background-color: #3498db;
    }

    .icon-box.red {
        background-color: #e74c3c;
    }

    .icon-box.green {
        background-color: #2ecc71;
    }

    .icon-box.yellow {
        background-color: #FFD12D;
    }

    .icon-box.purple {
        background-color: #8e44ad;
    }

    .icon-box.orange {
        background-color: #e67e22;
    }
    .icon-box.birumuda {
        background-color: #00FFF0;
    }
    .icon-box.pink {
        background-color: #FF00D6;
    }

</style>

    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Dashboard') }}</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <!-- Cards Row -->
    <div class="row">
    <!-- ========== First Card with Blue Icon Box ========== -->
    <div class="col-lg-3">
        <div class="card card-stats">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box blue">
                <i class="fa-solid fa-clipboard" style="color: #ffffff;"></i>
                </div>
                <div>
                    <h5 class="card-title mb-2  small">IP Address</h5>
                    <span class="h4 font-weight-bold">{{ $identity }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-stats">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box red">
                <i class="fa-solid fa-user" style="color: #ffffff;" ></i>
                </div>
                <div>
                    <h5 class="card-title mb-2  small">Total User</h5>
                    {{-- <span class="h4 font-weight-bold" id="user">0 Users</span> --}}
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3">
        <div class="card card-stats">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box green">
                <i class="fas fa-users" style="color: #ffffff;"></i>
                </div>
                <div>
                    <h5 class="card-title mb-2  small">Online User</h5>
                     {{-- <span class="h4 font-weight-bold" id="active-user"></span> --}}
                </div>
            </div>
        </div>
    </div>
   
    <div class="col-lg-3">
        <div class="card card-stats">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box yellow">
                <i class="fa-solid fa-wifi" style="color: #ffffff;"></i>
                </div>
                <div>
                    <h5 class="card-title mb-2  small">NodeMCU Status</h5>
                    {{-- <span class="h4 font-weight-bold" id="status"></span> --}}
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 mt-4">
        <div class="card card-stats">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box purple">
                <i class="fas fa-cloud" style="color: #ffffff;"></i>
                </div>
                <div>
                    <h5 class="card-title mb-2  small">System Runtime</h5>
                    {{-- <span class="h4 font-weight-bold" id="uptime"></span> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 mt-4">
        <div class="card card-stats">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box orange">
                <i class="fa-solid fa-microchip" style="color: #ffffff;"></i>
                </div>
                <div>
                    <h5 class="card-title mb-2  small">Board Name</h5>   
                    {{-- <span class="h4 font-weight-bold">{{ $board_name }}</span> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 mt-4">
        <div class="card card-stats">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box birumuda">
                <i class="fa-solid fa-money-bill" style="color: #ffffff;"></i>
                </div>
                <div>
                    <h5 class="card-title mb-2  small">Today Income</h5>
                    {{-- <span class="h4 font-weight-bold"></span> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 mt-4">
        <div class="card card-stats">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box pink">
                <i class="fa-solid fa-money-bills" style="color: #ffffff;"></i>
                </div>
                <div>
                    <h5 class="card-title mb-2  small">Total Income</h5>
                    {{-- <span class="h4 font-weight-bold">Rp.{{ number_format($countUser*1000) }}</span> --}}
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- End Cards Row -->
    <div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Graph</h5>
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">

    

</script>
    
@endsection