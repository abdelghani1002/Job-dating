@extends("layouts.layout")
@section('title')
    Company-index
@endsection

@section('content')
    <h1>List of Companies</h1>
    @foreach ($companies as $company)
        <h1>{{ $company->name }}</h1>
        <hr>
    @endforeach
@endsection
