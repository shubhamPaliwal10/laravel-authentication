@extends('layouts.app')

@section('title', 'Welcome Page')

@section('custom_styles')

@endsection


@section('content')
    <h1 class="text-center">Welcome to the Home Page</h1>
@endsection



@section('custom_scripts')
<script>
    console.log('Welcome to Home Page');
</script>
@endsection
