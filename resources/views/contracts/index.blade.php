@extends('layouts.main')
@section('title', 'Contact App | All Contacts')
@section('content')
<!-- content -->
<main class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-title">
                        <div class="d-flex align-items-center">
                            <h2 class="mb-0">All Contacts</h2>
                            <div class="ml-auto">
                                <a href="{{ route('contracts.create') }}" class="btn btn-success"><i
                                        class="fa fa-plus-circle"></i> Add Contract</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('contracts._filter')
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('layouts._message')
                                @if ($contracts->count())
                                    @foreach ($contracts as $index => $contract)
                                        <tr>
                                            <th scope="row">{{ $index + $contracts->firstItem() }}</th>
                                            <td>{{ $contract->first_name }}</td>
                                            <td>{{ $contract->last_name }}</td>
                                            <td>{{ $contract->email }}</td>
                                            <td>{{ $contract->company->name }}</td>
                                            <td width="150">
                                                <a href="{{route('contracts.show',$contract->id)}}" class="btn btn-sm btn-circle btn-outline-info"
                                                    title="Show"><i class="fa fa-eye"></i></a>
                                                <a href="{{route('contracts.edit',$contract->id)}}" class="btn btn-sm btn-circle btn-outline-secondary"
                                                    title="Edit"><i class="fa fa-edit"></i></a>
                                                <a href="{{route('contracts.destroy',$contract->id)}}" class="btn-delete btn btn-sm btn-circle btn-outline-danger"
                                                    title="Delete"><i
                                                        class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @include('layouts._delete-form')
                                @endif
                            </tbody>
                        </table>

                        {{
                            $contracts->appends(request()->only('company_id','search'))->links()
                        }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
