@extends('layouts.student')

@section('content')
    <div class="container" style="width: 700%; height: 100vh; position: relative; padding: 0; overflow: hidden;">
        <img src="{{ asset('assets/student.png') }}" alt="Image" style="width: 100%; object-fit: cover; position: absolute; top: 0; left: 0; margin-top:70px; z-index: -1;">
        
        <div class="text-wrapper" style="position: absolute; top: 20%; right: 20px; font-family: 'Poppins', sans-serif; width: calc(100% - 60px); max-width: 400px; color: black; z-index: 1;">
            <p class="text-24" style="font-size: 36px; margin-bottom: 20px; line-height: 1.2;">
                <span class="line1" style="color: black; font-weight: bold;">Hello, {{ $name }}</span><br>
                <span class="line2" style="color: white; white-space: nowrap; font-weight: bold;">how are you today?</span>
            </p>
            <p class="text-14" style="font-size: 16px; color: rgba(14, 1, 20, 0.959); text-align: right; line-height: 1.3; margin-top: 165px; white-space: normal; margin-right: 90px;">
                Come, have a regular check<br>and receive the result.
            </p>
        </div>
        
        <div class="link" style="position: absolute; bottom: 100px; right: 50px; z-index: 1;">
            <a href="{{ url('/student/assessment') }}" style="text-decoration: none; color: blue; font-size: 14px; font-family: 'Poppins', sans-serif; font-weight: bold;">Assess Myself <span style="margin-bottom: 10px;">&#8594;</span></a>
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

            /* Sidebar should be set here if applicable */
            .sidebar { /* Adjust the class name as needed */
                z-index: 2; /* Ensure it's in front of the background image */
            }
        }
    </style>
@endsection
