<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AccountVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'certificate_uuid',
        'statement_uuid',
        'account_no',
        'account_name',
        'certificate_balance',
        'opening_balance',
        'closing_balance',
        'report_generation_date',
        'currency',
        'bank_name',
        'branch_name',
        'account_type',
        'status',
    ];

    protected $casts = [
        'report_generation_date' => 'date',
        'certificate_balance' => 'decimal:2',
        'opening_balance' => 'decimal:2',
        'closing_balance' => 'decimal:2',
    ];

    /**
     * Generate 4-digit~200-character custom verification ref token
     */
    public static function generateSecureRefToken(): string
    {
        $digits = str_pad((string)random_int(1000, 9999), 4, '0', STR_PAD_LEFT);
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_-';
        $randomStr = '';
        $max = strlen($chars) - 1;
        for ($i = 0; $i < 200; $i++) {
            $randomStr .= $chars[random_int(0, $max)];
        }
        return $digits . '~' . $randomStr;
    }

    protected static function booted()
    {
        static::creating(function ($verification) {
            if (empty($verification->certificate_uuid)) {
                $verification->certificate_uuid = static::generateSecureRefToken();
            }
            if (empty($verification->statement_uuid)) {
                $verification->statement_uuid = static::generateSecureRefToken();
            }
        });
    }

    /**
     * Formatted Balance Accessors (e.g. 150000.00)
     */
    public function getFormattedCertificateBalanceAttribute(): string
    {
        return number_format((float)$this->certificate_balance, 2, '.', '');
    }

    public function getFormattedOpeningBalanceAttribute(): string
    {
        return number_format((float)$this->opening_balance, 2, '.', '');
    }

    public function getFormattedClosingBalanceAttribute(): string
    {
        return number_format((float)$this->closing_balance, 2, '.', '');
    }

    public function getFormattedGenerationDateAttribute(): string
    {
        return $this->report_generation_date ? $this->report_generation_date->format('d M Y') : '';
    }

    /**
     * Public Verification URL Accessors
     */
    public function getCertificateVerificationUrlAttribute(): string
    {
        return url('/ini/certificates-statements/verification-info-display?ref=' . $this->certificate_uuid);
    }

    public function getStatementVerificationUrlAttribute(): string
    {
        return url('/ini/certificates-statements/verification-info-display?ref=' . $this->statement_uuid);
    }

    /**
     * URL QR Payloads
     */
    public function getCertificateQrPayloadAttribute(): string
    {
        return $this->certificate_verification_url;
    }

    public function getStatementQrPayloadAttribute(): string
    {
        return $this->statement_verification_url;
    }
}
