<div class="form-row">
    @foreach ($errors as $error)
    <div data-form-alert-danger="" class="alert alert-danger col-12">{!! $error !!}</div>
    @endforeach
</div>
