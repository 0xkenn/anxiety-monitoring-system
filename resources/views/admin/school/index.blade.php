<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School List</title>
  
  <!-- Google Fonts and Bootstrap CSS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f2f2f2;
    }

    .container {
      max-width: 900px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h3 {
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      margin-bottom: 20px;
      border-collapse: collapse;
    }

    table th, table td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: left;
    }

    table th {
      background-color: #007bff;
      color: #fff;
    }

    .btn-primary {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      font-weight: bold;
      background-color: #007bff;
      color: #fff;
      border: none;
      cursor: pointer;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h3>School List</h3>

    <!-- School table -->
    <table>
      <thead>
        <tr>
          <th>School Name</th>
          <th>Abbreviation</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($schools as $school)
        <tr>
          <td>{{ $school->school_name }}</td>
          <td>{{ $school->abbrev }}</td>
          <td>
            <a href="{{ route('edit.school', $school->id) }}" class="btn btn-sm btn-primary">Edit</a>
            <form action="{{ route('delete.school', $school->id) }}" method="post" style="display:inline-block;">
              @csrf
              <button class="btn btn-sm btn-danger">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <!-- Button to add new school -->
    <a href="{{ route('create.school') }}" class="btn btn-primary">Add New School</a>
  </div>
</body>
</html>