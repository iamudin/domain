<?php
namespace Leazycms\Domain\Controllers;
use Illuminate\Http\Request;
use Leazycms\Domain\Models\Domain;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Leazycms\Domain\Models\Invoice;

class InvoiceController extends Controller  implements HasMiddleware
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
    $data = $request->user()->isAdmin() ? Invoice::with('domain.pengelola')->get() : Invoice::with('domain.pengelola')->whereBelongsTo($request->user())->get();
    return view('domain::admin.invoice.index',compact('data'));
}
public function edit(Request $request, Invoice $invoice){
    $data = $request->user()->isAdmin() ? $invoice : ($invoice->user_id == $request->user()->id ? $invoice : abort('403'));
    return view('domain::admin.invoice.form',compact('data'));
}
public function create(Request $request){
    if(!$request->user()->isAdmin()){

       return to_route('invoice.index');
    }
    $data = null;
    $domains = Domain::get();
    return view('domain::admin.invoice.form',compact('data','domains'));
}
public function update(Request $request, Invoice $invoice){
    $confirmedold = $invoice->bukti_confirmed;
    if($request->user()->isAdmin()){
    $invoice->update([
        'bukti_confirmed'=>$request->bukti_confirmed ? now() : null,
    ]);
    if(!$confirmedold && $request->bukti_confirmed){
            notifications()->create([
                'user_id'=>$invoice->user_id,
                'title'=>'Konfirmasi Bukti Pembayaran',
                'message'=>'Pembayaran anda sudah di Konfirmasi ',
                'type'=> 'default',
                'url'=> route('invoice.edit',$invoice->id)
            ]);
    }
    if($request->hasFile('file_invoice')){
        $fname = $invoice->addFile([
            'file'=>$request->file('file_invoice'),
            'purpose'=>'file_invoice',
            'mime_type'=>['application/pdf']
        ]);
        $inv = $invoice->update([
            'file_invoice'=>$fname
        ]);
        if($inv){
            notifications()->create([
                'title'=>'Tagihan Invoice',
                'user_id'=>$invoice->user_id,
                'message'=>'Tagihan Invoice baru untuk anda, silahkan bayar ',
                'type'=> 'default',
                'url'=> route('invoice.edit',$invoice->id)
            ]);
        }
    }
    }else{
        if($request->hasFile('bukti_pembayaran')){
            $fname = $invoice->addFile([
                'file'=>$request->file('bukti_pembayaran'),
                'purpose'=>'bukti_pembayaran',
                'mime_type'=>['application/pdf','image/jpeg','image/png']
            ]);
            $success = $invoice->update([
                'bukti_pembayaran'=>$fname
            ]);
            if($success){
                notifications()->create([
                    'title'=>'Bukti Pembayaran',
                    'message'=>'Bukti pembayaran oleh '.$invoice->domain->pengelola->nama,
                    'type'=> 'default',
                    'url'=> route('invoice.edit',$invoice->id)
                ]);
            }

        }
    }

    return back()->with('success','Perubahan tersimpan');

}
public function store(Request $request, Invoice $invoice){
$user_id = Domain::whereId($request->domain_id)->first()->user_id;
    $data = $invoice->create([
        'domain_id'=>$request->domain_id,
        'user_id'=>$user_id,
        'tanggal_invoice'=>$request->tanggal_invoice,
        'perpanjangan_tahun'=>$request->perpanjangan_tahun,
    ]);
    if($request->hasFile('file_invoice')){
        $fname = $invoice->addFile([
            'file'=>$request->file('file_invoice'),
            'purpose'=>'file_invoice',
            'mime_type'=>['application/pdf']
        ]);
       $inv = $data->update([
            'file_invoice'=>$fname
        ]);

        if($inv){
            notifications()->create([
                'title'=>'Tagihan Invoice',
                'user_id'=>$user_id,
                'message'=>'Tagihan Invoice baru untuk anda, silahkan bayar ',
                'type'=> 'default',
                'url'=> route('invoice.edit',$invoice->id)
            ]);
        }

    }
    return back()->with('success','Perubahan tersimpan');
}
}
