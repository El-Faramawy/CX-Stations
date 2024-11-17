<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Contact\ContactRequest;
use App\Http\Traits\PaginateTrait;
use App\Models\Contact;

class ContactController extends Controller
{
    use PaginateTrait;

    public function contact_us(ContactRequest $request){
        $data = $request->all();
        $data['user_id'] = user_api()->id();
        $item = Contact::create($data);
        return $this->apiResponse($item,'','simple');
    }

}
