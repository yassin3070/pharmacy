<?php

namespace App\Requests\Api\Orders;

use App\Models\OrderItem;
use App\Requests\ApiMasterRequest;

class UploadRecipeRequest extends ApiMasterRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $orderItemId = $this->route('order_item_id');
        $item = OrderItem::find($orderItemId);
        if(user()->id != $item->user_id){
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'recipe'=> 'required|file|mimes:jpeg,jpg,png,gif'
        ];
    }


}
