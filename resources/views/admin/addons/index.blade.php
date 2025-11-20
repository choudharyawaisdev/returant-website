@extends('admin.layouts.app')

@section('title')
    Add-ons Index
@endsection

@section('body')
    <div class="container-fluid">
        <!-- PAGE HEADER -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add-ons</li>
                </ol>
            </nav>
            <button class="btn btn-primary btn-sm" onclick="openAddModal()">Add Add-on</button>
        </div>

        <!-- TABLE -->
        <div class="col-xl-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title">All Add-ons</h6>
                </div>
                <div class="card-body p-2">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($adons as $index => $adon)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $adon->name }}</td>
                                        <td>{{ number_format($adon->price, 2) }}</td>
                                        <td>{{ $adon->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <form action="{{ route('admin.addons.destroy', $adon->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                            <button class="btn btn-sm btn-warning"
                                                onclick="openEditModal(@json($adon))">
                                                <i class="fa fa-pen-to-square"></i> Edit
                                            </button>
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

    <!-- MODAL -->
    <div class="modal fade" id="adonModal" tabindex="-1" role="dialog" aria-labelledby="adonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="adonForm" method="POST" action="">
                @csrf
                <input type="hidden" name="_method" value="POST" id="formMethod">
                <input type="hidden" name="id" id="adon_id">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="adonModalLabel">Add Add-on</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mt-3">
                            <label for="name">Add-on Name</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" name="price" id="price" step="0.01"
                                min="0" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddModal() {
            $('#adonForm').attr('action', '{{ route('admin.addons.store') }}');
            $('#formMethod').val('POST');
            $('#adonModalLabel').text('Add Add-on');
            $('#name').val('');
            $('#price').val('');
            $('#menu_id').val('');
            $('#adon_id').val('');
            $('#adonModal').modal('show');
        }

        function openEditModal(adon) {
            $('#adonForm').attr('action', '/admin/addons/' + adon.id);
            $('#formMethod').val('PUT');
            $('#adonModalLabel').text('Edit Add-on');
            $('#name').val(adon.name);
            $('#price').val(adon.price);
            $('#menu_id').val(adon.menu_id);
            $('#adon_id').val(adon.id);
            $('#adonModal').modal('show');
        }

        function confirmDelete() {
            return confirm('Are you sure you want to delete this add-on?');
        }
    </script>
@endsection
