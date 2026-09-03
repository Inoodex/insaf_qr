<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountVerification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VerificationController extends Controller
{
    /**
     * Unified Verification Generator & Management (Certificate + Statement)
     */
    public function index(Request $request)
    {
        $verifications = AccountVerification::latest()->get();

        $editId = $request->query('edit');
        $editVerification = $editId ? AccountVerification::find($editId) : null;

        $activeId = $request->query('id', session('active_verification_id'));
        $activeVerification = $activeId ? AccountVerification::find($activeId) : ($editVerification ?? null);

        return view('admin.verifications.index', compact('verifications', 'activeVerification', 'editVerification'));
    }

    /**
     * Store new Unified Verification record and generate both QRs
     */
    public function store(Request $request)
    {
        // No sanitization, keep exact string

        $validated = $request->validate([
            'account_no' => 'required|regex:/^[0-9]+$/|max:50|unique:account_verifications,account_no',
            'account_name' => 'required|regex:/^[a-zA-Z\s\.\,\'\-]+$/|max:255',
            'certificate_balance' => 'required|string',
            'opening_balance' => 'required|string',
            'closing_balance' => 'required|string',
            'report_generation_date' => 'required|date',
            'bank_name' => 'nullable|string|max:255',
            'branch_name' => 'nullable|string|max:255',
            'account_type' => 'nullable|string|max:100',
            'currency' => 'nullable|string|max:10',
        ], [
            'account_no.regex' => 'The Account Number must contain only numbers (digits 0-9).',
            'account_no.unique' => 'An account verification with this Account Number already exists. Account numbers must be unique.',
            'account_name.regex' => 'The Account Name must contain only alphabetic characters and spaces.',
            'certificate_balance.string' => 'The Certificate Report Date Balance must be a valid amount.',
            'opening_balance.string' => 'The Opening Balance must be a valid amount.',
            'closing_balance.string' => 'The Closing Balance must be a valid amount.',
        ]);

        $verification = AccountVerification::create($validated);

        return redirect()->route('admin.verifications.index', ['id' => $verification->id])
            ->with('success', 'Verification record saved and both Certificate & Statement QR codes generated!')
            ->with('active_verification_id', $verification->id);
    }

    /**
     * Update existing Verification record and refresh both QRs
     */
    public function update(Request $request, AccountVerification $verification)
    {
        // No sanitization, keep exact string

        $validated = $request->validate([
            'account_no' => [
                'required',
                'regex:/^[0-9]+$/',
                'max:50',
                Rule::unique('account_verifications', 'account_no')->ignore($verification->id),
            ],
            'account_name' => 'required|regex:/^[a-zA-Z\s\.\,\'\-]+$/|max:255',
            'certificate_balance' => 'required|string',
            'opening_balance' => 'required|string',
            'closing_balance' => 'required|string',
            'report_generation_date' => 'required|date',
            'bank_name' => 'nullable|string|max:255',
            'branch_name' => 'nullable|string|max:255',
            'account_type' => 'nullable|string|max:100',
            'currency' => 'nullable|string|max:10',
        ], [
            'account_no.regex' => 'The Account Number must contain only numbers (digits 0-9).',
            'account_no.unique' => 'An account verification with this Account Number already exists. Account numbers must be unique.',
            'account_name.regex' => 'The Account Name must contain only alphabetic characters and spaces.',
            'certificate_balance.string' => 'The Certificate Report Date Balance must be a valid amount.',
            'opening_balance.string' => 'The Opening Balance must be a valid amount.',
            'closing_balance.string' => 'The Closing Balance must be a valid amount.',
        ]);

        $verification->update($validated);

        return redirect()->route('admin.verifications.index', ['id' => $verification->id])
            ->with('success', 'Verification record updated and both QR codes refreshed!')
            ->with('active_verification_id', $verification->id);
    }

    /**
     * Delete existing Verification record
     */
    public function destroy(AccountVerification $verification)
    {
        $name = $verification->account_name;
        $verification->delete();

        return redirect()->route('admin.verifications.index')
            ->with('success', "Verification record for \"{$name}\" deleted successfully.");
    }

}
