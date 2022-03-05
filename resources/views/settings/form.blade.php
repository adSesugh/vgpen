<h4 class="sub-title"><strong>Company Setup</strong></h4>
<div class="form-group row">
    <label class="col-sm-3 col-form-label text-right">App Title</label>
    <div class="col-sm-6">
        {!! Form::text('app_title', settings()->get('app_title'), ['class' => "form-control {{ $errors->has('app_title') ? ' is-invalid' : '' }}"]) !!}
        @if ($errors->has('app_title'))
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('app_title') }}</strong>
                </span> @endif
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 col-form-label text-right">Company Name</label>
    <div class="col-sm-6">
        {!! Form::text('company_name', settings()->get('company_name'), ['class' => "form-control {{ $errors->has('company_name') ? ' is-invalid' : '' }}"]) !!}
        @if ($errors->has('company_name'))
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('company_name') }}</strong>
                </span> @endif
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 col-form-label text-right">Default Year</label>
    <div class="col-sm-6">
        {!! Form::date('operating_year', settings()->get('operating_year'), ['class' => "form-control {{ $errors->has('operating_year') ? ' is-invalid' : ''
        }}"]) !!} @if ($errors->has('operating_year'))
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('operating_year') }}</strong>
                </span> @endif
    </div>
</div>
<h4 class="sub-title"><strong>Contact Details</strong></h4>
<div class="form-group row">
    <label class="col-sm-3 col-form-label text-right">Mobile Number</label>
    <div class="col-sm-6">
        {!! Form::text('company_telephone', settings()->get('company_telephone'), ['class' => "form-control {{ $errors->has('company_telephone') ? ' is-invalid' : '' }}"])
        !!} @if ($errors->has('company_telephone'))
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('company_telephone') }}</strong>
                </span> @endif
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 col-form-label text-right">Company Email</label>
    <div class="col-sm-6">
        {!! Form::email('company_email', settings()->get('company_email'), ['class' => "form-control {{ $errors->has('company_email') ? ' is-invalid' : '' }}"]) !!}
        @if ($errors->has('company_email'))
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('company_email') }}</strong>
                </span> @endif
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 col-form-label text-right">Website</label>
    <div class="col-sm-6">
        {!! Form::text('company_website', settings()->get('company_website'), ['class' => "form-control {{ $errors->has('company_website') ? ' is-invalid'
        : '' }}"]) !!} @if ($errors->has('company_website'))
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('company_website') }}</strong>
                </span> @endif
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 col-form-label text-right">Address</label>
    <div class="col-sm-6">
        {!! Form::textarea('company_address', settings()->get('company_address'), ['rows' => 3, 'class' => "form-control {{ $errors->has('company_address') ? ' is-invalid' : ''
        }}"]) !!}
        @if ($errors->has('company_address'))
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('company_address') }}</strong>
                </span> @endif
    </div>
</div>
<h4 class="sub-title"><strong>Company Logo</strong></h4>
<div class="form-group row">
    <label class="col-sm-3 col-form-label text-right">Logo Upload</label>
    <div class="col-sm-6">
        {!! Form::file('uploaded_logo', settings()->get('uploaded_logo'), ['class' => "form-control {{ $errors->has('uploaded_logo') ? ' is-invalid'
        : '' }}"]) !!}
        @if ($errors->has('uploaded_logo'))
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('uploaded_logo') }}</strong>
                </span> @endif
    </div>
</div>
