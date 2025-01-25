{{-- Lawyer Dashboard Template--}}
@extends('layout.master1')

@section('dynblock')
@include('layout.navlawyer')
  <!-- about section start -->
<div class="about_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img class= "img-fluid full" src="asset/images/Mustafa-Koca.jpg" alt="lawyer image" style="object-fit: cover;">
            </div>
            <div class="col-md-6">
            <h1 class="laywer_text">▎{{$data1->first_name}} {{ $data1->last_name }}</h1>
                <p class="lorem_text">{{ $data1->accomplishment }}</p>
            </div>
            <div class="col-md-3">
                <h2>▎Education</h2>
                <ul>
                    <li>{{$data1->education}}</li><br>
                </ul>
                <br>
                <h2>▎Language</h2>
                <ul>
                    <li>Dutch, Turkish,  Bahasa Indonesia and English</li>
                </ul>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-4">
                <h2 class="lawyer_text">Contact Details</h2>
                <ul>
                    <li>Phone: {{ $data1->phone_number }}</li>
                    <li>Email: {{ $data1->email }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
  <!-- about section end -->

@stop
