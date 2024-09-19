{{-- @extends('layouts.main')

@section('container')
<div class="bg" style="background-color:#E6E6FA ; background-size: cover; background-position: center;">

    <img src="/asset/bg-pattern.png" alt="">

<div id="hero" class="pt-3 align-content-center text-center">
    <img src="/asset/hero.png" alt="">
    <h1 class="align-center text-light text-bold"><mark>Welcome to Ramzy Scm</mark></h1>
    <h5 class="align-center tet-light text-bold"><mark>Empowering Scm in burger stall</mark></h5>
</div>


</div>

    
@endsection --}}

@extends('layouts.main')

@section('container')
<div class="bg bg-cover bg-center min-h-screen flex items-center justify-center" style="background-color:#6A0DAD; background-image: url('/asset/bg-pattern.png'); background-size: 90rem 50rem; background-repeat: no-repeat;">


    <div id="hero" class="container mx-auto flex items-center justify-between px-6 mt-20">

        <div class="flex-1 flex justify-center">
            <img src="/asset/hero.png" alt="Hero Image" class="w-full h-auto max-w-md">
        </div>
        

        <div class="flex-1 text-white mr-6 mt-1">
            <h1 class="text-4xl font-bold mb-4">Welcome to Ramzy Scm</h1>
            <p class="mb-4">Empowering Scm in burger stall and increase business productivity</p>
            <a href="{{ route('register') }}" class="btn btn-warning mt-4 font-bold text-white">SIGN UP</a>
        </div>

       
    </div>
    
</div>
@endsection

