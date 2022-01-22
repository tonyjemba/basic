<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
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
                            <div class="card-header"> All Category</div>
                            <table class="table">
                                <thead>
                                  <tr>
                                      <th scope="col">SL no</th>
                                      <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">created_At</th>
        
                                  </tr>
                                </thead>
                                <tbody>
                                        {{-- @php
                                            $i=1;
                                        @endphp --}}
                                        @foreach ($categories as $category )
                                        <tr>
                                            <th scope="row">{{ $categories->firstItem()+$loop->index}}</th>
                                            <td>{{ $category->category_name }}</td>
                                            <td>{{ $category->user->name }}</td>

                                            <td>
                                                @if ($category->created_at == NUll)
                                                    <span>Unknown</span>
                                                    @else
                                                    {{ $category->created_at->diffForHumans() }}
                                                @endif
                                                </td>

                                          </tr>
                                        @endforeach
                                    
                                  
                                 
                                </tbody>
                              </table>
                              {{ $categories->links() }}
                        </div>
                
                    </div>
                   
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header"> Add Category</div>
                            <div class="card-body">
                                <form action="{{ route('store_category') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                      <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                      <input type="text" name="category_name" class="form-control" id="categoryname" aria-describedby="emailHelp">
                                      @error('category_name')
                                      <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                          
                                      
                                    </div>
                                   
                                    <button type="submit" class="btn btn-primary">Add Category</button>
                                  </form>
                            </div>
                            
                        </div>
                
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
