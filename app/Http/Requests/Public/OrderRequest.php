<?php

namespace App\Http\Requests\Public;

use App\Http\Requests\Request;

class OrderRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment_method' => ['required', 'in:Bkash,Rocket,Nagad'],
            'txn_id' => ['required'],
            'amount' => ['required'],
        ];
    }
}
