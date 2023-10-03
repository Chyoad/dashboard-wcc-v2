@extends('layouts.app')


@section('title')
List Active User Page
@endsection

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Users') }}</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    
    <div class="card-styles">
        <div class="card-style-3 mb-30">
            <div class="card-content">
                <div class="table-wrapper table-responsive">

                <div id="list-active-user"></div>

                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">

    setInterval('activeUser();',1000);
    function activeUser() {
            var id = {{ $id }} ;
            var url = "{{ route('hotspot.active', ['id' => ':id']) }}";
            url = url.replace(':id', id);

            $('#list-active-user').load(url);
        }

    </script>
@endsection
