<?php
namespace Leazycms\Domain\Controllers;
use Illuminate\Http\Request;
use Leazycms\Domain\Models\Domain;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Leazycms\Domain\Models\Pengelola;

class DomainController extends Controller  implements HasMiddleware
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
    $data = $request->user()->isAdmin() ? Domain::with('user.pengelola')->get() : Domain::with('user.pengelola')->whereBelongsTo($request->user())->get();
    return view('domain::admin.daftar.index',compact('data'));
}
public function edit(Request $request, Domain $daftar){
    $data = $request->user()->isAdmin() ? $daftar : ($daftar->user_id == $request->user()->id ? $daftar : abort('403'));
    return view('domain::admin.daftar.form',compact('data'));
}
public function create(Request $request){
    if($request->user()->isAdmin() || Domain::whereBelongsTo($request->user())->count()){
       return to_route('daftar.index');
    }
    $data = null;
    return view('domain::admin.daftar.form',compact('data'));
}
public function update(Request $request, Domain $daftar){
    if($request->ipv4 && $request->ipv4 != $daftar->ipv4){
        $daftar->update([
            'ipv4_updated'=>now(),
            'ipv4_confirmed'=>null,
        ]);
    }
    foreach(['ns1','ns2','ns3','ns4'] as $row){
        if($request->$row && $request->$row != $daftar->$row){
            $nsedited[] = 1;
        }
    }
    if(isset($nsedited) &&array_sum($nsedited) > 0){
        $daftar->update([
            'ns_updated'=>now(),
            'ns_confirmed'=>null,
        ]);
    }

    $daftar->update([
        'nama'=>$request->nama,
        'ns1'=>$request->ns1,
        'ns2'=>$request->ns2,
        'ns3'=>$request->ns3,
        'ns4'=>$request->ns4,
        'ipv4'=>$request->ipv4,
    ]);

    if($request->hasFile('surat_permohonan')){
        $fname = $daftar->addFile([
            'file'=>$request->file('surat_permohonan'),
            'purpose'=>'surat-permohonan',
            'mime_type'=>['application/pdf']
        ]);

        $daftar->update([
            'surat_permohonan'=>$fname
        ]);

    }
    return back()->with('success','Perubahan tersimpan');

}
public function store(Request $request, Domain $daftar){

    $pengelola = Pengelola::whereBelongsTo($request->user())->id;
    $data = $daftar->create([
        'nama'=>$request->nama,
        'ns1'=>$request->ns1,
        'ns2'=>$request->ns2,
        'ns3'=>$request->ns3,
        'ns4'=>$request->ns4,
        'ipv4'=>$request->ipv4,
        'user_id'=>$request->user()->id,
        'pengelola_id'=>$pengelola,
    ]);
    if($request->ipv4){
        $data->update([
            'ipv4_updated'=>now(),
            'ipv4_confirmed'=>null,
        ]);
    }
    foreach(['ns1','ns2','ns3','ns4'] as $row){
        if($request->$row && $request->$row != $daftar->$row){
            $nsedited[] = 1;
        }
    }
    if(isset($nsedited) &&array_sum($nsedited) > 0){
        $data->update([
            'ns_updated'=>now(),
            'ns_confirmed'=>null,
        ]);
    }
    if($request->hasFile('surat_permohonan')){
        $fname = $daftar->addFile([
            'file'=>$request->file('surat_permohonan'),
            'purpose'=>'surat-permohonan',
            'mime_type'=>['application/pdf']
        ]);

        $daftar->update([
            'surat_permohonan'=>$fname
        ]);

    }
    return back()->with('success','Perubahan tersimpan');
}
}
