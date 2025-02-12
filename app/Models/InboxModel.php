<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InboxModel extends Model
{
    use HasFactory;
    protected $table = 'm_inbox';
    protected $primaryKey = 'inbox_id';
    protected $fillable = ['sender', 'surat_id', 'receiver', 'created_at', 'updated_at'];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'sender', 'user_id');
    }
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'receiver', 'user_id');
    }

    public function surat(): BelongsTo
    {
        return $this->belongsTo(SuratModel::class, 'surat_id', 'surat_id');
    }
}
