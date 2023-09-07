@extends('layouts.app')

@section('content')
    <x-admin.projects.header :title="$project->name" has-back-button />

    <section>
        <div class="row">
            <div class="col-12 col-md-8">

                {{-- GITHUB URL --}}
                @isset($project->github_url)
                    <div><strong>Github url: </strong><a href={{ $project->github_url }}>{{ $project->github_url }}</a>
                    </div>
                @endisset
                {{-- URL --}}
                @isset($project->url)
                    <div><strong>Website url: </strong><a href={{ $project->url }}>{{ $project->url }}</a></div>
                @endisset

                <div class="my-2"><strong>Project Description:</strong></div>
                <p class="text-justify">
                    {{ $project->description }}
                </p>

            </div>
            <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
                {{-- preview --}}
                <figure class="bg-dark-subtle overflow-hidden d-flex justify-content-center align-items-center">
                    <img src="{{ $project->thumbUrl ?? Vite::asset('resources/images/placeholder.jpg') }}" alt="thumbnail"
                        class="block object-fit-cover  w-100" />
                </figure>

                <div class="d-flex gap-2 justify-content-end ">

                    {{-- EDIT BUTTON --}}
                    <a class="btn btn-warning" href="{{ route('admin.projects.edit', $project) }}">
                        <i class="fa-solid fa-pen me-2"></i>
                        <span>Edit</span>
                    </a>
                    {{-- DELETE BUTTON --}}
                    <x-admin.projects.delete-form :$project></x-admin.projects.delete-form>
                </div>
            </div>
    </section>
@endsection

@section('scripts')
    @vite('resources/js/delete-project-confirmation.js')
@endsection
