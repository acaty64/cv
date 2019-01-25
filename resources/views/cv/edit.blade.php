@extends('layouts.app')

@section('title','Curriculum Vitae')

@section('content')
	{{-- <h2>Prioridad de Docentes del curso: {{ $curso->wcurso }}</h2> --}}
	<Cv_edit-Component></Cv_edit-Component>
@endsection

@section('view','cv/edit.blade.php')