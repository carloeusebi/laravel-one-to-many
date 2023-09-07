@extends('layouts.app')

@section('content')
    <x-admin.projects.header :title="$title" has-back-button />

    <x-admin.projects.form method="PUT" action="admin.projects.update" :project="$project" />
@endsection
