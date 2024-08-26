<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    public function displayProducts()
    {
        $product = Product::latest()->get();
        return view('admin.product.all_product', compact('product'));
    }
    public function createProducts()
    {
        return view('admin.product.create_product');
    }
    public function storeProducts(Request $request)
    {
        $destinationPath = 'upload/';
        $imageName = $request->image->getClientOriginalName();

        // Resize image using Intervention Image
        $image = Image::read($request->image->getRealPath());
        $image->resize(800, 800, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Save the resized image
        $image->save(public_path($destinationPath . $imageName));

        $storeProducts = Product::create([
            "price" => $request->price,
            "name" => $request->name,
            "description" => $request->description,
            "stock" => $request->stock,
            "image" => $imageName,
            "created_at" => Carbon::now(),
        ]);

        if ($storeProducts) {
            toast('Berhasil menambahkan data!', 'success')->timerProgressBar();
            return Redirect()->route("products.all");
        }
    }
    public function editProducts($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit_product', compact('product'));
    }

    public function updateProducts(Request $request)
    {
        $product_id = $request->id;
        $product = Product::findOrFail($product_id);

        if ($request->file('image')) {
            $destinationPath = 'upload/';
            $imageName = $request->image->getClientOriginalName();

            // Resize image using Intervention Image
            $image = Image::read($request->image->getRealPath());
            $image->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            // Save the resized image
            $image->save(public_path($destinationPath . $imageName));

            // Delete the old image
            if (File::exists(public_path('upload/' . $product->image))) {
                File::delete(public_path('upload/' . $product->image));
            }

            Product::findOrFail($product_id)->update([
                "price" => $request->price,
                "name" => $request->name,
                "description" => $request->description,
                "stock" => $request->stock,
                "image" => $imageName,
            ]);

            toast('Berhasil Mengubah data!', 'success')->timerProgressBar();
            return Redirect::route("products.all");
        } else {
            Product::findOrFail($product_id)->update([
                "price" => $request->price,
                "name" => $request->name,
                "description" => $request->description,
                "stock" => $request->stock,
            ]);

            toast('Berhasil Mengubah data!', 'success')->timerProgressBar();
            return Redirect::route("products.all");
        }
    }

    public function deleteProducts($id)
    {
        $product = Product::find($id);
        if (File::exists(public_path('upload/' . $product->image))) {
            File::delete(public_path('upload/' . $product->image));
        } else {
            //dd('File does not exists.');
        }
        $product->delete();
        if ($product) {
            toast('Berhasil Menghapus data!', 'success')->timerProgressBar();
            return Redirect::route("products.all")->with(['delete' => 'Product deleted successfully']);
        }
    }
}
