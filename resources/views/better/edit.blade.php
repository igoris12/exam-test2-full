@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit better</div>
                    <div class="card-body">

                        <div class="block__form">
                            <form method="POST" action="{{ route('better.update', [$better]) }}">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input class="form-control" type="text" name="better_name"
                                        value="{{ old('better_name', $better->name) }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Surname</label>
                                    <input class="form-control" type="text" name="better_surname"
                                        value="{{ old('better_surname', $better->surname) }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Bet</label>
                                    <input class="form-control" type="text" name="better_bet"
                                        value="{{ old('better_bet', $better->bet) }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Horse</label>
                                    <select name="horse_id">
                                        @foreach ($horses as $horse)
                                            <option value="{{ $horse->id }}" @if (old('horse_id', $better->horse_id) == $horse->id) selected @endif>
                                                {{ $horse->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @csrf
                                <button type="submit" class="btn btn-secondary">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title') Edit better @endsection
