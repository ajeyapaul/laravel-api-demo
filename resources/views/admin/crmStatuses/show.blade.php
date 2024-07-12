@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ __('Show') }} {{ __('Statuses') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.crm-statuses.index') }}">
                    {{ __('Back to list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ __('ID') }}
                        </th>
                        <td>
                            {{ $crmStatus->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Name') }}
                        </th>
                        <td>
                            {{ $crmStatus->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.crm-statuses.index') }}">
                    {{ __('Back to list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection