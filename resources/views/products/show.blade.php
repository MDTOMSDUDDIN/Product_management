<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>product-show</title>
</head>
<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header text-center"><h4>Product Show </h4></div>
            <div class="card-body">
                <a href="{{ route('products.index') }}" class="btn btn-primary col-md-1 offset-md-11 mb-3">Back</a>
                <div class="mb-2">
                    <p><strong>Product_id: </strong>{{ $product->product_id }}</p>
                    <p><strong>Image : </strong> <img src="{{ asset('images') }}/{{ $product->image }}" alt="images" style="width:120px"></p>
                    <p><strong>Name : </strong>{{ $product->name }}</p>
                    <p><strong>Description : </strong>{{ $product->description }}</p>
                    <p><strong>Price : </strong>{{ $product->price }}</p>
                    <p><strong>Stock : </strong>{{ $product->stock }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>