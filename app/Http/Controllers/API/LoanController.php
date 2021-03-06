<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\User;
use App\Repositories\LoanRepository;

class LoanController extends Controller
{
    protected $loanRepo;


    public function __construct(LoanRepository $loanRepo)
    {
        $this->loanRepo = $loanRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = $this->loanRepo->all();

        return response()->json(
            $this->loanRepo->resourceCollection($loans)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {

        // dd($request->all());
                $loan = $this->loanRepo->createLoan($request->all(), $user);

        return response()->json(
            $this->loanRepo->resource($loan)
        );
    }

    /**
     * Display Loan detail
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Loan $loan)
    {
        return response()->json(
            $this->loanRepo->resource($loan)
        );
    }

    /**
     * Display list of loans from specific user
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showByUser(User $user)
    {
        $loans = $this->loanRepo->getByUser($user);

        return response()->json(
            $this->loanRepo->resourceCollection($loans)
        );
    }

     /**
     *Update Status of loans from specific user.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */

    public function loanStatus(Request $request,$user)
    {
    
        $user = $this->loanRepo->update($request->all(), $user);
        return response()->json($this->loanRepo->resource($user));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        $this->loanRepo->delete($loan);
        return response()->json(null, 204);
    }
}
