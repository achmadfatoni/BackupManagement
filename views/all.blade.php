@extends('app')

@section('page-header')
    <h2>Backup Management</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Backup Management</span></li>
            <li><span>Backup Lists</span></li>
        </ol>

        <div class="sidebar-right-toggle"></div>
    </div>
@endsection


@section('content')
    <div class="panel panel-default">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Backup List</h2>
            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed mb-none">
                        <thead>
                        <tr>
                            <th class="text-center">Created at</th>
                            <th class="text-center">Path</th>
                            <th class="text-center">File size</th>
                            <th class="text-center">Is Synced</th>
                            <th class="text-center">Is Deleted</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($backups as $backup)
                            <tr>
                                <td class="text-center">{{ $backup->created_at }}</td>
                                <td class="text-center">
                                    @if($backup->is_completed == 1)
                                        <a href="{{ url('backup-management/view/' . $backup->id) }}">{{ $backup->path_to_backup }}</a>
                                    @else
                                        In progress
                                    @endif
                                </td>
                                <td class="text-center">{{ $backup->file_size }}</td>
                                <td class="text-center">{{ $backup->is_synced }}</td>
                                <td class="text-center">{{ $backup->is_deleted }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div> <!-- div.panel-body -->
        </section>
    </div>
@endsection
