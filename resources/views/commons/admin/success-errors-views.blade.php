@if (count($errors)>0)
<div class="pb-3 text-danger " >
    @foreach ($errors->all() as $error)
        <div>
            <i class="fa fa-exclamation-circle fa-fw"></i>{!! $error !!}
        </div>
    @endforeach
</div>
@endif

<div class="col-md-12 mb-12 pt-1" id="danger-alert">
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {!! session('error') !!}
        </div>
    @endif
</div>

<div class="col-md-12 mb-12 pt-1" id="success-alert">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {!! session('status') !!}
        </div>
    @endif
</div>