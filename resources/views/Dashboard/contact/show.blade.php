@extends("Layouts.Dashboard.app")
@section("title", "Contact Details")
@section("content")
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Contact Details</h1>

        <!-- Contact Details Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Contact Information</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <td>{{ $contact->id }}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $contact->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $contact->email }}</td>
                            </tr>
                            <tr>
                                <th>Title</th>
                                <td>{{ $contact->title }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $contact->phone }}</td>
                            </tr>
                            <tr>
                                <th>Message</th>
                                <td>{{ $contact->body }}</td>
                            </tr>
                            <tr>
                                <th>IP Address</th>
                                <td>{{ $contact->ip_address }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $contact->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        </table>
                        <div class="mt-3">
                            <a href="{{ route('admin.contact.index') }}" class="btn btn-primary">Back to Contacts</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
