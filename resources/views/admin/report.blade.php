@extends('layouts.admin')

@section('content')
<div class="table-container" style="margin-top: 90px; margin-left: 200px; padding-left: 20px; font-family: 'Poppins', sans-serif;">
    <h4>Student and Employee Report</h4>

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px;">
      <thead>
        <tr>
          <th style="padding: 10px; border: 1px solid #dee2e6; font-size: 12px;">No.</th>
          <th style="padding: 10px; border: 1px solid #dee2e6; font-size: 12px;">User ID</th>
          <th style="padding: 10px; border: 1px solid #dee2e6; font-size: 12px;">User Type</th>
          <th style="padding: 10px; border: 1px solid #dee2e6; font-size: 12px;">Score</th>
          <th style="padding: 10px; border: 1px solid #dee2e6; font-size: 12px;">Status</th>
          <th style="padding: 10px; border: 1px solid #dee2e6; font-size: 12px;">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($questions as $question)
          <tr>
            <td style="padding: 10px; border: 1px solid #dee2e6; font-size: 12px;">{{ $loop->iteration }}</td>
            @if ($question->employee)
              <td style="padding: 10px; border: 1px solid #dee2e6; font-size: 12px;">{{ $question->employee->employee_id }}</td>
              <td style="padding: 10px; border: 1px solid #dee2e6; font-size: 12px;">Employee</td>
            @else
             @if ($question->student)
                <td style="padding: 10px; border: 1px solid #dee2e6; font-size: 12px;">{{ $question->student->user_id }}</td>
              <td style="padding: 10px; border: 1px solid #dee2e6; font-size: 12px;">Student</td>
             @endif
            @endif
            <td style="padding: 4px; border: 1px solid #dee2e6; font-size: 12px;">{{ $question->score }}</td>
            <td style="padding: 5px; border: 1px solid #dee2e6; font-size: 12px;">{{ $question->status }}</td>
            <td style="padding: 5px; border: 1px solid #dee2e6; font-size: 12px; display:fle justify-content:center; ">
              <form action="{{ route('question.destroy', $question->id) }}" method="post" style="display: flex; justify-content: center; align-items: center;">
    @csrf
    <button>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" height="16">
        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
    </svg>
    </button>
</form>

            </td>
           
          </tr>
          
        @endforeach
        
      </tbody>
    </table>
</div>
@endsection
