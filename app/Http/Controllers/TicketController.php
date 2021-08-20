<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreationUpdatePost;
use App\Models\ticket;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = ticket::latest()->paginate();

        return view('admin.tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('admin.tickets.create');
    }

    public function creation(CreationUpdatePost $request)
    {
        $data = $request->all();
        //upload de arquivos
        if($request->image->isValid())
        {
            $nameFile = Str::of($request->title)->slug('-') . '.' .$request->image->getClientOriginalExtension(); //nome do arquivo da imagem

            $image = $request->image->storeAs('tickets', $nameFile); //cria a pasta posts e vai incluindo as imagens
            $data['image'] = $image; //pegando a imagem
        }

        ticket::create($data); //insere automaticamente todos os campos

        return redirect() 
            ->route('tickets.index')
            ->with('message', 'Ticket criado com sucesso!');
    }

    public function show($id)
    {
        if (!$ticket = ticket::find($id))
        {
            return redirect()->route('tickets.index');
        }

        return view('admin.tickets.show', compact('ticket'));
    }

    public function destroy($id)
    {
        if(!$ticket = ticket::find($id))
        {
            return redirect()->route('tickets.index');
        }

        if(Storage::exists($ticket->image))
        {
            Storage::delete($ticket->image);
        }

        $ticket->delete(); //deleta o ticket

        return redirect()
            ->route('tickets.index')
            ->with('message', 'Ticket apagado com sucesso!');
    }

    public function edit($id)
    {
        if(!$ticket = ticket::find($id))
        {
            return redirect()->route('tickets.index');
        }

        return view('admin.tickets.edit', compact('ticket'));
    }

    public function update(CreationUpdatePost $request, $id)
    {
        if(!$ticket = ticket::find($id))
        {
            return redirect()->back();
        }

        $data = $request->all();

        $ticket->update($data);

        return redirect()
            ->route('tickets.index')
            ->with('message', 'Ticket atualizado com sucesso!');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $tickets = ticket::where('title', 'LIKE', "%{$request->search}%")
                            ->orWhere('category', 'LIKE', "%{$request->search}%")
                            ->orWhere('urgency', 'LIKE', "%{$request->search}%")
                            ->orWhere('status', 'LIKE', "%{$request->search}%")
                            ->paginate();

        return view('admin.tickets.index', compact('tickets'));
    }

    public function statistics()
    {
        $worksId = "5f0468a0060ecb299fb5f16b";
        $userId = "5efb6eb4d3dcea59533b428e";

        $response = Http::withHeaders([
            'X-Api-Key' => 'ZGRiYWZjMWEtMDYxZC00YzUzLWJiMDQtMTNlN2JhYTVjODFh',
            'Accept' => 'application/json'
        ])->GET("https://api.clockify.me/api/v1/workspaces/{$worksId}/user/{$userId}/time-entries");

        $response->json();
        $json = json_decode($response);
        
        $descricao = array_column($json, 'description');
        $time = array_column($json,'timeInterval', 'duration');

        return view('admin.tickets.statistics', compact('descricao', 'time'));
    }

    public function start(Request $request)
    {
        $worksId = "5f0468a0060ecb299fb5f16b";
        $initialDate = $request->input('initialDate');
        $initialTime = $request->input('initialTime');
        $finalDate = $request->input('finalDate');
        $finalTime = $request->input('finalTime');
        $description = $request->input('description');

        $response = Http::withHeaders([
            'X-Api-Key' => 'ZGRiYWZjMWEtMDYxZC00YzUzLWJiMDQtMTNlN2JhYTVjODFh',
            'Accept' => 'application/json'
        ])->POST("https://api.clockify.me/api/v1/workspaces/{$worksId}/time-entries",[
                "start" => "{$initialDate}T{$initialTime}:00.000Z",
                "billable" => "true",
                "description" => "{$description}",
                "projectId" => null,
                "taskId" => null,
                "end" => "{$finalDate}T{$finalTime}:00.000Z"
        ]);

        $response->json();
        $json = json_decode($response);

        return redirect()
            ->route('tickets.index')
            ->with('message', 'Horas adicionadas ao clockify com sucesso!');

    }
}
