@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">{{ $criminal->name }}</h2>
        <div class="jumbotron">
            <div class="row">
                <div class=" col-md-3 text-center">
                    <img class="img-view rounded" src="{{ asset('storage/images/' . $criminal->photo) }}" alt="{{ $criminal->name }}">
                    <p>
                        {{ $criminal->birth_date }}
                    </p>
                </div>
                <div class="col-md-9">
                    <p class="text-justify">
                        {{ $criminal->article }}
                    </p>
                </div>
            </div>
            <div class="row">
                <form class="form-inline" action="/criminals/file/load" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $criminal->id }}" name="id">
                    <div class="form-group"i>
                        <input class="form-control" type="file" id="file" name="file"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-dark">
                            Загрузть документ
                        </button>
                    </div>
                </form>
            </div>
            <div class="button-print">
                @foreach ($criminal->files as $file)
                    <a class="btn btn-success" href="/criminals/files/get/{{ $file->id }}">Файл {{ $file->id }}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection