<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Course;

class PurchaseController extends Controller
{
    public function sendCourseConfirmationMail($course, $user)
    {
        // Logic to send a course confirmation email (if required)
    }

    public function creditCheckout(Request $request) {
        $intent = auth()->user()->createSetupIntent();

        $userId = auth()->user()->id;
        $courses = User::find($userId)->coursesInCart;
        $total = 0;
        foreach($courses as $course) {
            $total += $course->price;
        }
        return view('credit.checkout', compact('total', 'intent'));
    }






    public function purchase(Request $request)
    {
        $user = $request->user();
        $paymentMethod = $request->input('payment_method');
        
        $userId = auth()->user()->id;
        $courses = User::find($userId)->coursesInCart;
        $total = 0;
        foreach($courses as $course) {
            $total += $course->price;
        }

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($total * 100 , $paymentMethod, [
                'return_url' => route('cart.view')
            ]);
        } catch (\Exception $exception) {
            return back()->with('An error occurred while purchasing the course. Please check the card information.', $exception->getMessage());
        }
        // $this->sendCourseConfirmationMail($courses, auth()->user());

        foreach($courses as $course) {
            $coursePrice = $course->price;
            $purchaseTime = Carbon::now();
            $user->coursesInCart()->updateExistingPivot($course->id, ['bought' => TRUE, 'price_at_purchase' => $coursePrice, 'created_at' => $purchaseTime]);
            $course->save();
        }

        return redirect('/cart');   
    }








    // public function myOrders() {
    //     $userId = auth()->user()->id;
    //     $myCourses = User::find($userId)->purchasedCourses;

    //     return view('course.myorders', compact('myCourses'));
    // }

    // public function allOrders() {
    //     $allCourses = Shopping::with(['user', 'course'])->where('bought', true)->get();
    //     return view('admin.courses.allOrders', compact('allCourses'));
    // }
}
