@if($errors->any())
<div class="col-lg-12 py-2">
    <div class="alert alert-danger fade show" role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning-sign">
            </i>
        </div>
        <div class="alert-text">
            @foreach($errors->all() as $error)
            <p>
                {{ $error }}
            </p>
            @endforeach
        </div>
    </div>
</div>
@endif
