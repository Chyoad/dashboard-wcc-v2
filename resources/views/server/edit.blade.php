@extends('layouts.app')

@section('title')
Update Server Page
@endsection

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Edit Server') }}</h2>
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
                <form action="{{ route('server.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" id="" name="name" value="{{ $item->name }}" aria-describedby="emailHelp" >
                    </div>
                    <div class="form-group mb-3">
                        <label for=""></label>Host
                        <input type="text" class="form-control" id="" name="host" value="{{ $item->host }}" aria-describedby="emailHelp" >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">username</label>
                        <input type="text" class="form-control" id="" name="username" value="{{ $item->username }}" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="myPass" name="password" value="{{ $item->password }}">
                            <span class="input-group-text" onclick="showPass()"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">port</label>
                        <input type="text" class="form-control" id="" name="port" value="{{ $item->port }}" aria-describedby="emailHelp">
                    </div>
                    <script>
                        function showPass() {
                            var x = document.getElementById("myPass");
                            if (x.type === "password") {
                                x.type = "text";
                            } else {
                                x.type = "password";
                            }
                        }
                    </script>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
   
@endsection
