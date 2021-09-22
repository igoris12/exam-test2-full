@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Better</div>

                    <form action="{{ route('better.index') }}" method="get">
                        <fieldset>
                            <legend>Sort</legend>
                            <div class="block">
                                <button type="submit" class="btn btn-info" name="sort" value="name">Name</button>
                                <button type="submit" class="btn btn-info" name="sort" value="surname">Surname</button>
                                <button type="submit" class="btn btn-info" name="sort" value="bet">Bet</button>
                            </div>
                            <div class="block">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sort_dir" id="_1" value="asc"
                                        @if ('desc' != $sortDirection) checked @endif>
                                    <label class="form-check-label" for="_1">
                                        ASC
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sort_dir" id="_2" value="desc"
                                        @if ('desc' == $sortDirection) checked @endif>
                                    <label class="form-check-label" for="_2">
                                        DESC
                                    </label>
                                </div>
                            </div>
                            <div class="block">

                                <a href="{{ route('better.index') }}" class="btn btn-warning"><i
                                        class="fas fa-redo"></i></a>
                            </div>
                        </fieldset>
                    </form>

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
                                        <details>
                                            <summary>{{ $better->name }} {{ $better->surname }}</summary>

                                            <div class="listBlock__content">
                                                <p>Horse: {{ $better->getHorse->name }}</p>
                                            </div>

                                            <div class="listBlock__content">
                                                <p><b>Bet: </b>{{ $better->bet }} $.</p>
                                            </div>

                                        </details>
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
