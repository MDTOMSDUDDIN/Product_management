<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>product-management</title>
</head>
<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header text-center"><h4>Product Edit </h4></div>
            <div class="card-body">
                <a href="{{ route('products.index') }}" class="btn btn-primary col-md-1 offset-md-11 mb-3">Back</a>
                <form method="POST"  action="{{ route('products.update',$product->id) }}" enctype="multipart/form-data">
                    @csrf
                  
                    @method('PUT')
                    <div class="mb-2">
                        <label class="form-label">product id :</label>
                        <input type="text" name="product_id" class="form-control" value="{{ $product->product_id }}">
                        @error('product_id')
                        <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label" for="name">Name :</label>
                        <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label" for="description">description :</label>
                        <textarea name="description" class="form-control" >{{ $product->description }}</textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label" for="price">price :</label>
                        <input type="number" name="price" class="form-control" value="{{ $product->price }}">
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label" for="stock">stock :</label>
                        <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
                        @error('stock')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label" for="image">image :</label>
                        <input type="file" name="image" class="form-control">
                        <img src="{{ asset('images') }}/{{ $product->image }}" alt="images" style="width:80px">
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>