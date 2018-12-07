<?php

namespace App\Http\Controllers\Backend\Test99;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Backend\Test99\CreateTest99;
use App\Http\Requests\Backend\Test99\UpdateTest99;
use App\Repositories\Backend\Test99Repository;
use App\Events\Backend\Test99\Test99Created;
use App\Events\Backend\Test99\Test99Updated;
use App\Events\Backend\Test99\Test99Deleted;
use Prettus\Repository\Criteria\RequestCriteria;
//use XLabTechs\AdminListing\Facades\AdminListing;
use App\Models\Test99;

class Test99Controller extends Controller
{
    /** @var test99Repository */
    private $test99Repository;

    public function __construct(Test99Repository $test99Repo)
    {
        $this->test99Repository = $test99Repo;
    }

    /**
     * Display a listing of the Test99.
     *
     * @param  Request $request
     * @return Response | \Illuminate\View\View|Response
     */

    public function index(Request $request)
    {
        $this->test99Repository->pushCriteria(new RequestCriteria($request));
        $data = $this->test99Repository->paginate(25);

        return view('backend.test99s.index')->with('test99s', $data);
    }

    /**
     * Show the form for creating a new Test99.
     *
     * @return Response | \Illuminate\View\View|Response
     */
    public function create()
    {
        return view('backend.test99s.create');
    }

    /**
     * Store a newly created Test99 in storage.
     *
     * @param CreateTest99Request $request
     *
     * @return Response | \Illuminate\View\View|Response
     */
    public function store(CreateTest99 $request)
    {
        $obj = $this->test99Repository->create(
            $request->only(["name", "status"])
        );

        event(new Test99Created($obj));
        return redirect()
            ->route('admin.test99.index')
            ->withFlashSuccess(__('alerts.frontend.test99.saved'));
    }

    /**
     * Display the specified Test99.
     *
     * @param Test99 $test99
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     *
     */
    public function show(Test99 $test99)
    {
        return view('backend.test99s.show')->with('test99', $test99);
    }

    /**
     * Show the form for editing the specified Test99.
     *
     * @param Test99 $test99
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     *
     */
    public function edit(Test99 $test99)
    {
        return view('backend.test99s.edit')->with('test99', $test99);
    }

    /**
     * Update the specified Test99 in storage.
     *
     * @param UpdateTest99Request $request
     *
     * @param Test99 $test99
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     */
    public function update(UpdateTest99 $request, Test99 $test99)
    {
        $obj = $this->test99Repository->update($test99, $request->all());

        event(new Test99Updated($obj));
        return redirect()
            ->route('admin.test99.index')
            ->withFlashSuccess(__('alerts.frontend.test99.updated'));
    }

    /**
     * Remove the specified Test99 from storage.
     *
     * @param Test99 $test99
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     *
     */
    public function destroy(Test99 $test99)
    {
        $obj = $this->test99Repository->delete($test99);
        event(new Test99Deleted($obj));
        return redirect()
            ->back()
            ->withFlashSuccess(__('alerts.frontend.test99.deleted'));
    }
}
