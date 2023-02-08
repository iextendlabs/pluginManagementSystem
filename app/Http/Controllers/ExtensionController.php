<?php
    
namespace App\Http\Controllers;
    
use App\Models\Extension;
use App\Models\ExtensionStatus;
use Illuminate\Http\Request;
    
class ExtensionController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:extension-list|extension-create|extension-edit|extension-delete', ['only' => ['index','show']]);
         $this->middleware('permission:extension-create', ['only' => ['create','store']]);
         $this->middleware('permission:extension-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:extension-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $extensions = Extension::select
            (
                "extensions.id", 
                "extensions.title", 
                "extensions.marketplaceLink",
                "extensions.driveLink",
                "extension_statuses.title as status"
            )
        ->leftJoin("extension_statuses", "extension_statuses.id", "=", "extensions.statusId")
        ->orderBy('extensions.created_at','DESC')->paginate(5);
        return view('extensions.index',compact('extensions'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = ExtensionStatus::all();
        return view('extensions.create',compact('statuses'));
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
            'marketplaceLink' => 'required',
            'driveLink' => 'required',
            'githubLink' => 'required',
            'statusId' => 'required',
        ]);
    
        Extension::create($request->all());
    
        return redirect()->route('extensions.index')
                        ->with('success','Extension created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Extension  $extension
     * @return \Illuminate\Http\Response
     */
    public function show(Extension $extension)
    {
        $status = ExtensionStatus::find($extension->statusId);

        return view('extensions.show',compact('extension','status'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Extension  $extension
     * @return \Illuminate\Http\Response
     */
    public function edit(Extension $extension)
    {
        $statuses = ExtensionStatus::all();
        return view('extensions.edit',compact('extension','statuses'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Extension  $extension
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Extension $extension)
    {
        request()->validate([
            'title' => 'required',
            'marketplaceLink' => 'required',
            'driveLink' => 'required',
            'githubLink' => 'required',
            'statusId' => 'required',
        ]);
    
        $extension->update($request->all());
    
        return redirect()->route('extensions.index')
                        ->with('success','Extension updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Extension  $extension
     * @return \Illuminate\Http\Response
     */
    public function destroy(Extension $extension)
    {
        $extension->delete();
    
        return redirect()->route('extensions.index')
                        ->with('success','Extension deleted successfully');
    }
}