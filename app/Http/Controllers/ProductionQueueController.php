<?php

namespace App\Http\Controllers;

use App\Models\ProductionQueue;
use Illuminate\Support\Facades\Storage;

class ProductionQueueController extends Controller
{
    /**
     * Menampilkan halaman Antrian Produksi.
     */
    public function index()
    {
        $productionQueues = ProductionQueue::latest('invoice_date')->get();

        $totalQueues = $productionQueues->count();

        return view('production_queues.index', compact(
            'productionQueues',
            'totalQueues'
        ));
    }


    /**
     * Menandai produksi sebagai selesai.
     */
    public function complete(ProductionQueue $productionQueue)
    {
        $productionQueue->update([
            'progress' => 100,
            'production_status' => 'Selesai',
        ]);

        return redirect()
            ->route('production-queues.index')
            ->with(
                'success',
                'Produksi berhasil ditandai selesai.'
            );
    }


    /**
     * Download file produksi.
     */
    public function download(ProductionQueue $productionQueue)
    {
        if (
            !$productionQueue->file_path ||
            !Storage::disk('public')->exists($productionQueue->file_path)
        ) {
            return redirect()
                ->route('production-queues.index')
                ->with(
                    'error',
                    'File produksi tidak ditemukan.'
                );
        }

        $filePath = storage_path(
            'app/public/' . $productionQueue->file_path
        );

        return response()->download($filePath);
    }
}
