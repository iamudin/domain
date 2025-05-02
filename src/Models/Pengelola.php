<?php
namespace Leazycms\Domain\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Leazycms\FLC\Traits\Fileable;

class Pengelola extends Model
{
    use SoftDeletes,Fileable;
    protected $fillable = [
        'user_id',
        'nip',
        'nama',
        'jabatan',
        'jenis_pengelola',
        'nohp',
        'surat_keterangan',
        'surat_kuasa'
    ];

    public function domain(){
        return $this->hasOne(Domain::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
