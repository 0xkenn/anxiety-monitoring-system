@extends('layouts.employee')

@section('content')
  @if (session()->has('message'))
    <p>{{ session()->get('message') }}</p>
  @endif

  <div class="container" style="margin: 80px auto; width: 70%; margin-left: 250px;">
    <h4 style="text-align: center; margin-top: 50px; margin-bottom: 100px; margin-right: 170px;">Assessment Test</h4>
    
    <div style="margin-bottom: 20px;">
      <h6 class="value hide-in-result" style="display: flex;">Score Value (0-35=Low) (36-75=Moderate) (76-105=Severe)</h6>
    </div>

    <table class="table table-bordered bg-white" id="newTable">
      <thead>
        <tr>
          <th scope="col" style="background-color: lightblue;">Scoring</th>
          <th scope="col">Not At All</th>
          <th scope="col">Mild, but it didn't bother me much</th>
          <th scope="col">Moderately, it wasn't pleasant at times</th>
          <th scope="col">Severely, it bothered me a lot</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td>0</td>
          <td>1</td>
          <td>2</td>
          <td>3</td>
        </tr>
      </tbody>
    </table>

    <form id="myForm" method="POST" action="{{ route('assessment.store') }}">
    @csrf
      <table class="table table-bordered" id="myTable" style="margin-top: 60px;">
        <thead>
          <tr>
            <th scope="col" style="background-color: lightblue;">Anxiety Symptoms</th>
            <th scope="col">Not At All</th>
            <th scope="col">Mild, but it didn't bother me much</th>
            <th scope="col">Moderately, it wasn't pleasant at times</th>
            <th scope="col">Severely, it bothered me a lot</th>
          </tr>
        </thead>
        <tbody id="questionsBody">
          <!-- Questions rows will be generated dynamically -->
        </tbody>
      </table>

      <button type="submit" class="btn btn-primary" style="float: right; margin: 10px; background-color: blue;" id="viewResultBtn">Prediction</button>
    </form>

    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="successModalLabel">Message</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modalMessage" style="color: black;">
            <!-- Error message will be inserted here -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function () {
      var questions = [
        "Numbness or Tingling", "Feeling hot", "Wobbliness in legs", "Unable to relax",
        "Fear of worst happening", "Dizzy or Lightheaded", "Heart pounding/racing",
        "Unsteady", "Terrified or Afraid", "Nervous", "Feeling of choking",
        "Hands trembling", "Shaky/Unsteady", "Fear of losing control",
        "Difficulty of breathing", "Fear of dying", "Scared", "Indigestion",
        "Faint", "Hot flushes or chills", "Face flushed"
      ];

      let tbody = $("#questionsBody");
      for (let i = 0; i < questions.length; i++) {
        let row = `<tr><td>${questions[i]}</td>
           <td><input type='radio' name='q${i}' value='0' class='answer'></td>
           <td><input type='radio' name='q${i}' value='1' class='answer'></td>
           <td><input type='radio' name='q${i}' value='2' class='answer'></td>
           <td><input type='radio' name='q${i}' value='3' class='answer'></td>
           </tr>`;
        tbody.append(row);
      }

      $("#myForm").submit(function (event) {
        let allAnswered = true;

        $("input[type='radio']").removeClass('error');
        $("td").css('border', '');

        for (let i = 0; i < questions.length; i++) {
          if (!$(`input[name='q${i}']:checked`).val()) {
            allAnswered = false;
            $(`input[name='q${i}']`).closest('td').css('border', '2px solid red');
          }
        }

        if (!allAnswered) {
          event.preventDefault();
          alert("Please answer all questions.");
        }
      });

      @if(session('message'))
        $('#modalMessage').text("{{ session('message') }}");
        $('#successModal').modal('show');
      @endif
    });
  </script>
@endsection
