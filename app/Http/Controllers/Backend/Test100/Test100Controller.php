<?php

namespace App\Http\Controllers\Backend\Test100;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Backend\Test100\CreateTest100;
use App\Http\Requests\Backend\Test100\UpdateTest100;
use App\Repositories\Backend\Test100Repository;
use App\Events\Backend\Test100\Test100Created;
use App\Events\Backend\Test100\Test100Updated;
use App\Events\Backend\Test100\Test100Deleted;
use Prettus\Repository\Criteria\RequestCriteria;
//use XLabTechs\AdminListing\Facades\AdminListing;
use App\Models\Test100;

class Test100Controller extends Controller
{
    /** @var test100Repository */
    private $test100Repository;

    public function __construct(Test100Repository $test100Repo)
    {
        $this->test100Repository = $test100Repo;
    }

    /**
     * Display a listing of the Test100.
     *
     * @param  Request $request
     * @return Response | \Illuminate\View\View|Response
     */

    public function index(Request $request)
    {
        $this->test100Repository->pushCriteria(new RequestCriteria($request));
        $data = $this->test100Repository->paginate(25);

        return view('backend.test100s.index')->with('test100s', $data);
    }

    /**
     * Show the form for creating a new Test100.
     *
     * @return Response | \Illuminate\View\View|Response
     */
    public function create()
    {
        return view('backend.test100s.create');
    }

    /**
     * Store a newly created Test100 in storage.
     *
     * @param CreateTest100Request $request
     *
     * @return Response | \Illuminate\View\View|Response
     */
    public function store(CreateTest100 $request)
    {
        $obj = $this->test100Repository->create(
            $request->only(["name", "status"])
        );

        event(new Test100Created($obj));
        return redirect()
            ->route('admin.test100.index')
            ->withFlashSuccess(__('alerts.frontend.test100.saved'));
    }

    /**
     * Display the specified Test100.
     *
     * @param Test100 $test100
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     *
     */
    public function show(Test100 $test100)
    {
        return view('backend.test100s.show')->with('test100', $test100);
    }

    /**
     * Show the form for editing the specified Test100.
     *
     * @param Test100 $test100
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     *
     */
    public function edit(Test100 $test100)
    {
        return view('backend.test100s.edit')->with('test100', $test100);
    }

    /**
     * Update the specified Test100 in storage.
     *
     * @param UpdateTest100Request $request
     *
     * @param Test100 $test100
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     */
    public function update(UpdateTest100 $request, Test100 $test100)
    {
        $obj = $this->test100Repository->update($test100, $request->all());

        event(new Test100Updated($obj));
        return redirect()
            ->route('admin.test100.index')
            ->withFlashSuccess(__('alerts.frontend.test100.updated'));
    }

    /**
     * Remove the specified Test100 from storage.
     *
     * @param Test100 $test100
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     *
     */
    public function destroy(Test100 $test100)
    {
        $obj = $this->test100Repository->delete($test100);
        event(new Test100Deleted($obj));
        return redirect()
            ->back()
            ->withFlashSuccess(__('alerts.frontend.test100.deleted'));
    }
}
