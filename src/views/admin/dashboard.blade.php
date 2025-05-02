@extends('cms::backend.layout.app',['title'=>'Dashboard'])
@section('content')
<div class="row">
<div class="col-lg-12"><h3 style="font-weight:normal"> <i class="fa fa-dashboard"></i> Dashboard</h3>
</div>

</div>
<div class="row mt-4">
        <div title="Klik untuk selengkapnya" onclick="location.href='{{ route('daftar.index') }}'" class="pointer col-md-6 col-lg-6">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-globe fa-3x"></i>
              <div class="info pl-3">
                <p class="mt-2 text-muted">Domain</p>
                <h2><b>{{ $domain }}</b></h2>
              </div>
            </div>

    </div>
    <div title="Klik untuk selengkapnya" onclick="location.href='{{ route('invoice.index') }}'"  class="pointer col-md-6 col-lg-6">
        <div class="widget-small warning coloured-icon"><i class="icon fa fa-dollar fa-3x"></i>
          <div class="info pl-3">
            <p class="mt-2 text-muted">Tagihan</p>
            <h2><b>{{ $tagihan }}</b></h2>
          </div>
        </div>
</div>

</div>
@endsection
