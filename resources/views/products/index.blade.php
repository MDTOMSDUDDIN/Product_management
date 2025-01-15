<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <title>product management</title>
</head>
<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header text-center"><h4>Product List </h4></div>
            <div class="card-body">

                <form action="{{ route('products.index') }}" method="GET" class="mb-3">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}" >
                        </div>
                        <div class="col-md-1 col-lg-1">
                            <button type="submit" class="btn btn-success ">Search</button>
                            {{-- <a href="{{ route('products.index') }}" class="btn btn-secondary">Reset</a> --}}
                        </div>
                    </div>
                </form>


             <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product_id</th>
                        <th>Image</th>
                        <th>
                            <a href="{{ route('products.index', ['sort' => 'name', 'direction' => $sortBy === 'name' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                Name
                                @if ($sortBy === 'name')
                                    <span>{{ $direction === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </a>
                        </th>
                        <th>Description</th>
                        
                        <th>
                            <a href="{{ route('products.index', ['sort' => 'price', 'direction' => $sortBy === 'price' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                Price
                                @if ($sortBy === 'price')
                                    <span>{{ $direction === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </a>
                        </th>

                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
              
                <tbody>
                    <a href="{{ route('products.create') }}" class="btn btn-primary col-md-2 offset-md-10 mb-3 text-decoration-none">Add New Product</a>
                   @session('success')
                   <div class="alert alert-success">{{ $value }}</div>
                   @endsession

                    @foreach ($products as $product)
                        <tr>
                        <td>{{ $product->id}}</td>
                        <td>{{ $product->product_id}}</td>
                        <td><img src="{{ asset('images') }}/{{ $product->image }}" alt="images" style="width:80px"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <form action="{{ route('products.delete',$product->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                            
                            <button class="badge text-bg-danger"><i class="bi bi-trash b"></i>Delete</button>
                        </form>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
             </table>

             
             {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</body>
</html>