@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Better</div>

                    <form action="{{ route('better.index') }}" method="get">
                        <fieldset>
                            <legend>Filter</legend>
                            <div class="block">
                                <div class="form-group">
                                    <select class="form-control" name="horse_id">
                                        <option value="0" disabled selected>Select horse</option>
                                        @foreach ($horses as $horse)
                                            <option value="{{ $horse->id }}" @if ($horse_id == $horse->id) selected @endif>
                                                {{ $horse->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">Select horse from the list.</small>
                                </div>
                            </div>
                            <div class="block">
                                <button type="submit" class="btn btn-info" name="filter" value="horse">Filter</button>
                                <a href="{{ route('better.index') }}" class="btn btn-danger">
                                    <i class="fas fa-redo"></i></a>
                            </div>
                        </fieldset>
                    </form>
                    <div class="card-body">
                        <div class="mt-3">{{ $betters->links() }}</div>

                        <ul class="list-group">
                            @foreach ($betters as $better)
                                <li class="list-group-item">
                                    <div class="listBlock">
                                        <div class="listBlock__content">
                                            <div class="item">
                                                <p><b>Name:</b> <i>{{ $better->name }}</i> </p>
                                            </div>
                                            <div class="item">
                                                <p><b>Lastname:</b> <i>{{ $better->surname }}</i> </p>
                                            </div>
                                            <div class="item">

                                                <p><b>Horse: </b>{{ $better->getHorse->name }}</p>
                                            </div>
                                            <div class="item">
                                                <p><b>Bet: </b>{{ $better->bet }} $.</p>
                                            </div>
                                        </div>

                                        <div class="listBlock__buttons">
                                            <a href="{{ route('better.edit', [$better]) }}"
                                                class="btn btn-info">Edit</a>
                                            <form method="POST" action="{{ route('better.destroy', $better) }}">
                                                <button class="btn btn-danger" type="submit"><i
                                                        class="fas fa-trash-alt"></i></button>
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </li>

                            @endforeach
                        </ul>
                        <div class="mt-3">{{ $betters->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title') Better @endsection
