<?php
namespace Leazycms\Domain\Controllers;
use Illuminate\Http\Request;
use Leazycms\Domain\Models\Domain;
use Leazycms\Domain\Models\Invoice;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class AdminController extends Controller  implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('auth'),

        ];
    }
public function index(){
    $data = [
        'tagihan' => auth()->user()->isAdmin() ? Invoice::whereNull('bukti_confirmed')->whereNotNull('bukti_pembayaran')->count() : Invoice::whereBelongsTo(auth()->user())->whereNull('bukti_confirmed')->whereNotNull('bukti_pembayaran')->count() ,
        'domain' => auth()->user()->isAdmin() ? Domain::count() : Domain::whereBelongsTo(auth()->user())->count() ,
    ];
    return view('domain::admin.dashboard',$data);
}

}
