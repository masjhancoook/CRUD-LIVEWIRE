<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="container">
        @if ($errors->any())
            <div class="mb-3">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->ALL() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (session()->has('message'))
            <div class="mb-3">
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            </div>
        @endif
        <!-- START FORM -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <form>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" wire:model="nama">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" wire:model="email">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" wire:model="alamat">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    @if ($updatedata == false)
                        <div class="col-sm-10"><button type="button" class="btn btn-primary" name="submit"
                                wire:click="store()">SIMPAN</button>
                        @else
                            <button type="button" class="btn btn-primary" name="submit"
                                wire:click="updates()">UPDATE</button>
                    @endif
                    <button type="button" class="btn btn-danger" name="submit" wire:click="clear()">Reset</button>
                </div>
        </div>
        </form>
    </div>
    <!-- AKHIR FORM -->

    <!-- START DATA -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h1>Data Pegawai</h1>
        <input type="text" placeholder="Search..." wire:model.live="searchData">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-4">Nama</th>
                    <th class="col-md-3">Email</th>
                    <th class="col-md-2">Alamat</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataemployee as $key => $item)
                    <tr>
                        <td class="col-md-1">{{ $dataemployee->firstItem() + $key }}</td>
                        <td class="col-md-4">{{ $item->nama }}</td>
                        <td class="col-md-3">{{ $item->email }}</td>
                        <td class="col-md-2">{{ $item->alamat }}</td>
                        <td class="col-md-2">
                            <a wire:click="update({{ $item->id }})" class="btn btn-warning btn-sm">Edit</a>
                            <a wire:click="delete({{ $item->id }})" class="btn btn-danger btn-sm">Del</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $dataemployee->links() }}

    </div>
    <!-- AKHIR DATA -->
</div>
</div>
