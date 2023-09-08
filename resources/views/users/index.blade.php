@extends('layouts.app')

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
                    <table class="table striped-table">
                        <thead>
                            <h1>User Active</h1>
                        <tr>
                            <th><h6>ID</h6></th>
                            <th><h6>Server</h6></th>
                            <th><h6>User</h6></th>
                            <th><h6>Address</h6></th>
                            <th><h6>Uptime</h6></th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
                        @foreach($totalUserActiveQuery as $data)
                            <tr>
                                <td>{{ $data[".id"] }}</td>
                                <td>{{ $data["server"] }}</td>
                                <td>{{ $data["user"] }}</td>
                                <td>{{ $data["address"] }}</td>
                                <td>{{ $data["uptime"] }}</td>
                                {{-- <td>
                                    <p>{{ $data->email }}</p>
                                </td> --}}
                            </tr>
                        @endforeach
                        <!-- end table row -->
                        </tbody>
                    </table>
                    <!-- end table -->

                    {{-- {{ $users->links() }} --}}
                </div>

            </div>
        </div>
    </div>
    <div class="card-styles">
        <div class="card-style-3 mb-30">
            <div class="card-content">
                <div class="table-wrapper table-responsive">
                    <table class="table striped-table">
                        <thead>
                            <h1>All User</h1>
                        <tr>
                            <th><h6>ID</h6></th>
                            <th><h6>Server</h6></th>
                            <th><h6>Name</h6></th>
                            <th><h6>Profile</h6></th>
                            <th><h6>Uptime</h6></th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
                        @foreach($totalUserQuery as $data)
                            <tr>
                                <td>{{ $data[".id"] ?? '' }} </td>
                                <td>{{ $data["server"] ?? ''}}</td>
                                <td>{{ $data["name"] ?? '' }}</td>
                                <td>{{ $data["profile"] ?? '' }}</td>
                                <td>{{ $data["uptime"] ?? '' }}</td>
                                {{-- <td>
                                    <p>{{ $data->email }}</p>
                                </td> --}}
                            </tr>
                        @endforeach
                        <!-- end table row -->
                        </tbody>
                    </table>
                    <!-- end table -->

                    {{-- {{ $users->links() }} --}}
                </div>

            </div>
        </div>
    </div>
@endsection
