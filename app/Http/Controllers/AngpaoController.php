<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AngpaoPool;
use App\Models\AngpaoClaim;
use Illuminate\Support\Facades\DB;

class AngpaoController extends Controller
{
// Di dalam AngpaoController.php
public function claim(Request $request, $poolId)
{
    $request->validate(['name' => 'required|string|max:50']);

    try {
        $result = DB::transaction(function () use ($poolId, $request) {
            $pool = AngpaoPool::lockForUpdate()->findOrFail($poolId);

            if ($pool->remaining_slots <= 0) {
                throw new \Exception('Yah, Angpaonya sudah habis!');
            }

            $amount = $this->calculateRandomAmount($pool);

            $pool->claims()->create([
                'claimed_by' => $request->name,
                'amount' => $amount
            ]);

            $pool->decrement('remaining_slots');

            return $amount;
        });

        return back()->with('success', [
            'amount' => $result,
            'message' => "Gong Xi Fa Cai! Selamat {$request->name}!"
        ]);

    } catch (\Exception $e) {
        return back()->with('error', $e->getMessage());
    }
}

    private function calculateRandomAmount($pool)
    {
        // Jika sisa 1 slot, berikan semua sisa uangnya
        if ($pool->remaining_slots == 1) {
            $alreadyClaimed = $pool->claims()->sum('amount');
            return $pool->total_amount - $alreadyClaimed;
        }

        /**
         * Algoritma Double Average:
         * Maksimal yang didapat = (Sisa Uang / Sisa Slot) * 2
         */
        $alreadyClaimed = $pool->claims()->sum('amount');
        $remainingMoney = $pool->total_amount - $alreadyClaimed;
        
        $avg = $remainingMoney / $pool->remaining_slots;
        $max = $avg * 2;

        // Random antara Rp 1.000 sampai batas $max
        return rand(1000, floor($max));
    }
}