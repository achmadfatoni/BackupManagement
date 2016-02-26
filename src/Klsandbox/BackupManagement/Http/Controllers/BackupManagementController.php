<?php

namespace Klsandbox\BackupManagement\Http\Controllers;

use Klsandbox\BackupManagement\Commands\StartOnDemandBackup;
use Klsandbox\BackupManagement\Models\BackupRun;

class BackupManagementController extends Controller
{

    /**
     * List page of backup management.
     *
     * @return mixed
     */
    public function index()
    {
        return view('backup-management.all')->withBackups(BackupRun::orderBy('id', 'desc')->get());
    }

    /**
     * Show a backup info.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $backup = BackupRun::getCompletedById($id);

        return view('backup-management.show')->withBackup($backup);
    }

    /**
     * Start backing up with ondemand is true.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function start()
    {
        \Queue::pushOn('backup', new StartOnDemandBackup());

        return redirect('backup-management/list/all');
    }

    /**
     * Sync backups by file path.
     *
     * @param $path
     * @return \Illuminate\Http\JsonResponse
     */
    public function synced($path)
    {
        BackupRun::syncedByFilepath($path);

        return response()->json(['message' => 'Success']);
    }

    /**
     * Delete backups by file path.
     *
     * @param $path
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($path)
    {
        BackupRun::deleteByFilepath($path);

        return response()->json(['message' => 'Success']);
    }

}
