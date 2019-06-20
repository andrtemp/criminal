@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">{{ $criminal->name }}</h2>
        <div class="jumbotron">
            <div class="text-center">
                <img class="img-view rounded" src="{{ asset('storage/images/' . $criminal->photo) }}" alt="{{ $criminal->name }}">
                <p>
                    {{ $criminal->birth_date }}
                </p>
            </div>
            <p class="text-justify">
                {{ $criminal->article }}
            </p>
        </div>
    </div>
@endsection