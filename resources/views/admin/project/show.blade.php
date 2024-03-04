@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mt-5">
                <h2>{{ $project->name }}</h2>
                <p>{{ $project->type ? $project->type->name : 'Tipo assente' }}</p>
                <div class="logo">
                    @if ($project->logo != null)
                        <img src="{{ asset('/storage/' . $project->logo) }}" alt="{{ $project->name }}">
                    @else
                        <img src="{{ asset('/placeholder/logo.jpeg') }}" alt="{{ $project->name }}">
                    @endif
                </div>
                <p>Tecnologie utilizzate:</p>
                <ul class="list-unstyled">
                    @forelse ($project->technologies as $technology)
                        <li>{{ $technology->name }}</li>
                    @empty
                        <li>le tecnologie utilizzate non sono specificate</li>
                    @endforelse
                </ul>
                <div class="my-3">
                    Inizio Progetto: {{ $project->start_project }}
                    <p>{{ $project->finish_project ? 'Fine Progetto: ' . $project->finish_project : '' }}</p>
                </div>
                <p>{{ $project->description }}</p>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-sm btn-primary"><a href="{{ route('admin.project.index') }}"
                            class="text-light text-decoration-none">
                            < Indietro </a>
                    </button>

                    <button class="btn btn-sm btn-primary mx-1"><a
                            href="{{ route('admin.project.edit', ['project' => $project]) }}"
                            class="text-light text-decoration-none">
                            Modifica</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
