<?php

namespace App\Jobs;

use App\Mail\CompletedOrderMail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailComplatedOrderJop implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $orders = Order::where('status', 'shipped')->get();
        foreach ($orders as $order) {
            $targetDate = $order->updated_at->addDays(2)->toDateString();
            if (now()->toDateString() == $targetDate) {
                $order->status = 'completed';
                $order->save();
                //mail
                Mail::to($order->user->email)->send(new CompletedOrderMail($order));
            }
        }
    }
}
