@extends('filament::layouts.app')

@section('content')
    <x-filament::app-header :title="$title" />

    <x-filament::app-content>
        <x-filament::card>
            <x-slot name="content">
                <h2 class="text-2xl font-semibold mb-6">Read-only Project Details</h2>

                <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <x-filament::readonly-field label="Project Title" :value="$project->project_title" />
                    <x-filament::readonly-field label="Department/Office" :value="$project->department_office" />
                    <x-filament::readonly-field label="Project Description" :value="$project->project_description" />
                    <!-- Add more fields as needed -->
                </dl>
            </x-slot>
        </x-filament::card>
    </x-filament::app-content>
@endsection
