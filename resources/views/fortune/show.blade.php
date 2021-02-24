@extends('layout')

@section('content')
<h2>{{ $fortune->target_date }}の{{ $fortune->target_sign }}の運勢</h2>
<div>{{ $fortune->fortune_text }}</div>
@endsection
