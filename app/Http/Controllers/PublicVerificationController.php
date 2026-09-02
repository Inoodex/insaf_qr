<?php

namespace App\Http\Controllers;

use App\Models\AccountVerification;
use Illuminate\Http\Request;

class PublicVerificationController extends Controller
{
    /**
     * Unified Verification Display (Handles ?ref={uuid} URL parameter)
     */
    public function displayVerificationInfo(Request $request)
    {
        $ref = $request->query('ref');
        if (!$ref) {
            abort(404, 'Verification reference token is missing.');
        }

        // 1. Check if ref matches Certificate UUID
        $certVerification = AccountVerification::where('certificate_uuid', $ref)->first();
        if ($certVerification) {
            return $this->verifyCertificate($ref);
        }

        // 2. Check if ref matches Statement UUID
        $stmtVerification = AccountVerification::where('statement_uuid', $ref)->first();
        if ($stmtVerification) {
            return $this->verifyStatement($ref);
        }

        abort(404, 'Invalid or expired verification QR reference.');
    }

    /**
     * Public Verification Page for Account Certificate
     */
    public function verifyCertificate(string $uuid)
    {
        $verification = AccountVerification::where('certificate_uuid', $uuid)->firstOrFail();

        return view('public.verify_certificate', [
            'certificate' => (object)[
                'account_no' => $verification->account_no,
                'account_name' => $verification->account_name,
                'formatted_balance' => $verification->formatted_certificate_balance,
                'report_date_balance' => $verification->certificate_balance,
                'formatted_generation_date' => $verification->formatted_generation_date,
                'report_generation_date' => $verification->report_generation_date,
                'bank_name' => $verification->bank_name,
                'branch_name' => $verification->branch_name,
                'account_type' => $verification->account_type,
                'currency' => $verification->currency,
                'status' => $verification->status,
                'uuid' => $verification->certificate_uuid,
            ],
            'verification' => $verification,
        ]);
    }

    /**
     * Public Verification Page for Account Statement
     */
    public function verifyStatement(string $uuid)
    {
        $verification = AccountVerification::where('statement_uuid', $uuid)->firstOrFail();

        return view('public.verify_statement', [
            'statement' => (object)[
                'account_no' => $verification->account_no,
                'account_name' => $verification->account_name,
                'formatted_opening_balance' => $verification->formatted_opening_balance,
                'formatted_closing_balance' => $verification->formatted_closing_balance,
                'opening_balance' => $verification->opening_balance,
                'closing_balance' => $verification->closing_balance,
                'formatted_generation_date' => $verification->formatted_generation_date,
                'report_generation_date' => $verification->report_generation_date,
                'bank_name' => $verification->bank_name,
                'branch_name' => $verification->branch_name,
                'account_type' => $verification->account_type,
                'currency' => $verification->currency,
                'status' => $verification->status,
                'uuid' => $verification->statement_uuid,
            ],
            'verification' => $verification,
        ]);
    }
}
