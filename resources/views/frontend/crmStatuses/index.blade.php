@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('crm_status_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.crm-statuses.create') }}">
                            {{ __('Add') }} {{ __('Status') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ __('Status') }} {{ __('List') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-CrmStatus">
                            <thead>
                                <tr>
                                    <th>
                                        {{ __('ID') }}
                                    </th>
                                    <th>
                                        {{ __('Name') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($crmStatuses as $key => $crmStatus)
                                    <tr data-entry-id="{{ $crmStatus->id }}">
                                        <td>
                                            {{ $crmStatus->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $crmStatus->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('crm_status_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.crm-statuses.show', $crmStatus->id) }}">
                                                    {{ __('View') }}
                                                </a>
                                            @endcan

                                            @can('crm_status_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.crm-statuses.edit', $crmStatus->id) }}">
                                                    {{ __('Edit') }}
                                                </a>
                                            @endcan

                                            @can('crm_status_delete')
                                                <form action="{{ route('frontend.crm-statuses.destroy', $crmStatus->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('crm_status_delete')
  let deleteButtonTrans = '{{ __('Delete selected') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.crm-statuses.massDestroy') }}",
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
  let table = $('.datatable-CrmStatus:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection