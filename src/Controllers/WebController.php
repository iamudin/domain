<?php
namespace Leazycms\Domain\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
public function index(Request $request){
    return view('simpel::web.home');
}
}
