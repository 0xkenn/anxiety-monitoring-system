@extends('layouts.employee')

@section('content')
<div class="contact-container" style="background-color: #fff; padding: 40px; border-radius: 20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); width: 100%; max-width: 900px; display: flex; justify-content: space-between; align-items: center; margin-left: 300px; margin-top: 120px;"> <!-- Set margin-left to 150px -->
    <div class="contact-info" style="width: 55%;">
        <h2 style="font-size: 32px; color: #000; margin-bottom: 20px;">Contact Information</h2>
        <p style="font-size: 16px; color: #333; margin: 15px 0; display: flex; align-items: center;">
            <i class="fas fa-clock" style="margin-right: 15px; font-size: 18px; color: #007bff;"></i> Monday - Friday from 7:30 AM - 5:00 PM
        </p>
        <p style="font-size: 16px; color: #333; margin: 15px 0; display: flex; align-items: center;">
            <i class="fas fa-map-marker-alt" style="margin-right: 15px; font-size: 18px; color: #007bff;"></i> 2nd Floor Student Center, BIPSU Main Campus, Naval, Biliran
        </p>
        <p style="font-size: 16px; color: #333; margin: 15px 0; display: flex; align-items: center;">
            <i class="fas fa-phone-alt" style="margin-right: 15px; font-size: 18px; color: #007bff; transform: rotate(-45deg);"></i> +63 9123456789
        </p>
        <p style="font-size: 16px; color: #333; margin: 15px 0; display: flex; align-items: center;">
            <i class="fas fa-envelope" style="margin-right: 15px; font-size: 18px; color: #007bff;"></i> <a href="mailto:guidanceoffice@bipsu.edu.ph" style="color: #007bff; text-decoration: none;">guidanceoffice@bipsu.edu.ph</a>
        </p>
        <p style="font-size: 16px; color: #333; margin: 15px 0; display: flex; align-items: center;">
            <i class="fas fa-globe" style="margin-right: 15px; font-size: 18px; color: #007bff;"></i> Psychosocial Support of the BIPSU Guidance Office
        </p>
    </div>

    <div class="image-container" style="width: 45%; display: flex; justify-content: center;">
        <img src="{{ asset('assets/counsel.jpg') }}" alt="Contact Image" style="width: 100%; max-width: 350px; border-radius: 10px;">
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .contact-container {
            flex-direction: column;
            text-align: center;
        }

        .contact-info {
            width: 100%;
        }

        .image-container {
            margin-top: 20px;
            width: 100%;
        }

        .image-container img {
            max-width: 100%;
        }

        .h2 {
            margin-bottom: 60px;
        }
    }
</style>
@endsection
