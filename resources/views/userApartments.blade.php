@extends('layouts.app')
@section('content')

    @foreach ($apartments as $apartments)
        <p>{{apartments->title}} </p>
    @endforeach
@endsection