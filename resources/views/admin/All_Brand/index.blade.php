<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Brand
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden ">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


                <div class="container">
                    <div class="row">

                        
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header"> Brand List</div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL no</th>
                                            <th scope="col">brand Name</th>
                                            <th scope="col">Brand Image</th>
                                            <th scope="col">created_At</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @php
                                            $i=1;
                                        @endphp --}}
                                        @foreach ($brands as $brand)
                                            <tr>
                                                <th scope="row">{{ $brands->firstItem() + $loop->index }}</th>
                                                <td>{{ $brand->brand_name }}</td>
                                                <td><img src="{{ asset($brand->brand_image) }}" style="height: 40px; width:70px"></td>

                                                <td>
                                                    @if ($brand->created_at == null)
                                                        <span>Unknown</span>
                                                    @else
                                                        {{ $brand->created_at->diffForHumans() }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('brand/edit/' . $brand->id) }}"
                                                        class="btn btn-info">edit</a>
                                                    <a href="{{ url('brand/delete/' . $brand->id) }}"
                                                        class="btn btn-danger">Delete</a>
                                                </td>

                                            </tr>
                                        @endforeach



                                    </tbody>
                                </table>
                                {{ $brands->links() }}
                            </div>

                        </div>
                        <div class="col-md-4">
                            
                        <div class="card">
                            <div class="card-header"> Add Brand</div>
                            <div class="card-body">
                                <form action="{{ route('store_brand') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                                        <input type="text" name="brand_name" class="form-control" id="brandname"
                                            aria-describedby="emailHelp">
                                        @error('brand_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror


                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Brand Image</label>
                                        <input type="file" name="brand_image" class="form-control" id="brandimage"
                                            aria-describedby="emailHelp">
                                        @error('brand_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror


                                    </div>

                                    <button type="submit" class="btn btn-primary">Add Brand</button>
                                </form>
                            </div>

                        </div>

                        </div>




                    </div>


                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
</x-app-layout>
