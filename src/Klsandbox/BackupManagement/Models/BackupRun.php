<?php

namespace Klsandbox\BackupManagement\Models;

use Illuminate\Database\Eloquent\Model;

class BackupRun extends Model
{
    /**
     * @var string
     */
    protected $table = 'backups_run';

    /**
     * @var array
     */
    protected $fillable = [
        'path_to_backup', 'file_size', 'output_text', 'error_text', 'is_deleted', 'is_synced',
        'is_on_demand', 'is_completed'
    ];

    /**
     * This private method is to support api end point.
     * It will update all backups in database by the matching paths.
     *
     * @param $path
     */
    private static function updateAllByPath($path, $column)
    {
        $backup = self::where('path_to_backup', $path);

        if($backup->count() > 0)
        {
            $backup->update([$column => 1]);
        }
    }

    /**
     * Find a backup by id.
     *
     * @param $id
     * @return mixed
     */
    public static function findById($id)
    {
        $backup = self::find($id);

        if(count($backup) > 0)
        {
            return $backup;
        }

        abort(404);
    }

    /**
     * Get a completed backup by id.
     *
     * @param $id
     * @return mixed
     */
    public static function getCompletedById($id)
    {
        $backup = self::where('id', $id)->where('is_completed', 1);

        if($backup->count() > 0)
        {
            return $backup->first();
        }

        abort(404);
    }

    /**
     * This public method is to support api end point.
     * Delete by the file path.
     *
     * @param $path
     */
    public static function deleteByFilepath($path)
    {
        $disk = \Storage::disk(config('backup-management.filesystem'));
        $allFiles = $disk->allFiles($path);

        if (count($allFiles) > 0)
        {
            foreach($allFiles as $file)
            {
                self::updateAllByPath($file, 'is_deleted');
            }
        }
    }

    /**
     * This public method is to support api end point.
     * Sync by the file path.
     *
     * @param $path
     */
    public static function syncedByFilepath($path)
    {
        $disk = \Storage::disk(config('backup-management.filesystem'));
        $allFiles = $disk->allFiles($path);

        if (count($allFiles) > 0)
        {
            foreach($allFiles as $file)
            {
                self::updateAllByPath($file, 'is_synced');
            }
        }
    }

}
