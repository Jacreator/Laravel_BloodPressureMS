<div>
    {{-- The Master doesn't talk, he acts. --}}

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @include('livewire.create')

    @include('livewire.update')
    @include('livewire.add')
    <br />
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($patientData as $data)
                <tr>
                    <td>{{ $data->first_name }}</td>
                    <td>{{ $data->last_name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->age }}</td>

                    <td>{{ $data->gender }}</td>
                    <td>
                        <button data-toggle="modal" data-target="#updateModal" class="btn btn-primary btn-sm"
                            wire:click="edit({{ $data->id }})">Edit</button>
                        <button data-toggle="modal" data-target="#AddBPModal" class="btn btn-secondary btn-sm"
                            wire:click="add({{ $data->id }})">Add BPRs</button>
                        <button wire:click="delete({{ $data->id }})" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
