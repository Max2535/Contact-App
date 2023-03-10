<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <label for="first_name" class="col-md-3 col-form-label">First Name</label>
            <div class="col-md-9">
                <input type="text" name="first_name" value="{{old('first_name',$contract->first_name)}}" id="first_name" class="form-control @error('first_name') is-invalid @enderror">
                @error('first_name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="last_name" class="col-md-3 col-form-label">Last Name</label>
            <div class="col-md-9">
                <input type="text" name="last_name" value="{{old('last_name',$contract->last_name)}}" id="last_name" class="form-control @error('last_name') is-invalid @enderror">
                @error('last_name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-3 col-form-label">Email</label>
            <div class="col-md-9">
                <input type="text" name="email" value="{{old('email',$contract->email)}}" id="email" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="phone" class="col-md-3 col-form-label">Phone</label>
            <div class="col-md-9">
                <input type="text" name="phone" value="{{old('phone',$contract->phone)}}" id="phone" class="form-control @error('phone') is-invalid @enderror">
                @error('phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-3 col-form-label">Address</label>
            <div class="col-md-9">
                <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{old('address',$contract->address)}}</textarea>
                @error('address')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="company_id" class="col-md-3 col-form-label">Company</label>
            <div class="col-md-9">
                <select name="company_id" id="company_id" class="form-control @error('company_id') is-invalid @enderror">
                    @foreach ($companies as $id => $name)
                        <option {{ $id == old('company_id',$contract->company_id) ? 'selected' : '' }} value="{{ $id }}">
                            {{ $name }}</option>
                    @endforeach
                </select>
                @error('company_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <hr>
        <div class="form-group row mb-0">
            <div class="col-md-9 offset-md-3">
                <button type="submit" class="btn btn-primary">{{$contract->exists ?'Update':'Save'}}</button>
                <a href="{{ route('contracts.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </div>
    </div>
</div>
