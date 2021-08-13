<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreationUpdatePost;
use App\Models\ticket;
use App\Models\User;
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
}
