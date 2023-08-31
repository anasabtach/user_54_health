<div style="margin:10px 0;" id="_error_div" class="error_div d-none"></div>
<div style="margin:10px 0;" id="_success_dev" class="success_div d-none"></div>
@if ($errors->any())
    <div style="margin:10px 0;" class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if( Session::has('error') )
    <div style="margin:10px 0;" class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif
@if( Session::has('success') )
    <div style="margin:10px 0;" class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif
@if( Session::has('info') )
    <div style="margin:10px 0;" class="alert alert-info">
        {{ Session::get('info') }}
    </div>
@endif
@if( Session::has('warning') )
    <div style="margin:10px 0;" class="alert alert-warning">
        {{ Session::get('warning') }}
    </div>
@endif
@if( Session::has('api_error') )
    <div style="margin:10px 0;" class="alert alert-danger">
        <ul>
            @foreach( Session::get('api_error') as $errors )
                <li>{{ $errors }}</li>
            @endforeach
        </ul>
    </div>
@endif
