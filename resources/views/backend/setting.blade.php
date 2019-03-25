@extends('backend.layouts.app')

@section('content')
	<div class="container">
		@if(Session::has('status'))
		<div class="alert alert-info">
			<span>{{ Session::get('status') }}</span>
		</div>
		@endif
		<form action="{{ route('admin.setting.store') }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<label>URL callback for Telegram Bot</label>
				<div class="input-group">
					<div class="input-group-btn">
						<button type="button" class="btn btn-default dropdown-toggle" 
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Action
						<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li>
								<a href="#" class="dropdown-item" onclick="document.getElementById('url_callback_bot').
								value='{{ url('') }}' ">Add url</a>
							</li>
							<li>
								<a href="#" class="dropdown-item" onclick="event.preventDefault(); 
								document.getElementById('setwebhook').submit()">Send url</a>
							</li>
							<li>
								<a href="#" class="dropdown-item" onclick="event.preventDefault(); 
								document.getElementById('getwebhookinfo').submit()" >Information</a>
							</li>
						</ul>
					</div>
					<input type="url" class="form-control" id="url_callback_bot" name="url_callback_bot" 
					value="{{ $url_callback_bot }}">
				</div>
			</div>
			<button class="btn btn-primary" type="submit">Save</button>
		</form>
		<form id="setwebhook" action="{{ route('admin.setting.setwebhook') }}" method="POST" style="display: none;">
			{{ csrf_field() }}
			<input type="hidden" name="url" value="{{ $url_callback_bot }}">
		</form>
		<form id="getwebhookinfo" action="{{ route('admin.setting.getwebhookinfo') }}" method="POST" style="display: none;">
			{{ csrf_field() }}			
		</form>
	</div>
@endsection