<?php
namespace Leazycms\Domain\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Leazycms\FLC\Traits\Fileable;

class Invoice extends Model
{
    use Fileable,SoftDeletes;
    protected $fillable = [
        'user_id',
        'domain_id',
        'perpanjangan_tahun',
        'file_invoice',
        'tanggal_invoice',
        'bukti_pembayaran',
        'bukti_confirmed',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function domain(){
        return $this->belongsTo(Domain::class);
    }
}
