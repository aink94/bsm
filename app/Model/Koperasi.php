<?php

namespace bsm\Model;

use Illuminate\Database\Eloquent\Model;

use bsm\Model\Transaksi;

class Koperasi extends Model
{
    protected $table = 'koperasi';
    protected $hidden = ["token", "password"];
    protected $fillable = ['nama', 'token', 'key'];

    public function transaksis()
    {
    	return $this->hasMany(Transaksi::class, 'koperasi_id');
    }

    public function getActionAttribute(){
    	return '
    		<div class="btn-group pull-right">
                <button type="button" class="btn btn-xs btn-primary" id="btn-ubah" data-id="'.$this->id.'" data-nama="'.$this->nama.'" data-token="'.$this->token.'" data-key="'.$this->key.'" ><i class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-xs btn-danger" id="btn-hapus" data-id="'.$this->id.'" ><i class="fa fa-trash"></i></button>
            </div>	
    	';
    }
}
