<?php

namespace App\Http\Controllers;

use App\Mail\Welcomeemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function contactForm()
    {
        return view('contact-form');
    }
    public function sendContactEmail(Request $r)
    {
        $r->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',

            'attachment1' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'attachment2' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'attachment3' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'attachment4' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'attachment5' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        $fileName1 = null;
        $fileName2 = null;
        $fileName3 = null;
        $fileName4 = null;
        $fileName5 = null;

        foreach (range(1, 5) as $i) {
            $field = 'attachment' . $i;

            if ($r->hasFile($field)) {
                $file = $r->file($field);

                $fileName = time() . '_' . uniqid()
                    . '.' . $file->extension();

                $file->move(public_path('uploads'), $fileName);

                ${'fileName' . $i} = $fileName;
            }
        }



        $adminEmail = 'cklaha1947@gmail.com';
        try {
            Mail::to($adminEmail)->queue(
                new Welcomeemail(
                    $r->only(['name', 'email', 'subject', 'message']),
                    $fileName1,
                    $fileName2,
                    $fileName3,
                    $fileName4,
                    $fileName5
                )
            );

            return response()->json([
                'success' => true,
                'message' => 'Email queued successfully!'
            ], 200);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Failed to queue email.'
            ], 500);
        }
    }
}
