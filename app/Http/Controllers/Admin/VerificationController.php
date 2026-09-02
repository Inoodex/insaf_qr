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
        // Sanitize comma formatting from numeric balance inputs
        $this->sanitizeBalanceInputs($request);

        $validated = $request->validate([
            'account_no' => 'required|string|max:50|unique:account_verifications,account_no',
            'account_name' => 'required|string|max:255',
            'certificate_balance' => 'required|numeric',
            'opening_balance' => 'required|numeric',
            'closing_balance' => 'required|numeric',
            'report_generation_date' => 'required|date',
            'bank_name' => 'nullable|string|max:255',
            'branch_name' => 'nullable|string|max:255',
            'account_type' => 'nullable|string|max:100',
            'currency' => 'nullable|string|max:10',
        ], [
            'account_no.unique' => 'An account verification with this Account Number already exists. Account numbers must be unique.',
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
        $this->sanitizeBalanceInputs($request);

        $validated = $request->validate([
            'account_no' => [
                'required',
                'string',
                'max:50',
                Rule::unique('account_verifications', 'account_no')->ignore($verification->id),
            ],
            'account_name' => 'required|string|max:255',
            'certificate_balance' => 'required|numeric',
            'opening_balance' => 'required|numeric',
            'closing_balance' => 'required|numeric',
            'report_generation_date' => 'required|date',
            'bank_name' => 'nullable|string|max:255',
            'branch_name' => 'nullable|string|max:255',
            'account_type' => 'nullable|string|max:100',
            'currency' => 'nullable|string|max:10',
        ], [
            'account_no.unique' => 'An account verification with this Account Number already exists. Account numbers must be unique.',
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

    /**
     * Helper to strip commas from currency balance inputs
     */
    private function sanitizeBalanceInputs(Request $request): void
    {
        $fields = ['certificate_balance', 'opening_balance', 'closing_balance'];
        $merges = [];

        foreach ($fields as $field) {
            if ($request->filled($field)) {
                $merges[$field] = str_replace(',', '', $request->input($field));
            }
        }

        if (!empty($merges)) {
            $request->merge($merges);
        }
    }
}
