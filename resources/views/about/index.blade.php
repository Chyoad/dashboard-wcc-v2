@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                {{-- <div class="title mb-30">
                    <h2>{{ __('List All Mitra') }}</h2>
                    <a href="{{ route('client.create') }}" class="btn btn-primary mt-2">About</a>
                </div> --}}
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
                            <th><h6>Email</h6></th>
                            <th><h6>Nomor Telepon</h6></th>
                            <th><h6>Alamat</h6></th>
                            <th><h6>Logo</h6></th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
            
                            @foreach ($about as $item)
                            <tr>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->telepon }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->logo }}</td>
                                <td>
                                    <a href="{{ route('about.edit', $item->id) }}"><i class="fas fa-cog mr-20 fa-xl"></i></a>
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
