<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeedbackResource;
use App\Http\Resources\PaginatedResource;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
class FeedbackController extends Controller
{
    public function save_feedback(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];

        $data = json_decode($request->data);

        $validator = Validator::make((array) $data, $rules);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'validation_error' => true, 'validation_message' => $validator->errors()]);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $imageUrl = asset('uploads/' . $imageName);

            
            Feedback::create([
                'image_url' => $imageUrl,
                'title' => $data->title,
                'description' => $data->description, 
                'product_id' =>$data->product_id
            ]);

        } else {
            Feedback::create([
                'title' => $data->title,
                'description' => $data->description, 
                'product_id' =>$data->product_id
            ]);
        }
        return response()->json(['error' => false, 'validation_error' => false]);
    }
    public function get_product_feedback(Request $request)
    {
        $product_id=request()->product_id;
        if($product_id)
        {
            $authenticatedUserId=1;
            $feedback=Feedback::Where('product_id',$product_id)
            ->withCount(['likes as is_liked' => function ($query) use ($authenticatedUserId) {
                $query->where('user_id', $authenticatedUserId);
            }])->withCount('likes')->paginate(3);
           
            return response()->json(
                array(
                    'error' => false,
                    'feedback' => $feedback
                    )
                );

        }
    }
    
}
