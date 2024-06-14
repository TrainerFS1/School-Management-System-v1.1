<?php

namespace App\Http\Controllers;

use App\Models\Teachers;
use App\Models\Students;
use App\Models\Payments;
use App\Models\Notification;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'teachers' => Teachers::count(),
            'students' => Students::count(),
            'class' => Students::count(),
            'total_payments' => Payments::sum('amount'),
            'notifications' => Notification::latest()->limit(5)->get(),
        ];

        return view('dashboard', compact('data'));
    }

    public function storeNotification(Request $request)
    {
        $request->validate([
            'notificationMessage' => 'required|string',
        ]);

        Notification::create([
            'content' => $request->notificationMessage,
        ]);

        return redirect()->back()->with('success', 'Notification added successfully.');
    }

    public function deleteNotification($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }
}
