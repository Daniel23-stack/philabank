<form method="post" class="ajax-submit" autocomplete="off" action="{{ action('DPSPlanController@update', $id) }}" enctype="multipart/form-data">
	{{ csrf_field()}}
	<input name="_method" type="hidden" value="PATCH">
	<div class="row px-2">
		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('Name') }}</label>						
				<input type="text" class="form-control" name="name" value="{{ $dpsplan->name }}" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Currency') }}</label>						
				<select class="form-control auto-select" name="currency_id" id="currency_id" data-selected="{{ $dpsplan->currency_id }}" required>
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
						<span class="input-group-text currency">{{ $dpsplan->currency->name }}</span>
					</div>						
					<input type="text" class="form-control float-field" name="per_installment" value="{{ $dpsplan->per_installment }}" required>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Installment Interval') }}</label>						
				<input type="number" class="form-control" name="installment_interval" value="{{ $dpsplan->installment_interval }}" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Interval Type') }}</label>						
				<select class="form-control auto-select" data-selected="{{ $dpsplan->interval_type }}" name="interval_type"  required>
					<option value="">{{ _lang('Select One') }}</option>
					<option value="days">{{ _lang('Days') }}</option>
					<option value="month">{{ _lang('Month') }}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Number of Total installment') }}</label>						
				<input type="number" class="form-control" name="total_installment" value="{{ $dpsplan->total_installment }}" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Interest Rate') }} %</label>						
				<input type="text" class="form-control" name="interest_rate" value="{{ $dpsplan->interest_rate }}" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Total Deposit') }}</label>			
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text currency">{{ $dpsplan->currency->name }}</span>
					</div>			
					<input type="text" class="form-control" id="total_deposit" value="{{ $dpsplan->total_installment *  $dpsplan->per_installment }}" readonly>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Final Amount after matured') }}</label>		
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text currency">{{ $dpsplan->currency->name }}</span>
					</div>				
					<input type="text" class="form-control" id="final_amount" value="{{ $dpsplan->final_amount }}" readonly>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('Status') }}</label>						
				<select class="form-control auto-select" data-selected="{{ $dpsplan->status }}" name="status"  required>
					<option value="">{{ _lang('Select One') }}</option>
					<option value="1">{{ _lang('Active') }}</option>
					<option value="0">{{ _lang('Deactivate') }}</option>
				</select>
			</div>
		</div>

		<div class="form-group">
		    <div class="col-md-12">
			    <button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Update') }}</button>
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