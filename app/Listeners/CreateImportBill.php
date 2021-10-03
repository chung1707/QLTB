<?php

namespace App\Listeners;

use App\Models\AppConst;
use App\Models\Equipment;
use App\Models\Importbill;
use Illuminate\Support\Str;
use App\Events\EquipmentsCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateImportBill
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EquipmentsCreated $event)
    {
        $equipments = $event->bill[0];
        $importbill = new Importbill;
        $importbill->transaction_id = Str::random(AppConst::RANDOM_CODE);
        $importbill->supplier_id = $event->bill[1];
        $importbill->total_price = $event->bill[2];
        $importbill->user_id = auth()->user()->id;
        $importbill->save();
        foreach ($equipments as $equip){
            $item  = Equipment::where('device_code', '=', $equip['device_code'])->first();
            $importbill->equipments()->attach($item,['quantity' => $equip['quantity'], 'price' => $equip['price']]);
        }
    }
}
