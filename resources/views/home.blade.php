@extends('layouts.app')

@section('title')
Home Page
@endsection

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('List All Server') }}</h2>
                    <a href="{{ route('server.create') }}" class="btn btn-primary mt-2"> + Add Server</a>
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
        <div id="alertMessage" class="alert" style="display: none;"></div>

        <div class="card-style-3 mb-30">
            <div class="card-content">
                <div class="table-wrapper table-responsive">
                    <table class="table striped-table">
                        <thead>
                            {{-- <h1>User Active</h1> --}}
                        <tr>
                            <th><h6>ID</h6></th>
                            <th><h6>Name</h6></th>
                            <th><h6>Ip Address</h6></th>
                            <th><h6>Host</h6></th>
                            <th><h6>Port</h6></th>
                            <th><h6>Action</h6></th>
                        </tr>
                        <!-- end table row-->
                        </thead>
                        <tbody>
            
                            @forelse ($servers as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->host }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->port }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('server.destroy', $item->id) }}" method="POST" class="mr-2">
                                            <a href="{{ route('dashboard.show', $item->id) }}" class="btn btn-success"><i class="fas fa-home"></i></a>
                                            <a href="{{ route('server.edit', $item->id) }}" class="btn btn-primary"><i class="fas fa-pencil"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>

                                        <button id="checkMikrotikStatusButton" class="btn btn-warning mx-1" onclick="checkMikrotikStatus({{ $item->id }})"><i class="fas fa-plug"></i></button>
                                    </div>
                                    <div id="mikrotikStatusResult"></div>
                                </td>

                            </tr>
                             @empty
                                <div class="alert alert-danger">
                                    Data Router belum Tersedia.
                                </div>
                            @endforelse
                    
                            
                        <!-- end table row -->
                        </tbody>
                    </table>
                    <!-- end table -->

                    {{-- {{ $users->links() }} --}}
                </div>
            </div>
        </div>
    </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function checkMikrotikStatus(serverId) {
    // Get the CSRF token value from the page's meta tag
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '{{ route('checkMikrotikStatus') }}',
        type: 'POST',
        data: {
            id: serverId,
            _token: csrfToken, // Include the CSRF token
        },
        success: function(response) {
            // Display success message
            showAlert('success', response.message + ' - Server: ' + response.identityName + ' - RouterOS Version: ' + response.routerOSVersion + ' - Board Name: ' + response.boardName);
        },
        error: function(xhr, status, error) {
            // Display error message
            showAlert('error', 'Error: ' + xhr.responseText);
        }
    });
}

function showAlert(type, message) {
    var alertElement = $('#alertMessage');
    
    // Set the appropriate alert class based on the type
    var alertClass = (type === 'success') ? 'alert-success' : 'alert-danger';

    alertElement.removeClass('alert-success alert-danger').addClass(alertClass).text(message).fadeIn();

    // Automatically hide the alert after 5 seconds (5000 milliseconds)
    setTimeout(function() {
        alertElement.fadeOut('slow');
    }, 5000);
}

</script> 
   
@endsection
