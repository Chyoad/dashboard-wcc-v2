<table class="table striped-table">
  <thead>
    <h1>Active User</h1>
      <tr>
        <th><h6>ID</h6></th>
        <th><h6>Server</h6></th>
        <th><h6>User</h6></th>
      </tr>
      <!-- end table row-->
  </thead>
  <tbody>
  @foreach($active_users as $data)
      <tr>
        <td>{{ $data[".id"] ?? '' }} </td>
        <td>{{ $data["server"] ?? '' }}</td>
        <td>{{ $data["user"] ?? '' }}</td>
      </tr>
  @endforeach
      <!-- end table row -->
  </tbody>
</table>
 <!-- end table -->