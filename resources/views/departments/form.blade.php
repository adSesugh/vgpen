<h4 class="sub-title"><strong>Department Setup</strong></h4>
<div class="form-group row">
    <label class="col-sm-3 col-form-label text-right">Department</label>
    <div class="col-sm-9">
        {!! Form::text('department_name', null, ['class' => "form-control {{ $errors->has('department_name') ? ' is-invalid' : '' }}", 'placeholder'=>
        'Department Name']) !!} @if ($errors->has('department_name'))
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('department_name') }}</strong>
                </span> @endif
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 col-form-label text-right">Department Head</label>
    <div class="col-sm-9">
        {!! Form::select('department_head', [null => 'Select Staff as Department Head']+$leaders, null, ['class' => "form-control {{ $errors->has('department_head')
        ? ' is-invalid' : '' }}"]) !!} @if ($errors->has('department_head'))
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('department_head') }}</strong>
                </span> @endif
    </div>
</div>
