<?php

namespace bsm\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

use bsm\_web\Status;
use bsm\Model\Transaksi;

class Pegawai extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    protected $table = 'pegawai';

    protected $hidden = ["password", "remember_token"];
    protected $fillable = ['nama', 'username', 'password', 'status_id'];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'pegawai_id');
    }
    public function getActionAttribute()
    {   
        return '
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-xs btn-primary" id="btn-ubah" data-id="'.$this->id.'" data-nama="'.$this->nama.'" data-username="'.$this->username.'" data-status="'.$this->status_id.'"><i class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-xs btn-danger" id="btn-hapus" data-id="'.$this->id.'" data-nama="'.$this->nama.'" data-username="'.$this->username.'" data-status="'.$this->status_id.'"><i class="fa fa-trash"></i></button>
            </div>
        ';
    }
}
