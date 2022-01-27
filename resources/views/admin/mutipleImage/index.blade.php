<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Multi Images
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


                        </div>
                        <div class="col-md-4">
                            
                        <div class="card">
                            <div class="card-header"> Multiple Image</div>
                            <div class="card-body">
                                <form action="{{ route('addmultipleImages') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                         
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Brand Image</label>
                                        <input type="file" name="image[]" class="form-control" id="image"
                                            aria-describedby="emailHelp" multiple>
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror


                                    </div>

                                    <button type="submit" class="btn btn-primary">Add Image</button>
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
