<?php
namespace Leazycms\Domain\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Leazycms\FLC\Traits\Fileable;

class Domain extends Model
{

    use Fileable,SoftDeletes;
    protected $fillable = [
        'user_id',
        'pengelola_id',
        'nama',
        'surat_permohonan',
         'ns1',
         'ns2',
         'ns3',
         'ns4',
         'ipv4',
         'ns_updated',
         'ns_confirmed',
         'ipv4_updated',
         'ipv4_confirmed'
        ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function pengelola(){
        return $this->belongsTo(Pengelola::class);
    }
    public function invoices(){
        return $this->hasMany(Invoice::class);
}
}
