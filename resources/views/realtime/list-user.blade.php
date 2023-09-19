<table class="table striped-table">
  <thead>
    <h1>All User</h1>
      <tr>
        <th><h6>ID</h6></th>
        <th><h6>Name</h6></th>
        <th><h6>Profile</h6></th>
        <th><h6>Uptime</h6></th>
        <th><h6>Limit-uptime</h6></th>
      </tr>
      <!-- end table row-->
  </thead>
  <tbody>
  @foreach($all_users as $data)
      <tr>
        <td>{{ $data[".id"] ?? '' }} </td>
        <td>{{ $data["name"] ?? '' }}</td>
        <td>{{ $data["profile"] ?? '' }}</td>
        <td>{{ $data["uptime"] ?? '' }}</td>
        <td>{{ $data["limit-uptime"] ?? '' }}</td>
      </tr>
  @endforeach
      <!-- end table row -->
  </tbody>
</table>
 <!-- end table -->