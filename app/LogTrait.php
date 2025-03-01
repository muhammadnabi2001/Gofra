<?php

namespace App;

use App\Models\ActionHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait LogTrait
{
    public static function bootLogTrait()
    {
        static::created(function (Model $model) {
            $model->logHistory('created', $model->toArray());
        });

        static::updated(function (Model $model) {
            $model->logHistory('updated', [
                'old' => $model->getOriginal(),
                'new' => $model->getChanges(),
            ]);
        });

        static::deleted(function (Model $model) {
            $model->logHistory('deleted', $model->toArray());
        });
    }

    protected function logHistory(string $action, array $data)
    {
        ActionHistory::create([
            'actionable_type' => static::class,
            'actionable_id' => $this->id,
            'action' => $action,
            'data' => $data,
            'user_id' => Auth::id(),
        ]);
    }

    public function actionHistories()
    {
        return $this->morphMany(ActionHistory::class, 'actionable');
    }
}
