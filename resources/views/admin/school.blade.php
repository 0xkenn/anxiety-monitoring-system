@extends('layouts.admin')

@section('content')
<div class="container" style="margin-left: 220px; margin-top:20px; max-width: 800px; font-family: 'Poppins', sans-serif; font-size: 12px;">
    <h1>Schools List</h1>

    @if(session()->has('message'))
        <p>{{ session()->get('message') }}</p>
    @endif

    <div class="table-container" style="overflow-x: auto;">
        <div class="top-section" style="margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
            <div></div> <!-- Empty div to push the button to the right -->
            <button class="btn-primary" onclick="showModal()" 
                style="background-color: green; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer;">
                Add School
            </button>
        </div>
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <thead>
                <tr>
                    <th style="padding: 10px; border: 1px solid #dee2e6;">School Name</th>
                    <th style="padding: 10px; border: 1px solid #dee2e6;">Abbreviation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schools as $school)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $school->school_name }}</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">{{ $school->abbrev }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for adding a school -->
<div id="myModal" class="modal" style="display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0, 0, 0, 0.5);">
    <div class="modal-content" style="background-color: #fff; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 300px; border-radius: 5px;">
        <span class="close" onclick="closeModal()" style="cursor: pointer; float: right; font-size: 20px; font-weight: bold;">&times;</span>
        <h2>Add School</h2>
        <form action="{{ route('create.school') }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="input-group" style="margin-bottom: 10px;">
                    <label for="school_name" style="display: block; margin-bottom: 5px;">School Name</label>
                    <input type="text" id="school_name" name="school_name" value="{{ old('school_name') }}" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                </div>
                <div class="input-group" style="margin-bottom: 10px;">
                    <label for="abbrev" style="display: block; margin-bottom: 5px;">Abbreviation</label>
                    <input type="text" id="abbrev" name="abbrev" required style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-primary" style="background-color: green; color: white; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showModal() {
        document.getElementById('myModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('myModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>
@endsection
