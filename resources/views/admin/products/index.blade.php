<x-admin.layout>
    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
                <a href="{{ route('admin.products.create') }}">Create Product</a>
                <table width="900" align="center">
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ substr($product->product_desc, 0, 30) }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <a href="#">Edit</a> ||
                                <a href="#">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</x-admin.layout>
