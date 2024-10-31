<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit School</title>
  
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

    .input-group {
      margin-bottom: 15px;
    }

    .input-group label {
      font-weight: bold;
      margin-bottom: 5px;
    }

    .input-group input, .input-group select {
      width: 100%;
      height: 40px;
      padding: 8px;
      font-size: 14px;
      border-radius: 5px;
      border: 1px solid #ccc;
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

    .text-color-red {
      color: red;
      font-size: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h3>Edit School</h3>

    <!-- Form for editing school -->
    <form action="{{ route('update.school', $school->id) }}" method="post">
      @csrf
      @method('PUT')

      <div class="input-group">
        <label for="school_name">School Name</label>
        <select id="school_name" name="school_name" required>
          <option value="School of Technology and Computer Studies" {{ $school->school_name == 'School of Technology and Computer Studies' ? 'selected' : '' }}>School of Technology and Computer Studies</option>
          <option value="School of Engineering" {{ $school->school_name == 'School of Engineering' ? 'selected' : '' }}>School of Engineering</option>
          <option value="School of Teacher Education" {{ $school->school_name == 'School of Teacher Education' ? 'selected' : '' }}>School of Teacher Education</option>
          <option value="School of Arts and Sciences" {{ $school->school_name == 'School of Arts and Sciences' ? 'selected' : '' }}>School of Arts and Sciences</option>
          <option value="School of Criminal and Justice" {{ $school->school_name == 'School of Criminal and Justice' ? 'selected' : '' }}>School of Criminal and Justice</option>
          <option value="School of Management and Entrepreneurship" {{ $school->school_name == 'School of Management and Entrepreneurship' ? 'selected' : '' }}>School of Management and Entrepreneurship</option>
          <option value="School of Nursing and Health Sciences" {{ $school->school_name == 'School of Nursing and Health Sciences' ? 'selected' : '' }}>School of Nursing and Health Sciences</option>
        </select>
        @error('school_name')
          <div class="text-color-red">{{ $message }}</div>
        @enderror
      </div>

      <div class="input-group">
        <label for="abbrev">Abbreviation</label>
        <input type="text" id="abbrev" name="abbrev" value="{{ old('abbrev', $school->abbrev) }}" placeholder="School Abbreviation" required>
        @error('abbrev')
          <div class="text-color-red">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</body>
</html>
