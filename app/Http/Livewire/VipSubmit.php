<?php

namespace App\Http\Livewire;

use App\Models\Notification;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\Subscription;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Str;

class VipSubmit extends Component
{
    use LivewireAlert;

    public $modal = false;
    public $price, $duration, $billing_cycle, $plan_id, $payment_option = [], $payment_method;
    public $listeners = [
        'openModal' => 'openModal',
        'createSubscription' => 'createSubscription'
    ];

    public function render()
    {
        return view('livewire.vip-submit');
    }

    public function save()
    {
        if (auth()->check() && $this->hasPendingSubscription()) {
            $this->alert('error', 'You already have a subscription.', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        } else {
            $this->createSubscription();
        }
    }

    public function hasPendingSubscription()
    {
        $user = auth()->user();

        if ($user->can('can premium content') || $user->subscriptions()->where('status', 'pending')->exists()) {
            return true;
        }

        return false;
    }

    public function createSubscription()
    {
        $duration = $this->duration;
        $start_date = now();
        $end_date = $start_date->copy();

        switch ($this->billing_cycle) {
            case 'year':
                $end_date->addYear($duration);
                break;
            default:
                $end_date->addMonth($duration);
                break;
        }


        try {
            DB::beginTransaction();
        
            // Your database operations go here
            $payment_code = $this->generatePaymentCode(auth()->user()->name);
            $user = auth()->user();
        
            Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $this->plan_id,
                'payment_code' => $payment_code,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'status' => 'pending',
                'billing_amount' => $this->price,
                'payment_method' => $this->payment_method,
            ]);
        
            Telegraph::message("<b>Subscription Created</b>\n\nPayment Code: $payment_code\nUsername: $user->name\nEmail: $user->email\nPayment method: $this->payment_method\nBilling amount: $this->price\n")->send();
        
            Notification::create([
                'user_id' => $user->id,
                'title' => 'Successfully subscribed ',
                'message' => 'Congratulations! You have successfully subscribed. Please copy your payment code and confirm your payment on the Contact page. Thank you!',
                'is_read' => true
            ]);
        
            // Commit the transaction if all queries are successful
            DB::commit();
        
            $this->modal = false;
            $this->emit('sendNotif');
            $this->alert('success', 'Successfully created subscription. Check your notification');
            return redirect()->route('usersubscription.log');
        } catch (\Throwable $th) {
            // Rollback the transaction if an error occurs
            DB::rollBack();
            Log::error('Subscription creation failed: ' . $th->getMessage());
            $this->alert('error', 'Subscription creation failed: '.$th->getMessage());
        }
    }

    public function openModal($plan)
    {
        $this->payment_option = Payment::all();
        $this->duration = $plan['duration'];
        $this->billing_cycle = $plan['billing_cycle'];
        $this->duration = $plan['duration'];
        $this->price = $plan['price'];
        $this->plan_id = $plan['id'];
        $this->modal = true;
    }

    public static function generatePaymentCode($userName)
    {
        $userInitials = substr(strtoupper(preg_replace('/[^A-Za-z]/', '', $userName)), 0, 3);
        $randomString = Str::random(6);

        $code = $userInitials . $randomString;

        return $code;
    }
}
