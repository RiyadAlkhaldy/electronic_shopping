<?php

namespace App\Http\Controllers;

use App\Jobs\ImportProducts;
use Illuminate\Http\Request;

class ImportProductController extends Controller
{
    public function create()
    {
        return view('dashboard.products.import');
    }

    public function store(Request $request)
    {
        $request->validate([
            'count' => 'required|integer|min:1|max:1000000',
        ]);

        /**
         * Dispatch the job to import products
         */
        ImportProducts::dispatch($request->post('count'))
        ->onQueue('import')
        ->delay(now()->addSeconds(5));

        return redirect()->back()
            ->with('success', 'Products are being imported ...');
    }
}
