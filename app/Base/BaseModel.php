<?php

namespace App\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class BaseModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Guarded properties for mass assignment
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 20;

    /**
     * Restore function for soft deleted models.
     *
     * @return void
     */
    public function restore(): void
    {
        if (isset($this->deleted_at) && !is_null($this->deleted_at)) {
            $this->update([
                'deleted_at' => null,
                'deleted_by' => null,
                'restored_at' => now(),
                'restored_by' => request()->user() ?? null,
            ]);

            $this->fresh();
        }
    }

    /**
     * Delete function with parameter to indicate force deletion.
     *
     * @param  bool  $force
     * @return bool
     */
    public function delete(bool $force = false): bool
    {
        $this->forceDeleting = $force;
        parent::delete();

        return true;
    }

    /**
     * Count function to indicate to include trashed models
     *
     * @param  bool  $withTrashed
     * @return int
     */
    public function count(bool $withTrashed = false): int
    {
        return $withTrashed ? $this->withTrashed()->count()
            : $this->count();
    }

    /**
     * Updating the accessor for the created_at column
     * to return config specific timezone.
     *
     * @return Carbon
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone(config('app.timezone_display'));
    }

    /**
     * Updating the accessor for the updated_at column
     * to return config specific timezone.
     *
     * @return Carbon|void
     */
    public function getUpdatedAtAttribute($value)
    {
        if (!$value) {
            return;
        }

        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone(config('app.timezone_display'));
    }

    /**
     * Updating the accessor for the deleted_at column
     * to return config specific timezone.
     *
     * @return Carbon|void
     */
    public function getDeletedAtAttribute($value)
    {
        if (!$value) {
            return;
        }

        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone(config('app.timezone_display'));
    }

    /**
     * Updating the accessor for the deleted_at column
     * to return config specific timezone.
     *
     * @return Carbon|void
     */
    public function getRestoredAtAttribute($value)
    {
        if (!$value) {
            return;
        }

        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone(config('app.timezone_display'));
    }
}
