@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ __('Show') }} {{ __('Documents') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.crm-documents.index') }}">
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
                                        {{ $crmDocument->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('Customer') }}
                                    </th>
                                    <td>
                                        {{ $crmDocument->customer->first_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('File') }}
                                    </th>
                                    <td>
                                        @if($crmDocument->document_file)
                                            <a href="{{ $crmDocument->document_file->getUrl() }}" target="_blank">
                                                {{ __('View file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('Document name') }}
                                    </th>
                                    <td>
                                        {{ $crmDocument->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('Description') }}
                                    </th>
                                    <td>
                                        {{ $crmDocument->description }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.crm-documents.index') }}">
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