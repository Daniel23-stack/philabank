<form method="post" class="ajax-submit" autocomplete="off" action="{{ route('dps_plans.store') }}" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="row px-2">
	    <div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('Name') }}</label>						
				<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Currency') }}</label>						
				<select class="form-control auto-select" name="currency_id" id="currency_id" data-selected="{{ old('currency_id') }}" required>
					<option value="">{{ _lang('Select One') }}</option>
					@foreach(\App\Models\Currency::active()->get() as $currency)
						<option value="{{ $currency->id }}" data-currency="{{ $currency->name }}">{{ $currency->name }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Per installment Amount') }}</label>	
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text currency">{{ get_base_currency() }}</span>
					</div>					
					<input type="text" class="form-control float-field" name="per_installment" value="{{ old('per_installment') }}" required>		
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Installment Interval') }}</label>						
				<input type="number" class="form-control" name="installment_interval" value="{{ old('installment_interval') }}" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Interval Type') }}</label>						
				<select class="form-control auto-select" data-selected="{{ old('interval_type') }}" name="interval_type"  required>
					<option value="">{{ _lang('Select One') }}</option>
					<option value="days">{{ _lang('Day') }}</option>
					<option value="month">{{ _lang('Month') }}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Number of Total Installment') }}</label>						
				<input type="number" class="form-control" name="total_installment" value="{{ old('total_installment') }}" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Interest Rate') }} %</label>						
				<input type="text" class="form-control" name="interest_rate" value="{{ old('interest_rate') }}" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Total Deposit') }}</label>	
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text currency">{{ get_base_currency() }}</span>
					</div>						
					<input type="text" class="form-control" id="total_deposit" readonly>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Final Amount after matured') }}</label>	
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text currency">{{ get_base_currency() }}</span>
					</div>						
					<input type="text" class="form-control" id="final_amount" value="{{ old('final_amount') }}" readonly>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('Status') }}</label>						
				<select class="form-control auto-select" data-selected="{{ old('status') }}" name="status"  required>
					<option value="">{{ _lang('Select One') }}</option>
					<option value="1">{{ _lang('Active') }}</option>
					<option value="0">{{ _lang('Deactivate') }}</option>
				</select>
			</div>
		</div>

	
		<div class="col-md-12">
		    <div class="form-group">
			    <button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Save') }}</button>
		    </div>
		</div>
	</div>
</form>

<script>
(function ($) {
  "use strict";

  	$(document).on('change','#currency_id', function(){
		var currency = $(this).find(':selected').data('currency');
		$('.currency').html(currency);
  	});

    $('input[name=per_installment], input[name=total_installment], input[name=interest_rate]').on( 'input', () => calculateTotal() );

	function calculateTotal(){
		let perInstallment      = Number($('input[name=per_installment]').val());
		let totalInstallment    = Number($('input[name=total_installment]').val());
		let interestRate        = Number($('input[name=interest_rate]').val());
		let totalAmount         = parseFloat(perInstallment * totalInstallment);
		let interest            = parseFloat(totalAmount * interestRate / 100);

		if(perInstallment && totalInstallment && interestRate){
			$('#total_deposit').val(totalAmount.toFixed(2));
			$('#final_amount').val((totalAmount + interest).toFixed(2));
		}
	}
})(jQuery);
</script>