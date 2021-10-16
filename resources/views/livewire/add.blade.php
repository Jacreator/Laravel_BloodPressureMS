<div wire:ignore.self id="AddBPModal" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">First Name</label>
                        <input readonly type="text" id="exampleFormControlInput1" class="form-control"
                            placeholder="Enter First Name" wire:model="first_name" />
                        @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Last Name</label>
                        <input readonly type="text" id="exampleFormControlInput2" class="form-control"
                            placeholder="Enter Last Name" wire:model="last_name" />
                        @error('last_name')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Email</label>
                        <input readonly type="email" id="exampleFormControlInput2" class="form-control"
                            placeholder="Enter Email Address" wire:model="email" />
                        @error('email')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <br />
                    {{-- former record for bp --}}
                    <p>{{__('Last 10 readings')}}</p>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Readings</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($bPreports == null)
                            <tr>
                                <td colspan="3">
                                    <p>This Patient has no record</p>
                                </td>
                            </tr>
                            @else
                                @foreach ($bPreports as $key => $bpReading)
                                    <tr>
                                        <td>{{ ($key+1) }}</td>
                                        <td>{{ $bpReading->readings }}</td>
                                        <td>
                                            <button wire:click="delete({{ $bpReading->id }})"
                                                class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            
                        </tbody>

                    </table>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">New Reading</label>
                        <input type="text" id="exampleFormControlInput2" class="form-control"
                            placeholder="Enter new reading" wire:model="reading" />
                        @error('reading')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button wire:click.prevent="storeBPs({{ $dataId }})" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
