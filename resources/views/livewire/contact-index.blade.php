<div>
    @livewire('contact-create')
    @livewire('contact-update')

    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $key => $contact)
            <tr>
                <th scope="row">{{ ++$key }}</th>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->phone }}</td>
                <td>
                    <button wire:click="getContact({{ $contact->id }})" type="button" class="btn btn-sm btn-info"
                        data-bs-toggle="modal" data-bs-target="#updateModal">
                        Edit
                    </button>
                    <button class="btn btn-sm btn-danger">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>