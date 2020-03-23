@extends('layouts.app')

@section('content')

    <div style="height: 20px;"></div>

    <div class="row">
        <div class="col">
            {{ $records->links() }}
        </div>
    </div>

    <div style="height: 100px;"></div>

@endsection