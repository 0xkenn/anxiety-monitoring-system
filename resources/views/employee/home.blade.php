@extends('layouts.employee')

@section('content')
    <div class="container" style="width: 100%; height: 100vh; position: relative; padding: 0; overflow: hidden;margin-left:220px;">
        <img src="{{ asset('assets/student.png') }}" alt="Image" style="width: 100%; height: auto; object-fit: cover; position: absolute; top: 0; left: 0;">
        
        <div class="text-wrapper" style="position: absolute; top: 20%; right: 20px; font-family: 'Poppins', sans-serif; width: calc(100% - 60px); max-width: 400px; color: black;">
            <p class="text-24" style="font-size: 36px; margin-bottom: 20px; line-height: 1.2;">
                <span class="line1" style="color: black; font-weight: bold;">Hello, {{ $name }}</span><br>
                <span class="line2" style="color: white; white-space: nowrap; font-weight: bold;">how are you today?</span>
            </p>
            <p class="text-14" style="font-size: 16px; color: rgba(14, 1, 20, 0.959); text-align: right; line-height: 1.3; margin-top: 190px; white-space: normal; margin-right: 90px;">
                Come, have a regular check<br>and receive the result.
            </p>
        </div>
        
        <div class="link" style="position: absolute; bottom: 100px; right: 50px; margi">
            <a href="{{ url('/employee/assessment') }}" style="text-decoration: none; color: blue; font-size: 14px; font-family: 'Poppins', sans-serif; font-weight: bold;">Assess Myself <span style="margin-buttom: 10px;">&#8594;</span></a>
        </div>
    </div>

    <style>
        /* Add responsive styles */
        @media (max-width: 768px) {
            .text-wrapper {
                top: 10%; /* Adjust for smaller screens */
                right: 10px; /* Adjust for smaller screens */
                width: calc(100% - 40px); /* Responsive width */
            }

            .link {
                bottom: 10px; /* Adjust for smaller screens */
                right: 10px; /* Adjust for smaller screens */
            }
        }
    </style>
@endsection  