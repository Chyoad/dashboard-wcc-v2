@extends('layouts.app')

@section('title')
Dashbaord Server Page
@endsection

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

    .scrollable {
        
        width: 420px; 
        height: 80px; 
        border: 1px solid #3498db;
        border-radius: 5px; 
        background-color: #ffffff; 
        padding: 5px;
        max-height: 35px; /* Adjust according to your preferred initial visible height */
    overflow: hidden;
    transition: max-height 0.2s ease-out; /* Smooth transition */
}

    .scrollable select {
        border: none;
        background-color: transparent;
        width: 100%;
        height: 100%;
        outline: none; 
        font-size: 14px; 
        color: #333; 
    }

    
    .scrollable select option {
        padding: 5px;
    }


    .scrollable select option:hover {
        background-color: #3498db;
        color: #fff;
    }

</style>

    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Dashboard') }}</h2>
                    <h3>{{ $identity }}</h3>
                    <ul class="dropdown-menu">
                        <li><span class="dropdown-item-text">Dropdown item text</span></li>
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                    
                    <div class="ui scrolling dropdown mt-2">
                        <div class="text">Scrolling DropDown</div>
                        <i class="dropdown icon"></i>
                        <div class="menu">
                            @foreach ($servers as $server)
                                <div class="item"><a href="{{ route('dashboard.show', $server['id']) }}">{{ $server['host'] }}</a></div>
                            @endforeach
                        </div>
                    </div>
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
        <div class="col-lg-4">
            <div class="card card-stats" style="height: 10rem">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box blue">
                    <i class="fa-solid fa-clipboard" style="color: #ffffff;"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-2  small">IP Address</h5>
                        <span class="h4 font-weight-bold">{{ $ip_address }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-stats" style="height: 10rem">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box yellow">
                    <i class="fa-solid fa-wifi" style="color: #ffffff;"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-2  small">NodeMCU Status</h5>
                        <span class="h4 font-weight-bold" id="status">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-stats" style="height: 10rem">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box red">
                    <i class="fa-solid fa-user" style="color: #ffffff;" ></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-2  small">Total User</h5>
                        <span class="h4 font-weight-bold" id="user-income">Loading...</span>
                    </div>
                </div>
            </div>
        </div> 
    </div>   

    <div class="row">
        <div class="col-lg-4 mt-4">
            <div class="card card-stats" style="height: 10rem">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box purple">
                    <i class="fas fa-cloud" style="color: #ffffff;"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-2  small">System Runtime</h5>
                        <span class="h4 font-weight-bold" id="uptime">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-4">
            <div class="card card-stats" style="height: 10rem">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box orange">
                    <i class="fa-solid fa-microchip" style="color: #ffffff;"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-2  small">Board Name</h5>   
                        <span class="h4 font-weight-bold">{{ $board_name }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-4">
            <div class="card card-stats" style="height: 10rem">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box birumuda">
                    <i class="fa-solid fa-money-bill" style="color: #ffffff;"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-2  small">User Active</h5>
                    <span class="h4 font-weight-bold" id="active-user-income">Loading...</span>
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

    setInterval('uptime();',1000);
    function uptime() {
        var id = {{ $id }} ;
        var url = "{{ route('dashboard.uptime', ['id' => ':id']) }}";
        url = url.replace(':id', id);

        $('#uptime').load(url);
    }

    setInterval('activeUserIncome();',1000);
    function activeUserIncome() {
            var id = {{ $id }} ;
            var url = "{{ route('dashboard.activeUserIncome', ['id' => ':id']) }}";
            url = url.replace(':id', id);

            $('#active-user-income').load(url);
        }

    setInterval('allUserIncome();',1000);
    function allUserIncome() {
            var id = {{ $id }} ;
            var url = "{{ route('dashboard.userIncome', ['id' => ':id']) }}";
            url = url.replace(':id', id);

            $('#user-income').load(url);
        }

    setInterval('status();',1000);
    function status() {
            var id = {{ $id }} ;
            var url = "{{ route('dashboard.status', ['id' => ':id']) }}";
            url = url.replace(':id', id);

            $('#status').load(url);
        }

    

</script>
    

<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
<script>
    $('.ui.dropdown').dropdown();
</script>

@endsection