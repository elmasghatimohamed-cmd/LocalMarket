<?php

namespace App\Livewire;

use Livewire\Component;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\OrderStatusChanged;

class CheckoutModal extends Component
{
    public $isOpen = false;
    public $cart;
    public $address;

    protected $listeners = ['handleStripeToken' => 'processOrder'];

    public function mount($cart)
    {
        $this->cart = $cart;
    }

    public function openModal()
    {
        $this->isOpen = true;
        $this->dispatch('initStripe');
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function processOrder($token)
    {
        $this->validate(['address' => 'required|string|max:255']);

        try {
            DB::beginTransaction();
            
            $total = $this->cart->items->sum(fn($i) => $i->product->price * $i->quantity);
            
            Stripe::setApiKey(config('services.stripe.secret'));
            
            $charge = Charge::create([
                'amount' => $total * 100,
                'currency' => 'usd',
                'source' => $token,
                'description' => 'Order from LocalMarket - ' . Auth::user()->email,
            ]);
            
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'status' => 'on_hold',
                'address' => $this->address,
                'payment_id' => $charge->id,
                'payment_status' => 'completed',
            ]);
            
            foreach ($this->cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
                
                $item->product->decrement('stock', $item->quantity);
            }
            
            $this->cart->items()->delete();
            $this->cart->delete();
            
            DB::commit();
            
            try {
                Auth::user()->notify(new OrderStatusChanged($order));
            } catch (\Exception $e) {
                \Log::error('Mail Error: ' . $e->getMessage());
            }
            
            session()->flash('success', 'TRANSACTION SUCCESSFUL');
            return redirect()->route('orders.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('payment', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.checkout-modal');
    }
}