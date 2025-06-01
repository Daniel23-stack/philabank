<form method="post" class="ajax-screen-submit" autocomplete="off" action="{{ action('TransactionController@update', $id) }}" enctype="multipart/form-data">
	{{ csrf_field()}}
	<input name="_method" type="hidden" value="PATCH">
	<div class="row px-2">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Date') }}</label>
				<input type="text" class="form-control datetimepicker" name="date" value="{{ $transaction->getRawOriginal('created_at') }}" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Status') }}</label>
				<select class="form-control auto-select" data-selected="{{ $transaction->status }}" name="status" required>
					<option value="">{{ _lang('Select One') }}</option>
					<option value="0">{{ _lang('Cancelled') }}</option>
					<option value="1">{{ _lang('Pending') }}</option>
					<option value="2">{{ _lang('Completed') }}</option>
				</select>
			</div>
		</div>

        <div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Charge') }}</label>
				<input type="text" class="form-control float-field" name="fee" value="{{ $transaction->fee }}" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Amount') }}</label>
				<input type="text" class="form-control float-field" name="amount" value="{{ $transaction->amount }}" required>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('Note') }}</label>
				<textarea class="form-control" name="description">{{ $transaction->none }}</textarea>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
			    <button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Update') }}</button>
		    </div>
		</div>
	</div>
</form>

