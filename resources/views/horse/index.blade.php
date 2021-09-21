@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Horses list</div>
                    <div class="card-body">
                        <div class="mt-3">{{ $horses->links() }}</div>

                        <ul class="list-group">
                            @foreach ($horses as $horse)
                                <li class="list-group-item">
                                    <div class="listBlock">
                                        <div class="listBlock__content">
                                            <h4>{{ $horse->name }}</h4>
                                        </div>

                                        <div class="listBlock__content">
                                            <h4>Runs: {{ $horse->runs }}</h4>
                                        </div>
                                        <div class="listBlock__content">
                                            <h4>Wins: {{ $horse->wins }}</h4>
                                        </div>

                                        <div class="listBlock__content">
                                            <h4>about: {{ $horse->about }}</h4>
                                        </div>

                                        <div class="listBlock__buttons">
                                            <a href="{{ route('horse.edit', [$horse]) }}" class="btn btn-info">Edit</a>
                                            <form method="POST" action="{{ route('horse.destroy', $horse) }}">
                                                <button class="btn btn-danger" type="submit">delete</button>
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-3">{{ $horses->links() }}</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title') Horses list @endsection
