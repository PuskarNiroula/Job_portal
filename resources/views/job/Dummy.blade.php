@extends('layouts.jobseeker')

@section('title', 'Complete Profile')
@section('page_title',"Update Profile")

@section('content')

    <form method="POST" action="{{ route('jobseeker.application.apply') }}">
        @csrf
        <input type="number" placeholder="post" name="post_id"/>
        <button type="submit">Apply</button>
    </form>

@endsection


