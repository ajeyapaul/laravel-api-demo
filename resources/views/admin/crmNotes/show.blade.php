@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ __('Show') }} {{ __('Notes') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.crm-notes.index') }}">
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
                            {{ $crmNote->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Customer') }}
                        </th>
                        <td>
                            {{ $crmNote->customer->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Note') }}
                        </th>
                        <td>
                            {{ $crmNote->note }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.crm-notes.index') }}">
                    {{ __('Back to list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection