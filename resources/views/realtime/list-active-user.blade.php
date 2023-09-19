<table class="table striped-table">
  <thead>
    <h1>Active User</h1>
      <tr>
        <th><h6>ID</h6></th>
        <th><h6>Name</h6></th>
        <th><h6>Uptime</h6></th>
      </tr>
      <!-- end table row-->
  </thead>
  <tbody>
  @foreach($active_users as $data)
      <tr>
        <td>{{ $data[".id"] }} </td>
        <td>{{ $data["name"] }}</td>
        <td>{{ $data["uptime"] }}</td>
      </tr>
  @endforeach
      <!-- end table row -->
  </tbody>
</table>
 <!-- end table -->