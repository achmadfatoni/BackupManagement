@extends('app')

@section('page-header')
    @include('elements.page-header', ['section_title' => 'Backup Management', 'page_title' => 'View Backup'])
@endsection


@section('content')
    <div class="panel panel-default">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Backup</h2>
            </header>
            <div class="panel-body">
                <p><strong>Created at:</strong> {{ $backup->created_at }}</p>
                <p><strong>Path:</strong> {{ $backup->path_to_backup }}</p>
                <p><strong>File size:</strong> {{ $backup->file_size }}</p>
                <p><strong>Output text:</strong> {{ $backup->output_text }}</p>
                <p><strong>Error text:</strong> {{ $backup->error_text }}</p>
            </div> <!-- div.panel-body -->
        </section>
    </div>
@endsection
