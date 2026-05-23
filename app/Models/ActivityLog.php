<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'action',
        'description',
        'model_type',
        'model_id',
        'ip_address'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public static function log(string $action, string $description, $model = null, $adminId = null)
    {
        self::create([
            'admin_id' => $adminId ?? (auth('admin')->check() ? auth('admin')->id() : null),
            'action' => $action,
            'description' => $description,
            'model_type' => $model ? get_class($model) : null,
            'model_id' => $model ? $model->id : null,
            'ip_address' => request()->ip(),
        ]);
    }
}
