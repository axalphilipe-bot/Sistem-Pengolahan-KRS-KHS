<?php

namespace App\Console\Commands;

use App\Services\DemoSidangPreparationService;
use App\Services\DemoSidangVerificationService;
use App\Support\DemoConfig;
use Illuminate\Console\Command;

class PrepareDemoSidangCommand extends Command
{
    protected $signature = 'demo:prepare';

    protected $description = 'Siapkan database ke kondisi demo sidang (reset demo user, seeder selesai)';

    public function __construct(
        private readonly DemoSidangPreparationService $preparationService,
        private readonly DemoSidangVerificationService $verificationService,
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $this->components->info('Demo Sidang Preparation');
        $this->line('Scope : '.DemoConfig::TOTAL_MHS.' mahasiswa '
            .DemoConfig::KODE_PRODI.' '.DemoConfig::KELAS_HURUF.' '.DemoConfig::KELAS);
        $this->line('Demo user : '.DemoConfig::NIM_MHS_LOGIN);
        $this->line('Mata kuliah : '.implode(', ', DemoConfig::MATA_KULIAH_DEMO));
        $this->newLine();

        try {
            $this->components->task('Menyiapkan data demo sidang', function () {
                $this->preparationService->prepare();

                return true;
            });
        } catch (\Throwable $exception) {
            $this->newLine();
            $this->components->error('FAILED — Persiapan dibatalkan (rollback).');
            $this->line($exception->getMessage());

            return self::FAILURE;
        }

        $this->newLine();
        $this->components->info('Verifikasi');

        $result = $this->verificationService->verify();

        foreach ($result->checks as $check) {
            $icon = $check['passed'] ? '<fg=green>✓</>' : '<fg=red>✗</>';
            $this->line("  {$icon} {$check['label']}");
            $this->line("      expected: {$check['expected']} | actual: {$check['actual']}");
        }

        $this->newLine();

        if ($result->passed) {
            $this->components->info('READY — Database siap untuk demo sidang.');

            return self::SUCCESS;
        }

        $this->components->error('FAILED — Database belum memenuhi kondisi demo sidang.');

        if ($result->failedStudents !== []) {
            $this->newLine();
            $this->line('Mahasiswa seeder bermasalah:');

            foreach ($result->failedStudents as $student) {
                $this->line("  - {$student['nim']}: ".implode('; ', $student['issues']));
            }
        }

        return self::FAILURE;
    }
}
