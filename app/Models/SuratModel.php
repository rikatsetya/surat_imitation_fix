<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SuratModel extends Model
{
    use HasFactory;
    protected $table = 'm_surat';
    protected $primaryKey = 'surat_id';
    protected $fillable = ['kepada', 'tembusan', 'pengirim', 'pemeriksa', 'perihal', 'isi_surat', 'lampiran', 'created_at', 'updated_at'];

    public function kepada(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'kepada', 'user_id');
    }

    public function tembusan(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'tembusan', 'user_id');
    }

    public function pengirim(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'pengirim', 'user_id');
    }

    public function pemeriksa(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'pemeriksa', 'user_id');
    }

    public function inbox(): HasMany
    {
        return $this->hasMany(InboxModel::class, 'surat_id', 'surat_id');
    }
}
