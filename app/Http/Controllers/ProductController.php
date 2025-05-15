<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Instantiate a new ProductController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:product-view', ['only' => ['index']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('cms.products.index', [
            'page_title' => 'Daftar Produk',
            'sub_title' => 'Lihat, kelola, dan atur inventaris produk Anda secara efisien.'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('cms.products.create', [
            'page_title' => 'Daftar Produk',
            'sub_title' => 'Tambah Produk Baru',
            'categories' => ProductCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $product = new Product();
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->description = $request->description;
            $product->is_available = $request->has('is_available') ? 1 : 0;
            $product->is_active = $request->has('is_active') ? 1 : 0;
            $product->product_category_id = $request->product_category_id;

            // Handle image upload
            for ($i = 1; $i <= 4; $i++) {
                if ($request->hasFile("image{$i}")) {
                    $image = $request->file("image{$i}");
                    $name = time() . "_img{$i}." . $image->getClientOriginalExtension();
                    $destinationPath = public_path('assets/img/product/');
                    $image->move($destinationPath, $name);
                    $product->{"image{$i}"} = $name;
                }
            }

            // Handle PDF upload
            for ($i = 1; $i <= 3; $i++) {
                if ($request->hasFile("pdf{$i}")) {
                    $pdf = $request->file("pdf{$i}");
                    $name = time() . "_pdf{$i}." . $pdf->getClientOriginalExtension();
                    $destinationPath = public_path('assets/pdf/product/');
                    $pdf->move($destinationPath, $name);
                    $product->{"pdf{$i}"} = $name;
                }
            }

            $product->save();
            DB::commit();

            return redirect()->route('cms.product.index')
                    ->withSuccess('Produk baru berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                    ->withErrors('Gagal menambahkan produk. Kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('cms.products.edit', [
            'page_title' => 'Daftar Produk',
            'sub_title' => 'Edit Produk',
            'product' => $product,
            'categories' => ProductCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->description = $request->description;
            $product->is_available = $request->is_available;
            $product->is_active = $request->is_active;
            $product->product_category_id = $request->product_category_id;

            // Handle image updates
            for ($i = 1; $i <= 4; $i++) {
                $key = "image{$i}";
                if ($request->hasFile($key)) {
                    // Hapus file lama jika ada
                    if ($product->$key) {
                        $oldPath = public_path("assets/img/product/" . $product->$key);
                        if (File::exists($oldPath)) {
                            File::delete($oldPath);
                        }
                    }

                    $file = $request->file($key);
                    $name = uniqid("img{$i}_") . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('assets/img/product/'), $name);
                    $product->$key = $name;
                }
            }

            // Handle PDF updates
            for ($i = 1; $i <= 3; $i++) {
                $key = "pdf{$i}";
                if ($request->hasFile($key)) {
                    if ($product->$key) {
                        $oldPath = public_path("assets/pdf/product/" . $product->$key);
                        if (File::exists($oldPath)) {
                            File::delete($oldPath);
                        }
                    }

                    $file = $request->file($key);
                    $name = uniqid("pdf{$i}_") . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('assets/pdf/product/'), $name);
                    $product->$key = $name;
                }
            }


            $product->save();
            DB::commit();

            return redirect()->route('cms.product.index')
                    ->withSuccess('Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                    ->withErrors('Gagal mengedit produk. Kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        DB::beginTransaction();

        try {
            // Hapus semua gambar jika ada
            for ($i = 1; $i <= 4; $i++) {
                $imageField = "image{$i}";
                $imageName = $product->$imageField;
                if ($imageName) {
                    $imagePath = public_path("assets/img/product/{$imageName}");
                    if (File::exists($imagePath)) {
                        File::delete($imagePath);
                    }
                }
            }

            // Hapus semua PDF jika ada
            for ($i = 1; $i <= 3; $i++) {
                $pdfField = "pdf{$i}";
                $pdfName = $product->$pdfField;
                if ($pdfName) {
                    $pdfPath = public_path("assets/pdf/product/{$pdfName}");
                    if (File::exists($pdfPath)) {
                        File::delete($pdfPath);
                    }
                }
            }

            // Hapus data dari database
            $product->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Produk telah berhasil dihapus.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mencoba menghapus produk. Silakan coba lagi nanti.'
            ], 500);
        }
    }


    // ====================================================================================================================
    // API
    // ====================================================================================================================

    public function getDataProduct(): JsonResponse
    {
        try {
            // Get data product
            $products = Product::with('category')->orderBy('id', 'DESC')->get();
            // 200 Success
            return response()->json([
                'success' => true,
                'message' => 'Data produk berhasil diambil',
                'data' => $products
            ], 200);
        } catch (\Exception $e) {
            // 500 Error
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data produk',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
