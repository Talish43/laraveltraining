<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Notifications\TicketUpdatedNotification;
class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $tickets = $user->isAdmin ? Ticket::paginate(5) : $user->tickets;
        return view('ticket.index', [
            'tickets' =>$tickets,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'user_id'=>auth()->id(),
        ]);
        if($request->file('attachment')){
            $ext = $request->file('attachment')->extension();
            $contents = file_get_contents($request->file('attachment'));
            $filename = Str::random(25);
            $path = "attachments/".$filename.".".$ext;
            Storage::disk('public')->put($path,$contents);
            $ticket->update(['attachment'=>$path]);
        }

        return response()->redirectToRoute('ticket.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('ticket.show', [
            'ticket' =>$ticket,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('ticket.edit', [
            'ticket' =>$ticket,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];
        if ($request->has('status')) {
            $data['status'] = $request->status;
        }
        $ticket->update($data);
        if ($request->has('status')) {
            $user = $ticket->user;
            $user->notify(new TicketUpdatedNotification($ticket));
        }
        return response()->redirectToRoute('ticket.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $deleteTicket = Ticket::find($ticket->id);
        $deleteTicket->delete();
        return response()->redirectToRoute('ticket.index');
    }
}
