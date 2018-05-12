<?php
/**
 * Created by PhpStorm.
 * User: Faisal Abdul Hamid
 * Date: 30/09/2016
 * Time: 15:17.
 */

namespace bsm\Helpers\Navigation;

use bsm\_web\Menu;
use bsm\Helpers\Navigation\Contract\NavigationContract;
use bsm\Model\Pegawai as Users;
use Illuminate\Support\Facades\Auth;

class Navigation implements NavigationContract
{
    public static function getMenu()
    {
        $id_user = Auth::user()->id;
        $status = Users::find($id_user)->status;
        $id_status = $status->id;

        return 	Menu::with(['submenus'=> function ($q) use ($id_status) {
            $q->whereHas('status', function ($q) use ($id_status) {
                $q->where('id', '=', $id_status);
            });
        }])
            ->whereHas('status', function ($q) use ($id_status) {
                $q->where('id', '=', $id_status);
            })
            ->get()
            ->toArray();
    }
}
