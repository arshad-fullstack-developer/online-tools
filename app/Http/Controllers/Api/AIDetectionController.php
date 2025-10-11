<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIDetectionController extends Controller
{
    /**
     * Detect if content is AI-generated using multiple premium APIs
     */
    public function detectAIContent(Request $request)
    {
        $request->validate([
            'text' => 'required|string|min:100'
        ]);

        $text = $request->input('text');

        // Try ZeroGPT API first (most accurate - your API key)
        $result = $this->tryZeroGPT($text);
        if ($result) return $result;

        // Try GPTZero API
        $result = $this->tryGPTZero($text);
        if ($result) return $result;

        // Try Originality.ai API
        $result = $this->tryOriginalityAI($text);
        if ($result) return $result;

        // Try Winston AI API
        $result = $this->tryWinstonAI($text);
        if ($result) return $result;

        // Fallback to improved local algorithm
        return $this->fallbackDetection($text);
    }

    /**
     * Try ZeroGPT API (Your API Key)
     */
    private function tryZeroGPT($text)
    {
        try {
            $apiKey = env('ZEROGPT_API_KEY');
            if (!$apiKey) return null;

            // ZeroGPT API endpoint and format
            $response = Http::timeout(30)
                ->withHeaders([
                    'ApiKey' => $apiKey,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ])
                ->post('https://api.zerogpt.com/api/detect/detectText', [
                    'input_text' => $text
                ]);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('ZeroGPT Response:', $data);
                
                // ZeroGPT returns various formats, handle all
                $aiScore = null;
                
                // Format 1: data.fakePercentage
                if (isset($data['data']['fakePercentage'])) {
                    $aiScore = floatval($data['data']['fakePercentage']);
                }
                // Format 2: data.isHuman (boolean)
                elseif (isset($data['data']['isHuman'])) {
                    $aiScore = $data['data']['isHuman'] ? 0 : 100;
                }
                // Format 3: Direct fakePercentage
                elseif (isset($data['fakePercentage'])) {
                    $aiScore = floatval($data['fakePercentage']);
                }
                // Format 4: ai_percentage
                elseif (isset($data['ai_percentage'])) {
                    $aiScore = floatval($data['ai_percentage']);
                }
                // Format 5: score
                elseif (isset($data['score'])) {
                    $aiScore = floatval($data['score']);
                }

                if ($aiScore !== null) {
                    return response()->json([
                        'success' => true,
                        'ai_probability' => round($aiScore),
                        'human_probability' => round(100 - $aiScore),
                        'source' => 'ZeroGPT API (Official)',
                        'raw_data' => $data // For debugging
                    ]);
                }
            } else {
                Log::error('ZeroGPT API Error: ' . $response->status() . ' - ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('ZeroGPT API Exception: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Try GPTZero API (Industry Leader)
     */
    private function tryGPTZero($text)
    {
        try {
            $apiKey = env('GPTZERO_API_KEY');
            if (!$apiKey) return null;

            $response = Http::timeout(20)
                ->withHeaders([
                    'x-api-key' => $apiKey,
                    'Content-Type' => 'application/json'
                ])
                ->post('https://api.gptzero.me/v2/predict/text', [
                    'document' => $text
                ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // GPTZero returns completely_generated_prob (0-1)
                $aiScore = isset($data['documents'][0]['completely_generated_prob']) 
                    ? $data['documents'][0]['completely_generated_prob'] * 100 
                    : null;

                if ($aiScore !== null) {
                    return response()->json([
                        'success' => true,
                        'ai_probability' => round($aiScore),
                        'human_probability' => round(100 - $aiScore),
                        'source' => 'GPTZero API (Premium)'
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::warning('GPTZero API failed: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Try Originality.ai API
     */
    private function tryOriginalityAI($text)
    {
        try {
            $apiKey = env('ORIGINALITY_API_KEY');
            if (!$apiKey) return null;

            $response = Http::timeout(20)
                ->withHeaders([
                    'X-OAI-API-KEY' => $apiKey,
                    'Accept' => 'application/json'
                ])
                ->post('https://api.originality.ai/api/v1/scan/ai', [
                    'content' => $text
                ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // Originality returns ai score (0-1)
                $aiScore = isset($data['score']['ai']) ? $data['score']['ai'] * 100 : null;

                if ($aiScore !== null) {
                    return response()->json([
                        'success' => true,
                        'ai_probability' => round($aiScore),
                        'human_probability' => round(100 - $aiScore),
                        'source' => 'Originality.ai API (Premium)'
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::warning('Originality.ai API failed: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Try Winston AI API
     */
    private function tryWinstonAI($text)
    {
        try {
            $apiKey = env('WINSTON_API_KEY');
            if (!$apiKey) return null;

            $response = Http::timeout(20)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json'
                ])
                ->post('https://api.gowinston.ai/v1/detect', [
                    'text' => $text,
                    'language' => 'en'
                ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // Winston returns ai_score (0-100)
                $aiScore = isset($data['ai_score']) ? $data['ai_score'] : null;

                if ($aiScore !== null) {
                    return response()->json([
                        'success' => true,
                        'ai_probability' => round($aiScore),
                        'human_probability' => round(100 - $aiScore),
                        'source' => 'Winston AI API (Premium)'
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::warning('Winston AI API failed: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Fallback detection using local algorithm
     */
    private function fallbackDetection($text)
    {
        // Simple but effective local detection
        $sentences = preg_split('/[.!?]+/', $text, -1, PREG_SPLIT_NO_EMPTY);
        $words = str_word_count(strtolower($text), 1);
        
        $score = 50; // Start neutral
        
        // Check for human markers
        $humanMarkers = 0;
        
        // Personal pronouns
        if (preg_match_all('/\b(I|me|my|we|our|you|your)\b/i', $text)) {
            $humanMarkers += 20;
        }
        
        // Contractions
        if (preg_match_all('/\b(don\'t|can\'t|won\'t|it\'s|that\'s|I\'m|we\'re)\b/i', $text)) {
            $humanMarkers += 15;
        }
        
        // Questions
        if (substr_count($text, '?') > 0) {
            $humanMarkers += 10;
        }
        
        // Exclamations
        if (substr_count($text, '!') > 0) {
            $humanMarkers += 8;
        }
        
        // Emotional words
        if (preg_match_all('/\b(love|hate|believe|feel|think|trust|amazing|terrible)\b/i', $text)) {
            $humanMarkers += 12;
        }
        
        // Calculate sentence length variance (AI has low variance)
        if (count($sentences) > 2) {
            $lengths = array_map(function($s) {
                return str_word_count($s);
            }, $sentences);
            
            $mean = array_sum($lengths) / count($lengths);
            $variance = 0;
            foreach ($lengths as $length) {
                $variance += pow($length - $mean, 2);
            }
            $variance = $variance / count($lengths);
            $stdDev = sqrt($variance);
            
            // Low std dev = AI-like
            if ($stdDev < 3) {
                $score += 25;
            } elseif ($stdDev < 5) {
                $score += 15;
            } elseif ($stdDev > 10) {
                $humanMarkers += 15;
            }
        }
        
        // Apply human markers
        $aiProbability = max(0, min(100, $score - $humanMarkers));
        
        return response()->json([
            'success' => true,
            'ai_probability' => round($aiProbability),
            'human_probability' => round(100 - $aiProbability),
            'source' => 'Local Algorithm (Fallback)'
        ]);
    }
}
