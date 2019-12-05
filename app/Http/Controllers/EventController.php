<?php

namespace Calendar\Http\Controllers;

use Illuminate\Http\Request;

use Calendar\Http\Requests;
use Calendar\Http\Controllers\Controller;

use Calendar\Repositories\EventRepository;
use Calendar\Event;

//use DB;
class EventController extends Controller
{
     /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $events;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EventRepository $events)
    {
        $this->middleware('auth');

        $this->events = $events;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        //method 1
        /*
        //$events = Event::where('user_id', $request->user()->id)->orderBy('event_date','desc')->get();
        $events = $request->user()->events->sortByDesc('event_date');
        //$events = User::with('events')->get();

        *///echo $this->events->forUser($request->user())->toJson(); exit;

        //dd($this->events->forUser($request->user()));
         return view('calendar.events.index',[
            'events'=> $this->events->forUser($request->user()),
            'eventsJSON' => $this->events->forUser($request->user())->toJson()
            ]); 

        
    }

    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'event' => 'required|max:255',
            'event_date' => 'required|date',
        ]);

        /* basic task alternate method */
        /*
        $validator = Validator::make($request->all(), [
                                    'name' => 'required|max:255',
                                    ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        */

        // Create The Task...
        //DB::enableQueryLog();
        $request->user()->events()->create([
            'event' => $request->event,
            'event_date' => $request->event_date,
            ]); 

        //dd(DB::getQueryLog());

        return redirect('/events');    
    }

    /**
     * Destroy the given event.
     *
     * @param  Request  $request
     * @param  Event  $event
     * @return Response
     */
    public function destroy(Request $request, Event $event)
    {
        $this->authorize('destroy', $event);

        $event->delete();

        return redirect('/events');
    }

}
