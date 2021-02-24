@extends('layout')

@section('content')
<form action="{{ route('fortune.show') }}" method="get">
    <input type="date" name="birthday">
    <button type="submit">今日の運勢を見る</button>
</form>
@endsection
