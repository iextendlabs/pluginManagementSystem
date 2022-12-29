<?php
    
namespace App\Http\Controllers;

use App\Models\Extension;
use App\Models\Plan;
use App\Models\PlanComment;
use App\Models\PlanPriority;
use App\Models\PlanStatuses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr;

class PlanController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:plan-list|plan-create|plan-edit|plan-delete', ['only' => ['index','show']]);
         $this->middleware('permission:plan-create', ['only' => ['create','store']]);
         $this->middleware('permission:plan-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:plan-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Plan::select
            (
                "plans.id", 
                "plans.title", 
                "extensions.title as extension",
                "plan_statuses.title as status"
            )
        ->leftJoin("plan_statuses", "plan_statuses.id", "=", "plans.statusId")
        ->leftJoin("extensions", "extensions.id", "=", "plans.extensionId");
        if(Auth::user()->id != 1){
            $query->where('plans.assigneeId',Auth::user()->id);
        }
        $plans = $query->orderBy('plans.created_at','DESC')->paginate(5);
        return view('plans.index',compact('plans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = PlanStatuses::all();
        $extensions = Extension::all();
        $users = User::all();
        $priorities = PlanPriority::all();
        return view('plans.create',compact('statuses','extensions','users','priorities'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'extensionId' => 'required',
            'description' => 'required',
            'statusId' => 'required',
            'assigneeId' => 'required',
            'priorityId' => 'required',
            'dueDate' => 'required',
            'spendHours' => 'required',
        ]);
        $extension = Extension::find($request->extensionId);
        $extension->statusId = 2;
        $extension->save();
        Plan::create($request->all());
        
        return redirect()->route('plans.index')
                        ->with('success','Plan created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        $status = PlanStatuses::find($plan->statusId);
        $extension = Extension::find($plan->extensionId);
        $assignee = User::find($plan->assigneeId);
        $priority = PlanPriority::find($plan->priorityId);

        return view('plans.show',compact('plan','status','extension','assignee','priority'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        $statuses = PlanStatuses::all();
        $extensions = Extension::all();
        $users = User::all();
        $priorities = PlanPriority::all();
        
        return view('plans.edit',compact('plan','statuses','extensions','users','priorities'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        request()->validate([
            'title' => 'required',
            'extensionId' => 'required',
            'description' => 'required',
            'statusId' => 'required',
            'assigneeId' => 'required',
            'priorityId' => 'required',
            'dueDate' => 'required',
            'spendHours' => 'required',
        ]);
    
        $plan->update($request->all());
    
        return redirect()->route('plans.index')
                        ->with('success','Plan updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        PlanComment::where('planId',$plan->id)->delete();
        $plan->delete();
    
        return redirect()->route('plans.index')
                        ->with('success','Plan deleted successfully');
    }

    public function commentSystem($id)
    {
        $plan = Plan::find($id);
        $comments = PlanComment::leftJoin("users", "users.id", "=", "plan_comments.userId")
        ->where('planId',$id)->orderBy('plan_comments.created_at','DESC')->get();

        return view('plans.comment',compact('plan','comments'));
    }

    public function sendComment(Request $request)
    {
        request()->validate([
            'body' => 'required',
            'userId' => 'required',
            'planId' => 'required'
        ]);

        PlanComment::create($request->all());
        
        return redirect()->back()
                        ->with('success','Comment successfully send.');
    }
}