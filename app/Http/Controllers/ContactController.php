<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    /**
     * Handle contact form submission
     */
    public function submit(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'required|string|max:255',
                'message' => 'required|string|max:5000',
            ]);

            // Log the attempt
            Log::info('Contact form submission attempt', $validated);

            // Send email to admin
            Mail::to('contact@toolxin.com')->send(new ContactFormMail($validated));

            Log::info('Contact form email sent successfully');

            return response()->json([
                'success' => true,
                'message' => 'Thank you for contacting us! We will get back to you within 24 hours.'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Contact form validation error', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Please check your form fields.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Contact form error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
