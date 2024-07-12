@extends('layouts.admin')
@section('content')
@can('crm_note_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.crm-notes.create') }}">
                {{ __('Add') }} {{ __('Note') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ __('Note') }} {{ __('List') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-CrmNote">
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
                            {{ __('Note') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($crmNotes as $key => $crmNote)
                        <tr data-entry-id="{{ $crmNote->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $crmNote->id ?? '' }}
                            </td>
                            <td>
                                {{ $crmNote->customer->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $crmNote->note ?? '' }}
                            </td>
                            <td>
                                @can('crm_note_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.crm-notes.show', $crmNote->id) }}">
                                        {{ __('View') }}
                                    </a>
                                @endcan

                                @can('crm_note_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.crm-notes.edit', $crmNote->id) }}">
                                        {{ __('Edit') }}
                                    </a>
                                @endcan

                                @can('crm_note_delete')
                                    <form action="{{ route('admin.crm-notes.destroy', $crmNote->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}');" style="display: inline-block;">
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
@can('crm_note_delete')
  let deleteButtonTrans = '{{ __('Delete selected') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.crm-notes.massDestroy') }}",
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
  let table = $('.datatable-CrmNote:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection