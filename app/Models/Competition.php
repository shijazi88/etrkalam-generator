<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competition extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const TYPE_SELECT = [
        'Quran' => 'Quran',
        'Athan' => 'Athan',
    ];

    public const STATUS_SELECT = [
        'enabled'  => 'enabled',
        'disabled' => 'disabled',
    ];

    public $table = 'competitions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'participant_id',
        'type',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
