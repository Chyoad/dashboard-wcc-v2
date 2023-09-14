@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Edit About') }}</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="row">
        <div class="col-md-6">
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
                        <form action="{{ route('about.update', $about->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="email" class="form-control" id="" name="email" value="{{ $about->email }}" aria-describedby="emailHelp" >
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Nomor Telepon</label>
                                <input type="text" class="form-control" id="" name="telepon" value="{{ $about->telepon }}" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Tautan alamat</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="" name="alamat" value="{{ $about->alamat }}" aria-describedby="emailHelp">
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <label for="">Gambar Logo</label>
                                <div class="custom-file">
                        <input type="file" name="logo" class="custom-file-input" id="image">
                                    <label class="custom-file-label">Pilih file</label>
                                </div>
                            </div>
                           
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
@endsection
