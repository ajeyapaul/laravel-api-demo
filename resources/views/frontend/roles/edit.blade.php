@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ __('Edit') }} {{ __('Role') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.roles.update", [$role->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ __('Title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $role->title) }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ __(' ') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="permissions">{{ __('Permissions') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ __('Select all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ __('Deselect all') }}</span>
                            </div>
                            <select class="form-control select2" name="permissions[]" id="permissions" multiple required>
                                @foreach($permissions as $id => $permission)
                                    <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || $role->permissions->contains($id)) ? 'selected' : '' }}>{{ $permission }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('permissions'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('permissions') }}
                                </div>
                            @endif
                            <span class="help-block">{{ __(' ') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection