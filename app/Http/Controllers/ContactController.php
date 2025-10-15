<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
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

            // Save to database
            DB::table('contact_submissions')->insert([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Try to send email, but don't fail if it doesn't work
            try {
                Mail::to('contact@toolxin.com')->send(new ContactFormMail($validated));
                Log::info('Contact form email sent successfully');
            } catch (\Exception $mailError) {
                // Log the error but don't fail the request
                Log::warning('Contact form email failed, but submission saved', [
                    'error' => $mailError->getMessage()
                ]);
            }

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
                'message' => 'There was an error submitting your message. Please try again.'
            ], 500);
        }
    }
}
