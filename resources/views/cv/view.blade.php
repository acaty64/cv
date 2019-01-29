@extends('layouts.app')

@section('title', $modulo)

@section('content')
	<embed src="{{ asset($documento) }}" style="width:100%; height:800px;" frameborder="0">
@endsection

@section('view','cv/edit.blade.php')



{{-- <iframe width="400" height="400" src="{{$documento}}" frameborder="0"></iframe> --}}
	{{-- <a href="{{ asset('public/tests.pdf') }}">Abrir</a> --}}
