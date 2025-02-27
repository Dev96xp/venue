<?php

namespace App\Http\Controllers\Pages\Ai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class AiController extends Controller
{
    public function index()
    {
        return view('pages.openai.index');
    }

    public function make_request(Request $request)
    {

        // VALIDA - Que sea un campo unico en la tabla categories
        $request->validate([
            'message' => 'required',
        ]);

        // Metodo 2
        // $result = OpenAI::chat()->create([
        //     'max_tokens' => 100,
        //     'model' => 'gpt-3.5-turbo',
        //     'messages' => [
        //         ['role' => 'user', 'content' => $request->post('message')],
        //     ],
        // ]);

        // $response = array_reduce(
        //     $result->toArray()['choices'],
        //     fn(string $result, array $choice) => $result . $choice['text'],
        //     ""
        // );
        // dd($response);

        // Metodo 1
        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $request->post('message')],
            ],
        ]);



        // dd($result->choices[0]->message->content);

        return $result->choices[0]->message->content; // Hello! How can I assist you today?
    }

    
}
