@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('crm_customer_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.crm-customers.create') }}">
                            {{ __('Add') }} {{ __('Customer') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ __('Customer') }} {{ __('List') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-CrmCustomer">
                            <thead>
                                <tr>
                                    <th>
                                        {{ __('ID') }}
                                    </th>
                                    <th>
                                        {{ __('First name') }}
                                    </th>
                                    <th>
                                        {{ __('Last name') }}
                                    </th>
                                    <th>
                                        {{ __('Status') }}
                                    </th>
                                    <th>
                                        {{ __('Email') }}
                                    </th>
                                    <th>
                                        {{ __('Phone') }}
                                    </th>
                                    <th>
                                        {{ __('Address') }}
                                    </th>
                                    <th>
                                        {{ __('Skype') }}
                                    </th>
                                    <th>
                                        {{ __('Website') }}
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
                                @foreach($crmCustomers as $key => $crmCustomer)
                                    <tr data-entry-id="{{ $crmCustomer->id }}">
                                        <td>
                                            {{ $crmCustomer->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $crmCustomer->first_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $crmCustomer->last_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $crmCustomer->status->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $crmCustomer->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $crmCustomer->phone ?? '' }}
                                        </td>
                                        <td>
                                            {{ $crmCustomer->address ?? '' }}
                                        </td>
                                        <td>
                                            {{ $crmCustomer->skype ?? '' }}
                                        </td>
                                        <td>
                                            {{ $crmCustomer->website ?? '' }}
                                        </td>
                                        <td>
                                            {{ $crmCustomer->description ?? '' }}
                                        </td>
                                        <td>
                                            @can('crm_customer_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.crm-customers.show', $crmCustomer->id) }}">
                                                    {{ __('View') }}
                                                </a>
                                            @endcan

                                            @can('crm_customer_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.crm-customers.edit', $crmCustomer->id) }}">
                                                    {{ __('Edit') }}
                                                </a>
                                            @endcan

                                            @can('crm_customer_delete')
                                                <form action="{{ route('frontend.crm-customers.destroy', $crmCustomer->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}');" style="display: inline-block;">
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
@can('crm_customer_delete')
  let deleteButtonTrans = '{{ __('Delete selected') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.crm-customers.massDestroy') }}",
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
  let table = $('.datatable-CrmCustomer:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection