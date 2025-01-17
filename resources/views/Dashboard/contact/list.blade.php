@extends("Layouts.Dashboard.app")
@section("title", "Contacts")
@section("content")
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Contacts</h1>
        <p class="mb-4">Below is a list of all contacts. You can manage them here.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Contacts Table</h6>
            </div>
            @include("Dashboard.contact.filter.filter")
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Phone</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody>
                        @forelse($contacts as $contact)
                            <tr>
                                <td>{{ $contact->id }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->title }}</td>
                                <td>{{$contact->status == "unread" ? "unread" :"read"}}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.contact.show', $contact) }}" class="btn btn-sm btn-info d-inline">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $contact->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <form id="delete_contact_{{ $contact->id }}" action="{{ route('admin.contact.destroy', $contact->id) }}" method="POST" style="display: none;">
                                @csrf @method('DELETE')
                            </form>
                        @empty
                            <tr>
                                <td class="alert alert-info" colspan="8">No Contacts Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $contacts->appends(request()->input())->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection

<script>
    function confirmDelete(contactId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this contact?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete_contact_${contactId}`).submit();
            }
        });
    }
</script>
