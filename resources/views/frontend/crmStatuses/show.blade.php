@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ __('Show') }} {{ __('Statuses') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.crm-statuses.index') }}">
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
                            <a class="btn btn-default" href="{{ route('frontend.crm-statuses.index') }}">
                                {{ __('Back to list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection