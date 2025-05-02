<?php
namespace Leazycms\Roro\Controllers;
use Illuminate\Http\Request;
use Leazycms\Roro\Models\Month;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class JadwalController extends Controller  implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),

        ];
    }
public function index(Request $request){
    $data = [
        'months'=>Month::get(),
    ];
    View::share($data);
    return view('domain::admin.jadwal.index');
}

}
