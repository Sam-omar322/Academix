<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CartController extends Controller
{
    public function viewCart()
    {
        $items = auth()->user()->CoursesInCart;
        return view('cart', compact('items'));
    }

    public function addToCart(Request $request)
    {
        $course = Course::find($request->id);
        $user = auth()->user();
    
        // Check if the course is already in the cart
        if ($user->coursesInCart->contains($course)) {
            return response()->json([
                'message' => __('لقد قمت بالفعل بإضافة هذه الدورة إلى سلة التسوق الخاصة بك.'),
                'already_added' => true
            ], 200);
        }
    
        // Check if the user already owns this course
        if ($user->myCourses()->where('course_id', $course->id)->exists()) {
            return response()->json([
                'message' => __('لقد قمت بالفعل بشراء هذه الدورة.'),
                'already_purchased' => true
            ], 200);
        }
    
        $user->coursesInCart()->attach($request->id, [
            'price_at_purchase' => $course->price,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        $num_of_product = $user->coursesInCart()->count();
    
        return response()->json([
            'num_of_product' => $num_of_product,
            'message' => __('تمت إضافة الدورة إلى سلة التسوق الخاصة بك بنجاح.'),
            'already_added' => false
        ]);
    }

    public function removeOne(Course $course)
    {
        auth()->user()->coursesInCart()->detach($course->id);
        return redirect()->back();
    }
}
