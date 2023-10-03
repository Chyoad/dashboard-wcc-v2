@extends('layouts.app')

@section('title')
List Server Page
@endsection

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('List All Mitra') }}</h2>
                    <a href="{{ route('server.create') }}" class="btn btn-primary mt-2"> + Add Server</a>
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
                            {{-- <h1>User Active</h1> --}}
                        <tr>
                            <th><h6>ID</h6></th>
                            <th><h6>Ip Address</h6></th>
                            <th><h6>Name</h6></th>
                            <th><h6>Action</h6></th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
            
                            @foreach ($servers as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->host }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a href="{{ route('server.edit', $item->id) }}"><i class="fas fa-cog mr-20 fa-xl"></i></a>
                                    <a href="{{ route('server.destroy', $item->id) }}"><i class="fas fa-trash mr-20 fa-xl"></i></a>
                                    <a href="#"><i class="fas fa-plug mr-20 fa-xl"></i></a>
                                </td>
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
