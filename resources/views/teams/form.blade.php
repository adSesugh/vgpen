<h4 class="sub-title"><strong>Team Setup</strong></h4>
<div class="form-group row">
    <label class="col-sm-3 col-form-label text-right">Team</label>
    <div class="col-sm-9">
        {!! Form::text('team_name', null, ['class' => "form-control {{ $errors->has('team_name') ? ' is-invalid' : '' }}", 'placeholder'=>
        'Team Name']) !!} @if ($errors->has('team_name'))
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('team_name') }}</strong>
                </span> @endif
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 col-form-label text-right">Team Leader</label>
    <div class="col-sm-9">
        {!! Form::select('team_leader', [null => 'Select Staff as Team Leader...']+$leaders, null, ['class' => "form-control {{ $errors->has('team_leader') ? ' is-invalid' : '' }}"]) !!}
        @if ($errors->has('team_leader'))
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('team_leader') }}</strong>
                </span> @endif
    </div>
</div>
