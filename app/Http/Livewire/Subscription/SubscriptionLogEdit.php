<?php

namespace App\Http\Livewire\Subscription;

use App\Models\Notification;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SubscriptionLogEdit extends Component
{
    use LivewireAlert;
    public Subscription $subscription;

    public $listeners = ['editSubscription' => 'getUser', 'saveData' => 'saveData'];
    public $modal = false,
        $status,
        $payment_code,
        $billing_amount,
        $start_date,
        $plan_description,
        $plan_duration,
        $plan_billing_cycle,
        $end_date;
    private $defaultMessageActive = 'Exciting update! Your VIP subscription is now active, granting you access to premium content. 🎉 Enjoy the best! 🌟📚📺',
        $defaultMessageExpired = 'Important Notice: Your VIP subscription has expired, and access to premium content has been deactivated. Renew now to continue enjoying the best! 🌟📚📺',
        $defaultMessageCancelled = 'Update: Your VIP subscription has been canceled, and access to premium content has been revoked. We hope you enjoyed your time with us! 🌟📚📺';

    public function render()
    {
        return view('livewire.subscription.subscription-log-edit');
    }

    public function save()
    {
        if (auth()->user()->hasRole(['super-admin', 'admin'])) {

            $duration = $this->subscription->plan->duration;
            $start_date = now();
            $end_date = $start_date->copy();

            switch ($this->subscription->plan->billing_cycle) {
                case 'year':
                    $end_date->addYear($duration);
                    break;
                default:
                    $end_date->addMonth($duration);
                    break;
            }

            $this->subscription->update([
                'status' => $this->status,
                'start_date' => $start_date,
                'end_date' => $end_date,
            ]);
            
            if ($this->status == 'active') {
                $this->subscription->user->assignRole('vip');

                DB::table('revenues')->insert([
                    'user_id' => $this->subscription->user_id,
                    'amount' => $this->subscription->billing_amount,
                    'date' => $start_date
                ]);
                
            } else {
                $this->subscription->user->removeRole('vip');
            }
            Notification::create([
                'user_id' => $this->subscription->user->id,
                'title' =>  $this->status === 'active'
                    ? 'Successfully subscribed to VIP content'
                    : ($this->status === 'expired'
                        ? 'VIP subscription expired'
                        : ($this->status === 'cancelled'
                            ? 'VIP subscription cancelled'
                            : ($this->status === 'pending'
                                ? 'VIP subscription is pending approval'
                                : 'Subscription Update'))),
                'message' => $this->message($this->status),
                'is_read' => true
            ]);
            $this->emit('reRender');
            $this->modal = false;
            $this->alert('success', 'Updated sucesfully', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        } else {
            $this->modal = false;

            $this->alert('error', 'Dont you dare to edit this!!!', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        }
    }

    public function message($props)
    {
        $message = '';
        switch ($props) {
            case 'expired':
                $message = $this->defaultMessageExpired;
                break;
            case 'cancelled':
                $message = $this->defaultMessageCancelled;
                break;
            default:
                $message = $this->defaultMessageActive;
                break;
        }

        return $message;
    }

    public function getUser(Subscription $subscription)
    {
        $this->subscription = $subscription;
        $this->plan_duration = $subscription->plan->duration;
        $this->plan_billing_cycle = $subscription->plan->billing_cycle;
        $this->plan_description = $subscription->plan->description;
        $this->status = $subscription->status;
        $this->payment_code = $subscription->payment_code;
        $this->start_date = $subscription->start_date;
        $this->end_date = $subscription->end_date;
        $this->billing_amount = $subscription->billing_amount;
        $this->modal = true;
    }
}
