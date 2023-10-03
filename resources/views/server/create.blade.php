@extends('layouts.app')

@section('title')
Create Server Page
@endsection

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Add Server') }}</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="card-styles">
        <div class="card-style-3 mb-30">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                </div>
            @endif
            <div class="card-content">
                <form action="{{ route('server.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" id="" name="name" aria-describedby="emailHelp" placeholder="Enter IP">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Host</label>
                        <input type="text" class="form-control" id="" name="host" aria-describedby="emailHelp" placeholder="Enter IP">
                    </div>
                    <div class="form-group mb-3">
                        <label for=""  class="form-label">Username</label>
                        <input type="text" class="form-control" id="" name="username" aria-describedby="emailHelp" placeholder="Enter name">
                    </div>
                    <div class="form-group mb-3">
                        <label for=""  class="form-label">Password</label>
                        <input type="password" class="form-control" id="" name="password" aria-describedby="emailHelp" placeholder="Enter password">
                    </div>
                    <div class="form-group mb-3">
                        <label for=""  class="form-label">Port</label>
                        <input type="password" class="form-control" id="" name="port" aria-describedby="emailHelp" placeholder="Enter password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
