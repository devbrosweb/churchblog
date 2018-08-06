<?php

namespace App\Http\Controllers\Admin;

use App\Subscriber;
use Brian2694\Toastr\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriberController extends Controller
{
    public function index()
    {
        $title = 'Suscriptores';
        $subscribers = Subscriber::latest()->get();
        return view('admin.subscribers.index',
            compact('subscribers', 'title'));

    }

    public  function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        Toastr()->success('Suscriptor borrado con exito :)', 'Exito');
        return redirect()->back();
    }
}
