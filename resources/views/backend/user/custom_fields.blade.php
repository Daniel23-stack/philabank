@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="header-title">{{ _lang('Custom Fields') }}</h4>
                <button class="btn btn-outline-primary btn-sm" id="add-new-field"><i class="icofont-plus-circle"></i> {{ _lang('Add New Field') }}</button>
            </div>
            <div class="card-body">   
                <form method="post" class="validate" autocomplete="off" action="{{ route('users.custom_fields') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12 mt-4">
                        <table class="table table-bordered" id="form-fields">
                            <thead>
                                <th></th>
                                <th>{{ _lang('Field Name') }}</th>
                                <th>{{ _lang('Field Type') }}</th>
                                <th>{{ _lang('Validation') }}</th>
                                <th>{{ _lang('File Max Size (MB)') }}</th>
                                <th class="text-center">{{ _lang('Action') }}</th>
                            </thead>
                            <tbody>
                                @foreach($customFields as $form_field)
                                <tr class="row-data">
                                    <td class="drag-element"><i class="icofont-drag"></i></td>
                                    <td><input type="text" name="field_name[]" class="form-control" placeholder="Field Name" value="{{ $form_field->field_label }}" required></td>
                                    <td>
                                        <select name="field_type[]" class="form-control auto-select" data-selected="{{ $form_field->field_type }}" required>
                                            <option value="file">File (PNG,JPG,PDF)</option>
                                            <option value="text">Textbox</option>
                                            <option value="number">Number</option>
                                            <option value="textarea">Textarea</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="validation[]" class="form-control auto-select" data-selected="{{ $form_field->validation }}" required>
                                            <option value="required">Required</option>
                                            <option value="nullable">No Required</option>
                                        </select>
                                    </td>
                                    <td><input type="number" name="max_size[]" class="form-control" placeholder="2" value="{{ $form_field->max_size }}" required></td>
                                    <td class="text-center"><button type="button" class="btn btn-danger btn-sm btn-remove-row"><i class="icofont-trash"></i></button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle-fill"></i> {{ _lang('Save Changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-script')
<script src="{{ asset('public/backend/assets/js/sortable.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
	new Sortable(document.getElementById('form-fields').getElementsByTagName('tbody')[0], {
		animation: 150,
		ghostClass: 'blue-background-class',
		handle: '.drag-element',
	});
});

(function ($) {
    "use strict";

    $(document).on('click', '#add-new-field', function () {
        var rowData = `<tr class="row-data">
                            <td class="drag-element"><i class="icofont-drag"></i></td>
                            <td><input type="text" name="field_name[]" class="form-control" placeholder="Field Name" required></td>
                            <td>
                                <select name="field_type[]" class="form-control" required>
                                    <option value="file">File (PNG,JPG,PDF)</option>
                                    <option value="text">Textbox</option>
                                    <option value="number">Number</option>
                                    <option value="textarea">Textarea</option>
                                </select>
                            </td>
                            <td>
                                <select name="validation[]" class="form-control" required>
                                    <option value="required">Required</option>
                                    <option value="nullable">No Required</option>
                                </select>
                            </td>
                            <td><input type="number" name="max_size[]" class="form-control" placeholder="2" value="2" required></td>
                            <td class="text-center"><button type="button" class="btn btn-danger btn-sm btn-remove-row"><i class="icofont-trash"></i></button></td>
                        </tr>`;

        $('#form-fields tbody').append(rowData);
    });

    $(document).on('click', '.btn-remove-row', function () {
        $(this).closest('.row-data').remove();
    });
})(jQuery);
</script>
@endsection