<?php

namespace App\Http\Controllers;

use App\Thread;
use App\ThreadSubscription;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ThreadSubscriptionsController extends Controller
{
    /**
     * ThreadSubscriptionsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $channelId
     * @param Thread $thread
     * @return void
     */
    public function store($channelId, Thread $thread)
    {
        $thread->subscribe();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return void
     */
    public function show(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ThreadSubscription $threadSubscription
     * @return Response
     */
    public function edit(ThreadSubscription $threadSubscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ThreadSubscription $threadSubscription
     * @return Response
     */
    public function update(Request $request, ThreadSubscription $threadSubscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $channelId
     * @param Thread $thread
     * @return Response
     */
    public function destroy($channelId, Thread $thread)
    {
        return $thread->unsubscribe();
    }
}
