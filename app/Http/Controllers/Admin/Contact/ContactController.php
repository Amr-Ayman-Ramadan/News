<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    private $contact;
    public function __construct(Contact $contactModel)
    {
        $this->contact = $contactModel;
    }

    public function index()
    {
        $contacts = $this->contact::when(request()->keyword, function ($query) {
            $query->where('name', 'like', '%' . request()->keyword . '%')
                  ->where('title', 'like', '%' . request()->keyword . '%');
        })
            ->when(request()->status, function ($query) {
                $query->where('status', request()->status);
            })
            ->orderBy(request("sort_by",'id'),request("order_by","desc"))
            ->paginate(request('limit_by',10));
        return view('Dashboard.contact.list', compact('contacts'));
    }
    public function show($id)
    {
        $contact = $this->contact::find($id);
        $contact->update(['status' => "read"]);
        return view('Dashboard.contact.show', compact('contact'));
    }
    public function destroy($id)
    {
        $contact = $this->contact::find($id);
        $contact->delete();
        return to_route("admin.contact.index");
    }

}
