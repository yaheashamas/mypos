<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClintRequest;
use App\Repositories\ClientRepository;

class ClientController extends Controller
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function index()
    {
        $clients = $this->clientRepository->paginate(5);
        return view('dashboard.clients.index',compact('clients'));
    }

    public function create()
    {
        return view('dashboard.clients.create');
    }

    public function store(ClintRequest $request)
    {
        $this->clientRepository->create($request->toArray());
        session()->flash('success',__('site.message_add'));
        return redirect()->route('dashboard.clients.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $client = $this->clientRepository->getById($id);
        return view('dashboard.clients.edit',compact('client'));
    }

    public function update(ClintRequest $request, $id)
    {
        $this->clientRepository->updateById($id,$request->toArray());
        session()->flash('success',__('site.message_update'));
        return redirect()->route('dashboard.clients.index');
    }

    public function destroy($id)
    {
        $this->clientRepository->deleteById($id);
        session()->flash('success',__('site.message_delete'));
        return redirect()->route('dashboard.clients.index');
    }
}
