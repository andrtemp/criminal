@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="list-cards">
            @foreach($criminals as $criminal)
                <div class="card criminal-card">
                    <img class="card-img-top criminal-photo" src="{{ asset('storage/images/' . $criminal->photo) }}" alt="{{ $criminal->name }}">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $criminal->name }}</h5>
                        {{--<p class="card-text">{{ $criminal->article }}</p>--}}
                        <div class="form-group">
                            <a class="btn btn-dark btn-criminal" href="/criminals/{{ $criminal->id }}">Просмотр</a>
                            <a class="btn btn-primary btn-criminal" href="/criminals/{{ $criminal->id }}/edit">Изменить</a>
                            <form method="POST" action="/criminals/{{ $criminal->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-criminal">
                                    Удалить
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection