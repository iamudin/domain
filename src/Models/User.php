<?php
namespace Leazycms\Domain\Models;
use Leazycms\Web\Models\User as BaseUser;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends BaseUser
{
    use  SoftDeletes;


    public function pengelola(){
        return $this->hasOne(Pengelola::class);
    }
}
