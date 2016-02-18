<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateShiftRequest;
use App\Http\Requests\UpdateShiftRequest;
use App\Repositories\UserRepository;
use App\Repositories\ShiftRepository;
use App\Repositories\RoleRepository;
use App\Repositories\VenueRepository;
use Illuminate\Http\Request;
use Flash;
use InfyOm\Generator\Controller\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ShiftController extends AppBaseController
{
	/** @var  ShiftRepository */
	private $shiftRepository;
	private $roleRepository;
	private $venueRepository;
	private $userRepository;

	function __construct(ShiftRepository $shiftRepo, RoleRepository $roleRepo, VenueRepository $venueRepo, UserRepository $userRepo)
	{
		$this->shiftRepository = $shiftRepo;
		$this->roleRepository  = $roleRepo;
		$this->venueRepository = $venueRepo;
		$this->userRepository  = $userRepo;
	}

	/**
	 * Display a listing of the Shift.
	 *
     * @param Request $request
	 * @return Response
	 */
    public function index(Request $request)
	{
        $this->shiftRepository->pushCriteria(new RequestCriteria($request));
		$shifts = $this->shiftRepository->all();

		// $roles = $this->roleRepository->all();
		// $venues = $this->venueRepository->all();

		return view('shifts.index')
			->with(array(
				'shifts' => $shifts,
			))
		;
	}

	/**
	 * Show the form for creating a new Shift.
	 *
	 * @return Response
	 */
	public function create()
	{
		$roles  = $this->roleRepository->all();
		$venues = $this->venueRepository->all();
		$users  = $this->userRepository->all();

		return view('shifts.create')
			->with(array(
				'roles'  => $roles,
				'venues' => $venues,
				'users'  => $users,
			))
		;
	}

	/**
	 * Store a newly created Shift in storage.
	 *
	 * @param CreateShiftRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateShiftRequest $request)
	{
		$input = $request->all();

		$shift = $this->shiftRepository->create($input);

		Flash::success('Shift saved successfully.');

		return redirect(route('shifts.index'));
	}

	/**
	 * Display the specified Shift.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$shift = $this->shiftRepository->findWithoutFail($id);

		if (empty($shift)) {
			Flash::error('Shift not found');

			return redirect(route('shifts.index'));
		}

		return view('shifts.show')->with('shift', $shift);
	}

	/**
	 * Show the form for editing the specified Shift.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$shift = $this->shiftRepository->findWithoutFail($id);

		$roles  = $this->roleRepository->all();
		$venues = $this->venueRepository->all();
		$users  = $this->userRepository->all();

		if (empty($shift)) {
			Flash::error('Shift not found');

			return redirect(route('shifts.index'));
		}

		return view('shifts.edit')
			->with(array(
				'roles'  => $roles,
				'venues' => $venues,
				'users'  => $users,
				'shift'  => $shift,
			))
		;
	}

	/**
	 * Update the specified Shift in storage.
	 *
	 * @param  int              $id
	 * @param UpdateShiftRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateShiftRequest $request)
	{
		$shift = $this->shiftRepository->findWithoutFail($id);

		if (empty($shift)) {
			Flash::error('Shift not found');

			return redirect(route('shifts.index'));
		}

		$shift = $this->shiftRepository->update($request->all(), $id);

		Flash::success('Shift updated successfully.');

		return redirect(route('shifts.index'));
	}

	/**
	 * Remove the specified Shift from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$shift = $this->shiftRepository->findWithoutFail($id);

		if (empty($shift)) {
			Flash::error('Shift not found');

			return redirect(route('shifts.index'));
		}

		$this->shiftRepository->delete($id);

		Flash::success('Shift deleted successfully.');

		return redirect(route('shifts.index'));
	}
}
