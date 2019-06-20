@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>

            @if( isset($criminal) )
                Изменить {{ $criminal->name }}
            @else
                Добавить преступника
            @endif

        </h2>
        <form class="form" action="{{ isset($criminal) ? '/criminals/' . $criminal->id : '/criminals' }}" method="post" enctype="multipart/form-data">
            @csrf
            @if( isset($criminal) )
                @method('PATCH')
            @endif

            <div class="form-group">
                <label for="name">
                    ФИО
                </label>
                <input class="form-control" type="text" name="name" id="name" value="{{ isset($criminal) ? $criminal->name : '' }}"/>
            </div>

            <div class="form-group">
                <label for="photo">
                    Фото
                </label>
                <input class="form-control" type="file" name="photo" id="photo"/>
            </div>

            <div class="form-group">
                <label for="birth_date">
                    Дата рождения
                </label>
                <input class="form-control" type="text" name="birth_date" id="birth_date" value="{{ isset($criminal) ? $criminal->birth_date : '' }}"/>
            </div>

            <div class="form-group">
                <label for="article">
                    Статья
                </label>
                <textarea class="form-control" type="text" name="article" id="article">{{ isset($criminal) ? $criminal->article : '' }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Сохранить
                </button>
                <button type="reset" class="btn btn-danger">
                    Сброс
                </button>
            </div>
        </form>
    </div>
@endsection