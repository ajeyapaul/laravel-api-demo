@extends('layouts.admin')
@section('content')
@can('crm_document_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.crm-documents.create') }}">
                {{ __('Add') }} {{ __('Document') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ __('Document') }} {{ __('List') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-CrmDocument">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ __('ID') }}
                        </th>
                        <th>
                            {{ __('Customer') }}
                        </th>
                        <th>
                            {{ __('File') }}
                        </th>
                        <th>
                            {{ __('Document name') }}
                        </th>
                        <th>
                            {{ __('Description') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($crmDocuments as $key => $crmDocument)
                        <tr data-entry-id="{{ $crmDocument->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $crmDocument->id ?? '' }}
                            </td>
                            <td>
                                {{ $crmDocument->customer->first_name ?? '' }}
                            </td>
                            <td>
                                @if($crmDocument->document_file)
                                    <a href="{{ $crmDocument->document_file->getUrl() }}" target="_blank">
                                        {{ __('View file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $crmDocument->name ?? '' }}
                            </td>
                            <td>
                                {{ $crmDocument->description ?? '' }}
                            </td>
                            <td>
                                @can('crm_document_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.crm-documents.show', $crmDocument->id) }}">
                                        {{ __('View') }}
                                    </a>
                                @endcan

                                @can('crm_document_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.crm-documents.edit', $crmDocument->id) }}">
                                        {{ __('Edit') }}
                                    </a>
                                @endcan

                                @can('crm_document_delete')
                                    <form action="{{ route('admin.crm-documents.destroy', $crmDocument->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ __('Delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('crm_document_delete')
  let deleteButtonTrans = '{{ __('Delete selected') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.crm-documents.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ __('No rows selected') }}')

        return
      }

      if (confirm('{{ __('Are you sure?') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-CrmDocument:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection