<?php

namespace App\Http\Livewire;

use App\Models\Notification;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\Subscription;
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

        Subscription::create([
            'user_id' => auth()->user()->id,
            'plan_id' => $this->plan_id,
            'payment_code' => $this->generatePaymentCode(auth()->user()->name),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => 'pending',
            'billing_amount' => $this->price,
            'payment_method' => $this->payment_method,
        ]);

        Notification::create([
            'user_id' => auth()->user()->id,
            'title' => 'Successfully subscribed ',
            'message' => 'Congratulations! You have successfully subscribed. Please copy youre payment code and confirm your payment on the Contact page. Thank you!',
            'is_read' => true
        ]);

        $this->modal = false;
        $this->emit('sendNotif');
        $this->alert('success', 'Succes created subscription check your notification');
        return redirect()->route('usersubscription.log');
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
