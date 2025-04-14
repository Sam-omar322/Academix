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

        if (auth()->user()->coursesInCart->contains($course)) {
            return response()->json([
                'message' => 'You have already added this course to your cart.',
                'already_added' => true
            ], 200);
        }

        auth()->user()->coursesInCart()->attach($request->id, [
            'price_at_purchase' => $course->price,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $num_of_product = auth()->user()->coursesInCart()->count();

        return response()->json([
            'num_of_product' => $num_of_product,
            'message' => 'Course added to cart successfully',
            'already_added' => false
        ]);
    }

    public function removeOne(Course $course)
    {
        auth()->user()->coursesInCart()->detach($course->id);
        return redirect()->back();
    }
}
