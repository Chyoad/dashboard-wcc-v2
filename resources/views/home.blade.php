@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('List All Mitra') }}</h2>
                    <a href="{{ route('client.create') }}" class="btn btn-primary mt-2"> + Add Mitra</a>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->
    <div class="card-styles">
        {{-- @if ($errors->any())
        <div class="form-group mt-4 mb-4">
            <div class="pull-right alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        @endif --}}

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
            
                            @foreach ($clients as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->ip }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('client.destroy', $item->id) }}" method="POST">
                                        <a href="{{ route('client.edit', $item->id) }}" class="btn btn-primary"><i class="fas fa-pencil"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        <a href="{{ route('dashboard.show', $item->id) }}" class="btn btn-success"><i class="fas fa-plug"></i></a>
                                    </form>
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
