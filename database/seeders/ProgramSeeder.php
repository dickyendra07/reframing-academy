<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\ProgramBatch;
use App\Models\ProgramPrice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Program utama
        |--------------------------------------------------------------------------
        | Di sini kita membuat master program:
        | - CDNP
        | - SPRC
        */

        $cdnp = Program::updateOrCreate(
            ['code' => 'CDNP'],
            [
                'name' => 'Clinical Dry Needling Program',
                'slug' => 'clinical-dry-needling-program',
                'description' => 'Offline certification program by Reframing Physio.',
                'status' => 'published',
            ]
        );

        $sprc = Program::updateOrCreate(
            ['code' => 'SPRC'],
            [
                'name' => 'Sports Physiotherapy Rehabilitation Certification',
                'slug' => 'sports-physiotherapy-rehabilitation-certification',
                'description' => 'Offline certification program by Reframing Physio.',
                'status' => 'published',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 1. CDNP Batch 10 Pontianak
        |--------------------------------------------------------------------------
        */

        $cdnpPontianak = ProgramBatch::updateOrCreate(
            ['slug' => Str::slug('CDNP Batch 10 Pontianak')],
            [
                'program_id' => $cdnp->id,
                'batch_number' => '10',
                'title' => 'CDNP Batch 10 Pontianak',
                'location' => 'Pontianak',
                'venue' => null,
                'start_date' => '2026-08-19',
                'end_date' => '2026-08-20',
                'quota' => null,
                'status' => 'published',
            ]
        );

        $this->syncPrices($cdnpPontianak, [
            [
                'label' => 'Publish Rate',
                'amount' => 6000000,
                'description' => 'Harga normal CDNP Batch 10 Pontianak.',
                'requires_profession' => null,
                'requires_alumni_number' => false,
                'requires_group_name' => false,
            ],
            [
                'label' => 'Dokter',
                'amount' => 5850000,
                'description' => 'Harga khusus dokter.',
                'requires_profession' => 'Dokter',
                'requires_alumni_number' => false,
                'requires_group_name' => false,
            ],
            [
                'label' => 'Fisioterapis',
                'amount' => 5700000,
                'description' => 'Harga khusus fisioterapis.',
                'requires_profession' => 'Fisioterapis',
                'requires_alumni_number' => false,
                'requires_group_name' => false,
            ],
            [
                'label' => 'IFI Pontianak',
                'amount' => 5000000,
                'description' => 'Harga khusus member IFI Pontianak.',
                'requires_profession' => null,
                'requires_alumni_number' => false,
                'requires_group_name' => false,
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | 2. SPRC Bali Batch 2
        |--------------------------------------------------------------------------
        */

        $sprcBali = ProgramBatch::updateOrCreate(
            ['slug' => Str::slug('SPRC Bali Batch 2')],
            [
                'program_id' => $sprc->id,
                'batch_number' => '2',
                'title' => 'SPRC Bali Batch 2',
                'location' => 'Bali',
                'venue' => null,
                'start_date' => '2026-08-22',
                'end_date' => '2026-08-25',
                'quota' => null,
                'status' => 'published',
            ]
        );

        $this->syncPrices($sprcBali, [
            [
                'label' => 'Publish Rate',
                'amount' => 7500000,
                'description' => 'Harga normal SPRC Bali Batch 2.',
                'requires_profession' => null,
                'requires_alumni_number' => false,
                'requires_group_name' => false,
            ],
            [
                'label' => 'Reframing Alumni',
                'amount' => 7250000,
                'description' => 'Harga khusus alumni Reframing.',
                'requires_profession' => null,
                'requires_alumni_number' => true,
                'requires_group_name' => false,
            ],
            [
                'label' => 'Group of 5',
                'amount' => 6900000,
                'description' => 'Harga group minimal 5 peserta. Harga per orang.',
                'requires_profession' => null,
                'requires_alumni_number' => false,
                'requires_group_name' => true,
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | 3. CDNP Bali Batch 11
        |--------------------------------------------------------------------------
        */

        $cdnpBali = ProgramBatch::updateOrCreate(
            ['slug' => Str::slug('CDNP Bali Batch 11')],
            [
                'program_id' => $cdnp->id,
                'batch_number' => '11',
                'title' => 'CDNP Bali Batch 11',
                'location' => 'Bali',
                'venue' => null,
                'start_date' => '2026-08-26',
                'end_date' => '2026-08-27',
                'quota' => null,
                'status' => 'published',
            ]
        );

        $this->syncPrices($cdnpBali, [
            [
                'label' => 'Publish Rate',
                'amount' => 5850000,
                'description' => 'Harga normal CDNP Bali Batch 11.',
                'requires_profession' => null,
                'requires_alumni_number' => false,
                'requires_group_name' => false,
            ],
            [
                'label' => 'Alumni',
                'amount' => 5550000,
                'description' => 'Harga khusus alumni Reframing.',
                'requires_profession' => null,
                'requires_alumni_number' => true,
                'requires_group_name' => false,
            ],
        ]);
    }

    private function syncPrices(ProgramBatch $batch, array $prices): void
    {
        foreach ($prices as $price) {
            ProgramPrice::updateOrCreate(
                [
                    'program_batch_id' => $batch->id,
                    'label' => $price['label'],
                ],
                [
                    'amount' => $price['amount'],
                    'description' => $price['description'],
                    'requires_profession' => $price['requires_profession'],
                    'requires_alumni_number' => $price['requires_alumni_number'],
                    'requires_group_name' => $price['requires_group_name'],
                    'status' => 'active',
                ]
            );
        }
    }
}