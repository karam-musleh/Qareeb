<?php

namespace App\Actions\Hub;

use App\Enum\HubStatus;
use App\Events\HubCreated;
use App\Helpers\ImageHelper;
use App\Models\Hub;
use Illuminate\Support\Facades\DB;

class CreateHubAction
{
    public function execute(array $data, int $userId): Hub
    {

        try {
            DB::beginTransaction();
            $data['owner_id'] = $userId;
            $data['status'] = HubStatus::PENDING->value;

            // 1. Create Hub
            $hub = Hub::create($data);

            // 2. Attach services
            if (!empty($data['service_ids'])) {
                $hub->services()->attach($data['service_ids']);
            }

            // 3. Main image
            if (!empty($data['main_image'])) {
                ImageHelper::uploadImage(
                    $hub,
                    $data['main_image'],
                    'hubs/main',
                    'main',
                    'custom'
                );
            }

            // 4. Gallery images


            // 5. Social accounts
            if (!empty($data['social_accounts'])) {
                $hub->hubSocialAccounts()->createMany($data['social_accounts']);
            }
            DB::commit();
            if (!empty($data['gallery'])) {
                foreach ($data['gallery'] as $file) {
                    $path = $file->store('hubs/gallery', 'custom');

                    $hub->images()->create([
                        'path' => $path,
                        'type' => 'gallery',
                    ]);
                }
            }
            // 6.  Load relations
            $hub->load([
                'images',
                'services',
                'location.parent',
                'owner',
                'hubSocialAccounts'
            ]);

            // 7. Event
            event(new HubCreated($hub));

            return $hub;
        } catch (\Exception $e) {
            DB::rollBack();

            // Handle exception (log it, rethrow it, or return a custom error response)
            throw $e; // For now, we just rethrow it
        }
    }
}
