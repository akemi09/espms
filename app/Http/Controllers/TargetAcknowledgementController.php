<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\TargetAcknowledgement;

class TargetAcknowledgementController extends Controller
{
    public function store(Request $request, User $user)
    {
        $data = $request->validate([
            'isAcknowledged' => 'required|accepted',
            'remarks' => 'nullable',
            'signatureDataUrl' => 'required',
        ]);

        $image_parts = explode(";base64,", $data['signatureDataUrl']);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            $imgFile = "/sign_" . uniqid() . '.' .$image_type;
            
            Storage::put('signature\\' . $imgFile, $image_base64);

            TargetAcknowledgement::create([
                'user_id' => auth()->user()->id,
                'target_user_id' => 1,
                'date_time' => now()->format('Y-m-d H:i:s'),
                'remarks' => $data['remarks'],
                'sign_url' => 'signature' . $imgFile,
            ]);

            session()->flash('success', 'Success');

            return redirect()->route('target.approvals.index');
    }
}
